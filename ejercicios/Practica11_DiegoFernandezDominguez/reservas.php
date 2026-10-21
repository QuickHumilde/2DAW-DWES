<?php

/*
    2. reservar.php (POST): formulario de reserva, que se muestra y se procesa en el mismo script,
    con estos campos:
        Campo Control Reglas
        Nombre texto Obligatorio, 2–60 caracteres,
        admite tildes y ñ
        Email email Email válido
        Pista select Una de: Pádel 1, Pádel 2, Tenis,
        Baloncesto
        Campo Control Reglas
        Fecha date Fecha válida, a partir de hoy y
        como máximo dentro de 14 días
        Hora radio Una franja entre las 16:00 y las
        21:00, en punto
        Material checkbox múltiple Opcional. Solo valores de la
        lista: raquetas, balón, petos
        Normas casilla suelta Obligatorio aceptarlas
*/

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include(__DIR__.'/src/functions.php');

define("PISTAS", ["Pádel 1","Pádel 2","Tenis","Baloncesto"]);
define("MATERIALES", ["Raquetas","Balón","Petos"]);

if (filter_input(INPUT_POST, 'mi_boton') !== null) {
    validarReserva();
}

include(__DIR__.'/templates/reservas.tpl.php');

function validarReserva() {

    $nombre = filter_input(INPUT_POST, 'nombre', FILTER_UNSAFE_RAW);
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $pista = filter_input(INPUT_POST, 'pista', FILTER_UNSAFE_RAW);
    $fecha = filter_input(INPUT_POST, 'date', FILTER_UNSAFE_RAW);
    $hora = filter_input(INPUT_POST, 'hora', FILTER_UNSAFE_RAW);
    $materiales = filter_input(
        INPUT_POST,
        'materiales',
        FILTER_UNSAFE_RAW,
        FILTER_REQUIRE_ARRAY
    );
    $normas = filter_input(INPUT_POST, 'normas', FILTER_UNSAFE_RAW);


    if (!validarNombre($nombre)){
        $errores[]=1;
    };

    if (!validarEmail($email)){
        $errores[]=2;
    };

    if (!validarPista($pista)){
        $errores[]=3;
    };

    if (!validarFecha($fecha)){
        $errores[]=4;
    };

    if (!validarHora($hora)){
        $errores[]=5;
    };

    if (!validarMateriales($materiales)){
        $errores[]=6;
    };

    if (!validarNormas($normas)) {
        $errores[]=7;
    };

    if (empty($errores)){

    $id_actual = getLastReservaId();

    guardarReservaCSV(
        $id_actual + 1,
        $nombre,
        $email,
        $pista,
        $fecha,
        $hora,
        $materiales
    );

    actualizarIdIndex($id_actual);

        header("Location: ./confirmacion.php");
        exit;
    } else {
        $string_errores = getMockupErrores($errores);
        echo($string_errores);
    };

};

function validarNombre($nombre){
    if ( strlen($nombre) >= 2 && strlen($nombre) <= 60 ){
        return true;
    } else {
        return false;
    }
};

function validarEmail($email){
    if (filter_var($email, FILTER_VALIDATE_EMAIL) !== false) {
        return true;
    } else {
        return false;
    }
};

function validarPista($pista){
    if ( in_array($pista, PISTAS)) {
        return true;
    } else {
        return false;
    }
};

function validarFecha($fecha) {
    if (!is_string($fecha)) {
        return false;
    }

    $date = DateTimeImmutable::createFromFormat('!Y-m-d', $fecha);

    if (!$date || $date->format('Y-m-d') !== $fecha) {
        return false;
    }

    $hoy = new DateTimeImmutable('today');
    $limite = $hoy->modify('+14 days');

    return $date >= $hoy && $date <= $limite;
};

function validarHora($hora) {
    if (!is_string($hora)) {
        return false;
    }

    $horasPermitidas = [
        '16:00',
        '17:00',
        '18:00',
        '19:00',
        '20:00',
        '21:00'
    ];

    return in_array($hora, $horasPermitidas, true);
};

function validarMateriales($materiales) {
    if ($materiales === null) {
        return true;
    }

    if (!is_array($materiales)) {
        return false;
    }

    foreach ($materiales as $material) {
        if (!is_string($material)
            || !in_array($material, MATERIALES, true)) {
            return false;
        }
    }

    return count($materiales) === count(array_unique($materiales));
};

function validarNormas($normas) {
    return $normas == '1';
};

function getMockupErrores($errores){
    $output = '<ul>';

    if (in_array(1, $errores)){
        $output .= '<li>Introduzca un nombre valido</li>';
    }

    if (in_array(2, $errores)){
        $output .= '<li>Introduzca un correo valido</li>';
    }

    if (in_array(3, $errores)){
        $output .= '<li>Introduzca una pista valida</li>';
    }

    if (in_array(4, $errores)){
        $output .= '<li>Introduzca una fecha valida</li>';
    }

    if (in_array(5, $errores)){
        $output .= '<li>Introduzca una hora valida</li>';
    }

    if (in_array(6, $errores)){
        $output .= '<li>Introduzca unos materiales validos</li>';
    }

    if (in_array(7, $errores)){
        $output .= '<li>Usted tiene que aceptar las normas para continuar</li>';
    }

    $output .= '</ul>';

    return $output;
};

function getLastReservaId(){
    $archivo = __DIR__.'/src/lastindex.txt';

    if (file_exists($archivo)) {
        $contenido = file_get_contents($archivo);
        return intval($contenido);
    }
    return -1;
};

function actualizarIdIndex($id_actual){

    $id_nuevo = $id_actual + 1;

    $archivo = __DIR__.'/src/lastindex.txt';

    file_put_contents($archivo, $id_nuevo);

}

function guardarReservaCSV(
    $id,
    $nombre,
    $email,
    $pista,
    $fecha,
    $hora,
    $materiales
){

    $ruta = __DIR__ . '/data_source/reservas.csv';

    $material = '';

    if (!empty($materiales)) {
        $material = implode(':', $materiales);
    }

    $linea = PHP_EOL .
        $id . ',' .
        $nombre . ',' .
        $email . ',' .
        $pista . ',' .
        $fecha . ',' .
        $hora . ',' .
        $material;

    file_put_contents(
        $ruta,
        $linea,
        FILE_APPEND
    );
}

?>