<?php
session_start();
include 'includes\header.php';
?>

<main class="index">
    <div class="waves">
        <div class="wave wave2"><img src="svg/wave2.svg" alt="wave2"></div>
        <div class="wave wave1"><img src="svg/wave1.svg" alt="wave1"></div>
    </div>
    <div class="deep-sea"></div>

    <!-- Sun -->
    <div class="svg-container" style="width: 33vw;height: 20vh;left: 45vw;top: 0;">
        <img src="svg/sun.svg" alt="Sun" style="width:100%; height:100%;">
    </div>
    <div class="mari-mancing">MAri Mancing
        <div class="reservasi">reservasi di sini</div>
        <a href="reservations.php">
            <div class="svg-container" style="
            max-width: 103.65px;max-height: 74.41px;right: 20%;top: 0;">
                <img src="svg/arrow.svg" alt="arrow" style="width:100%; height:100%;">
            </div>
        </a>
    </div>

    <!-- Cliff -->
    <div class="svg-container" style="
    max-width: 670.5px;
    max-height: 674px;
    left: -2.5px;
    top: 45vh;">
        <img src="svg/cliff.svg" alt="Cliff" style="width:100%; height:100%;">
        <!-- Rod -->
        <div class="svg-container" style="
        width: 308.61px;
        height: 695.06px;
        left: 75%;
        top: -25%;">
            <img src="svg/rod.svg" alt="Cliff" style="width:100%; height:100%;">
        </div>
    </div>

    <div class="tempat-mancing">tempat mancing buat yang mau mancing . . .</div>

    <section class="second-depth">
        <div class="left-half">
            <div class="carousel">
                <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="true">
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                    </div>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="img/ikan1.png" class="d-block w-100" alt="1">
                        </div>
                        <div class="carousel-item">
                            <img src="img/ikan2.png" class="d-block w-100" alt="2">
                        </div>
                        <div class="carousel-item">
                            <img src="img/ikan3.png" class="d-block w-100" alt="3">
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </div>
        <div class="right-half">
            <div class="desc-kolam">
                <a href="kolam.php">
                    <div class="title-kolam">Kolam Kami</div>
                </a>
                Temukan berbagai macam ikan pada tiap kolam!
            </div>
        </div>
    </section>
</main>
<?php include 'includes\footer.php'; ?>