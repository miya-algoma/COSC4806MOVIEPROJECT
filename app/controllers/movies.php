<?php
require_once __DIR__ . '/../../config/database.php';

class Movies {
    private $db;
    private $omdbApiKey = 'f9f6d42b'; // Your OMDB API key here

    public function __construct() {
        $this->db = db_connect();
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
                    $results = $data['Search'];
                }
            }
        }
        require __DIR__ . '/../views/movies/search.php';
    }

    // Show a specific movie details from your database
    public function show($id) {
        $stmt = $this->db->prepare('SELECT * FROM movies WHERE id = :id');
        $stmt->execute(['id' => $id]);
        $movie = $stmt->fetch();

        if (!$movie) {
            echo "Movie not found";
            exit;
        }

        $stmt = $this->db->prepare('SELECT AVG(rating) AS avg_rating FROM ratings WHERE movie_id = :id');
        $stmt->execute(['id' => $id]);
        $avg = $stmt->fetch();
        $avg_rating = $avg['avg_rating'] ?? 0;

        require __DIR__ . '/../views/movies/show.php';
    }

    // Save or update a user rating for a movie
    public function rate() {
        if (!isset($_POST['movie_id'], $_POST['rating'])) {
            header('Location: /movies');
            exit;
        }

        $movie_id = intval($_POST['movie_id']);
        $rating = intval($_POST['rating']);
        $user = $_SESSION['auth']['username'] ?? 'guest';

        $stmt = $this->db->prepare('
            INSERT INTO ratings (movie_id, username, rating) VALUES (:movie_id, :username, :rating)
            ON DUPLICATE KEY UPDATE rating = :rating
        ');

        $stmt->execute([
            'movie_id' => $movie_id,
            'username' => $user,
            'rating' => $rating,
        ]);

        header('Location: /movies/' . $movie_id);
        exit;
    }
}
