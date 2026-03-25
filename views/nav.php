<?php

include_once("../Tech-Shop/konekcija/konekcija.php");
$query = "SELECT * FROM `links` WHERE 1";
$links = IzvrsiSelectUpit($query, true);
echo "<div id='first-div'>";
if ($links) {
    echo "<div class='d-flex justify-content-around'><div>";
    echo "<nav><ul>";
    $counter = 0;
    foreach ($links as $link) {
        if ($counter == 2) {
            break;
        }
        echo "<li><a href='index.php?stranica=" . $link['path'] . "'>" . $link['text'] . "</a></li>";
        $counter++;
    }
    echo "</ul></nav></div>";
}

$logoQuery = "SELECT * FROM `images` WHERE name = 'logo'";
$logo = IzvrsiSelectUpit($logoQuery, $db);
echo "<div id='logo-div'>
        <img src='" . $logo[0]['src'] . "' alt='" . $logo[0]['alt'] . "'/>
    </div>";


if ($links) {
    echo "<div>";
    echo "<nav><ul>";
    $counter = 0;
    $profil = false;
    foreach ($links as $link) {
        if ($counter >= 2) {
            $profile = isset($_SESSION['ulogovan']);
            $text = $link['text'];
            
            if ($profile) {
                if ($text != 'Log in') {
                    echo "<li><a href='index.php?stranica=" . $link['path'] . "'>" . $link['text'] . "</a></li>";
                }
            } else {
                if ($text != 'Log out' && $text != 'Profile') {
                    echo "<li><a href='index.php?stranica=" . $link['path'] . "'>" . $link['text'] . "</a></li>";
                }
            }

        }




        $counter++;
    }
    echo "</ul></nav>";
}

echo "</div></div>";
