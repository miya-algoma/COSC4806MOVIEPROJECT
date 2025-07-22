<!DOCTYPE html>
<html>
<head><title>Edit Profile</title></head>
<body>
<?php include __DIR__ . '/../partials/navbar.php'; ?>

<h2>Edit Profile</h2>
<form method="POST" action="/account/edit">
    <label>Name: <input type="text" name="name" value="<?= htmlspecialchars($_SESSION['auth']['name']) ?>" required></label><br/>
    <button type="submit">Save</button>
</form>
<p><a href="/account">Cancel</a></p>
</body>
</html>
