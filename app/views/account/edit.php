<!DOCTYPE html>
<html>
<head>
  <title>Edit Profile</title>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap');

    /* Reset and base */
    * {
      box-sizing: border-box;
    }
    body, html {
      margin: 0;
      padding: 0;
      height: 100%;
      font-family: 'Inter', sans-serif;
      background-color: #f0f2f5;
      color: #222;
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    /* Navbar */
    nav {
      background-color: #0046d5;
      color: white;
      width: 100%;
      padding: 15px 20px;
      font-weight: 600;
      display: flex;
      justify-content: center;
      gap: 30px;
      position: fixed;
      top: 0;
      left: 0;
      z-index: 1000;
      box-shadow: 0 2px 8px rgba(0,0,0,0.15);
    }

    nav a {
      color: #a9c6ff;
      text-decoration: none;
      transition: color 0.3s ease;
    }

    nav a:hover {
      color: white;
    }

    nav .logo {
      font-weight: 900;
      font-size: 1.4rem;
      color: white;
      margin-right: auto;
    }

    /* Container for page content, offset below navbar */
    .container {
      margin-top: 80px; /* height of navbar + some space */
      flex-grow: 1;
      display: flex;
      justify-content: center;
      align-items: center;
      width: 100%;
      padding: 15px;
    }

    /* Form styling */
    form {
      background: white;
      padding: 40px 50px;
      border-radius: 15px;
      box-shadow: 0 4px 15px rgba(0,0,0,0.1);
      width: 350px;
    }

    h2 {
      text-align: center;
      color: #0046d5;
      margin-bottom: 25px;
    }

    label {
      display: block;
      font-weight: 600;
      margin-bottom: 8px;
      color: #222;
    }

    input[type="text"] {
      width: 100%;
      padding: 14px 20px;
      font-size: 1rem;
      border-radius: 30px;
      border: 1px solid #ccc;
      outline: none;
      transition: border-color 0.3s ease;
      margin-bottom: 25px;
      background: #fff;
      box-shadow: inset 0 2px 5px rgb(0 0 0 / 0.05);
    }

    input[type="text"]:focus {
      border-color: #0046d5;
      box-shadow: 0 0 10px rgba(0, 70, 213, 0.4);
    }

    button {
      width: 100%;
      background-color: #0046d5;
      border: none;
      color: white;
      font-weight: 700;
      padding: 14px 0;
      border-radius: 30px;
      font-size: 1.2rem;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    button:hover {
      background-color: #002d8a;
    }

    p {
      text-align: center;
      margin-top: 20px;
    }

    p a {
      color: #0046d5;
      text-decoration: none;
      font-weight: 600;
    }

    p a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>
  <?php include __DIR__ . '/../partials/navbar.php'; ?>

  <div class="container">
    <form method="POST" action="/account/edit">
      <h2>Edit Profile</h2>
      <label for="name">Name:</label>
      <input type="text" id="name" name="name" value="<?= htmlspecialchars($_SESSION['auth']['name']) ?>" required />
      <button type="submit">Save</button>
      <p><a href="/account">Cancel</a></p>
    </form>
  </div>
</body>
</html>
