<!DOCTYPE html>
<html>
<head><title>Login</title></head>
<body>
<?php include __DIR__ . '/../partials/navbar.php'; ?>

<h2>Login</h2>
<?php if (!empty($error)): ?>
    <p style="color:red;"><?= htmlspecialchars($error) ?></p>
<?php endif; ?>
<form method="POST" action="/account/login">
    <label>Username: <input type="text" name="username" required></label><br/>
    <label>Password: <input type="password" name="password" required></label><br/>
    <button type="submit">Login</button>
</form>
</body>
</html>
