<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Optica Aristos</title>

    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="assets/datatable/css/jquery.dataTables.css"/>

    <style>
        html,
        body {
            height: 100%;
            position: relative;
        }
    </style>
</head>

<body>

    <div class="row" style="height: 100%;">

        <div class="col-lg-2 col-sm-12" style="background-color: #E2E1DF;">
            <br>
            <ul class="list-group" style="margin-left: 10px;">
                <li class="list-group-item active">Inicio</li>
                <li class="list-group-item">Asignaciones por semana</li>
                <li class="list-group-item">Asignaciones por mes</li>
                <li class="list-group-item">Generar asignaciones auto.</li>
                <li class="list-group-item">Editar asignaciones</li>
                <li class="list-group-item">Administrar asignaciones</li>
                <li class="list-group-item">Administrar publicadores</li>
                <li class="list-group-item">Administrar estudios</li>
                <li class="list-group-item">Administrar semanas</li>
                <li class="list-group-item">Administrar asignación</li>
            </ul>
        </div>

        <!--<div id="inicio" class="col-lg-8 col-sm-12 d-flex align-items-end" style="background-color: #00627F; background-image: url(img/home.png); background-repeat: no-repeat;">
            <h1>
                <span class="text-light display-3">Administración para la reunión:</span>
                <span class="text-light display-2">SEAMOS MEJORES MAESTROS</span>
            </h1>
        </div>-->

        <div id="inicio" class="col-lg-8 col-sm-12" style="background-color: #00627F; display: block;">
            <h2>
                <span class="text-light display-4">Asignaciones por semana:</span>
            </h2>
            <hr>
            <?php require_once PATH_CLLER . '/reportes.controller.php'; ?>

        </div>
        

        <div class="col-lg-2 col-sm-12" style="background-color: #E2E1DF;">

            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        </div>

    </div>

    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery.dataTables.js"></script>
    <script src="assets/js/funciones.js"></script>

</body>

</html>