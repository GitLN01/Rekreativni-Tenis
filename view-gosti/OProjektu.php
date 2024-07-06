<?php
require_once './partials/navigacija.php';
?>

<div class="container-fluid" style="background-image: url('./images/carousel3.jpg'); background-repeat: no-repeat; background-size: cover; overflow-y: scroll; height: 100vh;">
    <div class="row justify-content-center">
        <div class="col-md-8 mt-5">
            <div class="card" style="background-color: rgba(255, 255, 255, 0.8); border-radius: 10px;">
                <div class="card-body p-4">
                    <h2 class="card-title text-center">O Projektu</h2>
                    <p class="card-text mt-4">
                        Dobrodošli na naš sajt! Ova stranica je posvećena detaljnom opisu našeg projekta. Cilj projekta je kreiranje modernog i funkcionalnog web sajta koji koristi tehnologije poput PHP-a, MySQL-a, Bootstrap-a i jQuery-a. 
                        Ovaj projekat uključuje različite module kao što su upravljanje korisnicima, prikaz terena, opreme i klubova, te mnoge druge funkcionalnosti koje će korisnicima omogućiti lako upravljanje i pregled podataka.
                    </p>
                    <p class="card-text mt-4">
                        Projekat je osmišljen da bude prilagođen korisnicima sa različitim nivoima tehničkog znanja, pružajući intuitivno korisničko iskustvo kroz responzivni dizajn i lako navigaciju. 
                        Implementirali smo najbolje prakse za sigurnost i optimizaciju performansi kako bismo osigurali stabilan i siguran rad aplikacije.
                    </p>
                    <div class="text-center mt-5">
                        <a href="./docs/documentacija.pdf" class="btn btn-lg btn-success">Prikaži Dokumentaciju</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
require_once './partials/footer.php';
?>
