<?php
require_once '../DAO/KorisnikDAO.php';
require_once '../model/Korisnik.php';

$action = isset($_GET['action']) ? $_GET['action'] : '';

if ($action == 'edit' && $_SERVER['REQUEST_METHOD'] == "POST") {
    $ime = isset($_POST['ime']) ? test_input($_POST['ime']) : '';
    $prezime = isset($_POST['prezime']) ? test_input($_POST['prezime']) : '';
    $email = isset($_POST['email']) ? test_input($_POST['email']) : '';
    $id = isset($_POST['id']) ? test_input($_POST['id']) : '';

    $slika = null;
    if (isset($_FILES['slika']) && $_FILES['slika']['error'] == 0) {
        $slika = fopen($_FILES['slika']['tmp_name'], 'rb');
    } else {
        $korisnikDAO = new KorisnikDAO();
        $temp = $korisnikDAO->getKluboviKorisniciById($id);
        if ($temp) {
            $slika = $temp['profilna_slika'];
        }
    }

    if (!empty($ime) && !empty($prezime) && !empty($email) && !empty($id)) {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $korisnik = new Korisnik();
            $korisnik->setIme($ime);
            $korisnik->setPrezime($prezime);
            $korisnik->setEmail($email);
            $korisnik->setProfilnaSlika($slika);

            $res = $korisnikDAO->UpdateKorisnikProfil($id, $korisnik);
            if ($res) {
                session_start();
                session_unset();
                session_destroy();
                header("Location: ../view-klubovi/login.php");
                exit;
            } else {
                session_start();
                $_SESSION['msg'] = "Došlo je do greške prilikom ažuriranja profila.";
                header("Location: ../view-klubovi/profil.php");
                exit;
            }
        } else {
            session_start();
            $_SESSION['msg'] = "Uneli ste pogrešan format za email";
            header("Location: ../view-klubovi/profil.php");
            exit;
        }
    } else {
        session_start();
        $_SESSION['msg'] = "Morate popuniti sva polja.";
        header("Location: ../view-klubovi/profil.php");
        exit;
    }
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>
