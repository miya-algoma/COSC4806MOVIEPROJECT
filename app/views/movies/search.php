<?php require __DIR__ . '/../partials/navbar.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Movie Search</title>
</head>
<body>
    <h1>Search Movies</h1>
    <form method="GET" action="/movies/search">
      <input type="text" name="q" placeholder="Movie title" value="<?= htmlspecialchars($_GET['q'] ?? '') ?>" required />
      <button type="submit">Search</button>
    </form>

    <?php if (!empty($results)): ?>
      <h2>Search Results</h2>
      <ul>
        <?php foreach ($results as $movie): ?>
          <li>
            <a href="/movies/<?= htmlspecialchars($movie['id']) ?>">
              <?= htmlspecialchars($movie['title']) ?> (<?= htmlspecialchars($movie['year']) ?>)
            </a>
          </li>
        <?php endforeach; ?>
      </ul>
    <?php elseif (isset($results)): ?>
      <p>No results found.</p>
    <?php endif; ?>
</body>
</html>
