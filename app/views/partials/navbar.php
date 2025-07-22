<?php session_start(); ?>
<nav style="background:#eee; padding:10px; margin-bottom:20px;">
  <a href="/">Home</a> |
  <a href="/movies">My Movies</a> |

  <?php if (isset($_SESSION['auth'])): ?>
    <div style="display:inline-block; position:relative;">
      <span>Account ▼</span>
      <ul style="list-style:none; margin:0; padding:0; position:absolute; background:#fff; border:1px solid #ccc; display:none;">
        <li><a href="/account/profile">Profile</a></li>
        <li><a href="/account/edit">Edit Profile</a></li>
        <li><a href="/account/logout">Logout</a></li>
      </ul>
    </div>
  <?php else: ?>
    <a href="/account/login">Login</a>
  <?php endif; ?>
</nav>

<script>
// Simple dropdown toggle for the Account menu
document.querySelectorAll('nav div').forEach(menu => {
  menu.addEventListener('click', () => {
    const ul = menu.querySelector('ul');
    ul.style.display = (ul.style.display === 'block') ? 'none' : 'block';
  });
  document.addEventListener('click', e => {
    if (!menu.contains(e.target)) {
      menu.querySelector('ul').style.display = 'none';
    }
  });
});
</script>
