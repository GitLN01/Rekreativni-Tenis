<?php
require_once './partials/navigacija.php';

require_once '../DAO/KorisnikDAO.php';
require_once '../model/Korisnik.php';

$korisnikDAO = new KorisnikDAO();
$igraci = $korisnikDAO->getAllIgraciSortWL();
?>

<div class="container-fluid" style="background-image: url('./images/carousel3.jpg'); background-repeat: no-repeat; background-size: cover; overflow: auto; height: 100vh;">
    <h2 class="m-4 text-white">Rangiranje prema broju pobeda i poraza</h2>

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

    <div class="container mt-3 mb-3 p-3" style="background-color: rgba(255, 255, 255, 0.8); border-radius: 10px;">
        <table class="table table-bordered table-striped table-hover text-center mt-3">
            <thead class="table-dark sticky-top bg-white">
                <tr>
                    <th class="th-sm">Ime</th>
                    <th class="th-sm">Prezime</th>
                    <th class="th-sm">Visina</th>
                    <th class="th-sm">Godine</th>
                    <th class="th-sm">Pobede</th>
                    <th class="th-sm">Porazi</th>
                    <th class="th-sm">Email</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($igraci as $item) : ?>
                    <tr>
                        <td><?= $item['ime'] ?></td>
                        <td><?= $item['prezime'] ?></td>
                        <td><?= $item['visina'] ?></td>
                        <td><?= $item['godine'] ?></td>
                        <td><?= $item['pobeda'] ?></td>
                        <td><?= $item['porazi'] ?></td>
                        <td><?= $item['email'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <h3><a href="results.php" class="m-4 text-white" style="text-decoration:none;">Svi rezultati</a></h3>
    <h3><a href="win.php" class="m-4 text-white" style="text-decoration:none;">Rangiranje prema broju pobeda</a></h3>
</div>

<?php require_once './partials/footer.php'; ?>
