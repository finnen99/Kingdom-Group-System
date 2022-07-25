<?php
function conectar()
{
    try {
        $servername = "localhost";
        $username = "id19319897_finnen99";
        $password = 'Kito990831#@';
        $bd = "id19319897_kingdomgroup";

        $conn = new PDO("mysql:host=$servername;dbname=$bd", $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }

    return $conn;
}
