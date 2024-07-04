<?php
require_once './partials/navigacija.php';

require_once '../DAO/SportskiKlubDAO.php';
require_once '../model/SportiskiKlub.php';

$klubDAO = new SportskiKlubDAO();
$klubovi = $klubDAO->getAllSportskiKlubovi();
?>

<div class="container" style="overflow:scroll;">
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

            <table class="table table-bordered  text-center  table-striped  table-sm mt-3" cellspacing="0" style=" margin-left:auto;margin-right:auto" id="dtBasicExample">
                <thead class="table-dark sticky-top bg-white">
                    <tr>
                        <th class="th-sm">Id</th>
                        <th class="th-sm">Naziv</th>
                        <th class="th-sm">Adresa</th>
                    </tr>
                </thead>
                <tbody>


                    <?php foreach ($klubovi as $item) : ?>
                        <tr>
                            <td><?= $item['id'] ?></td>
                            <td><?= $item['naziv'] ?></td>
                            <td><?= $item['adresa'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

            
        </div>
        <script>
            $(document).ready(function() {
                $('#dtBasicExample').DataTable();
                $('.dataTables_length').addClass('bs-select');
                $('.pagination').hide();
                $('#dtBasicExample_info').hide();
                $('#dtBasicExample_paginate').hide();
                $('#dtBasicExample_length').hide();

            });
        </script>

        <?php
        require_once './partials/footer.php';
        ?>