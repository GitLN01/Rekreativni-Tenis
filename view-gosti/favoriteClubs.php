<?php
require_once './partials/navigacija.php';
require_once '../model/SportiskiKlub.php';
require_once '../DAO/SportskiKlubDAO.php';
session_start();

$klubDAO = new SportskiKlubDAO();
$klubovi = $klubDAO->getAllSportskiKlubovi();
?>
<?php
$igrac = isset($_SESSION['klub']) ? unserialize($_SESSION['klub']) : new SportiskiKlub();
unset($_SESSION['igrac']);
?>

<div class="container-fluid" style="background-image: url('images/carousel3.jpg'); background-repeat: no-repeat; background-size: cover; overflow-y: auto; height: 100vh;">
    <div class="row justify-content-center align-items-center" style="min-height: 100vh;">
        <div class="col-md-6">
            <form id="formIgrac" action="../controller-gosti/OmiljeniKluboviController.php?action=sacuvaj" method="post" class="border rounded p-5" style="background-color: rgba(255, 255, 255, 0.8);">
                <h3 class="mb-4 text-center">Izbor omiljenog kluba</h3>
                <div class="mb-3">
                    <label for="naziv" class="form-label">Naziv <span class="text-danger">*</span></label>
                    <select name="naziv" class="form-control">
                        <?php foreach ($klubovi as $item) : ?>
                            <option value="<?= $item['naziv'] ?>"><?= $item['naziv'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <button type="submit" class="btn btn-success w-100">Prikaži</button>
                <?php
                $msg = isset($_SESSION['msg']) ? $_SESSION['msg'] : '';
                unset($_SESSION['msg']);
                ?>
                <p class="text-danger text-center mt-3"><?= $msg ?></p>
            </form>
        </div>
    </div>
</div>

<script src="./js/jquery-3.6.0.js"></script>
<script src="./js/jquery.validate.min.js"></script>
<?php
require_once './partials/footer.php';
?>
