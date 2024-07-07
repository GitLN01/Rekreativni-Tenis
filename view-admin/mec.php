<?php
require_once './partials/navigacija.php';

require_once '../DAO/MecDAO.php';
require_once '../model/Mec.php';

session_start();

$sessija = isset($_SESSION['last_active']) ? $_SESSION['last_active'] : 0;
if (time() - $sessija <  10 * 60) {
    if (!isset($_SESSION['loginA'])) {
        header("Location:./loginadmin.php");
    } else {
        $mecDAO = new MecDAO();
        $mec = $mecDAO->getAllMecevi();
?>

<div class="container my-5" style="background-color:#ffffff; padding: 2rem; border-radius: 10px;">
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
    <div class="table-responsive">
        <table id="dtBasicExample" class="table table-bordered text-center table-striped table-hover mt-3">
            <thead class="table-dark">
                <tr>
                    <th class="th-sm">Id</th>
                    <th class="th-sm">Tip meča</th>
                    <th class="th-sm">Obriši</th>
                    <th class="th-sm">Izmeni</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($mec as $item) : ?>
                    <tr>
                        <td><?= $item['id'] ?></td>
                        <td><?= $item['tip_meca'] ?></td>
                        <td><a class="btn btn-danger btn-sm" href="../controller-admin/Mecevi.php?action=delete&id=<?= $item['id'] ?>">IZBRIŠI MEČ</a></td>
                        <td><a class="btn btn-primary btn-sm" href="../controller-admin/Mecevi.php?action=edit&id=<?= $item['id'] ?>">IZMENI MEČ</a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    
    <div class="d-flex justify-content-center mt-4">
        <a class="btn btn-primary btn-lg" href="formaInsertMecevi.php">Dodaj mec</a>
    </div>

    <div class="mt-5">
        <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="false">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>

            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
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
    }
} else {
    session_unset();
    session_destroy();
    header("Location: loginadmin.php");
}

$_SESSION['last_active'] = time();   

require_once './partials/footer.php';
?>
