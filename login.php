.<?php
session_start();

if(isset($_SESSION["id_usuario"])){
    header("Location: tablero.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Índice de Inclusión LGTBI+</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">

<div class="container">

<div class="row justify-content-center mt-5">

<div class="col-md-4">

<div class="card shadow">

<div class="card-header text-center">

<h4>Índice de Inclusión LGTBI+</h4>

</div>

<div class="card-body">

<form id="frmLogin">

<div class="mb-3">

<label>Usuario</label>

<input
type="text"
name="usuario"
class="form-control"
required>

</div>

<div class="mb-3">

<label>Contraseña</label>

<input
type="password"
name="password"
class="form-control"
required>

</div>

<div id="mensaje"></div>

<button
type="submit"
class="btn btn-primary w-100">

Ingresar

</button>

</form>

</div>

</div>

</div>

</div>

</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script>

$("#frmLogin").submit(function(e){

    e.preventDefault();

    $.ajax({

        url:'controladores/login.php',

        type:'POST',

        data:$(this).serialize(),

        dataType:'json',

        success:function(r){

            if(r.success){

                window.location='tablero.php';

            }else{

                $("#mensaje").html(
                    '<div class="alert alert-danger mt-2">'+
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