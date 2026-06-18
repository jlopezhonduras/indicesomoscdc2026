<?php

require_once("includes/session.php");

?>

<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1">

<title>Tablero Principal</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

<?php include("includes/menu.php"); ?>

<div class="container mt-4">

<div class="card">

<div class="card-body">

<h3>Bienvenido</h3>

<hr>

<p>
Usuario:
<strong>
<?php echo $_SESSION["usuario"]; ?>
</strong>
</p>

<p>
Nombre:
<strong>
<?php echo $_SESSION["nombre"]; ?>
</strong>
</p>

<p>
Rol:
<strong>
<?php echo $_SESSION["id_rol"]; ?>
</strong>
</p>

</div>

</div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>