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

$sql_fish = "SELECT h.*, i.nama_ikan, i.harga_per_kg 
             FROM hasilMancing h 
             INNER JOIN ikan i ON h.id_ikan = i.id_ikan 
             WHERE h.id_reservasi = $reservation_id AND h.jumlah_ikan > 0";
$result_fish = $conn->query($sql_fish);

// Calculate total price based on fish caught
$total_price = 0;
$fish_data = array();
while ($fish = $result_fish->fetch_assoc()) {
    $total_price += $fish['jumlah_ikan'] * $fish['harga_per_kg'];
    $fish_data[] = $fish;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receipt</title>
    <style>
        /* CSS styles for the receipt */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 800px;
            margin: auto;
            border: 1px solid #ccc;
            padding: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .total {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Receipt for Reservation ID: <?php echo $reservation_id; ?></h2>
        <p>Date: <?php echo $reservation['tgl_pemakaian']; ?></p>
        <p>Time: <?php echo $reservation['waktu_mulai'] . ' - ' . $reservation['waktu_selesai']; ?></p>
        
        <h3>Fish Caught</h3>
        <?php if (!empty($fish_data)) : ?>
            <table>
                <tr>
                    <th>Fish Name</th>
                    <th>Quantity</th>
                    <th>Total Weight (kg)</th>
                    <th>Price per kg (USD)</th>
                    <th>Total Price (USD)</th>
                </tr>
                <?php foreach ($fish_data as $fish) : ?>
                    <tr>
                        <td><?php echo $fish['nama_ikan']; ?></td>
                        <td><?php echo $fish['jumlah_ikan']; ?></td>
                        <td><?php echo $fish['berat_total']; ?></td>
                        <td><?php echo $fish['harga_per_kg']; ?></td>
                        <td><?php echo $fish['jumlah_ikan'] * $fish['harga_per_kg']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
            <p class="total">Total Price: <?php echo number_format($total_price, 2); ?> USD</p>
        <?php else : ?>
            <p>No fish caught for this reservation.</p>
        <?php endif; ?>
    </div>
    <script>
        // JavaScript to print the receipt
        window.onload = function() {
            window.print();
        };
    </script>
</body>
</html>
