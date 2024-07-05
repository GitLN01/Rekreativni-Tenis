<?php
require_once './partials/navigacija.php';
require_once '../model/Korisnik.php';
?>

<div class="container">
    <div class="row" style="height: 68px; background-color:#6386a3">
        <div class="row">
            <div class="col-md-8">
                <?php
                $sati =  date('H');
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

            <div class="col-md-4">
                <div class="dropdown py-3 position-fixed right-0 end-0 p-3 ">
                    <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="./images/user128.png" width="32" class="rounded-circle me-2" height="32" alt="">
                        <strong>Prijava</strong>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
                        <li><a class="dropdown-item" href="../view-klubovi/login.php">Klubovi</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="../view-igraci/loginIgraci.php">Igraci</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="../view-admin/loginadmin.php">Admin</a></li>
                    </ul>
                </div>
            </div>

            <div class="col-md-12 carousel">
                <!-- Carousel -->
                <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000" style="padding:-5px;">
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                    </div>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="./images/carousel1.jpg" class="d-block w-100" alt="...">
                            <div class="carousel-caption d-none d-md-block">
                                <h5>Motivacioni tekst za tenis</h5>
                                <p>Ovo je mesto gde možete dodati inspirativnu poruku za tenis.</p>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="./images/carousel2.jpg" class="d-block w-100" alt="...">
                            <div class="carousel-caption d-none d-md-block">
                                <h5>Motivacioni tekst za tenis</h5>
                                <p>Drugi inspirativni tekst koji podseća na prednosti tenisa.</p>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="./images/carousel3.jpg" class="d-block w-100" alt="...">
                            <div class="carousel-caption d-none d-md-block">
                                <h5>Motivacioni tekst za tenis</h5>
                                <p>Još jedna motivaciona poruka koja inspiriše na vežbanje tenisa.</p>
                            </div>
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
    </div>
</div>

<?php
require_once './partials/footer.php';
?>
