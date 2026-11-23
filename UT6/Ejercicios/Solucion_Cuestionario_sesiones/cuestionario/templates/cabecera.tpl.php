<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= e($titulo) ?></title>
    <style>
        body { font-family: sans-serif; max-width: 34rem; margin: 3rem auto; padding: 0 1rem; }
        label { display: block; margin-top: 1rem; }
        input[type=text], input[type=email], input[type=password] { width: 100%; padding: .4rem; box-sizing: border-box; }
        button { margin-top: 1.2rem; padding: .5rem 1.2rem; }
        .error { color: #b00020; font-size: .9rem; margin: .2rem 0 0; }
        .aviso { background: #e7f4e4; border: 1px solid #9cc79a; padding: .6rem; }
        .aviso.mal { background: #fde8e8; border-color: #e3a0a0; }
        label.opcion { margin-top: .5rem; }
        table { border-collapse: collapse; }
        th, td { border: 1px solid #ccc; padding: .3rem .8rem; text-align: left; }
    </style>
</head>
<body>
