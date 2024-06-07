<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: admin-login.html");
    exit();
}

// Database connection
include '../config.php';

if (isset($_GET['id'])) {
    $id_reservasi = $_GET['id'];

    // Prepare the SQL statement to fetch the status
    $sql_get_status = "SELECT status_reservasi FROM reservasi WHERE id_reservasi = ?";
    $stmt = $conn->prepare($sql_get_status);
    $stmt->bind_param("i", $id_reservasi);
    $stmt->execute();
    $stmt->bind_result($status);
    $stmt->fetch();
    $stmt->close();

    if ($status === 'Sudah Bayar') {
        // Prepare the SQL statement to delete the reservation
        $sql_delete_reservasi = "DELETE FROM reservasi WHERE id_reservasi = ?";
        $stmt = $conn->prepare($sql_delete_reservasi);
        $stmt->bind_param("i", $id_reservasi);

        if ($stmt->execute() === TRUE) {
            $message = "Reservation deleted successfully!";
            $redirect_url = "admin-panel.php";
        } else {
            $message = "Error deleting reservation: " . $conn->error;
            $redirect_url = "admin-panel.php";
        }

        $stmt->close();
    } else {
        $message = "Reservasi belum dibayar.";
        $redirect_url = "admin-panel.php";
    }
} else {
    $message = "Invalid request.";
    $redirect_url = "admin-panel.php";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Delete Reservation</title>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var message = "<?php echo addslashes($message); ?>";
            if (message) {
                alert(message);
                window.location.href = "<?php echo $redirect_url; ?>";
            }
        });
    </script>
</head>
<body>
</body>
</html>
