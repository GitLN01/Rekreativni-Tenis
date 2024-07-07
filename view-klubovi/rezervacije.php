<?php
require_once './partials/navigacija.php';
require_once '../DAO/RezervacijeDAO.php';
require_once '../DAO/KorisnikDAO.php';
require_once '../model/Korisnik.php';

$rezervacijeDAO = new RezervacijeDAO();
$korisnikDAO = new KorisnikDAO();

session_start();
$vremeActivneSesije = isset($_SESSION['last_active1']) ? $_SESSION['last_active1'] : 0;

if (time() - $vremeActivneSesije < 10 * 60) {
    if (!isset($_SESSION['loginK'])) {
        header("Location: ./login.php");
    } else {
        $rezervacije = $rezervacijeDAO->getAllRezervacije();
        ?>

        <div class="container-fluid" style="background-repeat: no-repeat; background-size: cover; background-image: url('images/carousel1.jpg'); overflow-y: scroll; height: 100vh;">
            <h1 class="h1 m-2 mt-3" style="color:white;">Prikaz svih terena:</h1>
            <div class="container m-3" style="width: 90%; background-color: rgba(255,255,255,0.8); border-radius: 10px; padding: 20px;">
                <div class="row">
                    <div class="col-md-12">
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
                            <?php
                        }
                        unset($_SESSION['msg']);
                        ?>
                        <div class="container ">
                            <table class="table table-bordered text-center table-striped table-sm mt-3" id="dtBasicExample">
                                <thead class="table-dark sticky-top bg-white">
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
                                    <?php foreach ($rezervacije as $item): ?>
                                        <tr>
                                            <td>
                                                <?php
                                                $igrac1 = $korisnikDAO->getAllIgraciById($item['id_igraca1']);
                                                echo $igrac1 ? $igrac1['ime'] . ' ' . $igrac1['prezime'] : '/';
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                $igrac2 = $korisnikDAO->getAllIgraciById($item['id_igraca2']);
                                                echo $igrac2 ? $igrac2['ime'] . ' ' . $igrac2['prezime'] : '/';
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                $igrac3 = $korisnikDAO->getAllIgraciById($item['id_igraca3']);
                                                echo $igrac3 ? $igrac3['ime'] . ' ' . $igrac3['prezime'] : '/';
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                $igrac4 = $korisnikDAO->getAllIgraciById($item['id_igraca4']);
                                                echo $igrac4 ? $igrac4['ime'] . ' ' . $igrac4['prezime'] : '/';
                                                ?>
                                            </td>
                                            <td><?= $item['naziv'] ?></td>
                                            <td><?= $item['tip_meca'] ?></td>
                                            <td><?= $item['datum'] ?></td>
                                            <td><?= $item['vreme'] ?></td>
                                            <td><a class="btn btn-danger btn-sm"
                                                   href="../controller-klubovi/Rezervacija.php?action=delete&id=<?= $item['id_r'] ?>&id_terena=<?= $item['id_terena'] ?>">Poništi</a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-center m-4">
                <a class="btn btn-primary btn-lg" href="formaInsertRezervacijaDouble.php">Rezerviši double</a>&nbsp;&nbsp;&nbsp;
                <a class="btn btn-primary btn-lg" href="formaInsertRezervacijaSingle.php">Rezerviši single</a>
            </div>
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
    }
} else {
    session_unset();
    session_destroy();
    header("Location: ./login.php");
}

$_SESSION['last_active1'] = time();
require_once './partials/footer.php';
?>
