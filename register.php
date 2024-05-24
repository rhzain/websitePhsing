<?php
include('../config.php');
include 'includes/header.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama_admin = $_POST['nama_admin'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    $sql = "INSERT INTO admin (nama_admin, username, password) VALUES ('$nama_admin', '$username', '$password')";

    if ($conn->query($sql) === TRUE) {
        echo "<p>Registration successful. <a href='login.php'>Login here</a>.</p>";
    } else {
        echo "<p>Error: " . $sql . "<br>" . $conn->error . "</p>";
    }
}
?>

<form method="post" action="">
    <label for="nama_admin">Name:</label>
    <input type="text" id="nama_admin" name="nama_admin" required>
    <label for="username">Username:</label>
    <input type="text" id="username" name="username" required>
    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required>
    <button type="submit">Register</button>
</form>

<?php include 'includes/footer.php'; ?>