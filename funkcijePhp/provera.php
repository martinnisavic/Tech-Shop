<?php
session_start();

//RegEx-i za registraciju
$regExUsername = '/^[a-z\9\._]{8,25}$/';
$regExPassword = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*()-\+]).{8,}$/';
$regExTelephone = '/^((\+381)6\d\s\d{2}\s\d{2}\s\d{3}|(06)\d\s\d{2}\s\d{2}\s\d{3}|(06)\d-\d{2}-\d{2}-\d{3})$/';
$regExEmail = '/^[\S]{3,20}@(gmail|yahoo|outlook|ict\.edu\.rs)\.(com|rs)$/';


if ($logInSubmit) {
    include("./konekcija.php");
    if ($conn) {
        if (isset($_POST['email'])) {
            $email = $_POST['email'];
        } else {
            echo "Los email";
        }
        if (isset($_POST['password'])) {
            $pass = $_POST['password'];
        } else {
            echo "Los pass";
        }
        $query = "SELECT username,role FROM `users` WHERE email=:email AND password=:password";
        $prepareStatement = $conn->prepare($query);
        $prepareStatement->bindValue(":email", $email);
        $prepareStatement->bindValue(":password", $pass);
        $prepareStatement->execute(); //ovde se izvrasava SQL upit ali tabela rezultata je jos uvek na sql serveru php je ne vidi
        $user = $prepareStatement->fetch(); //ovde preuzimamo podatke 
        if ($user) {
    
            $_SESSION['role'] = $user['role'];
            $_SESSION['username'] = $user['username'];
            header("Location: index.php");
        } else {
            echo "nije pronadjen korisnik";
        }
    } else {
        echo "Greska sa konekcijom";
    }
} // ... početak koda ostaje isti ...
else if ($regSubmit) {
    $greske = 0;

    // USERNAME provera
    if (isset($_POST['username'])) {
        $username = $_POST['username'];
        // Mora biti poseban IF da bi se preg_match izvršio nakon što uzmeš vrednost
        if (!preg_match($regExUsername, $username)) {
            echo "lose unet username\n";
            $greske++;
        }
    } else {
        echo "nije unet username\n";
        $greske++;
    }

    // EMAIL provera
    if (isset($_POST['email'])) {
        $email = $_POST['email'];
        if (!preg_match($regExEmail, $email)) {
            echo "lose unet email\n";
            $greske++;
        }
    } else {
        echo "nije unet email\n";
        $greske++;
    }

    // PASSWORD provera
    if (isset($_POST['password'])) {
        $password = $_POST['password'];
        if (!preg_match($regExPassword, $password)) {
            echo "lose unet password\n";
            $greske++;
        }
    } else {
        echo "nije unet password\n";
        $greske++;
    }

    // PASSWORD CONFIRM provera
    if (isset($_POST['password_confirm'])) {
        $password_confirm = $_POST['password_confirm'];
        // Tvoj uslov: ako su isti, baci grešku? Verovatno si hteo !=
        // Ali držim tvoju logiku kako si tražio:
        if ($password != $password_confirm) {
            echo "nisu unete iste sifre\n";
            $greske++;
        }
    }

    // TELEFON provera
    if (isset($_POST['telefon'])) {
        $telefon = $_POST['telefon'];
        if (!preg_match($regExTelephone, $telefon)) {
            echo "lose unet telefon\n";
            $greske++;
        }
    } else {
        echo "nije unet telefon\n";
        $greske++;
    }

    // POL provera (ovde si imao greske++ u if-u, to sklanjamo da bi radilo)
    if (isset($_POST['pol'])) {
        $pol = $_POST['pol'];
    } else {
        echo "nije unet pol\n";
        $greske++;
    }

    // GRAD provera
    if (isset($_POST['grad'])) {
        $grad = $_POST['grad'];
    } else {
        echo "nije unet grad\n";
        $greske++;
    }

    // Dodatne varijable koje koristiš u bind-u (moraju postojati)
    $newsletter = isset($_POST['newsletter']) ? 1 : 0;
    $datum_rodjenja = $_POST['datum_rodjenja'] ?? NULL;

    if ($greske == 0) {
        include('./konekcija.php');
        if ($conn) {
            // TVOJ UPIT I PREPARED STATEMENT (NETAKNUT)
            $query = "INSERT INTO `users` (username, email, password, pol, grad, datum_rodjenja, telefon, newsletter, role) 
                      VALUES (:username, :email, :password, :pol, :grad, :datum_rodjenja, :telefon, :newsletter,:role)";

            $prepareStatement = $conn->prepare($query);

            $prepareStatement->bindValue(':username', $username);
            $prepareStatement->bindValue(':email', $email); // Koristimo $email varijablu
            $prepareStatement->bindValue(':password', $password);
            $prepareStatement->bindValue(':pol', $pol);
            $prepareStatement->bindValue(':grad', $grad);
            $prepareStatement->bindValue(':datum_rodjenja', $datum_rodjenja);
            $prepareStatement->bindValue(':telefon', $telefon);
            $prepareStatement->bindValue(':newsletter', $newsletter);
            $prepareStatement->bindValue(':role', 'user');

            if ($prepareStatement->execute()) {
                $_SESSION['username'] = $username;
                $_SESSION['role'] = 'user';
                header("Location: index.php");
            } else {
                echo "Bezuspesno";
            }
        }
    }
}
