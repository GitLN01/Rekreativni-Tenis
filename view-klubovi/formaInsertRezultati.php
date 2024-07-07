<?php
require_once './partials/navigacija.php';
require_once '../DAO/RezervacijeDAO.php';
require_once '../model/PregledRezultata.php';
require_once '../DAO/PregledRezultataDAO.php';

session_start();
$rezultatiDAO = new PregledRezultataDAO();
$rezultati = $rezultatiDAO->getAllJOIN();

$rezervacijeDAO = new RezervacijeDAO();
$rezervacije = $rezervacijeDAO->getAllRezervacije();

$rezultat = isset($_SESSION['rezultat']) ? unserialize($_SESSION['rezultat']) : new PregledRezultata();
unset($_SESSION['rezultat']);

$vremeActivneSesije = isset($_SESSION['last_active1']) ? $_SESSION['last_active1'] : 0;

if (time() - $vremeActivneSesije < 10 * 60) {
    if (!isset($_SESSION['loginK'])) {
        header("Location: ./login.php");
    } else {
?>
         <div class="container-fluid"
         style="background-repeat: no-repeat; background-size: cover; background-image: url('images/carousel1.jpg'); overflow-y: scroll; height: 100vh;">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <form id="formRezultat" action="../controller-klubovi/controllerRezultat.php?action=insert" method="post" class="border rounded p-4  mt-3" style="background-color: rgba(255, 255, 255, 0.8);">

                        <div class="mb-3">
                            <label for="rezultat" class="form-label">Rezultat <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="rezultat" name="rezultat" placeholder="x-x" value="<?= $rezultat->getRezultat() ?>">
                        </div>

                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="potvrda_rezultata" name="potvrda_rezultata" <?php echo $rezultat->getPotvrda_rezultata() == 1 ? 'checked' : ''; ?>>
                            <label class="form-check-label" for="potvrda_rezultata"> Potvrda rezultata </label>
                        </div>

                        <div class="mb-3">
                            <label for="id_rezervacije" class="form-label"> Rezervacija <span class="text-danger">*</span></label>
                            <select name="id_rezervacije" class="form-control">
                                <option value=""></option>
                                <?php foreach ($rezervacije as $item) : ?>
                                    <option value="<?= $item['id_r'] ?>"> <?php echo 'Id: ' . $item['id_r'] . ';   Datum:  ' . $item['datum'] . '; Vreme:' . $item['vreme'] . '; Teren:' . $item['naziv'] ?> </option>
                                <?php endforeach ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="status_meca" class="form-label"> Status meča <span class="text-danger">*</span></label>
                            <select name="status_meca" class="form-control">
                                <option value=""></option>
                                <option value="odigran">Odigran</option>
                                <option value="otkazan">Otkazan</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">Sačuvaj</button>
                        <?php
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
        <script src="./js/validacija-rezultati.js"></script>
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
