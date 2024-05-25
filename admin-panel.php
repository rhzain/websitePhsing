<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: admin-login.html");
    exit();
}

// Database connection
include '../config.php';

// Fetch reservations with customer information
$sql = "SELECT r.id_reservasi, p.nama_pelanggan, p.alamat_email, p.no_telp, r.tgl_pemakaian, r.id_kolam, r.status_reservasi 
        FROM reservasi r
        INNER JOIN pelanggan p ON r.id_pelanggan = p.id_pelanggan";
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
                        <th>Status</th>
                    </tr>
                    <?php while($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['id_reservasi']; ?></td>
                            <td><?php echo $row['nama_pelanggan']; ?></td>
                            <td><?php echo $row['alamat_email']; ?></td>
                            <td><?php echo $row['no_telp']; ?></td>
                            <td><?php echo $row['tgl_pemakaian']; ?></td>
                            <td><?php echo $row['id_kolam']; ?></td>
                            <td><?php echo $row['status_reservasi']; ?></td>
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
