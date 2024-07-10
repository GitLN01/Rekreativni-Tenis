<?php
require_once './partials/navigacija.php';
require_once '../model/Korisnik.php';
session_start();

// Check session timeout
$vremeActivneSesije = isset($_SESSION['last_active1']) ? $_SESSION['last_active1'] : 0;
if (time() - $vremeActivneSesije < 10 * 60) {
    // Check if user is logged in
    if (!isset($_SESSION['loginK'])) {
        header("Location: ./login.php");
        exit();
    } else {
        // Deserialize user object from session
        $korisnik = isset($_SESSION['loginK']) ? unserialize($_SESSION['loginK']) : null;

        // Verify if $korisnik is an instance of Korisnik
        if (!($korisnik instanceof Korisnik)) {
            // Handle the error appropriately
            echo "Error: Invalid user data.";
            exit();
        }
?>
        <div class="container" style="background-color: #eee;">
            <section>
                <form action="../controller-klubovi/ProfilController.php?action=edit" method="post" id="formProfil" enctype='multipart/form-data'>
                    <div class="container py-5">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="card mb-4">
                                    <div class="card-body text-center">
                                        <?php
                                        // Check if user has a profile picture
                                        if (empty($korisnik->getProfilnaSlika())) {
                                        ?>
                                            <img src="./images/user128.png" alt="avatar" class="rounded-circle img-fluid" style="width: 150px;">
                                        <?php
                                        } else {
                                            echo '<img style="width: 150px;" class="rounded-circle" src="data:image/png;base64,' . base64_encode($korisnik->getProfilnaSlika()) . '" />';
                                        }
                                        ?>
                                        <h5 class="my-3">
                                            <?php echo $korisnik->getIme() . ' ' . $korisnik->getPrezime() ?>
                                        </h5>
                                        <p class="text-muted mb-1">Radnik u teniskom klubu</p>
                                        <input type="file" class="btn form-control btn-sm" name="slika" />
                                        <p class="text-muted mb-4"></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-8">
                                <div class="card mb-4">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <p class="mb-0">Ime</p>
                                            </div>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="ime" value="<?php echo $korisnik->getIme() ?>">
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <p class="mb-0">Prezime</p>
                                            </div>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="prezime" value="<?php echo $korisnik->getPrezime() ?>">
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <p class="mb-0">Email</p>
                                            </div>
                                            <div class="col-sm-9">
                                                <input type="email" class="form-control" name="email" value="<?php echo $korisnik->getEmail() ?>">
                                                <input type="hidden" name="id" value="<?= $korisnik->getId() ?>">
                                            </div>
                                        </div>
                                        <hr>
                                        <input type="submit" value="Sačuvaj promene" class="btn btn-primary btn-sm">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </section>
        </div>
        <script src="./js/jquery-3.6.0.js"></script>
        <script src="./js/jquery.validate.min.js"></script>
        <script src="./js/validacija-profila.js"></script>

<?php
    }
} else {
    // Destroy session if inactive
    session_unset();
    session_destroy();
    header("Location: login.php");
    exit();
}

// Update session activity time
$_SESSION['last_active1'] = time();
require_once './partials/footer.php';
?>
