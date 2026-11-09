<?php

function dump($var){
    echo '<pre>'.print_r($var,1).'</pre>';
}

function getDatabaseConnection($dsn, $user, $password){

    try{

    $connection = new PDO($dsn, $user, $password,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false
        ]
);

    return $connection;

    } catch(Exception $e) {
        dump("Error al conectar con la base de datos");
    }

}

function getVideoGamesFromDB($dbc){
    //Consulta a realizar:
    //'SELECT t.id AS tienda_id, t.nombre, t.ciudad,
    //               v.titulo, s.cantidad
    //        FROM tiendas t
    //        LEFT JOIN stock s ON s.tienda_id = t.id
    //        LEFT JOIN videojuegos v ON v.id = s.videojuego_id
    //        ORDER BY t.nombre, v.titulo';

    $stmt = $dbc -> query('SELECT t.id AS tienda_id, t.nombre, t.ciudad,
                   v.titulo, s.cantidad
            FROM tiendas t
            LEFT JOIN stock s ON s.tienda_id = t.id
            LEFT JOIN videojuegos v ON v.id = s.videojuego_id
            ORDER BY t.nombre, v.titulo');

    $result = $stmt->fetchAll();

    return $result;
}

function removeDuplicationFromArray($array){

    $repeatedId = [];

    foreach ($array as $valor) {
        if (in_array($valor['tienda_id'], $repeatedId)){
            $repeatedId[] = $valor['tienda_id'];
        }

    }

}