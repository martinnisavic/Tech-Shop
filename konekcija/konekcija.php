<?php

$username = "root";
$password = "";
$db = new PDO("mysql:host=localhost;dbname=tech-shop", $username, $password);

$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if ($db) {


    function IzvrsiSelectUpit($query, $viseRedova)
    {
        global $db;
        if ($viseRedova) {
            $result = $db->query($query)->fetchAll();
        } else {
            $result = $db->query($query)->fetch();
        }

        return $result;
    }

    function UpisUBazu($query)
    {
        try {
            global $db;
            return $db->query($query)->rowCount() > 0;
        } catch (PDOException $e) {
            return false;
        }
    }
}
