<?php

require_once("../../includes/session.php");

?>

<?php include("modal_editar.php"); ?>

<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Periodos de Encuesta</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

<?php include("../../includes/menu.php"); ?>

<div class="container mt-4">

<div class="d-flex justify-content-between mb-3">

<h3>Periodos de Encuesta</h3>

<button
class="btn btn-primary"
data-bs-toggle="modal"
data-bs-target="#modalNuevo">

Nuevo Periodo

</button>

</div>

<div id="tablaPeriodos"></div>

</div>

<?php include("modal_nuevo.php"); ?>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>

<script>

function cargarPeriodos(){

    $("#tablaPeriodos")
    .load("listar.php");

}

$(document).ready(function(){

    cargarPeriodos();

});

</script>

</body>
</html>