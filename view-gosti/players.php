<?php
require_once './partials/navigacija.php';

require_once '../DAO/KorisnikDAO.php';
require_once '../model/Korisnik.php';

$korisnikDAO = new KorisnikDAO();
$igraci = $korisnikDAO->getAllIgraci();
?>

<div class="container-fluid" style="overflow: hidden; background-repeat: no-repeat; background-size: cover; background-image: url('images/carousel3.jpg');">
    <div class="row">
        <?php

        $msg = isset($_SESSION['msg']) ? $_SESSION['msg'] : '';
        if (!empty($msg)) {
            ?>
            <div class="toast show position-fixed bottom-0 end-0 p-3" style="z-index: 11;">
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
        <h2 class="m-4 text-white">Prikaz svih igrača</h2>
        <div class="container mt-3 mb-5 p-3" style="background-color: rgba(255, 255, 255, 0.8); border-radius: 10px;">
            

            <table id="igraciTable" class="table table-bordered table-striped table-hover text-center">
                <thead class="table-dark sticky-top bg-white">
                    <tr>
                        <th>Ime</th>
                        <th>Prezime</th>
                        <th>Visina</th>
                        <th>Godine</th>
                        <th>Pobede</th>
                        <th>Porazi</th>
                        <th>Email</th>
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

<script>
    $(document).ready(function() {
        $('#igraciTable').DataTable({
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

<?php require_once './partials/footer.php'; ?>
