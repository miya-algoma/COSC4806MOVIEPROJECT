<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8" />
  <title>Profile</title>
  <link rel="stylesheet" href="/app/views/partials/styles.css" />
</head>
<body>
  <?php include __DIR__ . '/../partials/navbar.php'; ?>

  <div class="container">
    <h2>Welcome, <?= htmlspecialchars($_SESSION['auth']['name'] ?? '') ?></h2>

    <p>Username: <?= htmlspecialchars($_SESSION['auth']['username']) ?></p>

    <p><a href="/account/edit">Edit Profile</a> | <a href="/account/logout">Logout</a></p>
  </div>
</body>
</html>
