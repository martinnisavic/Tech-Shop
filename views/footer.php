<?php
    include_once("../Tech-Shop/konekcija/konekcija.php");
    $query = "SELECT * FROM `links` WHERE 1";
    $links = IzvrsiSelectUpit($query, true);

    echo "<div id='footer'>"; // Tvoj glavni kontejner sa slikom
    if ($links) {
        echo "<div id='links-wrap'><nav>";
        echo "<ul class='d-flex list-unstyled m-0 p-0'>"; 
      
        foreach($links as $link) {
            echo "<li class='mx-3'>
                    <a href='index.php?stranica=".$link['path']."' class='text-white text-decoration-none nav-link-custom'>
                        ".$link['text']."
                    </a>
                  </li>";
        }
        
        echo "</ul></nav></div>";
    }

    $query = "SELECT * FROM `socials` WHERE 1";
    $socials = IzvrsiSelectUpit($query, true);
    echo"<div id='socials-wrap'>";
    foreach($socials as $social) {
            echo "<li class='mx-3'>
                    <a href='".$social['link']."' class='text-white text-decoration-none nav-link-custom'>
                        ".$social['name']."
                    </a>
                  </li>";
        }
                  echo"</div></div>";
?>