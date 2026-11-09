<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

    try {
    $dbh = new PDO(
        'mysql:host=localhost;dbname=dwes;charset=utf8mb4', // DSN
        'dwes', // usuario
        'abc123.', // contraseña
        [ // opciones
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ]
    );
    $serverVersion = $dbh->getAttribute(PDO::ATTR_SERVER_VERSION);

    echo '<br>';

    $dbs = $dbh->query('SELECT cod, nombre, tlf FROM tienda ORDER BY nombre');

    if ($dbs){
        $data = $dbs->fetchAll();
        //var_dump($data);
    }

    //var_dump($serverVersion);

    $familia = filter_input(INPUT_GET,'cod',FILTER_SANITIZE_SPECIAL_CHARS);

    var_dump($familia);

    if (is_null($familia)) {
        $data = $dbs->fetchAll();
        foreach ($data as $valor) {
            echo '<ul>';
            echo '<li>';
            echo '</ul>';
        }
    } else {

        $dbs2 = $dbh->query("SELECT cod, nombre FROM familia WHERE cod = '$familia'");
        $data = $dbs->fetchAll();
        var_dump($data);
    }

    } catch(Exception $e) {
        echo "Se lanzo una excepcion". $e->getMessage();
    }

    // index.php sin querystring, lista todas las familias de las tablas
    //index.php?cos={cod_familia} solo pinta esa familia



?>