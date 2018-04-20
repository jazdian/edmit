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
        .linky{
            cursor: pointer;
        }
    </style>
</head>

<body>

    <div class="row" style="height: 100%;">

        <div class="col-lg-2 col-sm-12" style="background-color: #E2E1DF;">
            <br>
            <ul class="list-group" style="margin-left: 10px;">
                <li id="li1" class="list-group-item linky active" onclick="MostrarModulo(1);">Inicio</li>
                <li id="li2" class="list-group-item linky" onclick="MostrarModulo(2);">Asignaciones por semana</li >
                <li id="li3" class="list-group-item linky" onclick="MostrarModulo(3);">Asignaciones por mes</li>
                <li id="li4" class="list-group-item linky" onclick="MostrarModulo(4);">Generar asignaciones auto.</li>
                <li id="li5" class="list-group-item linky" onclick="MostrarModulo(5);">Editar asignaciones</li>
                <li id="li6" class="list-group-item linky" onclick="MostrarModulo(6);">Administrar asignaciones</li>
                <li id="li7" class="list-group-item linky" onclick="MostrarModulo(7);">Administrar publicadores</li>
                <li id="li8" class="list-group-item linky" onclick="MostrarModulo(8);">Administrar estudios</li>
                <li id="li9" class="list-group-item linky" onclick="MostrarModulo(9);">Administrar semanas</li>
            </ul>
            <hr>
            <form  method="POST" >
                <div class="form-group">
                    <button type="submit" class="btn btn-danger form-control" style="margin-left: 8px;">SALIR</button>
                    <input type="hidden" name="logout" value="true">
                </div>
            </form>
        </div>

        <div class="col-lg-8 col-sm-12" style="background-color: #00627F;">

            <div id="mod1" class="" style="display: none; background-color: #00627F; background-image: url(img/home.png); background-repeat: no-repeat; height: 100%;">
                <h1>
                    <span class="text-light display-3">Administración para la reunión:</span>
                    <span class="text-light display-2">SEAMOS MEJORES MAESTROS</span>
                </h1>
            </div>

            <div id="mod2" class="container" style="background-color: #00627F;">

                <h2>
                    <span class="text-light display-4">Asignaciones por semana:</span>
                </h2>
                <hr>
                <?php require_once PATH_VIEW . '/rep_semana.php'; ?>

            </div>

            <div id="mod3" class="container" style="background-color: #00627F;">

                <h2>
                    <span class="text-light display-4">Asignaciones por mes:</span>
                </h2>
                <hr>
                <?php require_once PATH_VIEW . '/rep_mes.php'; ?>

            </div>

            
        </div>


        <!-- ########################### seccion lateral ##################################### -->
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