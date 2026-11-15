<?php

require_once(__DIR__ . '/src/functions.php');

session_start();

cerrarSesion();

header('Location: login.php');
exit();
