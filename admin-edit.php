<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: admin-login.html");
    exit();
}

// Database connection
include '../config.php';

// Get the reservation details based on passed parameters
if (isset($_GET['op']) && $_GET['op'] == 'edit' && isset($_GET['waktu_mulai']) && isset($_GET['waktu_selesai'])) {
    $waktu_mulai = urldecode($_GET['waktu_mulai']);
    $waktu_selesai = urldecode($_GET['waktu_selesai']);
    
    $sql = "SELECT r.*, p.nama_pelanggan, p.alamat_email, p.no_telp, p.alamat_pelanggan, k.nama_kolam
            FROM reservasi r
            INNER JOIN pelanggan p ON r.id_pelanggan = p.id_pelanggan
            INNER JOIN kolam_pemancingan k ON r.id_kolam = k.id_kolam
            WHERE r.waktu_mulai = ? AND r.waktu_selesai = ?";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $waktu_mulai, $waktu_selesai);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "Reservation not found.";
        exit();
    }
} else {
    echo "Invalid request.";
    exit();
}
?>

<?php include 'includes/header.php' ?>

<main>
    <section>
        <h2><?php echo $_SESSION['admin']; ?></h2>
        <a href="logout.php">Logout</a>
    </section>

    <section>
        <h2>Edit Reservasi</h2>
        <section class="reservation-form">
            <h2>Formulir Reservasi</h2>
            <form action="submit-reservation.php" method="post">
                <label for="name">Nama:</label>
                <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($row['nama_pelanggan']); ?>">

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($row['alamat_email']); ?>">

                <label for="phone">Telepon:</label>
                <input type="tel" id="phone" name="phone" value="<?php echo htmlspecialchars($row['no_telp']); ?>">

                <label for="date">Tanggal Reservasi:</label>
                <input type="date" id="date" name="date" value="<?php echo htmlspecialchars($row['tgl_pemakaian']); ?>">

                <label for="address">Alamat Pelanggan:</label>
                <input type="text" id="address" name="address" value="<?php echo htmlspecialchars($row['alamat_pelanggan']); ?>">

                <label for="pool">Pilih Kolam Pemancingan:</label>
                <select id="pool" name="pool">
                    <option value="Kolam A" <?php echo ($row['nama_kolam'] == 'Kolam A') ? 'selected' : ''; ?>>Kolam A</option>
                    <option value="Kolam B" <?php echo ($row['nama_kolam'] == 'Kolam B') ? 'selected' : ''; ?>>Kolam B</option>
                    <option value="Kolam C" <?php echo ($row['nama_kolam'] == 'Kolam C') ? 'selected' : ''; ?>>Kolam C</option>
                </select>

                <label for="start-time">Waktu Mulai:</label>
                <select id="start-time" name="start-time">
                    <?php
                    $times = ["09:00", "10:00", "11:00", "12:00", "13:00", "14:00", "15:00"];
                    foreach ($times as $time) {
                        echo '<option value="' . $time . '"' . ($row['waktu_mulai'] == $time ? ' selected' : '') . '>' . $time . '</option>';
                    }
                    ?>
                </select>

                <label for="end-time">Waktu Selesai:</label>
                <select id="end-time" name="end-time">
                    <?php
                    $times = ["10:00", "11:00", "12:00", "13:00", "14:00", "15:00", "16:00"];
                    foreach ($times as $time) {
                        echo '<option value="' . $time . '"' . ($row['waktu_selesai'] == $time ? ' selected' : '') . '>' . $time . '</option>';
                    }
                    ?>
                </select>

                <label for="pembayaran">Pembayaran:</label>
                <select id="pembayaran" name="pembayaran">
                    <option value="ots" <?php echo ($row['status_reservasi'] == 'Belum Bayar') ? 'selected' : ''; ?>>Bayar di tempat</option>
                    <option value="trf" <?php echo ($row['status_reservasi'] == 'Sudah Bayar') ? 'selected' : ''; ?>>Transfer</option>
                </select>

                <input type="hidden" name="id_reservasi" value="<?php echo $row['id_reservasi']; ?>">
                <input type="hidden" name="edit" value="true">

                <button type="submit">Update</button>
            </form>
        </section>
    </section>
</main>

<?php include 'includes/footer.php' ?>

<?php
$conn->close();
?>
