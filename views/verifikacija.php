<?php
// Uključujemo konekciju (proveri putanju do tvog fajla)
include("../konekcija/konekcija.php");
if ($db) {


echo "<div style='text-align:center; margin-top:50px; font-family:Arial;'>";

if (isset($_GET['token'])) {
    $token = $_GET['token'];

    try {
        // 1. Proveravamo da li postoji korisnik sa tim tokenom i da li je još neaktivan
        $proveraSql = "SELECT id FROM user WHERE verification_token = :token AND is_active = 0";
        $stmt = $db->prepare($proveraSql);
        $stmt->execute([':token' => $token]);
        $korisnik = $stmt->fetch();

        if ($korisnik) {
            // 2. Ako postoji, menjamo is_active na 1 i brišemo token (ne treba nam više)
            $updateSql = "UPDATE user SET is_active = 1, verification_token = NULL WHERE id = :id";
            $updateStmt = $db->prepare($updateSql);
            $updateStmt->execute([':id' => $korisnik['id']]);

            echo "<h2>Uspešna aktivacija!</h2>";
            echo "<p>Vaš nalog je sada aktivan. Možete se ulogovati na svoj profil.</p>";
            echo "<a href='index.php?stranica=login.php' style='padding:10px 20px; background:#28a745; color:white; text-decoration:none; border-radius:5px;'>Idi na Login</a>";
        } else {
            // Token ne postoji ili je korisnik već aktiviran
            echo "<h2>Greška!</h2>";
            echo "<p>Link je neispravan, istekao ili ste već aktivirali nalog.</p>";
            echo "<a href='index.php'>Nazad na početnu</a>";
        }
    } catch (PDOException $e) {
        echo "<h2>Problem sa serverom</h2>";
        echo "Greška: " . $e->getMessage();
    }
} else {
    // Ako neko pokuša da otvori verifikacija.php bez tokena u URL-u
    echo "<h2>Pristup odbijen</h2>";
    echo "<p>Nedostaje verifikacioni kod.</p>";
    header("Refresh:3; url=index.php");
}
}
echo "<h2>Losa putanja</h2>";
echo "</div>";
?>