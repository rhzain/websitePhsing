<?php
session_start();
include 'includes\header.php';
?>

<main class="index">
    <div class="deep-sea"></div>
    <div class="waves">
        <div class="wave wave2"><img src="svg/wave2.svg" alt="wave2"></div>
        <div class="wave wave1"><img src="svg/wave1.svg" alt="wave1"></div>
    </div>

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
    <div class="cliff">
        <img src="svg/cliff.svg">
        <div class="parralax-obj1 rod">
            <img src="svg/rod.svg">
        </div>
    </div>
    <div class="parralax-obj2">
    </div>

    <div class="tempat-mancing">tempat mancing buat yang mau mancing . . .</div>

    <section class="undersea">
        <div class="second-depth">
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
        </div>
    </section>
    <div class="last">
        <div>
            <a href="aboutUs.php" class="none">
                <div class="section__title">About Us</div>
            </a>
            <div class="section__desc">
                Kam1 membuat 1n1 dengan sepenuh hat1.
            </div>
        </div>
    </div>
</main>
<?php include 'includes\footer.php'; ?>