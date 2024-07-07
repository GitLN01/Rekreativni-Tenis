<?php
require_once './partials/navigacija.php';

require_once '../DAO/TerenDAO.php';
require_once '../model/Korisnik.php';
session_start();
$vremeActivneSesije = isset($_SESSION['last_active1']) ? $_SESSION['last_active1'] : 0;
if (time() - $vremeActivneSesije < 10 * 60) {
    if (!isset($_SESSION['loginK'])) {
        header("Location: ./login.php");
    } else {
        $tereni = new TerenDAO();
        $tereni = $tereni->getAllTereniKluboviJOIN();
        ?>
        <div class="container-fluid"
            style="background-repeat: no-repeat; background-size: cover; background-image: url('images/carousel1.jpg'); overflow-y: scroll; height: 100vh;">

            <h1 class="h1 m-2 mt-3" style="color:white;">Prikaz svih terena:</h1>
            <div class="container m-3"
                style="width: 90%; background-color: rgba(255,255,255,0.8); border-radius: 10px; padding: 20px;">

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
                    }
                    unset($_SESSION['msg']);
                    ?>
                    <div class="container m-3" style="width: 90%;">
                        <table class="table table-bordered text-center table-striped table-sm mt-3" cellspacing="0"
                            style="margin-left:auto;margin-right:auto" id="dtBasicExample">
                            <thead class="table-dark sticky-top bg-white">
                                <tr>
                                    <th class="th-sm">Naziv</th>
                                    <th class="th-sm">Lokacija</th>
                                    <th class="th-sm">Vrsta podloge</th>
                                    <th class="th-sm">Kapacitet</th>
                                    <th class="th-sm">Zauzet</th>
                                    <th class="th-sm">Klub</th>
                                    <th class="th-sm">Obriši</th>
                                    <th class="th-sm">Izmeni</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($tereni as $item): ?>
                                    <tr>
                                        <td><?= $item['naziv'] ?></td>
                                        <td><?= $item['lokacija'] ?></td>
                                        <td><?= $item['vrsta_podloge'] ?></td>
                                        <td><?= $item['kapacitet'] ?></td>
                                        <td><?php echo $item['zauzet'] ? '<button class="btn btn-sm btn-outline-danger px-3">Zauzet</button>' : '<button class="btn btn-sm btn-outline-success">Slobodan</button>'; ?>
                                        </td>
                                        <td><?= $item['naziv-kluba'] ?></td>
                                        <td><a class="btn btn-danger btn-sm"
                                                href="../controller-klubovi/controllerTeren.php?action=delete&id=<?= $item['id'] ?>">IZBRIŠI</a>
                                        </td>
                                        <td><a class="btn btn-primary btn-sm"
                                                href="../controller-klubovi/controllerTeren.php?action=edit&id=<?= $item['id'] ?>">IZMENI</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <script>
                        $(document).ready(function () {
                            $('#dtBasicExample').DataTable({
                                "paging": false,
                                "info": false,
                                "searching": false
                            });
                        });
                    </script>
                </div>
                
            </div>
            <div class="d-flex justify-content-center mt-4">
                    <a class="btn btn-primary btn-lg" href="formaInserttereni.php">Dodaj teren</a>
                </div>
        </div>

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