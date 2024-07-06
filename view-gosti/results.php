<?php
require_once './partials/navigacija.php';

require_once '../DAO/PregledRezultataDAO.php';
require_once '../DAO/KorisnikDAO.php';
require_once '../model/Korisnik.php';

$rezultatiDAO = new PregledRezultataDAO();
$rezultati = $rezultatiDAO->getAllJOIN();
$korisnikDAO = new KorisnikDAO();
?>

<div class="container-fluid" style="background-image: url('./images/carousel3.jpg'); background-repeat: no-repeat; background-size: cover; overflow: auto; height: 100vh;">
    <h2 class="m-4 text-white">Svi rezultati</h2>

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
        <table id="rezultatiTable" class="table table-bordered table-striped table-hover text-center mt-3">
            <thead class="table-dark sticky-top bg-white">
                <tr>
                    <th class="th-sm">Rezultat</th>
                    <th class="th-sm">Potvrda rezultata</th>
                    <th class="th-sm">Id rezervacije</th>
                    <th class="th-sm">Protivnik 1</th>
                    <th class="th-sm">Protivnik 2</th>
                    <th class="th-sm">Protivnik 3</th>
                    <th class="th-sm">Protivnik 4</th>
                    <th class="th-sm">Status meča</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($rezultati as $item) : ?>
                    <tr>
                        <td><?= $item['rezultat'] ?></td>
                        <td>
                            <?php echo $item['potvrda_rezultata'] == 1 ? '<button class="btn btn-sm btn-outline-success px-3">Potvrđen</button>' : '<button class="btn btn-sm btn-outline-danger px-3">Nepotvrđen</button>'; ?>
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
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <h3><a href="win.php" class="m-4 text-white" style="text-decoration:none;">Rangiranje prema broju pobeda</a><br></h3>
    <h3><a href="win-loses.php" class="m-4 text-white" style="text-decoration:none;">Rangiranje prema odnosu broja pobeda i poraza</a></h3>

</div>

<?php require_once './partials/footer.php'; ?>

<script>
    $(document).ready(function() {
        $('#rezultatiTable').DataTable({
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
