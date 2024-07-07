<?php
require_once './partials/navigacija.php';

require_once '../DAO/RezervacijeDAO.php';
require_once '../DAO/KorisnikDAO.php';
require_once '../model/Korisnik.php';
session_start();

$sessija = isset($_SESSION['last_active']) ? $_SESSION['last_active'] : 0;
if (time() - $sessija < 10 * 60) {
    if (!isset($_SESSION['loginA'])) {
        header("Location: ./loginadmin.php");
    } else {
        $rezervacijeDAO = new RezervacijeDAO();
        $rezervacije = $rezervacijeDAO->getAllRezervacije();
        $korisnikDAO = new KorisnikDAO();
?>

<div class="container my-5" style="background-color:#ffffff; padding: 2rem; border-radius: 10px;">
    <?php
    $msg = isset($_SESSION['msg']) ? $_SESSION['msg'] : '';
    if (!empty($msg)) {
    ?>
        <div class="toast show position-fixed bottom-0 end-0 p-3" style="z-index: 11;">
            <div class="toast-header">
                <strong class="me-auto">Poruka</strong>
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
                    <th class="th-sm">Protivnik1</th>
                    <th class="th-sm">Protivnik2</th>
                    <th class="th-sm">Protivnik3</th>
                    <th class="th-sm">Protivnik4</th>
                    <th class="th-sm">Teren</th>
                    <th class="th-sm">Mec</th>
                    <th class="th-sm">Datum</th>
                    <th class="th-sm">Vreme</th>
                    <th class="th-sm">Poništi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($rezervacije as $item) : ?>
                    <tr>
                        <td>
                            <?php
                            $igraci = $korisnikDAO->getAllIgraciById($item['id_igraca1']);
                            if ($igraci != null)
                                echo $igraci['ime'] . ' ' . $igraci['prezime'];
                            else
                                echo '/';
                            ?>
                        </td>
                        <td>
                            <?php
                            $igraci = $korisnikDAO->getAllIgraciById($item['id_igraca2']);
                            if ($igraci != null)
                                echo $igraci['ime'] . ' ' . $igraci['prezime'];
                            else
                                echo '/';
                            ?>
                        </td>
                        <td>
                            <?php
                            $igraci = $korisnikDAO->getAllIgraciById($item['id_igraca3']);
                            if ($igraci != null)
                                echo $igraci['ime'] . ' ' . $igraci['prezime'];
                            else
                                echo '/';
                            ?>
                        </td>
                        <td>
                            <?php
                            $igraci = $korisnikDAO->getAllIgraciById($item['id_igraca4']);
                            if ($igraci != null)
                                echo $igraci['ime'] . ' ' . $igraci['prezime'];
                            else
                                echo '/';
                            ?>
                        </td>
                        <td><?= $item['naziv'] ?></td>
                        <td><?= $item['tip_meca'] ?></td>
                        <td><?= $item['datum'] ?></td>
                        <td><?= $item['vreme'] ?></td>
                        <td><a class="btn btn-danger btn-sm" href="../controller-admin/Rezervacija.php?action=delete&id=<?= $item['id_r'] ?>&id_terena=<?= $item['id_terena'] ?>">Poništi</a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-center mt-4">
        <a class="btn btn-primary btn-lg" href="formaInsertRezervacijaSingle.php">Rezerviši single</a>
        <a class="btn btn-primary btn-lg ms-2" href="formaInsertRezervacijaDouble.php">Rezerviši double</a>
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
