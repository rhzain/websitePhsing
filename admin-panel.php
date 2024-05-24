<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: admin-login.html");
    exit();
}

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

// Fetch reservations
$sql = "SELECT * FROM reservasi";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Phisnia</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" href="img/logo.png" type="image/png">
</head>
<body>
    <header>
        <h1>Admin Panel</h1>
        <nav>
            <ul>
                <li><a href="index.html">Beranda</a></li>
                <li><a href="reservations.html">Reservasi</a></li>
                <li><a href="admin-login.html">Admin Login</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section>
            <h2>Welcome, <?php echo $_SESSION['admin']; ?>!</h2>
            <a href="logout.php">Logout</a>
        </section>

        <section>
            <h2>Reservations</h2>
            <?php if ($result->num_rows > 0): ?>
                <table border="1">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Date</th>
                        <th>Pool</th>
                    </tr>
                    <?php while($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['name']; ?></td>
                            <td><?php echo $row['email']; ?></td>
                            <td><?php echo $row['phone']; ?></td>
                            <td><?php echo $row['date']; ?></td>
                            <td><?php echo $row['pool']; ?></td>
                        </tr>
                    <?php endwhile; ?>
                </table>
            <?php else: ?>
                <p>No reservations found.</p>
            <?php endif; ?>
        </section>
    </main>

    <footer>
        <p>&copy; 
            <a href="aboutUs.html" class="who">Phisnia</a>. All rights reserved.</p>
    </footer>
</body>
</html>

<?php
$conn->close();
?>
