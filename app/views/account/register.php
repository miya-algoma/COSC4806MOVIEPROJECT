<!DOCTYPE html>
<html>
<head>
    <title>Create Account</title>
</head>
<body>
    <h1>Create Account</h1>
    <form method="POST" action="/account/register">
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" required />
        <br/>
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required />
        <br/>
        <label for="confirm_password">Confirm Password:</label>
        <input type="password" name="confirm_password" id="confirm_password" required />
        <br/>
        <button type="submit">Register</button>
    </form>

    <p><a href="/account/login">Back to Login</a></p>
</body>
</html>
