<?php

 $username="root";
 $password="";
 $db=new PDO("mysql:host=localhost;dbname=tech-shop", $username, $password);

 $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

 function IzvrsiSelectUpit($query,$db)
 {
    return $db->query($query)->fetchAll();
 }

function UpisUBazu($db,$query)
{
    try {
        return $db->query($query)->rowCount()>0;
    } catch (PDOException $e) {
        return false;
    }
}

?>