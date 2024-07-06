<?php
require_once './partials/navigacija.php';

require_once '../DAO/TerenDAO.php';
require_once '../model/Teren.php';

$terenDAO = new TerenDAO();
$tereni = $terenDAO->getAllTereni();
?>

<div class="container-fluid" style="background-repeat: no-repeat; background-size: cover; background-image: url('images/carousel3.jpg'); overflow-y: scroll; height: 100vh;">
    <h2 class="m-4 text-white">Prikaz svih terena</h2>

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

    <div class="row justify-content-center">
        <?php foreach ($tereni as $item) { ?>
            <?php if ($item['zauzet'] == 0) { ?>
                <div class="col">
                    <div class="card bg-success text-white m-2" style="width: 18rem;">
                        <?php $image = "./images/" . $item['vrsta_podloge'] . ".jpg"; ?>
                        <img src="<?= $image ?>" class="card-img-top" style="object-fit: cover; height: 200px;" alt="teren">
                        <div class="card-body">
                            <h5 class="card-title"><?= $item['naziv'] ?></h5>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item bg-success text-white">Lokacija: <?= $item['lokacija'] ?></li>
                            <li class="list-group-item bg-success text-white">Vrsta podloge: <?= $item['vrsta_podloge'] ?></li>
                            <li class="list-group-item bg-success text-white">Kapacitet: <?= $item['kapacitet'] ?></li>
                            <li class="list-group-item bg-success text-white">Id kluba: <?= $item['id_kluba'] ?></li>
                        </ul>
                    </div>
                </div>
            <?php } ?>
        <?php } ?>
    </div>

</div>

<?php require_once './partials/footer.php'; ?>
