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

function obtenerFiltros(){

    $filtros = [];
    $filtros[]=filter_input(INPUT_POST, 'op');
    $filtros[]=filter_input(INPUT_POST, 'id');
    $filtros[]=filter_input(INPUT_POST, 'videojuego');
    $filtros[]=filter_input(INPUT_POST, 'cantidad');


    if (!in_array($filtros[0], ["lista_tiendas","actualizar_stock","borrar_tienda"])){
        $filtros[0]="lista_tiendas";
    }

    if ($filtros[1] < 0){
        $filtros[1]=-1;
    }
    return $filtros;
}

function borrarTienda($dbc, $id){
    $stmt = $dbc -> prepare('DELETE FROM TIENDAS WHERE id=:id');

    $stmt -> execute([':id' => $id]);

}

function actualizarStock($dbc, $filtros){

    $idVideojuego = obtenerIdVideojuego($dbc, $filtros[2]);
    
    $stmt = $dbc -> prepare('UPDATE stock
                            SET cantidad = :cantidad
                            WHERE tienda_id = :id AND videojuego_id= :videojuego');
    
    $stmt -> execute([':id' => $filtros[1], ':cantidad' => $filtros[3], ':videojuego_id' => $filtros[2]]);

}

function obtenerIdVideojuego($dbc, $titulo){
    $stmt = $dbc -> prepare('SELECT id
                            FROM videojuegos
                            WHERE titulo= :titulo');
            
    $id = $stmt -> execute([':titulo' => $titulo]);

    return $id;
}