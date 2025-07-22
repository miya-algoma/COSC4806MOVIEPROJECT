<?php
require_once 'config/database.php';

class Movies {
    private $db;

    public function __construct() {
        $this->db = db_connect();
    }

    public function index() {
        // Optional: you can query movies to list here if you store them locally.
        require 'app/views/movies/search.php';
    }

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

        require 'app/views/movies/show.php';
    }

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
