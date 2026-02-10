<?php



$reg_ime='';
$reg_prezime='';
$reg_email='';
$reg_pass='';
$reg_username='';
$reg_telefon='';
$greske=0;

if (isset($_POST['ime']) && preg_match($reg_ime),$_POST['ime']) {
    $ime=$_POST['ime'];
}
else{
    $greske++;
}
if (isset($_POST['prezime']) && preg_match($reg_prezime),$_POST['prezime']) {
    $prezime=$_POST['prezime'];
}
else{
    $greske++;
}
if (isset($_POST['username']) && preg_match($reg_username,$_POST['username'])) {
    $username=$_POST['username'];
}
else{
    $greske++;
}
if (isset($_POST['broj-telefona']) && preg_match($reg_telefon,$_POST['broj-telefona'])) {
    $imbroj_telefonae=$_POST['broj-telefona'];
}
else{
    $greske++;
}
if (isset($_POST['email']) && preg_match($reg_email, $_POST['email'])) {
    $email=$_POST['email'];
}
else{
    $greske++;
}


if (isset($_POST['password']) && preg_match($reg_pass, $_POST['password'],) && isset($_POST['conf-password']) && ($_POST['conf-password']==$_POST['password'])) {
    $password=$_POST['password'];
}
else{
    $greske++;
}

if ($greske==0) {
    include('../Tech-Shop/konekcija/konekcija.php');
    $query="";
}
else{
    header("Content-type:application/json");
}

?>