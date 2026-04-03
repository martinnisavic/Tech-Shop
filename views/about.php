<?php
session_start();
require_once("konekcija/konekcija.php");

// 1. Upit za tvoju sliku autora iz baze
// Pretpostavljamo da u tabeli images imaš sliku gde je alt='Martin'
$queryAuthor = "SELECT * FROM images WHERE alt LIKE '%Martin%' LIMIT 1";
$mojuSlika = IzvrsiSelectUpit($queryAuthor, false);

// Ako slika ne postoji u bazi, stavljamo placeholder
$slikaPath = ($mojuSlika) ? $mojuSlika['src'] : "assets/img/default-author.jpg";

require_once("views/head.php");
require_once("views/nav.php");

echo "
<div class='author-wrapper'>
    <div class='container'>
        <div class='row justify-content-center'>
            <div class='col-lg-8'>
                <div class='author-card shadow'>
                    <div class='author-content d-flex align-items-center p-5'>
                        <div class='author-img-holder'>
                            <img src='{$slikaPath}' alt='Martin Nisavic' class='img-fluid rounded-circle shadow-lg'>
                        </div>
                        <div class='author-info-holder ms-5'>
                            <h1 class='display-4 fw-bold text-dark'>Martin Nisavic</h1>
                            <p class='text-primary fs-3 fw-light mb-0'>Indeks: 21/23</p>
                            <div class='mt-3'>
                                <span class='badge bg-dark px-3 py-2'>Web Developer</span>
                                <span class='badge bg-secondary px-3 py-2'>Student</span>
                            </div>
                        </div>
                    </div>
                    <div class='author-footer bg-light p-4 text-center'>
                        <p class='mb-0 text-muted'>Projekat iz Web Programiranja - Visoka ICT</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
";

require_once("views/footer.php");
?>