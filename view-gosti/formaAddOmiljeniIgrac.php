<?php
require_once './partials/navigacija.php';
require_once '../model/Korisnik.php';
require_once '../DAO/KorisnikDAO.php';

session_start();

$korisnikDAO = new KorisnikDAO();
$igraci = $korisnikDAO->getAllIgraci();

$igrac = isset($_SESSION['igrac']) ? unserialize($_SESSION['igrac']) : new Korisnik();
unset($_SESSION['igrac']);
?>

<div class="container-fluid" style="background-image: url('images/carousel3.jpg'); background-repeat: no-repeat; background-size: cover; overflow-y: auto; height: 100vh;">
    <div class="row justify-content-center align-items-center" style="min-height: 100vh;">
        <div class="col-md-6">
            <?php
            $msg = isset($_SESSION['msg']) ? $_SESSION['msg'] : '';
            if (!empty($msg)) {
            ?>
                <div class="toast show position-fixed bottom-0 end-0 p-3" style="z-index: 11">
                    <div class="toast-header">
                        <strong class="me-auto"></strong>
                        <button type="button" class="btn-close" data-bs-dismiss="toast"></button>
                    </div>
                    <div class="toast-body">
                        <p><?= $msg ?></p>
                    </div>
                </div>
            <?php } ?>

            <form id="formIgrac" action="../controller-gosti/OmiljeniIgraciController.php?action=sacuvaj" method="post" class="border rounded p-5" style="background-color: rgba(255, 255, 255, 0.9);">
                <h3 class="text-center mb-4">Izaberite omiljenog igrača</h3>
                <div class="mb-3">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="ime" class="form-label">Ime <span class="text-danger">*</span></label>
                            <select name="ime" class="form-control" required>
                                <?php foreach ($igraci as $item) : ?>
                                    <option value="<?= $item['ime'] ?>"><?= $item['ime'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="prezime" class="form-label">Prezime <span class="text-danger">*</span></label>
                            <select name="prezime" class="form-control" required>
                                <?php foreach ($igraci as $item) : ?>
                                    <option value="<?= $item['prezime'] ?>"><?= $item['prezime'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-success w-100">Prikaži</button>
                <?php
                $msg = isset($_SESSION['msg']) ? $_SESSION['msg'] : '';
                unset($_SESSION['msg']);
                ?>
                <p class="text-danger mt-3 text-center"><?= $msg ?></p>
            </form>
        </div>
    </div>
</div>

<script src="./js/jquery-3.6.0.js"></script>
<script src="./js/jquery.validate.min.js"></script>
<script src="./js/validacija-igraci.js"></script>

<?php require_once './partials/footer.php'; ?>
