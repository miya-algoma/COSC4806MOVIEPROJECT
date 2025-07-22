<?php require __DIR__ . '/../partials/navbar.php'; ?>

<!DOCTYPE html>
<html>
<head>
  <title>Search Movies</title>
  <style>
    /* Container to center content */
    .container {
      max-width: 600px;
      margin: 40px auto;
      text-align: center;
      font-family: 'Inter', sans-serif;
    }

    /* Search bar container */
    .search-bar {
      display: flex;
      justify-content: center;
      gap: 8px;
      margin-top: 30px;
    }

    /* Search input */
    .search-bar input[type="text"] {
      flex-grow: 1;
      padding: 14px 20px;
      font-size: 1.4rem;
      border-radius: 40px 0 0 40px; /* Oval left */
      border: 2px solid #0047ab;
      outline: none;
      color: #0047ab;
      font-weight: 600;
      transition: box-shadow 0.3s ease;
    }

    /* Placeholder style */
    .search-bar input[type="text"]::placeholder {
      color: #aac7ff;
      font-style: italic;
    }

    .search-bar input[type="text"]:focus {
      box-shadow: 0 0 8px 2px #0047abaa;
      border-color: #003580;
    }

    /* Search button */
    .search-bar button {
      background-color: #0047ab;
      border: 2px solid #0047ab;
      border-radius: 0 40px 40px 0; /* Oval right */
      color: white;
      padding: 0 25px;
      font-size: 1.4rem;
      cursor: pointer;
      transition: background-color 0.3s ease;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .search-bar button:hover {
      background-color: #003580;
      border-color: #003580;
    }

    /* Optional: magnifying glass icon inside button */
    .search-bar button svg {
      width: 20px;
      height: 20px;
      fill: white;
    }

    h1 {
      color: #0047ab;
      font-weight: 700;
      font-size: 2rem;
    }
  </style>
</head>
<body>

<div class="container">
  <h1>Search Movies</h1>
  
  <form method="GET" action="/movies" class="search-bar">
    <input type="text" name="q" placeholder="Search for a movie..." value="<?= htmlspecialchars($_GET['q'] ?? '') ?>" required />
    <button type="submit" aria-label="Search">
      <!-- Optional SVG magnifying glass icon -->
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M10 18a8 8 0 1 1 5.293-2.707l5.707 5.707-1.414 1.414-5.707-5.707A7.968 7.968 0 0 1 10 18zm0-14a6 6 0 1 0 0 12a6 6 0 0 0 0-12z"/></svg>
    </button>
  </form>

  <?php if (!empty($results)): ?>
    <h2>Search Results</h2>
    <ul>
      <?php foreach ($results as $movie): ?>
        <li>
          <a href="/movies/<?= htmlspecialchars($movie['imdbID']) ?>">
            <?= htmlspecialchars($movie['Title']) ?> (<?= htmlspecialchars($movie['Year']) ?>)
          </a>
        </li>
      <?php endforeach; ?>
    </ul>
  <?php elseif (isset($_GET['q'])): ?>
    <p>No results found.</p>
  <?php endif; ?>
</div>

</body>
</html>
