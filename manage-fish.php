<?php
session_start();
include '../config.php';

if (!isset($_SESSION['admin'])) {
    header("Location: admin-login.html");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate input
    $reservation_id = $_POST['reservation_id'];
    $fish_id = $_POST['fish_name'];
    $quantity = $_POST['quantity'];
    $total_weight = $_POST['total_weight'];

    // Check if the fish already exists in hasilMancing for this reservation
    $sql_check_fish = "SELECT * FROM hasilMancing WHERE id_reservasi = $reservation_id AND id_ikan = $fish_id";
    $result_check_fish = $conn->query($sql_check_fish);

    if ($result_check_fish->num_rows > 0) {
        // If the fish exists, update the jumlah_ikan
        $row = $result_check_fish->fetch_assoc();
        $existing_quantity = $row['jumlah_ikan'];
        $new_quantity = $existing_quantity + $quantity;

        $sql_update_fish = "UPDATE hasilMancing 
                            SET jumlah_ikan = $new_quantity, berat_total = berat_total + $total_weight 
                            WHERE id_reservasi = $reservation_id AND id_ikan = $fish_id";

        if ($conn->query($sql_update_fish) === TRUE) {
            echo "Fish quantity updated successfully.";
        } else {
            echo "Error: " . $sql_update_fish . "<br>" . $conn->error;
        }
    } else {
        // If the fish doesn't exist, insert a new record
        $sql_insert_fish = "INSERT INTO hasilMancing (id_reservasi, id_ikan, jumlah_ikan, berat_total) 
                            VALUES ($reservation_id, $fish_id, $quantity, $total_weight)";
        if ($conn->query($sql_insert_fish) === TRUE) {
            echo "Fish caught added successfully.";
        } else {
            echo "Error: " . $sql_insert_fish . "<br>" . $conn->error;
        }
    }

    // Redirect back to fishing-result.php
    header("Location: fishing-result.php?id=$reservation_id");
    exit();
} else {
    header("Location: admin-dashboard.php"); // Redirect if accessed directly
    exit();
}
?>
