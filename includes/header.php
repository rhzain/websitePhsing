<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Phisnia</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" href="img/logo.png" type="image/png">
</head>

<body>
    <header>
        <h1>Selamat Datang di Phisnia</h1>
        <nav>
            <ul>
                <li><a href="index.php">Beranda</a></li>
                <li><a href="reservations.php">Reservasi</a></li>
                <li>
                    <?php
                    if (isset($_SESSION['admin'])) {
                        echo '<a href="admin-panel.php">' . $_SESSION['admin'] . '</a>';
                    } else {
                        echo '<a href="admin-login.php">Admin</a>';
                    }
                    ?>
                </li>
            </ul>
        </nav>
    </header>