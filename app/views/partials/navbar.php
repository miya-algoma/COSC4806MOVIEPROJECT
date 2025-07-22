<nav style="background:#eee;padding:10px;">
    <a href="/">Home</a> |
    <a href="/movies">Movies</a> |
    <div style="display:inline-block; position:relative;">
        <a href="#" onclick="event.preventDefault(); document.getElementById('account-dropdown').style.display = (document.getElementById('account-dropdown').style.display === 'block') ? 'none' : 'block';">
            Account ▼
        </a>
        <div id="account-dropdown" style="display:none; position:absolute; background:#fff; border:1px solid #ccc; padding:5px;">
            <?php if (isset($_SESSION['auth'])): ?>
                <a href="/account">Profile (<?= htmlspecialchars($_SESSION['auth']['name']) ?>)</a><br/>
                <a href="/account/logout">Logout</a>
            <?php else: ?>
                <a href="/account">Login</a>
            <?php endif; ?>
        </div>
    </div>
</nav>

<script>
// Optional: close dropdown if clicked outside
document.addEventListener('click', function(e) {
    const dropdown = document.getElementById('account-dropdown');
    if (!dropdown.contains(e.target) && e.target.innerText !== 'Account ▼') {
        dropdown.style.display = 'none';
    }
});
</script>
