<?php

require_once("../../controladores/conexion.php");

$id = intval($_POST["id"] ?? 0);

$db = new Conexion();
$cn = $db->conectar();

$stmt = $cn->prepare("
SELECT *
FROM periodos_encuesta
WHERE id_periodo=?
");

$stmt->bind_param(
"i",
$id
);

$stmt->execute();

$r = $stmt->get_result();

$fila = $r->fetch_assoc();

?>

<form id="frmEditarPeriodo">

<input
type="hidden"
name="id_periodo"
value="<?php echo $fila["id_periodo"]; ?>">

<div id="mensajeEditar"></div>

<div class="mb-3">

<label>Nombre</label>

<input
type="text"
name="nombre"
class="form-control"
value="<?php echo htmlspecialchars($fila["nombre"]); ?>"
required>

</div>

<div class="mb-3">

<label>Año</label>

<input
type="number"
name="anio"
class="form-control"
value="<?php echo $fila["anio"]; ?>"
required>

</div>

<div class="mb-3">

<label>Fecha Inicio</label>

<input
type="date"
name="fecha_inicio"
class="form-control"
value="<?php echo $fila["fecha_inicio"]; ?>"
required>

</div>

<div class="mb-3">

<label>Fecha Fin</label>

<input
type="date"
name="fecha_fin"
class="form-control"
value="<?php echo $fila["fecha_fin"]; ?>"
required>

</div>

<div class="mb-3">

<label>Observaciones</label>

<textarea
name="observaciones"
class="form-control"><?php echo htmlspecialchars($fila["observaciones"]); ?></textarea>

</div>

<button
type="submit"
class="btn btn-primary">

Actualizar

</button>

</form>

<script>

$("#frmEditarPeriodo").submit(function(e){

e.preventDefault();

$.ajax({

url:"actualizar.php",

type:"POST",

data:$(this).serialize(),

dataType:"json",

success:function(r){

if(r.success){

$("#mensajeEditar").html(
'<div class="alert alert-success">'+
r.message+
'</div>'
);

cargarPeriodos();

}else{

$("#mensajeEditar").html(
'<div class="alert alert-danger">'+
r.message+
'</div>'
);

}

}

});

});

</script>
