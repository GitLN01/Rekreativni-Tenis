<?php
require_once './partials/navigacija.php';
?>
<?php
require_once '../DAO/TerenDAO.php';
require_once '../DAO/KorisnikDAO.php';
require_once '../model/Teren.php';
require_once '../DAO/MecDAO.php';

$tereniDAO = new TerenDAO();
$tereni = $tereniDAO->getAllTereni();

$korinikDAO = new KorisnikDAO();
$igraci = $korinikDAO->getAllIgraci();

$mecDAO = new MecDAO();
$mecevi = $mecDAO->getAllMecevi();

session_start();
$vremeActivneSesije = isset($_SESSION['last_active1']) ? $_SESSION['last_active1'] : 0;

if (time() - $vremeActivneSesije < 10 * 60) {
    if (!isset($_SESSION['loginK'])) {
        header("Location: ./login.php");
    } else {
?>
        <div class="container-fluid" style="background-repeat: no-repeat; background-size: cover; background-image: url('images/carousel1.jpg'); overflow-y: scroll; height: 100vh;">
            <?php
            $msg = isset($_SESSION['msg']) ? $_SESSION['msg'] : '';
            if (!empty($msg)) {
            ?>
                <div class="toast show position-fixed bottom-0 end-0 p-3" style="z-index: 11; background-color: #ffd4dc;">
                    <div class="toast-header" style="background-color: #ffd4dc;">
                        <strong class="me-auto"></strong>
                        <button type="button" class="btn-close" data-bs-dismiss="toast"></button>
                    </div>
                    <div class="toast-body">
                        <p><?= $msg ?></p>
                    </div>
                </div>
            <?php
            }
            unset($_SESSION['msg']);
            ?>
            <div class="row mt-4" style="width: 45%; margin-left: auto; margin-right: auto;">
                <div class="col-md-12">
                    <form id="formRezervacija" action="../controller-klubovi/Rezervacija.php?action=insertSingle" method="post" class="border rounded p-5" style="width: 90%; background-color: rgba(255,255,255,0.8); border-radius: 10px; padding: 20px;">
                        <div class="mb-3">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="id_igraca1" class="form-label">Protivnik1 <span class="text-danger">*</span></label>
                                    <select name="id_igraca1" class="form-control">
                                        <option value="" selected></option>
                                        <?php foreach ($igraci as $item) : ?>
                                            <option value="<?= $item['id'] ?>"><?php echo $item['ime'] . ' ' . $item['prezime'] ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="id_igraca2" class="form-label">Protivnik2 <span class="text-danger">*</span></label>
                                    <select name="id_igraca2" class="form-control">
                                        <option value="" selected></option>
                                        <?php foreach ($igraci as $item) : ?>
                                            <option value="<?= $item['id'] ?>"><?php echo $item['ime'] . ' ' . $item['prezime'] ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="id_terena" class="form-label">Teren <span class="text-danger">*</span></label>
                            <select name="id_terena" class="form-control">
                                <option value="" selected></option>
                                <?php foreach ($tereni as $item) : ?>
                                    <option value="<?= $item['id'] ?>"><?php echo $item['naziv'] ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="id_meca" class="form-label">Meč <span class="text-danger">*</span></label>
                            <select name="id_meca" class="form-control">
                                <option value="" selected></option>
                                <?php foreach ($mecevi as $item) : ?>
                                    <option value="<?= $item['id'] ?>"><?php echo $item['tip_meca'] ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="datum" class="form-label">Datum <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" name="datum" value="<?= date("Y-m-d") ?>">
                        </div>
                        <div class="mb-3">
                            <label for="vreme" class="form-label">Vreme <span class="text-danger">*</span></label>
                            <input type="time" class="form-control" name="vreme">
                        </div>
                        <button type="submit" class="btn btn-primary">Sačuvaj</button>
                        <p class="text-danger"><?= isset($_SESSION['msg']) ? $_SESSION['msg'] : '' ?></p>
                    </form>
                </div>
            </div>
        </div>
        <script src="./js/jquery-3.6.0.js"></script>
        <script src="./js/jquery.validate.min.js"></script>
        <script src="./js/validacija-rezervacija.js"></script>
<?php
    }
} else {
    session_unset();
    session_destroy();
    header("Location: ./login.php");
}

$_SESSION['last_active1'] = time();
require_once './partials/footer.php';
?>
