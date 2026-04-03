<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

// 1. Izađi iz funkcijePhp (../) 
// 2. Uđi u phpmailer/
// 3. Pozovi fajl .php
require '../phpmailer/Exception.php';
require '../phpmailer/PHPMailer.php';
require '../phpmailer/SMTP.php';
session_start();
header("Content-Type: application/json");

$response = [];
$errors = [];

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    $response['errors'] = ["common" => "Metod nije dozvoljen."];
}
// REGULARNI IZRAZI (Ostaju isti tvoji)
$regExUsername = '/^[\S]{8,25}$/';
$regExPassword = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*()-\+]).{8,}$/';
$regExImePrezime = '/^[A-ZČĆŽŠĐ][a-zčćžšđ]{1,20}(\s[A-ZČĆŽŠĐ][a-zčćžšđ]{1,20}|-[A-ZČĆŽŠĐ][a-zčćžšđ]{1,20})?$/';
$regExTelephone = '/^((\+381)6\d\s\d{2}\s\d{2}\s\d{3}|(06)\d\s\d{2}\s\d{2}\s\d{3}|(06)\d-\d{2}-\d{2}-\d{3})$/';
$regExEmail = '/^[\S]{3,20}@(gmail|yahoo|outlook)\.com$/';

$greske = 0;

// Validacija podataka (Skraćeno radi preglednosti, tvoja logika je OK)
if (isset($_POST['username'])) {
    $username = $_POST['username'];
    if (!preg_match($regExUsername, $username)) {
        $greske++;
        $errors['username'] = "Username je u losem formatu";
    }
} else {
    $errors['username'] = "Username je obavezan";
}
if (isset($_POST['email'])) {
    $email = $_POST['email'];
    if (!preg_match($regExEmail, $email)) {
        $greske++;
        $errors['email'] = "Email je u losem formatu";
    }
} else {
    $errors['email'] = "Email je obavezan";
}
if (isset($_POST['password'])) {
    $pass = trim($_POST['password']);
    if (!preg_match($regExPassword, $pass)) {
        $greske++;
        $errors['password'] = "Lozinka je u losem formatu";
    }
} else {
    $errors['password'] = "Lozinka je obavezna";
}
if (isset($_POST['password_confirm'])) {
    $password_confirm = $_POST['password_confirm'];
    if ($pass !== $password_confirm) {
        $greske++;
    }
} else {
    $errors['password_confirm'] = "Potvrda lozinke je obavezna";
}
if (isset($_POST['telefon'])) {
    $telefon = $_POST['telefon'];
    if (!preg_match($regExTelephone, $telefon)) {
        $greske++;
        $errors['telefon'] = "Telefon je u losem formatu";
    }
} else {
    $errors['telefon'] = "Telefon je obavezan";
}
if (isset($_POST['pol'])) {
    $pol = $_POST['pol'];
} else {
    $errors['pol'] = "Pol je obavezan";
}
if (isset($_POST['grad'])) {
    $grad = $_POST['grad'];
} else {
    $errors['grad'] = "Grad je obavezan";
}
if (isset($_POST['ime'])) {
    $ime = $_POST['ime'];
    if (!preg_match($regExImePrezime, $ime)) {
        $greske++;
        $errors['ime'] = "Ime je u losem formatu";
    }
} else {
    $errors['ime'] = "Ime je obavezno";
}
if (isset($_POST['prezime'])) {
    $prezime = $_POST['prezime'];
    if (!preg_match($regExImePrezime, $prezime)) {
        $greske++;

        $errors['prezime'] = "Prezime je u losem formatu";
    }
} else {
    $errors['prezime'] = "Prezime je obavezno";
}


if (!empty($errors)) {
        $response = [
            "status" => "422",
            "message" => "Greska sa validacijom",
            "errors" => $errors
        ];
        echo json_encode($response);
        exit();
    }
else{
    include("../konekcija/konekcija.php");
    if ($db) {

        // Hešovanje i generisanje tokena
        $hashedPassword = password_hash($pass, PASSWORD_BCRYPT);
        $token = bin2hex(random_bytes(16));
        $ime_firme = $_POST['ime_firme'] ?? '';


        $query = "INSERT INTO user (ime, prezime, username, password, email, telefon, `ime firme`, role, verification_token, is_active) 
                      VALUES (:ime, :prezime, :username, :pass, :email, :telefon, :firma, :role, :token, 0)";

        $prepareStatement = $db->prepare($query);

        
        $prepareStatement->bindValue(':ime', $ime);
        $prepareStatement->bindValue(':prezime', $prezime);
        $prepareStatement->bindValue(':username', $username);
        $prepareStatement->bindValue(':pass', $hashedPassword);
        $prepareStatement->bindValue(':email', $email);
        $prepareStatement->bindValue(':telefon', $telefon);
        $prepareStatement->bindValue(':firma', $ime_firme);
        $prepareStatement->bindValue(':role', 'user');
        $prepareStatement->bindValue(':token', $token);

        if ($prepareStatement->execute()) {
            // SLANJE MEJLA
            $mail = new PHPMailer(true);
            $mail->SMTPOptions = array(
    'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
    )
);
            try{
             $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'martinnisavic11@gmail.com'; 
        $mail->Password   = 'xbgi dmen rnvx dapk'; 
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;
        $mail->CharSet    = 'UTF-8'; 

        // Primalac i pošiljalac
        $mail->setFrom('no-reply@techshop.com', 'Tech Shop Support');
        $mail->addAddress($email); // Varijabla iz tvoje forme

        // Sadržaj mejla
        $mail->isHTML(true);
        $mail->Subject = 'Aktivacija naloga - Tech Shop';
        
        $link = "http://localhost/Projekti/Tech-Shop/index.php?stranica=verifikacija&token=" . $token;
        
        $mail->Body = "<h3>Dobrodošli u Tech Shop!</h3>
                       <p>Kliknite na dugme ispod da biste aktivirali svoj nalog:</p>
                       <a href='$link' style='background: #28a745; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;'>Aktiviraj nalog</a>
                       <br><br>
                       <p>Ili kopirajte ovaj link: <br> $link </p>";

        $mail->send();

        // Tek kad se mejl pošalje, šalješ JSON uspeh
        echo json_encode([
            "status" => "200",
            "message" => "Uspešna registracija! Proverite email za aktivaciju."
        ]);
        exit();
            }
            catch (Exception $e) {
                // Ako mejl ne može da se pošalje, brišeš korisnika iz baze da ne ostane neaktivan
                echo json_encode([
            "status" => "500",
            "message" => "Korisnik kreiran, ali mejl nije poslat. Greška: {$mail->ErrorInfo}"
        ]);
        exit();
            }
        } else {
            echo json_encode(["status" => "500", "message" => "Greška pri upisu u bazu."]);
            exit();
        }
    }
} 
