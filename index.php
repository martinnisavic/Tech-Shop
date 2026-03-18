<?php
session_start();
$stranica = "";
$ulogovan = false;
if (isset($_SESSION['ulogovan'])) {
    $ulogovan = true;
}
if (isset($_GET['stranica'])) {
    $stranica = $_GET['stranica'];
}
?>
<!DOCTYPE html>
<html>
<?php
require_once("views/head.php");
?>

<body>
    <?php if (!$ulogovan): ?>
        <?php
        switch ($stranica) {
            case 'login.php':
                require_once("views/nav.php"); 
                require_once("views/first_div.php");
                require_once("views/login.php");
                require_once("views/footer.php");
                break;
            case 'about.php':
                require_once("views/nav.php"); 
                require_once("views/first_div.php");
                require_once("views/footer.php");
                break;
            case 'register.php':
                require_once("views/nav.php"); 
                require_once("views/first_div.php");
                require_once("views/register.php");
                require_once("views/footer.php");
                break;
            case 'shop.php':
                require_once("views/nav.php");
                require_once("views/first_div.php");
                require_once("views/shop.php");                
                require_once("views/footer.php");
                break;
            default:
                require_once("views/nav.php"); 
                require_once("views/first_div.php");
                require_once("views/new_arrivals.php");
                require_once("views/add_div.php");
                require_once("views/footer.php");
                break;
        }
        // require_once ("views/register.php");
        ?>
    <?php endif ?>
    <script src="assets/main.js"></script>
</body>

</html>