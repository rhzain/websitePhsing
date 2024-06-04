<?php
$isDark = true;
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Phisnia</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" href="img/logo.png" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body class="<?php echo $isDark ? 'dark' : 'light'?>">
    <header>
        <nav>
            <ul>
                <li><a href="index.php">
                        <div class="phisnia">Phisnia\\</div>
                    </a></li>
                <li>
                    <?php
                    // Get the current page filename
                    $current_page = basename($_SERVER['REQUEST_URI']);

                    // Check if the current page is admin-panel.php
                    if ($current_page == "admin-panel.php" || $current_page == "admin-edit.php") {
                        echo '<a href="logout.php"><div class="admin">Logout</div></a>';
                    } else {
                        // Check if admin session is set
                        if (isset($_SESSION['admin'])) {
                            echo '<a href="admin-panel.php"><div class="admin">' . $_SESSION['admin'] . '</div></a>';
                        } else {
                            echo '<a href="admin-login.php"><div class="admin">Admin</div></a>';
                        }
                    }
                    ?>

                </li>
            </ul>
        </nav>
        --
    </header>