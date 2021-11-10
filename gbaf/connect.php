<?php
    define("HOST", "localhost");
    define("DATABASE", "gbaf");
    define("USER", "root");
    define("PASSWORD", "");

    try{
        $bdd = new PDO ('mysql: host='.HOST.';dbname='.DATABASE.';charset=utf8',USER,PASSWORD, array (PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    } catch (Exception $e){
        die('Erreur : ' . $e->getMessage());
    }
?>