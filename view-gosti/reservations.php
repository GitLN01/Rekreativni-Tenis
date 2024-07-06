<?php
require_once './partials/navigacija.php';

require_once '../DAO/RezervacijeDAO.php';
require_once '../model/Rezervacija.php';
require_once '../DAO/KorisnikDAO.php';
require_once '../model/Korisnik.php';
require_once '../DAO/TerenDAO.php';
require_once '../model/Teren.php';
require_once '../DAO/MecDAO.php';
require_once '../model/Mec.php';

$rezervacijaDAO = new RezervacijeDAO();
$rezervacije = $rezervacijaDAO->getAllRezervacije();
$korisnikDAO = new KorisnikDAO();
$terenDAO = new TerenDAO();
$meceviDAO = new MecDAO();
?>

<div class="container-fluid" style="background-image: url('./images/carousel3.jpg'); background-repeat: no-repeat; background-size: cover; overflow: auto; height: 100vh;">
    <h2 class="m-4 text-white">Prikaz svih rezervacija</h2>

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

    <div class="container mt-3 mb-5 p-3" style="background-color: rgba(255, 255, 255, 0.8); border-radius: 10px;">

        <table id="rezervacijeTable" class="table table-bordered table-striped table-hover text-center">
            <thead class="table-dark sticky-top bg-white">
                <tr>
                    <th class="th-sm">Id</th>
                    <th class="th-sm">Protivnik 1</th>
                    <th class="th-sm">Protivnik 2</th>
                    <th class="th-sm">Protivnik 3</th>
                    <th class="th-sm">Protivnik 4</th>
                    <th class="th-sm">Teren</th>
                    <th class="th-sm">Tip meca</th>
                    <th class="th-sm">Datum</th>
                    <th class="th-sm">Vreme</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($rezervacije as $item) : ?>
                    <tr>
                        <td><?= $item['id'] ?></td>
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
                        <td>
                            <?php
                            $teren = $terenDAO->getTereniById($item['id_terena']);
                            echo $teren ? $teren['naziv'] : '/';
                            ?>
                        </td>
                        <td>
                            <?php
                            $mec = $meceviDAO->getMeceviById($item['id_meca']);
                            echo $mec ? $mec['tip_meca'] : '/';
                            ?>
                        </td>
                        <td><?= $item['datum'] ?></td>
                        <td><?= $item['vreme'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

</div>

<?php require_once './partials/footer.php'; ?>

<script>
    $(document).ready(function() {
        $('#rezervacijeTable').DataTable({
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
