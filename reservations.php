<?php
session_start();
include 'includes\header.php';
?>

<main>
    <section class="reservation-form">
        <h2>Formulir Reservasi</h2>
        <form action="submit-reservation.php" method="post">
            <label for="name">Nama:</label>
            <input type="text" id="name" name="name" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="phone">Telepon:</label>
            <input type="tel" id="phone" name="phone" required>

            <label for="address">Alamat Pelanggan:</label>
            <input type="text" id="address" name="address" required>
            
            <label for="date">Tanggal Reservasi:</label>
            <input type="date" id="date" name="date" required>

            <label for="pool">Pilih Kolam Pemancingan:</label>
            <select id="pool" name="pool" required>
                <option value="Kolam A">Kolam A</option>
                <option value="Kolam B">Kolam B</option>
                <option value="Kolam C">Kolam C</option>
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
                <option value="ots">Bayar di tempat</option>
                <option value="trf">Transfer</option>
            </select>

            <button type="submit">Kirim Reservasi</button>
        </form>
    </section>
</main>

<?php include 'includes\footer.php' ?>