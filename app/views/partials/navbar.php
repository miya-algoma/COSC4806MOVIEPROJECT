<?php
if (session_status() === PHP_SESSION_NONE) {
session_start();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<title>AlgomaFlix Navbar</title>
<style>
/* Reset and base */
body, html {
margin: 0; padding: 0;
font-family: 'Inter', sans-serif;
}

/* Navbar container */
nav {
background-color: #0047ab; /* full blue */
color: white;
padding: 15px 0 5px 0;
text-align: center;
user-select: none;
}

/* Website name on top */
.navbar-brand {
font-size: 2rem;
font-weight: 700;
margin-bottom: 10px;
color: white;
}

/* Links container */
.nav-links {
display: flex;
justify-content: center;
gap: 30px;
font-weight: 600;
}

.nav-links a {
color: #66b3ff; /* lighter blue for links */
text-decoration: none;
font-size: 1.1rem;
padding: 8px 12px;
transition: color 0.3s ease;
}

.nav-links a:hover {
color: #cce4ff; /* even lighter on hover */
text-decoration: underline;
}

/* Account dropdown container */
.account-menu {
position: relative;
cursor: pointer;
}

.account-menu span {
color: #66b3ff;
font-weight: 600;
}

/* Dropdown menu styles */
.dropdown-menu {
position: absolute;
top: 35px;
left: 50%;
transform: translateX(-50%);
background: white;
color: #0047ab;
border-radius: 6px;
box-shadow: 0 4px 10px rgba(0,0,0,0.15);
list-style: none;
padding: 10px 0;
min-width: 160px;
display: none;
z-index: 1000;
}

.dropdown-menu li {
padding: 8px 20px;
}

.dropdown-menu li a {
color: #0047ab;
font-weight: 600;
}

.dropdown-menu li:hover {
background-color: #e6f0ff;
}
</style>
</head>
<body>

<nav>
<div class="navbar-brand">AlgomaFlix</div>

<div class="nav-links">
<a href="/">Home</a>
<a href="/movies">My Movies</a>

<?php if (isset($_SESSION['auth'])): ?>
<div class="account-menu" tabindex="0">
<span>Account ▼</span>
<ul class="dropdown-menu">
<li><a href="/account/profile">Profile</a></li>
<li><a href="/account/edit">Edit Profile</a></li>
<li><a href="/account/logout">Logout</a></li>
</ul>
</div>
<?php else: ?>
<a href="/account/login">Login</a>
<?php endif; ?>
</div>
</nav>

<script>
// Dropdown toggle for Account menu
document.querySelectorAll('.account-menu').forEach(menu => {
menu.addEventListener('click', () => {
const dropdown = menu.querySelector('.dropdown-menu');
dropdown.style.display = (dropdown.style.display === 'block') ? 'none' : 'block';
});
document.addEventListener('click', e => {
if (!menu.contains(e.target)) {
menu.querySelector('.dropdown-menu').style.display = 'none';
}
});
});
</script>

</body>
</html>