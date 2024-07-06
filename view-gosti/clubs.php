<?php
require_once './partials/navigacija.php';

require_once '../DAO/SportskiKlubDAO.php';
require_once '../model/SportiskiKlub.php';

$klubDAO = new SportskiKlubDAO();
$klubovi = $klubDAO->getAllSportskiKlubovi();
?>

<div class="container-fluid" style="overflow: hidden; background-repeat: no-repeat; background-size: cover; background-image: url('images/carousel1.jpg');">
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
                        <th class="th-sm" style="background-color: #343a40; color: white;">Id</th>
                        <th class="th-sm" style="background-color: #343a40; color: white;">Naziv</th>
                        <th class="th-sm" style="background-color: #343a40; color: white;">Adresa</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($klubovi as $item): ?>
                        <tr>
                            <td style="background-color: #b0b5b1;color:white;font-weight:bold;"><?= $item['id'] ?></td>
                            <td style="background-color: #b0b5b1;color:white;font-weight:bold;"><?= $item['naziv'] ?></td>
                            <td style="background-color: #b0b5b1;color:white;font-weight:bold;"><?= $item['adresa'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>


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