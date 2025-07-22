<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($movie['Title']) ?> (<?= htmlspecialchars($movie['Year']) ?>)</title>
    <style>
        body {
            font-family: 'Inter', Arial, sans-serif;
            background: #f8fafc;
            color: #002355;
            margin: 0;
            padding: 0;
        }
        .details-container {
            max-width: 700px;
            margin: 40px auto 0;
            background: #fff;
            border-radius: 18px;
            box-shadow: 0 4px 28px rgba(0,0,0,0.10);
            padding: 36px 36px 28px;
            display: flex;
            gap: 40px;
            align-items: flex-start;
        }
        .poster {
            width: 230px;
            min-width: 150px;
            border-radius: 13px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.09);
            object-fit: cover;
            border: 1.5px solid #e3e8f3;
            background: #eee;
        }
        .info {
            flex: 1;
        }
        .movie-title {
            font-size: 2.1rem;
            font-weight: 800;
            color: #004aad;
            margin-bottom: 12px;
            letter-spacing: -1px;
        }
        .movie-year {
            font-size: 1.1rem;
            color: #768baf;
            margin-bottom: 10px;
        }
        .movie-rating {
            margin: 12px 0 20px;
            font-size: 1.13rem;
            color: #f5a623;
            font-weight: 700;
        }
        .imdb-score {
            color: #002355;
            background: #f5f6ff;
            border-radius: 8px;
            font-size: 1rem;
            padding: 6px 16px;
            margin-bottom: 22px;
            display: inline-block;
            font-weight: 600;
            box-shadow: 0 1.5px 6px rgba(0,0,0,0.06);
        }
        .star-rating {
            display: flex;
            align-items: center;
            gap: 4px;
            margin-bottom: 8px;
        }
        .star-rating input { display: none; }
        .star-rating label {
            font-size: 2.1rem;
            color: #e3e8f3;
            cursor: pointer;
            transition: color 0.2s;
        }
        .star-rating input:checked ~ label,
        .star-rating label:hover,
        .star-rating label:hover ~ label {
            color: #f5a623;
        }
        .star-rating input:checked ~ label { color: #f5a623; }
        .rate-btn {
            margin-top: 6px;
            padding: 8px 30px;
            background: #004aad;
            color: #fff;
            border: none;
            border-radius: 22px;
            font-size: 1.08rem;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s;
        }
        .rate-btn:hover {
            background: #00347a;
        }
        .back-link {
            display: inline-block;
            margin: 34px auto 0 48px;
            color: #004aad;
            font-weight: 600;
            text-decoration: none;
            font-size: 1.06rem;
            padding: 2px 0;
            border-bottom: 2px solid #aac4f9;
            transition: color 0.18s;
        }
        .back-link:hover {
            color: #00347a;
            border-bottom-color: #004aad;
        }
        .avg-rating {
            color: #555;
            font-size: 1.08rem;
            margin-bottom: 10px;
        }
        @media (max-width: 900px) {
            .details-container { flex-direction: column; align-items: stretch; }
            .poster { margin: 0 auto; }
        }
    </style>
</head>
<body>
    <div class="details-container">
        <img class="poster"
             src="<?= htmlspecialchars($movie['Poster'] !== 'N/A' ? $movie['Poster'] : '/app/views/partials/no-image.png') ?>"
             alt="Poster of <?= htmlspecialchars($movie['Title']) ?>">
        <div class="info">
            <div class="movie-title"><?= htmlspecialchars($movie['Title']) ?> <span class="movie-year">(<?= htmlspecialchars($movie['Year']) ?>)</span></div>
            <div class="imdb-score">IMDB Rating: <?= htmlspecialchars($movie['imdbRating'] ?? 'N/A') ?></div>

            <?php if (isset($avg_rating) && $avg_rating > 0): ?>
                <div class="avg-rating">
                    User Average: <?= round($avg_rating, 2) ?> / 5 (<?= (int)$rating_count ?> ratings)
                </div>
            <?php endif; ?>

            <div style="margin-top:24px; margin-bottom:6px; font-weight:700; color:#004aad;">Your Rating:</div>
            <?php if (isset($user_rating)): ?>
                <div class="movie-rating">
                    <?php for ($i = 1; $i <= 5; $i++): ?>
                        <span style="font-size:2rem; color:<?= $i <= $user_rating ? '#f5a623' : '#e3e8f3' ?>">★</span>
                    <?php endfor; ?>
                    <span style="font-size:1.1rem; color:#222;">&nbsp;<?= htmlspecialchars($user_rating) ?>/5</span>
                </div>
            <?php else: ?>
                <form method="post" action="/movies/rate">
                    <input type="hidden" name="movie_id" value="<?= htmlspecialchars($movie['imdbID']) ?>">
                    <div class="star-rating" style="margin-bottom:0;">
                        <?php for ($i = 5; $i >= 1; $i--): ?>
                            <input type="radio" id="star<?= $i ?>" name="rating" value="<?= $i ?>">
                            <label for="star<?= $i ?>">★</label>
                        <?php endfor; ?>
                    </div>
                    <button class="rate-btn" type="submit">Rate</button>
                </form>
            <?php endif; ?>
        </div>
    </div>

    <a class="back-link" href="/movies">&larr; Back to Search</a>
</body>
</html>
