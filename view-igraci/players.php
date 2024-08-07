<?php
require_once './partials/navigacija.php';

require_once '../DAO/KorisnikDAO.php';
require_once '../model/Korisnik.php';

$korisnikDAO = new KorisnikDAO();
$igraci = $korisnikDAO->getAllIgraci();
?>

<div class="container-fluid"
    style="background-repeat: no-repeat; background-size: cover; background-image: url('images/carousel1.jpg'); overflow-y: scroll; height: 100vh;">
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

        <h1 class="h1 m-2 mt-3" style="color:white;">Prikaz svih igrača:</h1>
        <div class="container m-3" style="width: 90%; background-color: rgba(255,255,255,0.8); border-radius: 10px; padding: 20px;">

            <table class="table table-bordered  text-center  table-striped  table-sm mt-3" cellspacing="0"
                style=" margin-left:auto;margin-right:auto" id="dtBasicExample">
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
                    <?php foreach ($igraci as $item): ?>
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

        <script>
            $(document).ready(function () {
                $('#dtBasicExample').DataTable({
                    "paging": true,
                    "lengthChange": true,
                    "searching": true,
                    "ordering": true,
                    "info": true,
                    "autoWidth": false,
                    "responsive": true,
                    "language": {
                        "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Serbian.json"
                    }
                });
            });
        </script>

        <?php
        require_once './partials/footer.php';
        ?>