<?php
require_once './partials/navigacija.php';
?>
<?php
require_once '../DAO/TerenDAO.php';
require_once '../DAO/SportskiKlubDAO.php';
require_once '../model/Teren.php';

$tereniDAO = new TerenDAO();
$sportskiKlubDAO = new SportskiKlubDAO();

$teren = isset($_SESSION['teren']) ? unserialize($_SESSION['teren']) : new Teren();
unset($_SESSION['teren']);

$klubovi = $sportskiKlubDAO->getAllSportskiKlubovi();

session_start();
$vremeActivneSesije = isset($_SESSION['last_active1']) ? $_SESSION['last_active1'] : 0;

if (time() - $vremeActivneSesije < 10 * 60) {
    if (!isset($_SESSION['loginK'])) {
        header("Location:./login.php");
    } else {
?>
        <div class="container-fluid" style="background-repeat: no-repeat; background-size: cover; background-image: url('images/carousel1.jpg'); overflow-y: scroll; height: 100vh;">
            <div class="container mt-4">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <form id="formTeren" action="../controller-klubovi/controllerTeren.php?action=insert" method="post" class="border rounded p-5" style="background-color: rgba(255, 255, 255, 0.8);">
                            <h2 class="mb-4 text-center">Unos novog terena</h2>
                            <div class="mb-3">
                                <label for="naziv" class="form-label">Naziv <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="naziv" name="naziv" value="<?= $teren->getNaziv() ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="lokacija" class="form-label">Lokacija <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="lokacija" name="lokacija" value="<?= $teren->getLokacija() ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="kapacitet" class="form-label">Kapacitet <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" id="kapacitet" name="kapacitet" value="<?= $teren->getKapacitet() ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="vrsta_podloge" class="form-label">Vrsta podloge <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="vrsta_podloge" name="vrsta_podloge" value="<?= $teren->getVrstaPodloge() ?>" required>
                            </div>
                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" id="zauzet" name="zauzet" <?php echo $teren->getZauzet() ? 'checked' : ''; ?>>
                                <label class="form-check-label" for="zauzet">Zauzet</label>
                            </div>
                            <div class="mb-3">
                                <label for="id_kluba" class="form-label">Klub <span class="text-danger">*</span></label>
                                <select name="id_kluba" class="form-control" required>
                                    <option value="" selected disabled>Izaberite klub...</option>
                                    <?php foreach ($klubovi as $klub) : ?>
                                        <option value="<?= $klub['id'] ?>" <?= ($teren->getIdKluba() == $klub['id']) ? 'selected' : '' ?>><?= $klub['naziv'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Sačuvaj</button>
                            <?php
                            $msg = isset($_SESSION['msg']) ? $_SESSION['msg'] : '';
                            unset($_SESSION['msg']);
                            ?>
                            <p class="text-danger mt-3"><?= $msg ?></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <script src="./js/jquery-3.6.0.js"></script>
        <script src="./js/jquery.validate.min.js"></script>
        <script src="./js/validacija-teren.js"></script>
<?php
    }
} else {
    session_unset();
    session_destroy();
    header("Location: login.php");
}

$_SESSION['last_active1'] = time();
require_once './partials/footer.php';
?>
