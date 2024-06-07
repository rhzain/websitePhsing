<?php
session_start();
include 'includes\header.php';

// Database connection
include '../config.php';
$sql_kolam = "SELECT * FROM kolam_pemancingan";
$kolam = $conn->query($sql_kolam);
?>

<main class="res">
    <div class="bg-res">
        <div class="reservation-form">
            <h1>Formulir Reservasi</h1>
            <form action="submit-reservation.php" method="post">
                <label for="name">Nama:</label>
                <input type="text" id="name" name="name" required>

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>

                <label for="phone">Telepon:</label>
                <input type="tel" id="phone" name="phone" required>

                <label for="address">Alamat Pelanggan:</label>
                <input type="text" id="address" name="address" required>

                <label for="pool">Pilih Kolam Pemancingan:</label>
                <div class="kolam-info"></div>
                <select id="pool" name="pool" required>
                    <?php foreach ($kolam as $klm) : ?>
                        <option value="<?php echo $klm['id_kolam']; ?>"><?php echo $klm['nama_kolam']; ?></option>
                    <?php endforeach; ?>
                </select>

                <label for="start-time">Waktu Mulai:</label>
                <select id="start-time" name="start-time" required>
                    <option value="09:00">09:00</option>
                    <option value="10:00">10:00</option>
                    <option value="11:00">11:00</option>
                    <option value="12:00">12:00</option>
                    <option value="13:00">13:00</option>
                    <option value="14:00">14:00</option>
                    <option value="15:00">15:00</option>
                </select>

                <label for="end-time">Waktu Selesai:</label>
                <select id="end-time" name="end-time" required>
                    <option value="10:00">10:00</option>
                    <option value="11:00">11:00</option>
                    <option value="12:00">12:00</option>
                    <option value="13:00">13:00</option>
                    <option value="14:00">14:00</option>
                    <option value="15:00">15:00</option>
                    <option value="16:00">16:00</option>
                </select>

                <label for="pembayaran">Pembayaran:</label>
                <select id="pembayaran" name="pembayaran" required>
                    <option value="Bayar di tempat">Bayar di tempat</option>
                    <option value="Transfer">Transfer</option>
                </select>

                <button type="submit">Kirim Reservasi</button>
            </form>
        </div>
    </div>
    <a href="index.php">
        <div class="back">
            <div class="back-arrow" style="
                max-width: 103.65px;max-height: 74.41px;right: 20%;top: 0;">
                <img src="svg/arrow.svg" alt="arrow" style="width:100%; height:100%;">
            </div>
            Back
        </div>
    </a>
</main>

<?php include 'includes\footer.php' ?>