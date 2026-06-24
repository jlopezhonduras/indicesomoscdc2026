<?php
require_once("../../includes/session.php");
?>

<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Consultar Encuestas</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

<?php include("../../includes/menu.php"); ?>

<div class="container mt-4">

<div class="row mb-3">

<div class="col-md-3">
<input type="date" id="fecha_inicio" class="form-control">
</div>

<div class="col-md-3">
<input type="date" id="fecha_fin" class="form-control">
</div>

<div class="col-md-3">
<input type="text"
id="buscar"
class="form-control"
placeholder="Buscar organización o usuario">
</div>

<div class="col-md-3">
<button
class="btn btn-primary w-100"
onclick="cargarEncuestas()">
Buscar
</button>
</div>

</div>

<div id="totalEncuestas"></div>

<div id="tablaEncuestas"></div>

</div>

<?php include("modal_ver.php"); ?>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>

<script>

function cargarEncuestas(){

    $("#tablaEncuestas").load(
        "listar.php",
        {
            fecha_inicio:$("#fecha_inicio").val(),
            fecha_fin:$("#fecha_fin").val(),
            buscar:$("#buscar").val()
        }
    );

}

$(document).ready(function(){

    cargarEncuestas();

});

</script>

</body>
</html>