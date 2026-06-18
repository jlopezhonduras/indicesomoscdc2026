```php
<?php
require_once("../../includes/session.php");
?>

<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Formulario Índice de Inclusión LGTBI+</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

<?php include("../../includes/menu.php"); ?>

<div class="container mt-4 mb-5">

<div class="card shadow">

<div class="card-header bg-primary text-white">

<h4 class="mb-0">
Formulario Índice de Inclusión LGTBI+
</h4>

</div>

<div class="card-body">

<form id="frmEncuesta">

<h5 class="mb-3">Información General</h5>

<div class="row">

<div class="col-md-6 mb-3">
<label>¿Pertenece a alguna Organización?</label>
<select class="form-select" name="organizacion">
<option value="">Seleccione...</option>
<option>Si</option>
<option>No</option>
</select>
</div>

<div class="col-md-6 mb-3">
<label>Nombre de la Organización a la que pertenece</label>
<input type="text" class="form-control" name="nombre_organizacion">
</div>

<div class="col-md-4 mb-3">
<label>Sexo biológico</label>
<select class="form-select" name="sexo_biologico">
<option value="">Seleccione...</option>
<option>Masculino</option>
<option>Femenino</option>
<option>Intersexual</option>
</select>
</div>

<div class="col-md-4 mb-3">
<label>Edad</label>
<input type="number" class="form-control" name="edad">
</div>

<div class="col-md-4 mb-3">
<label>Departamento</label>
<select class="form-select" name="departamento">
<option value="">Seleccione...</option>
<option>Atlántida</option>
<option>Colón</option>
<option>Comayagua</option>
<option>Copán</option>
<option>Cortés</option>
<option>Choluteca</option>
<option>El Paraíso</option>
<option>Francisco Morazán</option>
<option>Gracias a Dios</option>
<option>Intibucá</option>
<option>Islas de la Bahía</option>
<option>La Paz</option>
<option>Lempira</option>
<option>Ocotepeque</option>
<option>Olancho</option>
<option>Santa Bárbara</option>
<option>Valle</option>
<option>Yoro</option>
</select>
</div>

<div class="col-md-6 mb-3">
<label>Orientación sexual</label>
<select class="form-select" name="orientacion">
<option value="">Seleccione...</option>
<option>Gay</option>
<option>Lesbiana</option>
<option>Bisexual</option>
<option>Pansexual</option>
<option>Asexual</option>
<option>Otra</option>
</select>
</div>

<div class="col-md-6 mb-3">
<label>Identidad de género</label>
<select class="form-select" name="identidad_genero">
<option value="">Seleccione...</option>
<option>Mujer Trans</option>
<option>Hombre Trans</option>
<option>Mujer Cis</option>
<option>Hombre Cis</option>
<option>No Binario</option>
<option>Otra</option>
</select>
</div>

</div>

<hr>

<h5 class="mb-3">Empleo</h5>

<div class="row">

<div class="col-md-6 mb-3">
<label>¿Cuenta actualmente con un trabajo?</label>
<select class="form-select" id="trabaja" name="trabaja">
<option value="">Seleccione...</option>
<option>Si</option>
<option>No</option>
</select>
</div>

<div class="col-md-6 mb-3 d-none" id="divTrabajo">
<label>¿Cuál es su trabajo?</label>
<input type="text" class="form-control" name="cual_trabajo">
</div>

</div>

<hr>

<h5 class="mb-3">Educación</h5>

<div class="row">

<div class="col-md-6 mb-3">
<label>Último nivel educativo completado</label>
<select class="form-select" name="nivel_educativo">
<option value="">Seleccione...</option>
<option>Primaria</option>
<option>Secundaria</option>
<option>Bachillerato</option>
<option>Técnico</option>
<option>Universitario</option>
<option>Postgrado</option>
</select>
</div>

<div class="col-md-6 mb-3">
<label>¿Se encuentra estudiando actualmente?</label>
<select class="form-select" id="estudia" name="estudia">
<option value="">Seleccione...</option>
<option>Si</option>
<option>No</option>
</select>
</div>

<div id="bloqueEstudios" class="row d-none">

<div class="col-md-6 mb-3">
<label>Tipo de educación</label>
<select class="form-select" name="tipo_educacion">
<option>Formal</option>
<option>No Formal</option>
</select>
</div>

<div class="col-md-6 mb-3">
<label>Grado que cursa actualmente</label>
<input type="number" class="form-control" name="grado_actual">
</div>

<div class="col-md-12 mb-3">
<label>Disciplina, profesión u oficio</label>
<input type="text" class="form-control" name="disciplina">
</div>

</div>

</div>

<hr>

<h5 class="mb-3">Discriminación Educativa</h5>

<div class="row">

<div class="col-md-6 mb-3">
<label>¿Ha enfrentado acoso, discriminación o violencia en el sistema educativo formal?</label>
<select class="form-select" id="acosoEducativo">
<option value="">Seleccione...</option>
<option>Si</option>
<option>No</option>
</select>
</div>

</div>

<div id="bloqueAcoso" class="row d-none">

<div class="col-md-12 mb-3">
<label>¿Qué tipo de acoso o discriminación enfrentó?</label>
<input type="text" class="form-control">
</div>

<div class="col-md-12 mb-3">
<label>¿Quién ejerció la discriminación? (Puede seleccionar varias opciones)</label>

<div class="form-check">
<input class="form-check-input" type="checkbox">
<label class="form-check-label">Docentes</label>
</div>

<div class="form-check">
<input class="form-check-input" type="checkbox">
<label class="form-check-label">Estudiantes</label>
</div>

<div class="form-check">
<input class="form-check-input" type="checkbox">
<label class="form-check-label">Personal administrativo</label>
</div>

</div>

</div>

<hr>

<div class="text-center">

<button
type="button"
class="btn btn-success btn-lg">

Guardar Encuesta

</button>

</div>

</form>

</div>

</div>

</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>

<script>

$("#trabaja").change(function(){

    if($(this).val()=="Si"){
        $("#divTrabajo").removeClass("d-none");
    }else{
        $("#divTrabajo").addClass("d-none");
    }

});

$("#estudia").change(function(){

    if($(this).val()=="Si"){
        $("#bloqueEstudios").removeClass("d-none");
    }else{
        $("#bloqueEstudios").addClass("d-none");
    }

});

$("#acosoEducativo").change(function(){

    if($(this).val()=="Si"){
        $("#bloqueAcoso").removeClass("d-none");
    }else{
        $("#bloqueAcoso").addClass("d-none");
    }

});

</script>

</body>
</html>
```
