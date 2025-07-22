<?php
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../models/api.php';

class Movies {
    private $db;
    private $omdbApiKey = 'f9f6d42b'; // Your OMDB API key here
    private $api;

    public function __construct() {
        $this->db = db_connect();
        $this->api = new Api();
    }

    // Display search form and results from OMDB if search query exists
    public function index() {
        $results = [];
        if (!empty($_GET['q'])) {
            $search = urlencode($_GET['q']);
            $url = "http://www.omdbapi.com/?apikey={$this->omdbApiKey}&s={$search}";

            $response = file_get_contents($url);
            if ($response !== false) {
                $data = json_decode($response, true);
                if (isset($data['Search'])) {
                    foreach ($data['Search'] as $movie) {
                        // Fetch the full details (with imdbRating)
                        $details = $this->api->getMovieDetails($movie['imdbID']);
                        $movie['imdbRating'] = $details['imdbRating'] ?? 'N/A';
                        $results[] = $movie;
                    }
                }
            }
        }
        require __DIR__ . '/../views/movies/search.php';
    }

    // Show a specific movie details from OMDB and rating info
    public function show($imdbID) {
        // Fetch OMDB details by imdbID (string, like tt0372784)
        $movie = $this->api->getMovieDetails($imdbID);

        if (!$movie || empty($movie['Title'])) {
            echo "Movie not found";
            exit;
        }

        // Get username (or 'guest')
        $user = $_SESSION['auth']['username'] ?? 'guest';

        // Fetch user rating for this movie (if any)
        $stmt = $this->db->prepare('SELECT rating FROM ratings WHERE movie_id = :movie_id AND username = :username');
        $stmt->execute([
            'movie_id' => $imdbID,
            'username' => $user,
        ]);
        $result = $stmt->fetch();
        $user_rating = $result['rating'] ?? null;

        // Fetch average rating for this movie (all users)
        $stmt = $this->db->prepare('SELECT AVG(rating) AS avg_rating, COUNT(*) as rating_count FROM ratings WHERE movie_id = :movie_id');
        $stmt->execute([
            'movie_id' => $imdbID,
        ]);
        $avg = $stmt->fetch();
        $avg_rating = $avg['avg_rating'] ?? null;
        $rating_count = $avg['rating_count'] ?? 0;

        require __DIR__ . '/../views/movies/show.php';
    }

    // Save or update a user rating for a movie
    public function rate() {
        if (!isset($_POST['movie_id'], $_POST['rating'])) {
            header('Location: /movies');
            exit;
        }

        $movie_id = $_POST['movie_id']; // imdbID string (e.g. "tt0372784")
        $rating = intval($_POST['rating']);
        $user = $_SESSION['auth']['username'] ?? 'guest';

        // Ensure valid rating
        if ($rating < 1 || $rating > 5) {
            header('Location: /movies/' . urlencode($movie_id));
            exit;
        }

        $stmt = $this->db->prepare('
            INSERT INTO ratings (movie_id, username, rating) VALUES (:movie_id, :username, :rating)
            ON DUPLICATE KEY UPDATE rating = :rating
        ');

        $stmt->execute([
            'movie_id' => $movie_id,
            'username' => $user,
            'rating' => $rating,
        ]);

        header('Location: /movies/' . urlencode($movie_id));
        exit;
    }
}
