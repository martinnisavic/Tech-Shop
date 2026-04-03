<?php
session_start();
header("Content-Type: application/json");

$response = [];
$errors = [];

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    $response['errors'] = ["common" => "Metod nije dozvoljen."];
}


//RegEx-i za registraciju
$regExUsername = '/^[a-z\9\._]{8,25}$/';
$regExPassword = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*()-\+]).{8,}$/';
$regExTelephone = '/^((\+381)6\d\s\d{2}\s\d{2}\s\d{3}|(06)\d\s\d{2}\s\d{2}\s\d{3}|(06)\d-\d{2}-\d{2}-\d{3})$/';
$regExEmail = '/^[\S]{3,20}@(gmail|yahoo|outlook|ict\.edu\.rs)\.(com|rs)$/';

include("../konekcija/konekcija.php");
if ($db) {
    if (empty($_POST['email'])) {
        $errors['email'] = "Email je obavezan";
    }
    if (isset($_POST['email'])) {
        $email = $_POST['email'];
        if (!preg_match($regExEmail, $email)) {
            $errors['email'] = "Email je u losem formatu";
        }
    }
    if (empty($_POST['password'])) {
        $errors['password'] = "Password je obavezan";
    }
    if (isset($_POST['password'])) {
    // Moraš dodeliti vrednost varijabli $pass
    $pass = trim($_POST['password']); 

    if (!preg_match($regExPassword, $pass)) {
        $errors['password'] = "Password je u losem formatu";
    }
}

    if (!empty($errors)) {
        $response = [
            "status" => "422",
            "message" => "Greska sa validacijom",
            "errors" => $errors
        ];
    } else {
        $query = "SELECT email,username,role,id,password FROM `user` WHERE email=:email AND is_active = 1";
        $params = [
            ":email" => $email
        ];
        $user = IzvrsiSelectUpit($query, false,$params);



       if ($user) {
    $ukucanaLozinka = trim($_POST['password']);
    $hesIzBaze = $user['password']; // Ovo je ono što si izvukao iz kolone 'password'
    if (password_verify($ukucanaLozinka, $hesIzBaze)) {
        // LOZINKA JE TAČNA
        $_SESSION['ulogovan'] = true;
        $_SESSION['userID'] = $user['id'];
        $_SESSION['role'] = $user['role'];
        $_SESSION['username'] = $user['username'];
        echo json_encode(["status" => "200", "message" => "Uspešan login!"]);
        
        exit();
    } else {
        // LOZINKA NIJE TAČNA
        http_response_code(401);
        echo json_encode(["status" => "401", "message" => "Neispravna lozinka."]);
    }
}
         else {
            http_response_code(401);
            $response = [
                "status" => "401",
                "message" => "Neispravan email ",
                "errors" => $errors
            ];
        }
    }
} else {
    $response = [
        "status" => "501",
        "message" => "Greska sa konekcijom"
    ];
}
echo json_encode($response);
