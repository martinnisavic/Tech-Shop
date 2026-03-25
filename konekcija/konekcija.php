<?php

$username = "root";
$password = "";
$db = new PDO("mysql:host=localhost;dbname=tech-shop", $username, $password);

$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$db->setAttribute(PDO::FETCH_DEFAULT, PDO::FETCH_ASSOC);

if ($db) {


    function IzvrsiSelectUpit($query, $viseRedova, $params = [])
    {
        global $db;
        $stmt = $db->prepare($query);
        $stmt->execute($params);
        if ($viseRedova) {
            return $stmt->fetchAll();
        } else {
            return $stmt->fetch();
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
