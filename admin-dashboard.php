<?php
session_start();

// Database connection
$servername = "localhost";
$username = "root"; // default XAMPP username
$password = ""; // default XAMPP password is empty
$dbname = "phisnia"; // the name of your database

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Hash the password to match the stored hash
    $password_hashed = md5($password);

    // Prepare and execute the SQL statement
    $sql = $conn->prepare("SELECT * FROM admin WHERE username = ? AND password = ?");
    $sql->bind_param("ss", $username, $password_hashed);
    $sql->execute();
    $result = $sql->get_result();

    if ($result->num_rows > 0) {
        $_SESSION['admin'] = $username;
        header("Location: admin-panel.php");
    } else {
        echo "Invalid username or password.";
    }
    
    $sql->close();
}

$conn->close();
?>
