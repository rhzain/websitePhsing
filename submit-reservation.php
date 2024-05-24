<?php
// Database connection
$servername = "localhost";
$username = "root"; // default XAMPP username
$password = ""; // default XAMPP password is empty
$dbname = "phisnia"; // the name of your database

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $date = $_POST['date'];
    $pool = $_POST['pool'];
    $start_time = $_POST['start-time'];
    $end_time = $_POST['end-time'];

    // Insert customer data into pelanggan table
    $sql_pelanggan = "INSERT INTO pelanggan (nama_pelanggan, no_telp, alamat_email) 
                      VALUES ('$name', '$phone', '$email')";
    if ($conn->query($sql_pelanggan) !== TRUE) {
        echo "Error: " . $sql_pelanggan . "<br>" . $conn->error;
        $conn->close();
        exit;
    }

    // Get the last inserted customer ID
    $last_customer_id = $conn->insert_id;

    // Get the selected pool's ID
    $sql_pool_id = "SELECT id_kolam FROM kolam_pemancingan WHERE nama_kolam = '$pool'";
    $result = $conn->query($sql_pool_id);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $pool_id = $row['id_kolam'];
        echo "Nama Kolam: " . $pool . "<br>";
        echo "ID Kolam: " . $pool_id . "<br>";
    } else {
        echo "Error: Kolam tidak ditemukan";
        $conn->close();
        exit;
    }


    // Insert reservation into reservasi table
    $sql_reservasi = "INSERT INTO reservasi (id_pelanggan, id_kolam, tgl_pemakaian, waktu_mulai, waktu_selesai, status_reservasi) 
                      VALUES ('$last_customer_id', '$pool_id', '$date', '$start_time', '$end_time', 'Pending')";
    if ($conn->query($sql_reservasi) === TRUE) {
        echo "Reservation submitted successfully!";
    } else {
        echo "Error: " . $sql_reservasi . "<br>" . $conn->error;
    }
}

$conn->close();
