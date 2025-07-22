<?php

require_once 'config/database.php';

class Movies
{
    private $db;

    public function __construct() {
        $this->db = db_connect();
    }

    // Show search form and results
    public function index() {
        require 'app/views/movies/search.php';
    }

    // Show details for one movie
    public function show($id) {
        // Query movie from database by ID
        $stmt = $this->db->prepare('SELECT * FROM movies WHERE id = :id');
        $stmt->execute(['id' => $id]);
        $movie = $stmt->fetch();

        if (!$movie) {
            echo "Movie not found";
            exit;
        }

        // Query average rating
        $stmt = $this->db->prepare('SELECT AVG(rating) AS avg_rating FROM ratings WHERE movie_id = :id');
        $stmt->execute(['id' => $id]);
        $avg = $stmt->fetch();
        $avg_rating = $avg['avg_rating'] ?? 0;

        require 'app/views/movies/show.php';
    }

    // Store rating submitted via POST
    public function rate() {
        if (!isset($_POST['movie_id'], $_POST['rating'])) {
            header('Location: /movies');
            exit;
        }

        $movie_id = intval($_POST['movie_id']);
        $rating = intval($_POST['rating']);
        $user = $_SESSION['auth']['username'] ?? 'guest';

        // Insert or update rating by this user
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
