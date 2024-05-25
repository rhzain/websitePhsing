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
        exit;
    } else {
        ?>
        <!DOCTYPE html>
        <html lang="id">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Phisnia</title>
            <link rel="stylesheet" href="css/style.css">
            <link rel="icon" href="img/logo.png" type="image/png">
        </head>
        <body>
            <?php echo 'Username atau password invalid.'?>
        </body>
        </html>
        <?php
    }
    
    $sql->close();
}

$conn->close();
?>
