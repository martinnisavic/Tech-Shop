<?php
session_start();
header("Content-Type: application/json");

// 1. Provera da li je korisnik ulogovan
if (!isset($_SESSION['userID'])) {
    echo json_encode(["status" => 401, "message" => "Niste ulogovani."]);
    exit();
}

// 2. Konekcija (putanja zavisi od tvog foldera, verovatno ../)
require_once("../konekcija/konekcija.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // Prikupljanje podataka
    $ime = trim($_POST['ime'] ?? '');
    $prezime = trim($_POST['prezime'] ?? '');
    $telefon = trim($_POST['telefon'] ?? '');
    $firma = trim($_POST['firma'] ?? '');
    $userId = $_SESSION['userID'];

    // 3. REGULARNI IZRAZI (Tvoji originalni)
    $regExImePrezime = '/^[A-ZČĆŽŠĐ][a-zčćžšđ]{1,20}(\s[A-ZČĆŽŠĐ][a-zčćžšđ]{1,20}|-[A-ZČĆŽŠĐ][a-zčćžšđ]{1,20})?$/';
// Dozvoljava +3816 ili 06 na početku, a nakon toga bilo šta što su cifre, razmaci ili crtice (ukupno 7 do 12 karaktera)
$regExTelephone = '/^(\+3816|06)[0-9\s\-]{7,12}$/';
    $errors = [];

    // Validacija
    if (!preg_match($regExImePrezime, $ime)) {
        $errors[] = "Ime nije u ispravnom formatu.";
    }
    if (!preg_match($regExImePrezime, $prezime)) {
        $errors[] = "Prezime nije u ispravnom formatu.";
    }
    if (!preg_match($regExTelephone, $telefon)) {
        $errors[] = "Telefon nije u ispravnom formatu.";
    }

    // Ako ima grešaka, vrati ih frontendu
    if (count($errors) > 0) {
        echo json_encode(["status" => 422, "message" => "Greška u validaciji", "errors" => $errors]);
        exit();
    }

    // 4. Izvršavanje UPDATE upita
    try {
        $query = "UPDATE user SET 
                    ime = :ime, 
                    prezime = :prezime, 
                    telefon = :telefon, 
                    `ime firme` = :firma 
                  WHERE id = :id";

        $stmt = $db->prepare($query);
        $stmt->bindValue(':ime', $ime);
        $stmt->bindValue(':prezime', $prezime);
        $stmt->bindValue(':telefon', $telefon);
        $stmt->bindValue(':firma', $firma);
        $stmt->bindValue(':id', $userId);

        if ($stmt->execute()) {
            // OPCIONO: Ako želiš da osvežiš i podatke u sesiji (ako ih tamo čuvaš)
            // $_SESSION['username'] = $noviUsername; // npr.

            echo json_encode([
                "status" => 200, 
                "message" => "Podaci su uspešno ažurirani!"
            ]);
        } else {
            echo json_encode(["status" => 500, "message" => "Greška pri upisu u bazu podataka."]);
        }
    } catch (PDOException $e) {
        echo json_encode(["status" => 500, "message" => "Serverska greška: " . $e->getMessage()]);
    }
} else {
    echo json_encode(["status" => 405, "message" => "Metod nije dozvoljen."]);
}