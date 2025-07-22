<!DOCTYPE html>
<html>
<head>
  <title><?= htmlspecialchars($movie['title']) ?></title>
</head>
<body>
  <?php require __DIR__ . '/../partials/navbar.php'; ?>

  <h1><?= htmlspecialchars($movie['title']) ?></h1>
  <p>Year: <?= htmlspecialchars($movie['year']) ?></p>
  <p>Description: <?= nl2br(htmlspecialchars($movie['description'])) ?></p>

  <p>Average Rating: <?= round($avg_rating, 2) ?></p>

  <form method="POST" action="/movies/rate">
    <input type="hidden" name="movie_id" value="<?= $movie['id'] ?>">
    <label for="rating">Your Rating (1-5):</label>
    <input type="number" name="rating" min="1" max="5" required>
    <button type="submit">Submit Rating</button>
  </form>

  <p><a href="/movies">Back to Movies</a></p>
</body>
</html>
