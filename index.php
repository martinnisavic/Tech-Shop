<?php
session_start();
$stranica = "";
$ulogovan = false;
$proizvodInfo = false;
if (isset($_SESSION['ulogovan'])) {
    $ulogovan = true;
}
if (isset($_GET['stranica'])) {
    $stranica = $_GET['stranica'];
}
if (isset($_GET['idProizvoda'])) {
    $proizvodInfoId = $_GET['idProizvoda'];
    $proizvodInfo = true;
}
?>
<!DOCTYPE html>
<html>
<?php
require_once("views/head.php");
?>

<body>
    <?php
    require_once("views/nav.php");
    require_once("views/first_div.php");

    // GLAVNI KONTROLER
    if ($proizvodInfo) {
        require_once("views/product_card_info.php");
    } else {
        switch ($stranica) {
            case 'login.php':
                require_once("views/login.php");
                break;
            case 'register.php':
                require_once("views/register.php");
                break;
            case 'shop.php':
                require_once("views/shop.php");
                break;
            case 'about.php':
                require_once('views/about.php');
                break;
            case 'cart.php':
                require_once("views/cart.php");
                break;
            case 'logout.php':
                require_once("views/logout.php");
                break;
            case 'profile.php':
                require_once("views/profil.php");
                break;
            case 'buy.php':
                require_once("views/buy.php");
                break;
                case 'edit_profile.php':
                require_once("views/edit_profile.php");
                break;
            case 'verifikacija': 
        require_once("views//verifikacija.php"); 
        break;
            default:

                require_once("views/new_arrivals.php");
                require_once("views/add_div.php");
                break;
        }
    }

    require_once("views/footer.php");
    ?>
    <script type="module" src="assets/main.js"></script>
    <script src="assets/logIn.js"></script>
    <script src="assets/register.js"></script>
</body>

</html>