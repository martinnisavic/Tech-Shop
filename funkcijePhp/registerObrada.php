<?php
session_start();

// REGULARNI IZRAZI (Ostaju isti tvoji)
$regExUsername = '/^[\S]{8,25}$/';
$regExPassword = '/^[\S]{8,15}$/';
$regExTelephone = '/^((\+381)6\d\s\d{2}\s\d{2}\s\d{3}|(06)\d\s\d{2}\s\d{2}\s\d{3}|(06)\d-\d{2}-\d{2}-\d{3})$/';
$regExEmail = '/^[\S]{3,20}@(gmail|yahoo|outlook)\.com$/';

$greske = 0;

// Validacija podataka (Skraćeno radi preglednosti, tvoja logika je OK)
$username = $_POST['username'] ?? '';
$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';
$password_confirm = $_POST['password_confirm'] ?? '';
$telefon = $_POST['telefon'] ?? '';
$pol = $_POST['pol'] ?? '';
$grad = $_POST['grad'] ?? '';
$ime = $_POST['ime'] ?? ''; // Dodaj polje 'ime' u formu
$prezime = $_POST['prezime'] ?? ''; // Dodaj polje 'prezime' u formu

if (!preg_match($regExUsername, $username)) $greske++;
if (!preg_match($regExEmail, $email)) $greske++;
if (!preg_match($regExPassword, $password)) $greske++;
if ($password != $password_confirm) $greske++;
if (!preg_match($regExTelephone, $telefon)) $greske++;
if (empty($pol) || empty($grad)) $greske++;

if ($greske == 0) {
    include("../konekcija/konekcija.php"); // Ovde je tvoj $db

    if ($db) {
        try {
            // Hešovanje i generisanje tokena
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
            $token = bin2hex(random_bytes(16));
            $ime_firme = $_POST['ime_firme'] ?? '';

            // SQL UPIT - Pazi na `ime firme` zbog razmaka!
            $query = "INSERT INTO user (ime, prezime, username, password, email, telefon, `ime firme`, role, verification_token, is_active) 
                      VALUES (:ime, :prezime, :username, :password, :email, :telefon, :firma, :role, :token, 0)";

            $prepareStatement = $db->prepare($query);

            // Bindovanje
            $prepareStatement->bindValue(':ime', $ime);
            $prepareStatement->bindValue(':prezime', $prezime);
            $prepareStatement->bindValue(':username', $username);
            $prepareStatement->bindValue(':password', $hashedPassword);
            $prepareStatement->bindValue(':email', $email);
            $prepareStatement->bindValue(':telefon', $telefon);
            $prepareStatement->bindValue(':firma', $ime_firme);
            $prepareStatement->bindValue(':role', 2);
            $prepareStatement->bindValue(':token', $token);

            if ($prepareStatement->execute()) {
                // SLANJE MEJLA (Aktivacioni link)
                $to = $email;
                $subject = "Aktivacija naloga - Tech Shop";
                $link = "http://localhost/Projekti/Tech-Shop/index.php?stranica=verifikacija&token=" . $token;
                $message = "Poštovani, kliknite na link da aktivirate nalog: " . $link;
                $headers = "From: no-reply@techshop.com";

                mail($to, $subject, $message, $headers);

                // REDIREKCIJA (Ne logujemo ga odmah!)
                header("Location: ../index.php?stranica=poruka.php&msg=proverite_email");
                exit();
            }
        } catch (PDOException $e) {
            echo "Greška: " . $e->getMessage();
        }
    }
}else {
    echo "Podaci nisu validni. Broj grešaka: $greske";
}
