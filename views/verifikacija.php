<?php


include_once("konekcija/konekcija.php"); 

if (isset($_GET['token'])) {
    $token = $_GET['token'];
    
    // TEST: Ispiši token iz URL-a da ga uporediš sa onim u bazi
    // echo "Token iz linka: " . $token; 

    $upitProvera = "SELECT id, is_active, verification_token FROM user WHERE verification_token = :token";
    $stmtProvera = $db->prepare($upitProvera);
    $stmtProvera->bindValue(':token', $token);
    $stmtProvera->execute();
    
    $user = $stmtProvera->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        if ($user['is_active'] == 1) {
            echo "Nalog je već aktiviran.";
        } else {
            // Sad radi UPDATE
            $upitAktivacija = "UPDATE user SET is_active = 1, verification_token = NULL WHERE id = :id";
            $stmtAktivacija = $db->prepare($upitAktivacija);
            $stmtAktivacija->bindValue(':id', $user['id']);
            $stmtAktivacija->execute();
            echo "Uspešna aktivacija!";
        }
    } else {
        echo "Token nije pronađen u bazi.";
    }
} else {
    echo "Nedostaje token u URL-u.";
}


// if (isset($_GET['token'])) {
//     $token = $_GET['token'];

//     // 2. Provera da li token uopšte postoji u bazi
//     $upitProvera = "SELECT id, username FROM user WHERE verification_token = :token AND is_active = 0";
//     $stmtProvera = $db->prepare($upitProvera);
//     $stmtProvera->bindValue(':token', $token);
//     $stmtProvera->execute();

//     if ($stmtProvera->rowCount() > 0) {
//         // Token je ispravan, korisnik je pronađen i još uvek nije aktiviran
        
//         // 3. Aktivacija korisnika
//         // Setujemo is_active na 1 i brišemo token da ne može ponovo da se koristi
//         $upitAktivacija = "UPDATE user SET is_active = 1, verification_token = NULL WHERE verification_token = :token";
//         $stmtAktivacija = $db->prepare($upitAktivacija);
//         $stmtAktivacija->bindValue(':token', $token);
        
//         if ($stmtAktivacija->execute()) {
//             echo "
//             <div class='alert alert-success text-center m-5'>
//                 <h2 style='color: green;'>Uspešna aktivacija!</h2>
//                 <p>Vaš nalog je sada aktivan. Možete se ulogovati na stranici za <a href='index.php?stranica=login'>prijavu</a>.</p>
//             </div>";
//         } else {
//             echo "<div class='alert alert-danger text-center m-5'>Greška prilikom aktivacije naloga. Pokušajte ponovo.</div>";
//         }
//     } else {
//         // Token ne postoji ili je nalog već aktiviran
//         echo "
//         <div class='alert alert-warning text-center m-5'>
//             <h2>Nevažeći link</h2>
//             <p>Link za verifikaciju je istekao, neispravan ili ste već aktivirali svoj nalog.</p>
//             <a href='index.php'>Vratite se na početnu</a>
//         </div>";
//     }
// } else {
//     // Ako neko pokuša da pristupi stranici bez tokena u URL-u
//     echo "<div class='alert alert-danger text-center m-5'>Pristup odbijen. Nedostaje verifikacioni kod.</div>";
// }
?>