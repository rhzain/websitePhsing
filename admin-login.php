<?php
session_start();
include 'includes\header.php';
?>

<main class="log">
    <div class="waves">
        <div class="wave wave2"><img src="svg/wave2.svg" alt="wave2"></div>
        <div class="wave wave1"><img src="svg/wave1.svg" alt="wave1"></div>
    </div>
    <div class="tengah">
        <section class="login-form">
            <h2>Masuk sebagai Admin</h2>
            <form action="admin-dashboard.php" method="post">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" placeholder="Username" required>
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" placeholder="Password" required>
                <button type="button" id="toggle-password">Tampilkan Password</button>
                <button type="submit">Login</button>
            </form>
        </section>
    </div>
</main>
<script>
    document.getElementById('toggle-password').addEventListener('click', function() {
        const passwordField = document.getElementById('password');
        const passwordFieldType = passwordField.getAttribute('type');
        if (passwordFieldType === 'password') {
            passwordField.setAttribute('type', 'text');
            this.textContent = 'Sembunyikan Password';
        } else {
            passwordField.setAttribute('type', 'password');
            this.textContent = 'Tampilkan Password';
        }
    });
</script>

<?php include 'includes\footer.php' ?>