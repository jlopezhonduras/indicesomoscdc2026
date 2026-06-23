<?php

require_once("../../controladores/conexion.php");

$db = new Conexion();
$cn = $db->conectar();

$departamentos = $cn->query("
SELECT *
FROM departamentos
ORDER BY nombre
");

?>

<div
class="modal fade"
id="modalNuevo"
tabindex="-1">

<div class="modal-dialog modal-lg">

<div class="modal-content">

<div class="modal-header">

<h5 class="modal-title">

Nueva Organización

</h5>

<button
type="button"
class="btn-close"
data-bs-dismiss="modal">
</button>

</div>

<div class="modal-body">

<div id="mensajeOrganizacion"></div>

<form id="frmOrganizacion">

<div class="row">

<div class="col-md-6 mb-3">

<label>Nombre *</label>

<input
type="text"
name="nombre"
class="form-control"
required>

</div>

<div class="col-md-6 mb-3">

<label>Departamento *</label>

<select
name="departamento"
class="form-select"
required>

<option value="">
Seleccione...
</option>

<?php
while($d = $departamentos->fetch_assoc()){
?>

<option
value="<?php echo $d["nombre"]; ?>">

<?php echo $d["nombre"]; ?>

</option>

<?php
}
?>

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
required>

</div>

<div class="col-md-6 mb-3">

<label>Correo *</label>

<input
type="email"
name="correo"
class="form-control"
required>

</div>

</div>

<div class="row">

<div class="col-md-12 mb-3">

<label>Teléfono *</label>

<input
type="text"
name="telefono"
class="form-control"
required>

</div>

</div>

<div class="mb-3">

<label>Dirección *</label>

<textarea
name="direccion"
class="form-control"
rows="3"
required></textarea>

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

$("#frmOrganizacion").submit(function(e){

    e.preventDefault();

    $.ajax({

        url:"guardar.php",

        type:"POST",

        data:$(this).serialize(),

        dataType:"json",

        success:function(r){

            if(r.success){

                $("#mensajeOrganizacion").html(
                    '<div class="alert alert-success">'+
                    r.message+
                    '</div>'
                );

                cargarOrganizaciones();

                $("#frmOrganizacion")[0].reset();

            }else{

                $("#mensajeOrganizacion").html(
                    '<div class="alert alert-danger">'+
                    r.message+
                    '</div>'
                );

            }

        }

    });

});

</script>