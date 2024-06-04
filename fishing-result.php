<?php
session_start();
include '../config.php';

if (!isset($_SESSION['admin'])) {
    header("Location: admin-login.html");
    exit();
}

if (!isset($_GET['id'])) {
    header("Location: admin-dashboard.php"); // Redirect to dashboard if ID is not provided
    exit();
}

$reservation_id = $_GET['id'];

// Fetch reservation details
$sql_reservation = "SELECT * FROM reservasi WHERE id_reservasi = $reservation_id";
$result_reservation = $conn->query($sql_reservation);
$reservation = $result_reservation->fetch_assoc();

$sql_fishResult = "SELECT h.*, i.nama_ikan, i.harga_per_kg 
                   FROM hasilMancing h 
                   INNER JOIN ikan i ON h.id_ikan = i.id_ikan 
                   WHERE h.id_reservasi = $reservation_id AND h.jumlah_ikan > 0";
$result_fish = $conn->query($sql_fishResult);

$sql_fish = "SELECT id_ikan, nama_ikan, harga_per_kg 
             FROM ikan";
$fishes = $conn->query($sql_fish);

// Calculate total price based on fish caught
$total_price = 0;

// Storing fish data in an array
$fish_data = array();
while ($fish = $result_fish->fetch_assoc()) {
    $fish_data[] = $fish;
    $total_price += $fish['jumlah_ikan'] * $fish['harga_per_kg'];
}
?>

<?php include 'includes/header.php' ?>

<main>
    <section class="intro">
        <h3>Hasil Mancing untuk Reservation ID: <?php echo $reservation_id; ?></h3>
        <p>Tanggal Reservasi: <?php echo $reservation['tgl_pemakaian']; ?></p>
        <p>Jam: <?php echo $reservation['waktu_mulai'] . ' - ' . $reservation['waktu_selesai']; ?></p>
    </section>

    <section>
        <h3>Hasil Mancing</h3>
        <?php if (!empty($fish_data)) : ?>
            <table border="1">
                <tr>
                    <th>Nama Ikan</th>
                    <th>Kuantitas</th>
                    <th>Total Berat (kg)</th>
                    <th>Harga per kg (IDR)</th>
                </tr>
                <?php foreach ($fish_data as $fish) : ?>
                    <tr>
                        <td><?php echo $fish['nama_ikan']; ?></td>
                        <td><?php echo $fish['jumlah_ikan']; ?></td>
                        <td><?php echo $fish['berat_total']; ?></td>
                        <td><?php echo $fish['harga_per_kg']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
            <p>Total Harga: Rp<?php echo number_format($total_price, 2); ?></p>
        <?php else : ?>
            <p>Tidak ada hasil untuk reservasi ini.</p>
        <?php endif; ?>
        <a href="receipt.php?op=mancing&id=<?php echo $reservation_id; ?>" target="_blank">Print Receipt</a>

        <h3>Kelola Hasil Mancing</h3>
        <div class="manage-fish">
            <form action="manage-fish.php" method="post">
                <input type="hidden" name="reservation_id" value="<?php echo $reservation_id; ?>">
                <label for="fish_name">Select Fish:</label>
                <select id="fish_name" name="fish_name" required>
                    <?php foreach ($fishes as $fish) : ?>
                        <option value="<?php echo $fish['id_ikan']; ?>"><?php echo $fish['nama_ikan']; ?></option>
                    <?php endforeach; ?>
                </select>
                <label for="quantity">Quantity:</label>
                <input type="number" id="quantity" name="quantity" required>
                <label for="total_weight">Total Weight (kg):</label>
                <input type="number" id="total_weight" name="total_weight" step="0.01" required>
                <button type="submit">Tambahkan Hasil Mancing</button>
            </form>
        </div>
    </section>
</main>

<?php include 'includes/footer.php' ?>

<?php $conn->close(); ?>