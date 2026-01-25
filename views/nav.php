<?php
    include("../Tech-Shop/konekcija/konekcija.php");
    $query="SELECT * FROM `links` WHERE 1";
    $links= IzvrsiSelectUpit($query, $db);
    echo "<div class='d-flex justify-content-around'>";
    if ($links) {
        echo "<div>";
        echo "<nav><ul>";
        $counter=0;
            foreach($links as $link)
            {
                if ($counter==2) {
                    break;
                }
                echo "<li><a href='".$link['path']."'>".$link['text']."</a></li>";
                $counter++;
            }
             echo "</ul></nav></div>";
            }

    $logoQuery="SELECT * FROM `images` WHERE name = 'logo'";
    $logo=IzvrsiSelectUpit($logoQuery,$db);
    echo "<div>
        <img src='".$logo[0]['src']."' alt='".$logo[0]['alt']."'/>
    </div>";


    if ($links) {
        echo "<div>";
        echo "<nav><ul>";
    $counter=0;
        foreach($links as $link)
            {
                if ($counter>=2) {
                    echo "<li><a href='".$link['path']."'>".$link['text']."</a></li>";
                }

                if ($counter==4) {
                    break;
                }
                 
              $counter++;
            }
            echo "</ul></nav>";
    
    }

    echo "</div>";
?>