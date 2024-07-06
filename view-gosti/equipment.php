<?php
require_once './partials/navigacija.php';

require_once '../DAO/OpremaDAO.php';
require_once '../model/Oprema.php';

$opremaDAO = new OpremaDAO();
$oprema = $opremaDAO->getAllOpremeTipOpremeJOIN();
?>

<div class="container-fluid" style="background-repeat: no-repeat; background-size: cover; background-image: url('images/carousel3.jpg'); overflow-y: scroll; height: 100vh;">
    
    <h2 class="m-4 text-white">Oprema</h2>
    
    <div class="row justify-content-center">
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

        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4 mx-auto mt-4">
            <?php foreach ($oprema as $item) { ?>
                <div class="col">
                    <div class="card text-white bg-primary m-2">
                        <?php $image = "./images/" . $item['tipovi_opreme'] . ".webp"; ?>
                        <img src="<?= $image ?>" class="card-img-top" style="object-fit: cover; height: 200px;" alt="<?= $item['tipovi_opreme'] ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?= $item['naziv'] ?></h5>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item bg-primary text-white">Opis: <?= $item['opis'] ?></li>
                            <li class="list-group-item bg-primary text-white">Tip opreme: <?= $item['tipovi_opreme'] ?></li>
                        </ul>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>

<?php require_once './partials/footer.php'; ?>
