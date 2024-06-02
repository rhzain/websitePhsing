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
    <div class="panel">
        <h2>Edit Reservasi</h2>
    </div>
    <section class="panel">
        <div class="customer-info">
            <div class="info-item">
                <div class="label">Nama:</div>
                <div class="value"><?php echo htmlspecialchars($row['nama_pelanggan']); ?></div>
            </div>

            <div class="info-item">
                <div class="label">Email:</div>
                <div class="value"><?php echo htmlspecialchars($row['alamat_email']); ?></div>
            </div>

            <div class="info-item">
                <div class="label">Telepon:</div>
                <div class="value"><?php echo htmlspecialchars($row['no_telp']); ?></div>
            </div>

            <div class="info-item">
                <div class="label">Tanggal Reservasi:</div>
                <div class="value"><?php echo htmlspecialchars($row['tgl_pemakaian']); ?></div>
            </div>

            <div class="info-item">
                <div class="label">Alamat Pelanggan:</div>
                <div class="value"><?php echo htmlspecialchars($row['alamat_pelanggan']); ?></div>
            </div>
        </div>
        <div class="form-container">
            <form action="submit-reservation.php" method="post">
                <label for="pool">Pilih Kolam Pemancingan:</label>
                <select id="pool" name="pool">
                    <option value="Kolam A" <?php echo ($row['nama_kolam'] == 'Kolam A') ? 'selected' : ''; ?>>Kolam A</option>
                    <option value="Kolam B" <?php echo ($row['nama_kolam'] == 'Kolam B') ? 'selected' : ''; ?>>Kolam B</option>
                    <option value="Kolam C" <?php echo ($row['nama_kolam'] == 'Kolam C') ? 'selected' : ''; ?>>Kolam C</option>
                </select>

                <label for="start-time">Waktu Mulai:</label>
                <select id="start-time" name="start-time">
                    <?php
                    $times = ["09:00:00", "10:00:00", "11:00:00", "12:00:00", "13:00:00", "14:00:00", "15:00:00"];
                    foreach ($times as $time) {
                        echo '<option value="' . $time . '"' . ($row['waktu_mulai'] == $time ? ' selected' : '') . '>' . $time . '</option>';
                    }
                    ?>
                </select>

                <label for="end-time">Waktu Selesai:</label>
                <select id="end-time" name="end-time">
                    <?php
                    $times = ["10:00:00", "11:00:00", "12:00:00", "13:00:00", "14:00:00", "15:00:00", "16:00:00"];
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

                <button type="submit" class="btn-update">Update</button>
            </form>
        </div>
    </section>
</main>

<?php include 'includes/footer.php' ?>

<?php
$conn->close();
?>