<?php
session_start();
include '../config.php';

if (!isset($_GET['op']) || !isset($_GET['id'])) {
    echo "Invalid request";
    exit();
}

$op = $_GET['op'];
$reservation_id = $_GET['id'];

if ($op == 'kolam') {
    // Fetch reservation details for the pool
    $sql = "SELECT r.*, k.nama_kolam, k.harga_perjam
            FROM reservasi r
            INNER JOIN kolam_pemancingan k ON r.id_kolam = k.id_kolam
            WHERE r.id_reservasi = $reservation_id";
    $result = $conn->query($sql);
    $reservation = $result->fetch_assoc();

    if ($reservation) {
        $start_time = new DateTime($reservation['waktu_mulai']);
        $end_time = new DateTime($reservation['waktu_selesai']);
        $interval = $start_time->diff($end_time);
        $hours = $interval->h + ($interval->days * 24);
        $total_price = $hours * $reservation['harga_perjam'];
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
                <p>Reservation Date: <?php echo $reservation['tgl_pemakaian']; ?></p>
                <p>Pool: <?php echo $reservation['nama_kolam']; ?></p>
                <p>Time: <?php echo $reservation['waktu_mulai'] . ' - ' . $reservation['waktu_selesai']; ?></p>
                <p>Total Hours: <?php echo $hours; ?></p>
                <p>Price per Hour: <?php echo $reservation['harga_perjam']; ?></p>
                <p>Total Price: Rp<?php echo number_format($total_price, 2); ?></p>
            </div>
            <script>
                // JavaScript to print the receipt
                window.onload = function() {
                    window.print();
                };
            </script>
        </body>
        </html>

        <?php
    } else {
        echo "Reservation not found.";
    }
} elseif ($op == 'mancing') {
    // Fetch reservation details for the fishing
    $sql_reservation = "SELECT * FROM reservasi WHERE id_reservasi = $reservation_id";
    $result_reservation = $conn->query($sql_reservation);
    $reservation = $result_reservation->fetch_assoc();

    if ($reservation) {
        // Fetch fish caught details for the reservation
        $sql_fish = "SELECT h.*, i.nama_ikan, i.harga_per_kg 
                     FROM hasilMancing h 
                     INNER JOIN ikan i ON h.id_ikan = i.id_ikan 
                     WHERE h.id_reservasi = $reservation_id AND h.jumlah_ikan > 0";
        $result_fish = $conn->query($sql_fish);

        // Calculate total price based on fish caught
        $total_price = 0;
        $fish_caught = [];
        while ($fish = $result_fish->fetch_assoc()) {
            $fish_caught[] = $fish;
            $total_price += $fish['jumlah_ikan'] * $fish['harga_per_kg'];
        }

        if (!empty($fish_caught)) {
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
                    <p>Reservation Date: <?php echo $reservation['tgl_pemakaian']; ?></p>
                    <p>Time: <?php echo $reservation['waktu_mulai'] . ' - ' . $reservation['waktu_selesai']; ?></p>
                </div>

                <div class="container">
                    <h3>Fish Caught</h3>
                    <table>
                        <tr>
                            <th>Fish Name</th>
                            <th>Quantity</th>
                            <th>Total Weight (kg)</th>
                            <th>Price per kg (IDR)</th>
                            <th>Total Price (IDR)</th>
                        </tr>
                        <?php foreach ($fish_caught as $fish) : ?>
                            <tr>
                                <td><?php echo $fish['nama_ikan']; ?></td>
                                <td><?php echo $fish['jumlah_ikan']; ?></td>
                                <td><?php echo $fish['berat_total']; ?></td>
                                <td><?php echo $fish['harga_per_kg']; ?></td>
                                <td><?php echo $fish['jumlah_ikan'] * $fish['harga_per_kg']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                    <p class="total">Total Price: Rp<?php echo number_format($total_price, 2); ?></p>
                </div>

                <script>
                    // JavaScript to print the receipt
                    window.onload = function() {
                        window.print();
                    };
                </script>
            </body>
            </html>

            <?php
        } else {
            echo "No fish caught for this reservation.";
        }
    } else {
        echo "Reservation not found.";
    }
} else {
    echo "Invalid operation.";
}

$conn->close();
?>
