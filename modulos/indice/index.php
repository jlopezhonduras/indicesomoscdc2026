<?php
require_once("../../includes/session.php");
require_once("../../controladores/conexion.php");

$db = new Conexion();
$cn = $db->conectar();

$sql = "
SELECT *
FROM periodos_encuesta
ORDER BY anio DESC, fecha_inicio DESC
";

$resultado = $cn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">

<title>Índice de Inclusión LGTBI+</title>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

<?php include("../../includes/menu.php"); ?>

<div class="container mt-4">

<div class="card">

<div class="card-header">

<div class="row">

<div class="col-md-8">

<h4>Generación del Índice de Inclusión LGTBI+</h4>

</div>

<div class="col-md-4 text-end">

<button
id="btnGenerar"
class="btn btn-success">

Generar Índice

</button>

</div>

</div>

</div>

<div class="card-body">

<div class="row mb-3">

<div class="col-md-6">

<label class="form-label">

Seleccione el período

</label>

<select
class="form-select"
id="id_periodo">

<option value="">

-- Seleccione --

</option>

<?php while($fila = $resultado->fetch_assoc()){ ?>

<option value="<?php echo $fila["id_periodo"]; ?>">

<?php

echo $fila["nombre"];

?>

 | 

<?php

echo $fila["anio"];

?>

 | 

<?php

echo ($fila["activo"]==1)
? "ACTIVO"
: "INACTIVO";

?>

</option>

<?php } ?>

</select>

</div>

<div class="col-md-6">

<div
id="informacionPeriodo"
class="alert alert-secondary mt-4">

Seleccione un período para generar el índice.

</div>

</div>

</div>

<hr>

<div id="resultadoIndice">

<div class="alert alert-info">

El resultado del índice aparecerá aquí después de presionar
<strong>Generar Índice</strong>.

</div>

</div>

</div>

</div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>

<script>

$("#btnGenerar").click(function(){

    let periodo =
    $("#id_periodo").val();

    if(periodo==""){

        alert("Seleccione un período.");

        return;

    }

    $("#resultadoIndice").load(

        "calcular.php",

        {

            id_periodo:periodo

        }

    );

});

$("#id_periodo").change(function(){

    let texto = $("#id_periodo option:selected").text();

    $("#informacionPeriodo").html(

        "<strong>Período seleccionado:</strong><br>"+texto

    );

});

</script>

</body>

</html>