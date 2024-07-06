<?php
require_once './partials/navigacija.php';
require_once '../DAO/SportskiKlubDAO.php';
require_once '../model/SportiskiKlub.php';

$klubDAO = new SportskiKlubDAO();
if (!isset($_SESSION)) {
    session_start();
}
$klubovi = $_SESSION['listaKlubovi'];
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

            <div class="container mt-3 mb-3 p-3" style="background-color: rgba(255, 255, 255, 0.8); border-radius: 10px;">
                <h2 class="text-center mb-4">Lista sportskih klubova</h2>
                <table class="table table-bordered text-center table-striped table-sm" id="dtBasicExample">
                    <thead class="table-dark sticky-top bg-white">
                        <tr>
                            <th class="th-sm">Id</th>
                            <th class="th-sm">Naziv</th>
                            <th class="th-sm">Adresa</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($klubovi as $klub) { ?>
                            <tr>
                                <td><?= $klub['id'] ?></td>
                                <td><?= $klub['naziv'] ?></td>
                                <td><?= $klub['adresa'] ?></td>
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
<script src="./js/datatables.min.js"></script>
<link rel="stylesheet" href="./css/datatables.min.css">
<script>
    $(document).ready(function() {
        $('#dtBasicExample').DataTable({
            "paging": false,
            "info": false,
            "lengthChange": false
        });
    });
</script>

<?php require_once './partials/footer.php'; ?>
