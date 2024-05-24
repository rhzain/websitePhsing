<?php
include('../config.php');
include 'includes/header.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM admin WHERE username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            session_start();
            $_SESSION['admin'] = $row['id_admin'];
            header('Location: admin.php');
        } else {
            echo "<p>Invalid password.</p>";
        }
    } else {
        echo "<p>No user found.</p>";
    }
}
?>

<form method="post" action="">
    <label for="username">Username:</label>
    <input type="text" id="username" name="username" required>
    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required>
    <button type="submit">Login</button>
</form>

<?php include 'includes/footer.php'; ?>
