<?php

require_once("../../includes/session.php");

?>

<!DOCTYPE html>

<html lang="es">

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1">

<title>Mi Perfil</title>

<link
href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css"
rel="stylesheet">

</head>

<body>

<?php include("../../includes/menu.php"); ?>

<div class="container mt-4">

<div class="row justify-content-center">

<div class="col-md-6">

<div class="card shadow">

<div class="card-header">

<h4>

Cambiar Contraseña

</h4>

</div>

<div class="card-body">

<div id="mensaje"></div>

<form id="frmPassword">

<div class="mb-3">

<label>

Contraseña Actual

</label>

<input
type="password"
name="password_actual"
class="form-control"
required>

</div>

<div class="mb-3">

<label>

Nueva Contraseña

</label>

<input
type="password"
name="password_nueva"
class="form-control"
required>

</div>

<div class="mb-3">

<label>

Confirmar Contraseña

</label>

<input
type="password"
name="password_confirmar"
class="form-control"
required>

</div>

<button
type="submit"
class="btn btn-primary">

Actualizar Contraseña

</button>

</form>

</div>

</div>

</div>

</div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script>

$("#frmPassword").submit(function(e){

e.preventDefault();

$.ajax({

url:"guardar_password.php",

type:"POST",

data:$(this).serialize(),

dataType:"json",

success:function(r){

if(r.success){

$("#mensaje").html(
'<div class="alert alert-success">'+
r.message+
'</div>'
);

$("#frmPassword")[0].reset();

}else{

$("#mensaje").html(
'<div class="alert alert-danger">'+
r.message+
'</div>'
);

}

}

});

});

</script>

</body>

</html>
