<?php require __DIR__ . '/../partials/navbar.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Home - Movie App</title>
    <link rel="stylesheet" href="/app/views/partials/styles.css" />
    <style>
      .home-container {
        max-width: 500px;
        margin: 80px auto;
        background: white;
        padding: 30px 40px;
        border-radius: 12px;
        box-shadow: 0 6px 20px rgba(0,0,0,0.1);
        text-align: center;
        font-family: 'Inter', sans-serif;
      }

      .home-container h1 {
        color: #004aad;
        margin-bottom: 25px;
      }

      .home-container a {
        color: #004aad;
        font-weight: 600;
        text-decoration: none;
        font-size: 1.1rem;
        border: 2px solid #004aad;
        padding: 10px 25px;
        border-radius: 25px;
        transition: background-color 0.3s ease, color 0.3s ease;
        display: inline-block;
      }

      .home-container a:hover {
        background-color: #004aad;
        color: white;
      }
    </style>
</head>
<body>

<div class="home-container">
    <h1>Welcome to the Movie App Home Page</h1>
    <a href="/movies">See Movies</a>
</div>

</body>
</html>
