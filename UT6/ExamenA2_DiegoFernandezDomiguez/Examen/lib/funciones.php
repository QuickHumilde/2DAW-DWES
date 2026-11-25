<?php

    const FILAS = 6;
    const COLUMNAS = 8;
    const TILES = [
        'hierba' => ['nombre' => 'Hierba', 'max' => 12],
        'agua' => ['nombre' => 'Agua', 'max' => 8],
        'arena' => ['nombre' => 'Arena', 'max' => 8],
        'arbol' => ['nombre' => 'Árbol', 'max' => 6],
        'roca' => ['nombre' => 'Roca', 'max' => 4],
        'muro' => ['nombre' => 'Muro', 'max' => 10],
    ];

    function dump($var) {
        echo '<pre>'; var_dump($var, 1); echo '</pre>';
    }

    function verificarDatos() {
        $fila = filter_input(INPUT_POST,'fila');
        $columna = filter_input(INPUT_POST,'columna');
        $tile = filter_input(INPUT_POST,'tile');

        $errores = [];

        if(is_null($fila) || $fila > FILAS || $fila < 1 || filter_var($fila, FILTER_VALIDATE_INT) === false) {
            $errores["fila"] = "Error fila";
        }

        if(is_null($columna) || $columna > COLUMNAS || $fila < 1 || filter_var($columna, FILTER_VALIDATE_INT) === false) {
            $errores["columna"] = "Error columna";
        }

        if (is_null($tile) || empty($tile) || !in_array(ucfirst($tile), TILES[$tile])) {
            $errores["tile"] = "Error tile";
        }

        return $errores;
    }

    function verificarTile() {
        $tile = filter_input(INPUT_POST,'tile');

        $errores = [];

        if (is_null($tile) || !in_array(ucfirst($tile), TILES[$tile])) {
            $errores["tile"] = "Error tile";
        }

        return $errores;
    }

    function contarTiles($tablero) {
        $cantidadTiles = [];
        $cantidadTiles["total"] = 0;
        $cantidadTiles["usadas"] = 0;
        $cantidadTiles["hierba"] = 0;
        $cantidadTiles["arena"] = 0;
        $cantidadTiles["agua"] = 0;
        $cantidadTiles["arbol"] = 0;
        $cantidadTiles["roca"] = 0;
        $cantidadTiles["muro"] = 0;

        if(!is_null($tablero)){
            foreach ($tablero as $key => $fila) {
                foreach ($fila as $columna) {
                    $cantidadTiles["total"] = $cantidadTiles["total"]+1;

                    switch ($columna) {
                        case 't-hierba':
                            $cantidadTiles["hierba"] = $cantidadTiles["hierba"]+1;
                            $cantidadTiles["usadas"] = $cantidadTiles["usadas"]+1;
                            break;
                        
                        case 't-arena':
                            $cantidadTiles["arena"] = $cantidadTiles["arena"]+1;
                            $cantidadTiles["usadas"] = $cantidadTiles["usadas"]+1;

                            break;

                        case 't-agua':
                            $cantidadTiles["agua"] = $cantidadTiles["agua"]+1;
                            $cantidadTiles["usadas"] = $cantidadTiles["usadas"]+1;

                            break;
            
                        case 't-arbol':
                            $cantidadTiles["arbol"] = $cantidadTiles["arbol"]+1;
                            $cantidadTiles["usadas"] = $cantidadTiles["usadas"]+1;

                            break;
                        
                        case 't-roca':
                            $cantidadTiles["roca"] = $cantidadTiles["roca"]+1;
                            $cantidadTiles["usadas"] = $cantidadTiles["usadas"]+1;

                            break;

                        case 't-muro':
                            $cantidadTiles["muro"] = $cantidadTiles["muro"]+1;
                            $cantidadTiles["usadas"] = $cantidadTiles["usadas"]+1;

                            break;
                        
                        default:
                            break;
                    }
            }
        }
        }

        return $cantidadTiles;
    }

?>