<?php

include '../config.php';

$sql = "SELECT * FROM kolam_pemancingan";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Phisnia</title>
    <link rel="stylesheet" href="css/kolam.css">
    <link rel="icon" href="img/logo.png" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body>
    <header>
        <nav>
            <ul>
                <li><a href="index.php">
                        <div class="phisnia">Phisnia\\</div>
                    </a>
                </li>
            </ul>
            <div class="layer sun" id="sun">
                <img src="svg/sun.svg" alt="Sun">
            </div>
        </nav>
    </header>
    <main class="index">
        <div class="parallax">
            <div class="waves" id="waves">
                <div class="wave wave2"><img src="svg/wave2.svg" alt="wave2"></div>
                <div class="layer title" id="title">
                    <p>Kolam Kami</p>
                </div>
                <div class="wave wave1"><img src="svg/wave1.svg" alt="wave1"></div>
            </div>
            <div class="layer obj1" id="obj1">
                <img src="svg/cliff.svg" alt="Cliff">
                <div class="layer obj1 rod">
                    <img src="svg/rod.svg">
                </div>
            </div>
            <div class="layer obj2" id="obj2">
                <img src="svg/cliff.svg" alt="Cliff">
            </div>
        </div>
        <section class="kolam-box" id="section">
            <?php if ($result->num_rows > 0) : ?>
                <div class="section">
                    <?php while ($row = $result->fetch_assoc()) : ?>
                        <div class="section__data <?php echo $row['id_kolam']; ?>">
                            <div class="left-half">
                                <div class="section_img">
                                    <img src="img/<?php echo strtolower($row['nama_kolam']); ?>.jpg" alt="<?php echo strtolower($row['nama_kolam']); ?>">
                                </div>
                            </div>
                            <div class="right-half">
                                <h2 class="section__title"><?php echo $row['nama_kolam']; ?></h2>
                                <div class="section__desc"><?php echo $row['deskripsi']; ?></div>
                            </div>
                        </div>
                    <?php endwhile; ?>

                <?php else : ?>
                    <p>No reservations found.</p>
                <?php endif; ?>
                </div>
                <div class="last">
                    <div>
                        <a href="reservations.php" class="none">
                            <div class="section__title">Reservasi Sekarang</div>
                        </a>
                        <div class="section__desc">
                            "Di tepian pantai yang menyejukkan, dalam pelukan matahari dan lagu angin yang membelai, aku memasuki dunia ajaib memancing. Setiap lemparan joran adalah sebuah tarian dengan makhluk laut, di mana setiap tarikan adalah seruan cinta dari samudera. Mari, kita jalin hubungan yang tak terlupakan dengan alam, di mana kita berdansa dengan ikan di bawah sinar mentari yang hangat. Rasakan keajaiban dan keindahan dalam setiap gerakan, dan biarkan laut menjadi panggung bagi petualangan kita. Ayo, mari kita temukan pesona yang tak ternilai dalam perjalanan memancing kita bersama!"
                        </div>
                        <div class="desc__quote">~Budi</div>
                    </div>
                </div>
        </section>
    </main>
    <footer>
        <p>&copy;
            <a href="aboutUs.php" class="who">Phisnia</a>. All rights revoked.
        </p>
    </footer>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            console.log("Document Loaded");

            let sun = document.getElementById('sun');
            let title = document.getElementById('title');
            let obj1 = document.getElementById('obj1');
            let obj2 = document.getElementById('obj2');

            console.log(sun, title, obj1, obj2); // Check if elements are correctly selected

            window.addEventListener('scroll', () => {
                console.log("Scroll event detected"); // Debug log for scroll event
                let value = window.scrollY;
                console.log("Scroll Value: ", value); // Debug log for scroll value

                sun.style.top = value * -0.5 + 'px';
                title.style.marginTop = value * 2.5 + 'px';
                obj1.style.left = value * -1.5 + 'px';
                obj2.style.right = value * -1.5 + 'px';

                console.log("Sun Position: ", sun.style.top); // Debug log
                console.log("Title Margin: ", title.style.marginTop); // Debug log
                console.log("Obj1 Position: ", obj1.style.left); // Debug log
                console.log("Obj2 Position: ", obj2.style.right); // Debug log
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>