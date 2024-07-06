<?php
require_once './partials/navigacija.php';

require_once '../DAO/TerenDAO.php';
require_once '../model/Teren.php';
require_once '../model/SportiskiKlub.php';
require_once '../DAO/SportskiKlubDAO.php';

$klubDAO = new SportskiKlubDAO();
$klubovi = $klubDAO->getAllSportskiKlubovi();
$brSlobodnihTereni = 0;

$terenDAO = new TerenDAO();
$tereni = $terenDAO->getAllTereni();
?>

<div class="container-fluid" style="background-repeat: no-repeat; background-size: cover; background-image: url('images/carousel3.jpg'); overflow-y: scroll; height: 100vh;">
    
    <h2 class="m-4 text-white">Broj trenutno slobodnih terena: <?= $brSlobodnihTereni ?></h2>
    <h3><a href="freegrounds.php" class="text-white text-decoration-underline" style="padding-left:80px;">Prikaz slobodnih terena</a></h3>
    
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
            <?php foreach ($tereni as $item): ?>
                <div class="col">
                    <div class="card text-white bg-success m-2">
                        <?php $image = "images/" . $item['vrsta_podloge'] . ".jpg"; ?>
                        <img src="<?= $image ?>" class="card-img-top" style="object-fit: cover; height: 200px;" alt="...">
                        <div class="card-body">
                            <h5 class="card-title"><?= $item['naziv'] ?></h5>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item bg-success text-white">Lokacija: <?= $item['lokacija'] ?></li>
                            <li class="list-group-item bg-success text-white">Vrsta podloge: <?= $item['vrsta_podloge'] ?>
                            </li>
                            <li class="list-group-item bg-success text-white">Kapacitet: <?= $item['kapacitet'] ?></li>
                            <li class="list-group-item bg-success text-white">
                                Klub:
                                <?php
                                $klub = $klubDAO->getKluboviById($item['id_kluba']);
                                echo $klub ? $klub['naziv'] : '/';
                                ?>
                            </li>
                            <li class="list-group-item bg-success text-white">Zauzetost:
                                <?= $item['zauzet'] == 0 ? 'Slobodan' : 'Zauzet' ?></li>
                        </ul>
                    </div>
                </div>
                <?php if ($item['zauzet'] == 0)
                    $brSlobodnihTereni++; ?>
            <?php endforeach; ?>
        </div>


    </div>
</div>

<?php require_once './partials/footer.php'; ?>