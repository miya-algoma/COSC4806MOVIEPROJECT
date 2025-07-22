<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8" />
  <title>Profile</title>
  <link rel="stylesheet" href="/app/views/partials/styles.css" />
  <style>
    /* Additional profile-specific styles */
    .profile-container {
      max-width: 400px;
      margin: 50px auto;
      background: white;
      padding: 30px 40px;
      border-radius: 12px;
      box-shadow: 0 6px 20px rgba(0,0,0,0.1);
      text-align: center;
    }

    .profile-container h2 {
      margin-bottom: 20px;
      color: #004aad;
    }

    .profile-info {
      font-size: 1.1rem;
      margin-bottom: 30px;
      color: #333;
    }

    .profile-links a {
      margin: 0 10px;
      font-weight: 600;
      color: #004aad;
      text-decoration: none;
      transition: color 0.2s ease;
    }

    .profile-links a:hover {
      color: #002f6c;
      text-decoration: underline;
    }
  </style>
</head>
<body>
  <?php include __DIR__ . '/../partials/navbar.php'; ?>

  <div class="container profile-container">
    <h2>Welcome, <?= htmlspecialchars($_SESSION['auth']['name'] ?? '') ?></h2>

    <p class="profile-info">Username: <?= htmlspecialchars($_SESSION['auth']['username']) ?></p>

    <p class="profile-links">
      <a href="/account/edit">Edit Profile</a> | <a href="/account/logout">Logout</a>
    </p>
  </div>
</body>
</html>
