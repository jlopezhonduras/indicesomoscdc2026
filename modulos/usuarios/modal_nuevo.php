<?php

require_once("../../controladores/conexion.php");

$db = new Conexion();
$cn = $db->conectar();

$roles = $cn->query("
SELECT id_rol,nombre
FROM roles
WHERE activo=1
ORDER BY nombre
");

$organizaciones = $cn->query("
SELECT id_organizacion,nombre
FROM organizaciones
WHERE activa=1
ORDER BY nombre
");
?>

<div class="modal fade" id="modalNuevo" tabindex="-1">

<div class="modal-dialog modal-lg">

<div class="modal-content">

<div class="modal-header">

<h5 class="modal-title">
Nuevo Usuario
</h5>

<button
type="button"
class="btn-close"
data-bs-dismiss="modal"> </button>

</div>

<div class="modal-body">

<div id="mensajeUsuario"></div>

<form id="frmUsuario">

<div class="row">

<div class="col-md-6 mb-3">

<label>Nombres *</label>

<input
type="text"
name="nombres"
class="form-control"
required>

</div>

<div class="col-md-6 mb-3">

<label>Apellidos *</label>

<input
type="text"
name="apellidos"
class="form-control"
required>

</div>

</div>

<div class="row">

<div class="col-md-6 mb-3">

<label>Correo Electrónico *</label>

<input
type="email"
name="correo"
class="form-control"
required>

</div>

<div class="col-md-6 mb-3">

<label>Teléfono *</label>

<input
type="text"
name="telefono"
class="form-control"
required>

</div>

</div>

<div class="row">

<div class="col-md-6 mb-3">

<label>Contraseña *</label>

<input
type="password"
name="password"
class="form-control"
required>

</div>

<div class="col-md-6 mb-3">

<label>Rol *</label>

<select
name="id_rol"
class="form-select"
required>

<option value="">
Seleccione...
</option>

<?php while($r = $roles->fetch_assoc()){ ?>

<option value="<?php echo $r["id_rol"]; ?>">
<?php echo $r["nombre"]; ?>
</option>

<?php } ?>

</select>

</div>

</div>

<div class="row">

<div class="col-md-6 mb-3">

<label>Organización *</label>

<select
name="id_organizacion"
class="form-select"
required>

<option value="">
Seleccione...
</option>

<?php while($o = $organizaciones->fetch_assoc()){ ?>

<option value="<?php echo $o["id_organizacion"]; ?>">
<?php echo $o["nombre"]; ?>
</option>

<?php } ?>

</select>

</div>

<div class="col-md-6 mb-3">

<label>Estado *</label>

<select
name="activo"
class="form-select"
required>

<option value="1">
Activo
</option>

<option value="0">
Inactivo
</option>

</select>

</div>

</div>

<button
type="submit"
class="btn btn-primary">

Guardar

</button>

</form>

</div>

</div>

</div>

</div>

<script>

$("#frmUsuario").submit(function(e){

e.preventDefault();

$.ajax({

url:"guardar.php",

type:"POST",

data:$(this).serialize(),

dataType:"json",

success:function(r){

if(r.success){

$("#mensajeUsuario").html(
'<div class="alert alert-success">'+
r.message+
'</div>'
);

$("#frmUsuario")[0].reset();

cargarUsuarios();

}else{

$("#mensajeUsuario").html(
'<div class="alert alert-danger">'+
r.message+
'</div>'
);

}

}

});

});

</script>
