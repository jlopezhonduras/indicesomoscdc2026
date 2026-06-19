<?php

require_once("../../includes/session.php");
require_once("../../controladores/conexion.php");

$db = new Conexion();
$cn = $db->conectar();

$sql = "SELECT *
        FROM secciones
        ORDER BY orden";

$secciones = $cn->query($sql);

?>

<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1">

<title>Encuesta</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<style>

.paso{
    display:none;
}

.paso.activo{
    display:block;
}

.is-invalid{
    border:2px solid #dc3545 !important;
}

.btn-especial,
.btn-numero{
    white-space: nowrap;
}

</style>

</head>

<body>

<?php include("../../includes/menu.php"); ?>


<div class="container mt-4 mb-5">

<div class="card shadow">

<div class="card-header bg-primary text-white">

<h4 class="mb-0">
Índice de Inclusión LGTBI+
</h4>

</div>

<div class="card-body">

<div class="progress mb-4">

<div
id="barraProgreso"
class="progress-bar"
style="width:0%">
0%
</div>

</div>

<form id="frmEncuesta">

<?php

$contador = 0;

while($seccion = $secciones->fetch_assoc()){

    $contador++;

?>

<div
class="paso <?php echo ($contador==1 ? 'activo' : ''); ?>"
data-paso="<?php echo $contador; ?>">

<h4 class="mb-4">

<?php echo $seccion["nombre"]; ?>

</h4>

<?php

$sqlPreguntas = "
SELECT *
FROM preguntas
WHERE id_seccion=?
AND activa=1
ORDER BY orden
";

$stmt = $cn->prepare($sqlPreguntas);

$stmt->bind_param(
"i",
$seccion["id_seccion"]
);

$stmt->execute();

$preguntas = $stmt->get_result();

while($pregunta = $preguntas->fetch_assoc()){

?>

<div class="mb-3">

<label class="form-label">

<?php echo $pregunta["pregunta"]; ?>

</label>

<?php


switch($pregunta["tipo"]){

    case "text":

        echo '

        <div class="input-group">

            <input
            type="text"
            required
            class="form-control respuesta-obligatoria"
            name="pregunta_'.$pregunta["id_pregunta"].'">

            <button
            type="button"
            class="btn btn-outline-secondary btn-especial"
            data-target="pregunta_'.$pregunta["id_pregunta"].'">

            N/A

            </button>

        </div>';

    break;


    case "number":

        echo '

        <div class="input-group">

            <input
            type="number"
            required
            class="form-control respuesta-obligatoria"
            name="pregunta_'.$pregunta["id_pregunta"].'">

            <button
            type="button"
            class="btn btn-outline-secondary btn-numero"
            data-target="pregunta_'.$pregunta["id_pregunta"].'">

            N/A

            </button>

        </div>';

    break;


    case "textarea":

        echo '

        <textarea
        rows="3"
        required
        class="form-control mb-2 respuesta-obligatoria"
        name="pregunta_'.$pregunta["id_pregunta"].'"></textarea>

        <button
        type="button"
        class="btn btn-outline-secondary btn-sm btn-especial"
        data-target="pregunta_'.$pregunta["id_pregunta"].'">

        No aplica / No sabe / No quiere responder

        </button>';

    break;


    case "select":

        echo '<select
              required
              class="form-select respuesta-obligatoria"
              name="pregunta_'.$pregunta["id_pregunta"].'">';

        echo '<option value="">Seleccione...</option>';

        if($pregunta["id_pregunta"]==78){

            echo '
            <option>Masculino</option>
            <option>Femenino</option>
            <option>Intersexual</option>
            <option>No sabe</option>
            <option>No quiere responder</option>
            <option>No aplica</option>';

        }elseif($pregunta["id_pregunta"]==80){

            echo '
            <option>Gay</option>
            <option>Lesbiana</option>
            <option>Bisexual</option>
            <option>Pansexual</option>
            <option>Asexual</option>
            <option>Heterosexual</option>
            <option>Otra</option>
            <option>No sabe</option>
            <option>No quiere responder</option>
            <option>No aplica</option>';

        }elseif($pregunta["id_pregunta"]==81){

            echo '
            <option>Mujer Trans</option>
            <option>Hombre Trans</option>
            <option>Mujer Cis</option>
            <option>Hombre Cis</option>
            <option>No Binario</option>
            <option>Otra</option>
            <option>No sabe</option>
            <option>No quiere responder</option>
            <option>No aplica</option>';

        }elseif($pregunta["id_pregunta"]==82){

            echo '
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
            <option>Yoro</option>';

        }else{

            echo '
            <option value="SI">Sí</option>
            <option value="NO">No</option>
            <option value="NS">No sabe</option>
            <option value="NR">No quiere responder</option>
            <option value="NA">No aplica</option>';
        }

        echo '</select>';

    break;


    case "likert":

        echo '

        <select
        required
        class="form-select respuesta-obligatoria"
        name="pregunta_'.$pregunta["id_pregunta"].'">

            <option value="">Seleccione...</option>

            <option value="1">1 - Muy mala</option>
            <option value="2">2 - Mala</option>
            <option value="3">3 - Regular</option>
            <option value="4">4 - Buena</option>
            <option value="5">5 - Muy buena</option>

            <option value="NS">No sabe</option>
            <option value="NR">No quiere responder</option>
            <option value="NA">No aplica</option>

        </select>';

    break;
}



?>

</div>

<?php } ?>

</div>

<?php } ?>

<div class="d-flex justify-content-between mt-4">

<button
type="button"
class="btn btn-secondary"
id="btnAnterior">

Anterior

</button>

<button
type="button"
class="btn btn-primary"
id="btnSiguiente">

Siguiente

</button>

</div>

</form>

</div>

</div>

</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script>

let pasoActual = 1;

let totalPasos = $(".paso").length;

actualizarBarra();

function actualizarBarra(){

    let porcentaje =
    Math.round(
        (pasoActual / totalPasos) * 100
    );

    $("#barraProgreso")
    .css("width", porcentaje+"%")
    .text(porcentaje+"%");
}

$("#btnSiguiente").click(function(){

    let valido = true;

    let pasoActualDiv =
    $('.paso[data-paso="'+pasoActual+'"]');

    pasoActualDiv.find('.respuesta-obligatoria').each(function(){

        let valor = $(this).val();

        if(valor === null || valor === undefined || $.trim(valor) === ''){

            $(this).addClass('is-invalid');
            valido = false;

        }else{

            $(this).removeClass('is-invalid');

        }

    });

    if(!valido){

        Swal.fire({
            icon:'warning',
            title:'Formulario incompleto',
            text:'Debe responder todas las preguntas antes de continuar.'
        });

        return false;
    }

    if(pasoActual < totalPasos){

        $(".paso").removeClass("activo");

        pasoActual++;

        $('.paso[data-paso="'+pasoActual+'"]')
        .addClass("activo");

        actualizarBarra();

        if(pasoActual == totalPasos){
            $("#btnSiguiente").text("Finalizar Encuesta");
        }

    }else{

        Swal.fire({
            icon:'success',
            title:'Encuesta completa',
            text:'Todas las secciones han sido respondidas.'
        });

    }

});

$("#btnAnterior").click(function(){

    if(pasoActual > 1){

        $(".paso").removeClass("activo");

        pasoActual--;

        $('.paso[data-paso="'+pasoActual+'"]')
        .addClass("activo");

        actualizarBarra();
    }

});
	
	
$(document).on("click",".btn-especial",function(){

    let campo=$(this).data("target");

    $('[name="'+campo+'"]')
    .val("NO APLICA / NO SABE / NO QUIERE RESPONDER");

});

$(document).on("click",".btn-numero",function(){

    let campo=$(this).data("target");

    $('[name="'+campo+'"]')
    .val(-1);

});



</script>

	<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
	
</body>
</html>