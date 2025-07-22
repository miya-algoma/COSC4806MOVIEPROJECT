<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Create Account - AlgomaFlix</title>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap');

    body {
      margin: 0;
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      background-color: #f0f2f5;
      font-family: 'Inter', sans-serif;
      color: #222;
    }

    .container {
      background: #fff;
      padding: 40px 35px;
      border-radius: 15px;
      box-shadow: 0 5px 20px rgba(0,0,0,0.1);
      width: 350px;
      text-align: center;
    }

    h1 {
      margin-bottom: 25px;
      color: #004aad;
      font-weight: 700;
      font-size: 1.8rem;
    }

    label {
      display: block;
      text-align: left;
      font-weight: 600;
      margin-bottom: 6px;
      font-size: 0.95rem;
      color: #333;
    }

    input[type="text"],
    input[type="password"] {
      width: 100%;
      padding: 12px 15px;
      margin-bottom: 20px;
      border-radius: 30px;
      border: 1px solid #ccc;
      font-size: 1rem;
      font-weight: 600;
      box-sizing: border-box;
      outline-offset: 2px;
      transition: border-color 0.2s ease;
    }

    input[type="text"]:focus,
    input[type="password"]:focus {
      border-color: #004aad;
      box-shadow: 0 0 6px #004aad88;
    }

    button {
      width: 100%;
      padding: 14px;
      background-color: #004aad;
      border: none;
      border-radius: 30px;
      color: white;
      font-size: 1.1rem;
      font-weight: 700;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    button:hover {
      background-color: #00337a;
    }

    p {
      margin-top: 18px;
      font-size: 0.9rem;
    }

    a {
      color: #004aad;
      text-decoration: none;
      font-weight: 600;
      transition: color 0.3s ease;
    }

    a:hover {
      color: #002a5a;
      text-decoration: underline;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>Create Account</h1>
    <form method="POST" action="/account/register">
      <label for="username">Username</label>
      <input type="text" name="username" id="username" required autofocus />

      <label for="password">Password</label>
      <input type="password" name="password" id="password" required />

      <label for="confirm_password">Confirm Password</label>
      <input type="password" name="confirm_password" id="confirm_password" required />

      <button type="submit">Register</button>
    </form>

    <p><a href="/account/login">Back to Login</a></p>
  </div>
</body>
</html>
