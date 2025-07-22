<!DOCTYPE html>
<html>
<head><title>Profile</title></head>
<body>
<?php include __DIR__ . '/../partials/navbar.php'; ?>

  <h2>Welcome, <?= htmlspecialchars($_SESSION['auth']['name'] ?? '') ?></h2>


<p>Username: <?= htmlspecialchars($_SESSION['auth']['username']) ?></p>

<p><a href="/account/edit">Edit Profile</a> | <a href="/account/logout">Logout</a></p>

</body>
</html>