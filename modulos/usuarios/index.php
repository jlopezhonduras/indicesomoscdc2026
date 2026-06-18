<?php
require_once("../../includes/session.php");
?>

<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">

<title>Usuarios</title>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

<?php include("../../includes/menu.php"); ?>

<div class="container mt-4">

<div class="card">

<div class="card-header">

<div class="row">

<div class="col-md-6">
<h4>Administración de Usuarios</h4>
</div>

<div class="col-md-6 text-end">

<button
class="btn btn-success"
data-bs-toggle="modal"
data-bs-target="#modalNuevo">

Nuevo Usuario

</button>

</div>

</div>

</div>

<div class="card-body">

<div id="tablaUsuarios"></div>

</div>

</div>

</div>

<?php include("modal_nuevo.php"); ?>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>

<script>

function cargarUsuarios(){

    $("#tablaUsuarios").load("listar.php");

}

$(document).ready(function(){

    cargarUsuarios();

});

</script>

</body>

</html>