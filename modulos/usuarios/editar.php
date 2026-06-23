<?php

require_once("../../controladores/conexion.php");

$id = intval($_POST["id"]);

$db = new Conexion();
$cn = $db->conectar();

$sql = "
SELECT *
FROM usuarios
WHERE id_usuario = ?
";

$stmt = $cn->prepare($sql);

$stmt->bind_param("i",$id);

$stmt->execute();

$r = $stmt->get_result();

$usuario = $r->fetch_assoc();

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

<form id="frmEditarUsuario">

<input
type="hidden"
name="id_usuario"
value="<?php echo $usuario["id_usuario"]; ?>">

<div id="mensajeEditar"></div>

<div class="row">

<div class="col-md-6 mb-3">

<label>Nombres *</label>

<input
type="text"
name="nombres"
class="form-control"
value="<?php echo htmlspecialchars($usuario["nombres"]); ?>"
required>

</div>

<div class="col-md-6 mb-3">

<label>Apellidos *</label>

<input
type="text"
name="apellidos"
class="form-control"
value="<?php echo htmlspecialchars($usuario["apellidos"]); ?>"
required>

</div>

</div>

<div class="row">

<div class="col-md-6 mb-3">

<label>Correo *</label>

<input
type="email"
name="correo"
class="form-control"
value="<?php echo htmlspecialchars($usuario["correo"]); ?>"
required>

</div>

<div class="col-md-6 mb-3">

<label>Teléfono *</label>

<input
type="text"
name="telefono"
class="form-control"
value="<?php echo htmlspecialchars($usuario["telefono"]); ?>"
required>

</div>

</div>

<div class="row">

<div class="col-md-6 mb-3">

<label>Rol *</label>

<select
name="id_rol"
class="form-select"
required>

<?php while($rol = $roles->fetch_assoc()){ ?>

<option
value="<?php echo $rol["id_rol"]; ?>"
<?php echo ($rol["id_rol"]==$usuario["id_rol"] ? "selected" : ""); ?>>

<?php echo $rol["nombre"]; ?>

</option>

<?php } ?>

</select>

</div>

<div class="col-md-6 mb-3">

<label>Organización *</label>

<select
name="id_organizacion"
class="form-select"
required>

<?php while($org = $organizaciones->fetch_assoc()){ ?>

<option
value="<?php echo $org["id_organizacion"]; ?>"
<?php echo ($org["id_organizacion"]==$usuario["id_organizacion"] ? "selected" : ""); ?>>

<?php echo $org["nombre"]; ?>

</option>

<?php } ?>

</select>

</div>

</div>

<div class="mb-3">

<label>Estado *</label>

<select
name="activo"
class="form-select">

<option
value="1"
<?php echo ($usuario["activo"]==1 ? "selected" : ""); ?>>

Activo

</option>

<option
value="0"
<?php echo ($usuario["activo"]==0 ? "selected" : ""); ?>>

Inactivo

</option>

</select>

</div>

<button
type="submit"
class="btn btn-primary">

Actualizar

</button>

</form>

<script>

$("#frmEditarUsuario").submit(function(e){

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

cargarUsuarios();

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
