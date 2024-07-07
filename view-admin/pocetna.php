<?php
require_once './partials/navigacija.php';
require_once '../model/Korisnik.php';
session_start();
$sessija = isset($_SESSION['last_active']) ? $_SESSION['last_active'] : 0;

if (time() - $sessija < 10 * 60) {
    if (!isset($_SESSION['loginA'])) {
        header("Location:./loginadmin.php");
    } else {
        $korisnik = isset($_SESSION['loginA']) ? unserialize($_SESSION['loginA']) : new Korisnik();
        ?>

        <div class="container" style="background-image:url(images/djokovic.jpg);background-repeat: no-repeat; background-size: cover; overflow-y: auto; height: 100vh;">
            <div class="row" style="height: 68px; background-color:#6386a3;">

                <div class="row">
                    <div class="col-md-6">

                    </div>
                    <div class="col-md-6">
                        <div class="dropdown py-3 position-fixed right-0 end-0 p-3">
                            <button style="background-color: #6386a3;border:none; color:#ffffff; font-size: 20px;"><a class="dropdown-item" href="../controller-admin/Login.php?action=logout">Logout</a></button>
                        </div>
                    </div>
                </div>

            </div>

            <?php
    }
} else {
    session_unset();
    session_destroy();
    header("Location: loginadmin.php");
}

$_SESSION['last_active'] = time();

require_once './partials/footer.php';

?>