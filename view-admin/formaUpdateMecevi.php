<?php
require_once './partials/navigacija.php';
?>
<?php
require_once '../model/Mec.php';
session_start();
$sessija = isset($_SESSION['last_active']) ? $_SESSION['last_active']:0;
if (time() - $sessija <  10 * 60) {

    if (!isset($_SESSION['loginA'])) {
        header("Location:./loginadmin.php");
    } else {
?>
        <?php

        $mec = isset($_SESSION['mec1']) ? ($_SESSION['mec1']) : array();
        unset($_SESSION['mec1']);
        //print_r($mec);
        ?>


        <div class="container">
            <div class="row mt-4" style="width: 45%;margin-left:auto;margin-right:auto">
                <div class="col-md-12">
                    <form id="formIgrac" action="../controller-admin/Mecevi.php?action=update" method="post" class="border rounded p-5">
                        <div class="mb-3">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="tip_meca" class="form-label">Tip meča <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="" name="tip_meca" value="<?= isset($mec['tip_meca']) ? $mec['tip_meca'] : ''  ?>">
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="id" value="<?= isset($mec['id']) ? $mec['id'] : ''  ?>">



                        <button type="submit" class="btn btn-primary">Sačuvaj</button>
                        <?php
                        // session_start();
                        $msg = isset($_SESSION['msg']) ? $_SESSION['msg'] : '';
                        unset($_SESSION['msg']);
                        ?>
                        <p class="text-danger"><?= $msg ?></p>
                    </form>
                </div>
            </div>

        </div>
        <script src="./js/jquery-3.6.0.js"></script>
        <script src="./js/jquery.validate.min.js"></script>
        <script src="./js/validacija-mecevi.js"></script>
<?php
    }
} else {
    // REDIREKCIJA NA POCETNU STRANU DA SE OBRISE I UNISTI SESIJA AKO JE ISTEKLA
    session_unset();
    session_destroy();
    header("Location: loginadmin.php");
}

$_SESSION['last_active'] = time();    // update zadnje aktivnosti na sesiji
require_once './partials/footer.php';
?>