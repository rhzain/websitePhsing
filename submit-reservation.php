<?php
// Database connection
include '../config.php';

$message = "";
$redirect_url = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $date = $_POST['date'];
    $pool = $_POST['pool'];
    $start_time = $_POST['start-time'];
    $end_time = $_POST['end-time'];
    $pembayaran = $_POST['pembayaran'];
    $status = ($pembayaran == 'ots') ? 'Belum Bayar' : 'Sudah Bayar';

    if (isset($_POST['edit']) && $_POST['edit'] == 'true') {
        // Update existing reservation
        $id_reservasi = $_POST['id_reservasi'];
        $sql_pool_id = "SELECT id_kolam FROM kolam_pemancingan WHERE nama_kolam = '$pool'";
        $result = $conn->query($sql_pool_id);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $pool_id = $row['id_kolam'];
        } else {
            $message = "Error: Kolam tidak ditemukan";
        }

        if (empty($message)) {
            $sql_update_reservasi = "UPDATE reservasi SET id_kolam='$pool_id', waktu_mulai='$start_time', waktu_selesai='$end_time', status_reservasi='$status'
                                         WHERE id_reservasi='$id_reservasi'";
            if ($conn->query($sql_update_reservasi) === TRUE) {
                $message = "Reservation updated successfully!";
                $redirect_url = "admin-panel.php";
            } else {
                $message = "Error updating reservasi: " . $conn->error;
            }
        }
    } else {
        // Check if the reservation table is empty and reset auto-increment if needed
        $sql_check_empty = "SELECT COUNT(*) AS count FROM reservasi";
        $result = $conn->query($sql_check_empty);
        $row = $result->fetch_assoc();
        $count = $row['count'];

        if ($count === 0) {
            $sql_reset_auto_increment = "ALTER TABLE reservasi AUTO_INCREMENT = 1";
            if ($conn->query($sql_reset_auto_increment) === TRUE) {
                $message .= " Reservation ID reset successfully!";
            } else {
                $message .= " Error resetting reservation ID: " . $conn->error;
            }
        }
        // Insert new reservation
        $sql_pelanggan = "INSERT INTO pelanggan (nama_pelanggan, alamat_pelanggan, no_telp, alamat_email) 
                          VALUES ('$name', '$address','$phone', '$email')";
        if ($conn->query($sql_pelanggan) !== TRUE) {
            $message = "Error inserting pelanggan: " . $conn->error;
        } else {
            $last_customer_id = $conn->insert_id;
            $sql_pool_id = "SELECT id_kolam FROM kolam_pemancingan WHERE nama_kolam = '$pool'";
            $result = $conn->query($sql_pool_id);
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $pool_id = $row['id_kolam'];
            } else {
                $message = "Error: Kolam tidak ditemukan";
            }

            if (empty($message)) {
                $sql_reservasi = "INSERT INTO reservasi (id_pelanggan, id_kolam, tgl_pemakaian, waktu_mulai, waktu_selesai, status_reservasi) 
                                  VALUES ('$last_customer_id', '$pool_id', '$date', '$start_time', '$end_time', '$status')";
                if ($conn->query($sql_reservasi) === TRUE) {
                    $message = "Reservation submitted successfully!";
                    $redirect_url = "index.php";
                } else {
                    $message = "Error inserting reservasi: " . $conn->error;
                }
            }
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Reservation Status</title>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var message = "<?php echo addslashes($message); ?>";
            if (message) {
                alert(message);
                <?php if (!empty($redirect_url)) { ?>
                    window.location.href = "<?php echo $redirect_url; ?>";
                <?php } ?>
            } else {
                window.history.back();
            }
        });
    </script>
</head>

<body>
</body>

</html>