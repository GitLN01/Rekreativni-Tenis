<?php
require_once './partials/navigacija.php';
require_once '../model/Korisnik.php';
session_start();

if (time() - $_SESSION['last_active'] < 10 * 60) {
    if (!isset($_SESSION['loginKorisnik'])) {
        header("Location:./loginIgraci.php");
    } else {
        $korisnik = isset($_SESSION['loginKorisnik']) ? unserialize($_SESSION['loginKorisnik']) : new Korisnik();
        ?>

        <div class="container">
            <div class="row" style="height: 68px; background-color:#09731e">

                <div class="row">
                    <div class="col-md-6">
                        <?php
                        $sati = date('H');
                        $pozdrav = '';
                        if ($sati >= 4 && $sati <= 9) {
                            $pozdrav = 'Dobro jutro';
                        } else if ($sati >= 10 && $sati <= 19) {
                            $pozdrav = 'Dobar dan';
                        } else if ($sati >= 20 && $sati <= 24) {
                            $pozdrav = 'Dobro veče';
                        } else {
                            $pozdrav = 'Dobro jutro';
                        }
                        $pozdrav = $pozdrav . ' i dobrodošli!';
                        ?>
                        <h3 class="text-white py-3"><?= $pozdrav ?></h3>
                    </div>

                    <!-- ODJAVA IZ SESIJE -->
                    <div class="col-md-6">
                        <div class="dropdown py-3 position-fixed right-0 end-0 p-3" style="border: 2px solid white">
                            <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle"
                                id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                                <?php if (isset($korisnik['profilna_slika'])): ?>
                                    <img width="32" height="32" class="rounded-circle me-2"
                                        src="data:image/png/image/jpeg;base64,<?= base64_encode($korisnik['profilna_slika']) ?>"
                                        alt="Profilna slika">
                                <?php else: ?>
                                    <img src="./images/user128.png" width="32" class="rounded-circle me-2" height="32"
                                        alt="Profilna slika">
                                <?php endif; ?>
                                <strong><?= $korisnik['ime'] . ' ' . $korisnik['prezime'] ?></strong>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
                                <li><a class="dropdown-item" href="profil.php">Profil</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item"
                                        href="../controller-igraci/LoginIgraci.php?action=logoutIgraci">Odjava</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12" style="position:relative;padding:0;z-index:-1;left:0px;top:-5px;">
                    <div id="carouselSlide" class="carousel slide" data-bs-ride="carousel">

                        <!-- Images with captions -->
                        <div class="carousel-inner">
                            <div class="carousel-item active" data-bs-interval="5000">
                                <img src="images/carousel1.jpg" class="d-block w-100" style="height: 100vh; object-fit: cover;"
                                    alt="...">
                                <div class="carousel-caption d-none d-md-block" style="top: 20%; transform: translateY(-20%);">
                                    <h1 class="text-white" style="font-size: 2.5rem;">"I never look back, I look forward." -
                                        Steffi Graf</h1>
                                    <p class="text-white" style="font-size: 1.5rem;">Inspiration to always move ahead.</p>
                                </div>
                            </div>
                            <div class="carousel-item" data-bs-interval="5000">
                                <img src="images/carousel2.jpg" class="d-block w-100" style="height: 100vh; object-fit: cover;"
                                    alt="...">
                                <div class="carousel-caption d-none d-md-block" style="top: 20%; transform: translateY(-20%);">
                                    <h1 class="text-white" style="font-size: 2.5rem;">"Success is a journey, not a destination."
                                        - Arthur Ashe</h1>
                                    <p class="text-white" style="font-size: 1.5rem;">Focus on the process.</p>
                                </div>
                            </div>
                            <div class="carousel-item" data-bs-interval="5000">
                                <img src="images/carousel3.jpg" class="d-block w-100" style="height: 100vh; object-fit: cover;"
                                    alt="...">
                                <div class="carousel-caption d-none d-md-block" style="top: 20%; transform: translateY(-20%);">
                                    <h1 class="text-white" style="font-size: 2.5rem;">"You have to believe in the long term plan
                                        you have but you need the short term goals to motivate and inspire you." - Roger Federer
                                    </h1>
                                    <p class="text-white" style="font-size: 1.5rem;">Set goals, big and small.</p>
                                </div>
                            </div>
                        </div>

                        <!-- Control buttons -->
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselSlide"
                            data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselSlide"
                            data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <?php
    }
} else {
    session_unset();
    session_destroy();
    header("Location: loginIgraci.php");
}

$_SESSION['last_active'] = time();

require_once './partials/footer.php';

?>