<?php
require_once './partials/navigacija.php';
require_once '../DAO/PregledRezultataDAO.php';
require_once '../DAO/KorisnikDAO.php';

session_start();
unset($_SESSION['rezultat1']);
unset($_SESSION['rezultat']);

$vremeActivneSesije = isset($_SESSION['last_active1']) ? $_SESSION['last_active1'] : 0;

if (time() - $vremeActivneSesije < 10 * 60) {
    if (!isset($_SESSION['loginK'])) {
        header("Location: ./login.php");
    } else {
        $pregledRezultataDAO = new PregledRezultataDAO();
        $rezultati = $pregledRezultataDAO->getAllJOIN();

        $korisnikDAO = new KorisnikDAO();
?>
        <div class="container-fluid" style="background-image: url('images/carousel1.jpg'); background-size: cover; background-repeat: no-repeat; overflow-y: scroll; height: 100vh;">
            <h1 class="h1 mt-3 text-white">Prikaz svih rezultata:</h1>
            <div class="container mt-3 p-3" style="background-color: rgba(255, 255, 255, 0.8); border-radius: 10px;">
                <?php
                $msg = isset($_SESSION['msg']) ? $_SESSION['msg'] : '';
                if (!empty($msg)) :
                ?>
                    <div class="toast show position-fixed bottom-0 end-0 p-3" style="z-index: 11;">
                        <div class="toast-header bg-primary text-white">
                            <strong class="me-auto">Obaveštenje</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="toast"></button>
                        </div>
                        <div class="toast-body">
                            <p><?= $msg ?></p>
                        </div>
                    </div>
                <?php
                endif;
                unset($_SESSION['msg']);
                ?>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped text-center mt-4" id="dtBasicExample">
                        <thead class="table-dark">
                            <tr>
                                <th>Rezultat</th>
                                <th>Potvrda rezultata</th>
                                <th>Id rezervacije</th>
                                <th>Protivnik 1</th>
                                <th>Protivnik 2</th>
                                <th>Protivnik 3</th>
                                <th>Protivnik 4</th>
                                <th>Status meča</th>
                                <th>Izbriši</th>
                                <th>Izmeni</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($rezultati as $item) : ?>
                                <tr>
                                    <td><?= $item['rezultat'] ?></td>
                                    <td>
                                        <?php if ($item['potvrda_rezultata'] == 1) : ?>
                                            <button class="btn btn-sm btn-outline-success">Potvrđen</button>
                                        <?php else : ?>
                                            <button class="btn btn-sm btn-outline-danger">Nepotvrđen</button>
                                        <?php endif; ?>
                                    </td>
                                    <td><?= $item['id_rezervacije'] ?></td>
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
                                    <td><?= $item['status_meca'] ?></td>
                                    <td><a class="btn btn-danger btn-sm" href="../controller-klubovi/controllerRezultat.php?action=Izbrisi&id=<?= $item['id'] ?>">Izbriši</a></td>
                                    <td><a class="btn btn-primary btn-sm" href="../controller-klubovi/controllerRezultat.php?action=Izmeni&id=<?= $item['id'] ?>">Izmeni</a></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                
            </div>
            <div class="d-flex justify-content-center mt-4">
                    <a class="btn btn-primary btn-lg" href="formaInsertRezultati.php">Dodaj rezultat</a>
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
    header("Location: login.php");
}

$_SESSION['last_active1'] = time();
require_once './partials/footer.php';
?>
