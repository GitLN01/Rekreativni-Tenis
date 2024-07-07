<?php
require_once './partials/navigacija.php';

require_once '../DAO/SportskiKlubDAO.php';
require_once '../model/SportiskiKlub.php';

$klubDAO = new SportskiKlubDAO();
$klubovi = $klubDAO->getAllSportskiKlubovi();
?>

<div class="container-fluid" style="background-repeat: no-repeat; background-size: cover; background-image: url('images/carousel1.jpg'); overflow-y: scroll; height: 100vh;">
    <div class="row">
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
        <?php }
        ?>
        <h1 class="h1 m-2 mt-3" style="color:white;">Prikaz svih klubova:</h1>
        <div class="container m-3" style="width: 90%; background-color: rgba(255,255,255,0.8); border-radius: 10px; padding: 20px;">
            <table class="table table-bordered table-striped table-hover text-center" cellspacing="0" style="margin-left:auto;margin-right:auto" id="dtBasicExample">
                <thead class="table-dark sticky-top bg-white">
                    <tr>
                        <th class="th-sm">Naziv</th>
                        <th class="th-sm">Adresa</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($klubovi as $item) : ?>
                        <tr>
                            <td><?= $item['naziv'] ?></td>
                            <td><?= $item['adresa'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
  $(document).ready(function() {
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
