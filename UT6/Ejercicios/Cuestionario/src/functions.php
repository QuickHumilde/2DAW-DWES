<?php

function dump($var){
    echo '<pre>'.print_r($var,1);echo'</pre>';
}

function conectar($dbParameters){
    try {

        $dbh = new PDO($dbParameters['dns'], $dbParameters['username'], $dbParameters['password']);
        
        return $dbh;
        
    } catch (PDOException $e) {
        dump("Error al conectar con la base de datos");
    }
}

function getPreguntasFromDB($dbc){
    $consulta = "SELECT * FROM preguntas";
    $resultado = $dbc->query($consulta);
    return $resultado->fetchAll(PDO::FETCH_ASSOC);
}