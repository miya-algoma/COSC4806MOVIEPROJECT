<?php require __DIR__ . '/../partials/navbar.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Search Movies</title>
  <style>
    /* Container for search/filter */
    .search-container {
      max-width: 700px;
      margin: 40px auto 20px;
      text-align: center;
    }

    h1 {
      color: #004aad;
      font-weight: 700;
      margin-bottom: 20px;
      font-family: 'Inter', sans-serif;
    }

    /* Search bar styles */
    .search-bar {
      display: inline-flex;
      width: 100%;
      max-width: 500px;
      border-radius: 30px;
      overflow: hidden;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
      border: 1px solid #004aad88;
      backdrop-filter: blur(8px);
      background: rgba(255 255 255 / 0.8);
    }

    .search-bar input[type="text"] {
      flex-grow: 1;
      padding: 14px 20px;
      border: none;
      font-size: 1.15rem;
      font-style: italic;
      color: #004aad;
      outline-offset: 2px;
    }

    .search-bar input[type="text"]::placeholder {
      color: #aac4f9;
    }

    .search-bar button {
      background: #004aad;
      border: none;
      padding: 0 24px;
      cursor: pointer;
      color: white;
      font-size: 1.2rem;
      border-radius: 0 30px 30px 0;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: background-color 0.3s ease;
    }

    .search-bar button:hover {
      background: #002e80;
    }

    /* Filter dropdown */
    .filter-select {
      margin-top: 15px;
      font-size: 1rem;
      padding: 8px 12px;
      border-radius: 12px;
      border: 1.5px solid #004aad;
      background: white;
      color: #004aad;
      font-weight: 600;
      cursor: pointer;
    }

    /* Movie grid */
    .movie-list {
      max-width: 900px;
      margin: 40px auto;
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(160px, 1fr));
      gap: 25px;
      padding: 0;
    }

    /* Movie card */
    .movie-card {
      background: rgba(255 255 255 / 0.9);
      border-radius: 15px;
      box-shadow: 0 6px 12px rgba(0,0,0,0.1);
      overflow: hidden;
      transition: transform 0.25s ease;
      cursor: pointer;
      display: flex;
      flex-direction: column;
      height: 340px;
    }

    .movie-card:hover {
      transform: scale(1.05);
      box-shadow: 0 10px 30px rgba(0,0,0,0.2);
    }

    .movie-poster {
      width: 100%;
      height: 240px;
      object-fit: cover;
      border-bottom: 1px solid #ddd;
    }

    .movie-info {
      padding: 10px;
      text-align: center;
      flex-grow: 1;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
    }

    .movie-title {
      font-weight: 700;
      font-size: 1.1rem;
      color: #004aad;
      margin-bottom: 4px;
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
    }

    .movie-year {
      color: #555;
      font-size: 0.9rem;
      margin-bottom: 6px;
    }

    .movie-rating {
      color: #f5a623;
      font-weight: 600;
      font-size: 0.9rem;
    }
  </style>
</head>
<body>

<div class="search-container">
  <h1>Search Movies</h1>
  <form method="GET" action="/movies" class="search-bar">
    <input type="text" name="q" placeholder="Search for a movie..." value="<?= htmlspecialchars($_GET['q'] ?? '') ?>" required />
    <button type="submit" aria-label="Search">&#128269;</button>
  </form>

  <?php if (!empty($results)): ?>
    <select class="filter-select" id="filterSelect" aria-label="Filter movies">
      <option value="rating" selected>Sort by Rating</option>
      <option value="year">Sort by Year</option>
      <option value="title">Sort by Title</option>
    </select>
  <?php endif; ?>
</div>

<?php if (!empty($results)): ?>
  <section class="movie-list" id="movieList">
    <?php foreach ($results as $movie): ?>
      <div class="movie-card" tabindex="0" role="button" onclick="location.href='/movies/<?= htmlspecialchars($movie['imdbID']) ?>'">
        <img class="movie-poster" src="<?= htmlspecialchars($movie['Poster'] !== 'N/A' ? $movie['Poster'] : '/app/views/partials/no-image.png') ?>" alt="Poster of <?= htmlspecialchars($movie['Title']) ?>">
        <div class="movie-info">
          <div class="movie-title" title="<?= htmlspecialchars($movie['Title']) ?>"><?= htmlspecialchars($movie['Title']) ?></div>
          <div class="movie-year"><?= htmlspecialchars($movie['Year']) ?></div>
          <div class="movie-rating">★ <?= isset($movie['imdbRating']) ? htmlspecialchars($movie['imdbRating']) : 'N/A' ?></div>
        </div>
      </div>
    <?php endforeach; ?>
  </section>
<?php elseif (isset($_GET['q'])): ?>
  <p style="text-align:center; color:#444; font-size:1.1rem;">No results found.</p>
<?php endif; ?>

<script>
  // Client-side sorting by filter dropdown
  const filterSelect = document.getElementById('filterSelect');
  const movieList = document.getElementById('movieList');

  if (filterSelect && movieList) {
    filterSelect.addEventListener('change', () => {
      const sortBy = filterSelect.value;
      let movies = Array.from(movieList.children);

      movies.sort((a, b) => {
        const aTitle = a.querySelector('.movie-title').textContent.toLowerCase();
        const bTitle = b.querySelector('.movie-title').textContent.toLowerCase();
        const aYear = parseInt(a.querySelector('.movie-year').textContent);
        const bYear = parseInt(b.querySelector('.movie-year').textContent);
        const aRating = parseFloat(a.querySelector('.movie-rating').textContent.replace('★ ', '')) || 0;
        const bRating = parseFloat(b.querySelector('.movie-rating').textContent.replace('★ ', '')) || 0;

        switch (sortBy) {
          case 'year': return bYear - aYear;
          case 'title': return aTitle.localeCompare(bTitle);
          case 'rating': default: return bRating - aRating;
        }
      });

      movieList.innerHTML = '';
      movies.forEach(m => movieList.appendChild(m));
    });
  }
</script>

</body>
</html>
