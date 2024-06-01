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
        <nav>
            <ul>
                <li><a href="index.php">
                        <div class="phisnia">Phisnia\\</div>
                    </a></li>
                <li>
                    <?php
                    if (isset($_SESSION['admin'])) {
                        echo '<a href="admin-panel.php"><div class="admin">' . $_SESSION['admin'] . '</div></a>';
                    } else {
                        echo '<a href="admin-login.php"><div class="admin">admin</div></a>';
                    }
                    ?>

                </li>
            </ul>
        </nav>
    </header>