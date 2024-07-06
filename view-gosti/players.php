<?php
require_once './partials/navigacija.php';

require_once '../DAO/KorisnikDAO.php';
require_once '../model/Korisnik.php';

$korisnikDAO = new KorisnikDAO();
$igraci = $korisnikDAO->getAllIgraci();
?>

<div class="container-fluid"
    style="overflow: hidden; background-repeat: no-repeat; background-size: cover; background-image: url('images/carousel2.jpg');">
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
                            <td style="background-color: #b0b5b1;color:white;font-weight:bold;"><?= $item['ime'] ?></td>
                            <td style="background-color: #b0b5b1;color:white;font-weight:bold;"><?= $item['prezime'] ?></td>
                            <td style="background-color: #b0b5b1;color:white;font-weight:bold;"><?= $item['visina'] ?></td>
                            <td style="background-color: #b0b5b1;color:white;font-weight:bold;"><?= $item['godine'] ?></td>
                            <td style="background-color: #b0b5b1;color:white;font-weight:bold;"><?= $item['pobeda'] ?></td>
                            <td style="background-color: #b0b5b1;color:white;font-weight:bold;"><?= $item['porazi'] ?></td>
                            <td style="background-color: #b0b5b1;color:white;font-weight:bold;"><?= $item['email'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <script>
            $(document).ready(function () {
                $('#dtBasicExample').DataTable();
                //$('.dataTables_length').addClass('bs-select');
                //$('.pagination').hide();
                //$('#dtBasicExample_info').hide();
                //$('#dtBasicExample_paginate').hide();
                $('#dtBasicExample_length').hide();

            });
        </script>

        <?php
        require_once './partials/footer.php';
        ?>