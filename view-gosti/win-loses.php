<?php
require_once './partials/navigacija.php';

require_once '../DAO/KorisnikDAO.php';
require_once '../model/Korisnik.php';

$korisnikDAO = new KorisnikDAO();
$igraci = $korisnikDAO->getAllIgraciSortWL();
?>

<div class="container">
    <div class="row">
        <?php

        $msg = isset($_SESSION['msg']) ? $_SESSION['msg'] : '';
        if (!empty($msg)) {
        ?>
            <div class="toast show  position-fixed bottom-0 end-0 p-3" style="z-index: 11">
                <div class="toast-header ">
                    <strong class="me-auto"></strong>
                    <button type="button" class="btn-close" data-bs-dismiss="toast"></button>
                </div>
                <div class="toast-body">
                    <p><?= $msg ?></p>
                </div>
            </div>
        <?php }
        ?>
        <div class="container m-3" style="width: 90%;">
        <h3>Rangiranje prema broju pobeda i poreza</h3>
        <a href="win.php">Svi rezultati</a><br>
        <a href="win.php">Rangiranje prema broju pobeda</a><br>
             
            <table class="table table-bordered  text-center  table-striped  table-sm mt-3" cellspacing="0" style=" margin-left:auto;margin-right:auto" id="dtBasicExample">
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

</div>
            
        </div>
   

        <?php
        require_once './partials/podnozije.php';
        ?>