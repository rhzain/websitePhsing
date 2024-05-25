<?php
session_start();

// Database connection
include '../config.php';

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
        exit;
    } else {
        echo '<script>            
             alert("Login failed. Invalid username or password!!")
             window.location.href = "admin-login.php";
             </script>';
    }


    $sql->close();
}

$conn->close();
?>