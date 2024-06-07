<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: admin-login.html");
    exit();
}

// Database connection
include '../config.php';

// Fetch reservations with customer information
$sql = "SELECT r.*, p.nama_pelanggan, p.alamat_email, p.no_telp, k.nama_kolam
        FROM reservasi r
        INNER JOIN pelanggan p ON r.id_pelanggan = p.id_pelanggan
        INNER JOIN kolam_pemancingan k ON r.id_kolam = k.id_kolam
        ORDER BY r.id_pelanggan";
$result = $conn->query($sql);
?>

<?php include 'includes\header.php' ?>

<main>
    <!-- Sun -->
    <div class="svg-container" style="width: 33vw;height: 20vh;left: 45vw;top: 0;">
        <img src="svg/sun.svg" alt="Sun" style="width:100%; height:100%;">
    </div>
    <section class="intro">
        <h2>Welcome, <?php echo $_SESSION['admin']; ?>!</h2>
    </section>

    <section>
        <h2>Reservations</h2>
        <?php if ($result->num_rows > 0) : ?>
            <table border="1">
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Ponsel</th>
                    <th>Kolam</th>
                    <th>Tanggal</th>
                    <th>Waktu Mulai</th>
                    <th>Waktu Selesai</th>
                    <th>Status</th>
                    <th>Ubah</th>
                    <th>Hasil</th>
                </tr>
                <?php while ($row = $result->fetch_assoc()) : ?>
                    <tr>
                        <td><?php echo $row['id_reservasi']; ?></td>
                        <td><?php echo $row['nama_pelanggan']; ?></td>
                        <td><?php echo $row['alamat_email']; ?></td>
                        <td><?php echo $row['no_telp']; ?></td>
                        <td><?php echo $row['nama_kolam']; ?></td>
                        <td><?php echo $row['tgl_pemakaian']; ?></td>
                        <td><?php echo $row['waktu_mulai']; ?></td>
                        <td><?php echo $row['waktu_selesai']; ?></td>
                        <td><?php echo $row['status_reservasi']; ?></td>
                        <td><a href="admin-edit.php?op=edit&id=<?php echo $row['id_reservasi']; ?>&waktu_mulai=<?php echo urlencode($row['waktu_mulai']); ?>&waktu_selesai=<?php echo urlencode($row['waktu_selesai']); ?>">
                                <button type="button">Edit</button>
                            </a>
                            <a href="delete-reservation.php?id=<?php echo $row['id_reservasi']; ?>&status=<?php echo $row['status_reservasi']; ?>" onclick="return confirm('Are you sure you want to delete this reservation?')">
                                <button type="button">Delete</button>
                            </a>
                        </td>
                        <td><a href="fishing-result.php?id=<?php echo $row['id_reservasi']; ?>">
                                <button type="button">Go</button>
                            </a>
                        </td>
                    </tr>
                <?php endwhile; ?>

            </table>
        <?php else : ?>
            <p>No reservations found.</p>
        <?php endif; ?>
    </section>
</main>

<?php include 'includes\footer.php' ?>

<?php
$conn->close();
?>