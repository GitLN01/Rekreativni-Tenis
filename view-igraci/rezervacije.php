<?php
require_once './partials/navigacija.php';

require_once '../DAO/RezervacijeDAO.php';
require_once '../DAO/KorisnikDAO.php';
require_once '../model/Korisnik.php';

session_start();

if (time() - $_SESSION['last_active'] < 10 * 60) {
    if (!isset($_SESSION['loginKorisnik'])) {
        header("Location:./loginIgraci.php");
    } else {
        $rezervacijeDAO = new RezervacijeDAO();
        $rezervacije = $rezervacijeDAO->getAllRezervacije();
        $korisnikDAO = new KorisnikDAO();
        $korisnik = isset($_SESSION['loginKorisnik']) ? unserialize($_SESSION['loginKorisnik']) : new Korisnik();
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
                    <?php
                    unset($_SESSION['msg']);
                }
                ?>
                <h1 class="h1 m-2 mt-3" style="color:white;">Prikaz svih rezervacija:</h1>
                <div class="container m-3"
                    style="width: 90%; background-color: rgba(255, 255, 255, 0.8); border-radius: 10px; padding: 20px;">

                    <table class="table table-bordered text-center table-striped table-sm mt-3" cellspacing="0"
                        style="margin-left:auto; margin-right:auto;" id="dtBasicExample">
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
                                    <td>
                                        <?php if ($item['id_igraca1'] == $korisnik['id']) { ?>
                                            <a class="btn btn-danger btn-sm"
                                                href="../controller-igraci/Rezervacija.php?action=delete&id=<?= $item['id_r'] ?>&id_terena=<?= $item['id_terena'] ?>">Poništi</a>
                                        <?php } else { ?>
                                            /
                                        <?php } ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <div class="text-center mt-3">
                    <a class="btn btn-success btn-lg mx-auto" href="formaInsertRezervacijaDouble.php">Rezerviši double</a>
                    <a class="btn btn-success btn-lg mx-auto" href="formaInsertRezervacijaSingle.php">Rezerviši single</a>
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
            </div>
        </div>

        <?php
    }
} else {
    session_unset();
    session_destroy();
    header("Location: ./loginIgraci.php");
}

$_SESSION['last_active'] = time();
require_once './partials/footer.php';
?>