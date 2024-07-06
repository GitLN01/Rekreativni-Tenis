<?php
require_once './partials/navigacija.php';
require_once '../DAO/KorisnikDAO.php';
require_once '../model/Korisnik.php';

$korisnikDAO = new KorisnikDAO();
if (!isset($_SESSION)) {
    session_start();
}
$igraci = $_SESSION['lista'];
?>
<div class="container-fluid" style="background-image: url('images/carousel3.jpg'); background-repeat: no-repeat; background-size: cover; overflow-y: auto; height: 100vh;">
    <div class="row justify-content-center align-items-center" style="min-height: 100vh;">
        <div class="col-md-10">
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

            <div class="table-responsive mt-5" style="background-color: rgba(255, 255, 255, 0.9); padding: 2rem; border-radius: 10px;">
                <h3 class="text-center mb-4">Lista Igrača</h3>
                <table class="table table-bordered text-center table-striped table-sm mt-3" id="dtBasicExample">
                    <thead class="table-dark sticky-top">
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
                        <?php foreach ($igraci as $igrac) { ?>
                            <tr>
                                <td><?= $igrac['ime'] ?></td>
                                <td><?= $igrac['prezime'] ?></td>
                                <td><?= $igrac['visina'] ?></td>
                                <td><?= $igrac['godine'] ?></td>
                                <td><?= $igrac['pobeda'] ?></td>
                                <td><?= $igrac['porazi'] ?></td>
                                <td><?= $igrac['email'] ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script src="./js/jquery-3.6.0.js"></script>
<script src="./js/jquery.validate.min.js"></script>
<script src="./js/validacija-igraci.js"></script>

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

<?php require_once './partials/footer.php'; ?>
