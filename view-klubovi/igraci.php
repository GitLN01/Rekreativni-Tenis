<?php
require_once './partials/navigacija.php';
require_once '../DAO/KorisnikDAO.php';
require_once '../model/Korisnik.php';

session_start();

$vremeActivneSesije = isset($_SESSION['last_active1']) ? $_SESSION['last_active1'] : 0;

if (time() - $vremeActivneSesije < 10 * 60) {
    if (!isset($_SESSION['loginK'])) {
        header("Location: ./login.php");
    } else {
        unset($_SESSION['igrac']);

        $korisnikDAO = new KorisnikDAO();
        $igraci = $korisnikDAO->getAllIgraci();

        ?>
 <div class="container-fluid"
            style="background-repeat: no-repeat; background-size: cover; background-image: url('images/carousel1.jpg'); overflow-y: scroll; height: 100vh;">

            <h1 class="h1 m-2 mt-3" style="color:white;">Prikaz svih terena:</h1>
            <div class="container m-3" style="width: 90%; background-color: rgba(255,255,255,0.8); border-radius: 10px; padding: 20px;">
            <div class="row mt-2">
                <div class="col-md-12">
                    

                    <?php
                    $msg = isset($_SESSION['msg']) ? $_SESSION['msg'] : '';
                    if (!empty($msg)) :
                    ?>
                        <div class="toast show position-fixed bottom-0 end-0 p-3" style="z-index: 11;">
                            <div class="toast-header">
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
                        <table class="table table-bordered table-striped table-hover text-center mt-3" id="dtBasicExample">
                            <thead class="table-dark">
                                <tr>
                                    <th>Ime</th>
                                    <th>Prezime</th>
                                    <th>Visina</th>
                                    <th>Godine</th>
                                    <th>Pobede</th>
                                    <th>Porazi</th>
                                    <th>Email</th>
                                    <th>Obriši</th>
                                    <th>Izmeni</th>
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
                                        <td><a class="btn btn-danger btn-sm" href="../controller-klubovi/Igraci.php?action=delete&id=<?= $item['id'] ?>">IZBRIŠI</a></td>
                                        <td><a class="btn btn-primary btn-sm" href="../controller-klubovi/Igraci.php?action=edit&id=<?= $item['id'] ?>">IZMENI</a></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-center mt-4">
        <a class="btn btn-primary btn-lg" href="formaInsertIgraci.php">Dodaj igrača</a>
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
