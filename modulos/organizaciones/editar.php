<?php

require_once("../../controladores/conexion.php");

$id = intval($_POST["id"]);

$db = new Conexion();
$cn = $db->conectar();

$sql = "
SELECT *
FROM organizaciones
WHERE id_organizacion = ?
";

$stmt = $cn->prepare($sql);

$stmt->bind_param("i",$id);

$stmt->execute();

$r = $stmt->get_result();

$org = $r->fetch_assoc();

$departamentos = $cn->query("
SELECT *
FROM departamentos
ORDER BY nombre
");

?>

<form id="frmEditarOrganizacion">

<input
type="hidden"
name="id_organizacion"
value="<?php echo $org["id_organizacion"]; ?>">

<div id="mensajeEditar"></div>

<div class="row">

<div class="col-md-6 mb-3">

<label>Nombre *</label>

<input
type="text"
name="nombre"
class="form-control"
value="<?php echo htmlspecialchars($org["nombre"]); ?>"
required>

</div>

<div class="col-md-6 mb-3">

<label>Departamento *</label>

<select
name="departamento"
class="form-select"
required>

<?php

while($d = $departamentos->fetch_assoc()){

    $selected = "";

    if(
        $d["nombre"] ==
        $org["departamento"]
    ){
        $selected = "selected";
    }

?>

<option
value="<?php echo $d["nombre"]; ?>"
<?php echo $selected; ?>>

<?php echo $d["nombre"]; ?>

</option>

<?php } ?>

</select>

</div>

</div>

<div class="row">

<div class="col-md-6 mb-3">

<label>Municipio *</label>

<input
type="text"
name="municipio"
class="form-control"
value="<?php echo htmlspecialchars($org["municipio"]); ?>"
required>

</div>

<div class="col-md-6 mb-3">

<label>Correo *</label>

<input
type="email"
name="correo"
class="form-control"
value="<?php echo htmlspecialchars($org["correo"]); ?>"
required>

</div>

</div>

<div class="mb-3">

<label>Teléfono *</label>

<input
type="text"
name="telefono"
class="form-control"
value="<?php echo htmlspecialchars($org["telefono"]); ?>"
required>

</div>

<div class="mb-3">

<label>Dirección *</label>

<textarea
name="direccion"
rows="3"
class="form-control"
required><?php echo htmlspecialchars($org["direccion"]); ?></textarea>

</div>

<button
type="submit"
class="btn btn-primary">

Actualizar

</button>

</form>

<script>

$("#frmEditarOrganizacion").submit(function(e){

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

                cargarOrganizaciones();

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