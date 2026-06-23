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
.lista-secciones{
    list-style:none;
    padding-left:0;
}

.lista-secciones li{
    padding:8px 12px;
    margin-bottom:5px;
    border-radius:6px;
    background:#f8f9fa;
    border-left:4px solid #dee2e6;
}

.lista-secciones li.activa{
    background:#e7f1ff;
    border-left:4px solid #0d6efd;
    font-weight:bold;
}

.lista-secciones li.completada{
    background:#d1e7dd;
    border-left:4px solid #198754;
}

.contador-seccion{
    font-size:14px;
    color:#666;
    margin-bottom:15px;
}

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
	
<!-- Modal de consentimiento --> <div class="modal fade" id="modalConsentimiento" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"> <div class="modal-dialog modal-dialog-centered"> <div class="modal-content"> <div class="modal-header bg-primary text-white"> <h5 class="modal-title"> Consentimiento para participar </h5> </div> <div class="modal-body"> <p class="mb-3"> Al continuar con la encuesta, usted acepta participar bajo los términos descritos. </p> <div class="form-check"> <input class="form-check-input" type="radio" name="consentimiento" id="consentimiento_si" value="SI"> <label class="form-check-label" for="consentimiento_si"> Sí, acepto participar </label> </div> <div class="form-check"> <input class="form-check-input" type="radio" name="consentimiento" id="consentimiento_no" value="NO"> <label class="form-check-label" for="consentimiento_no"> No acepto participar </label> </div> <div id="mensajeConsentimiento" class="alert alert-danger mt-3 d-none"> Debe seleccionar una opción. </div> </div> <div class="modal-footer"> <button type="button" class="btn btn-primary" id="btnAceptarConsentimiento"> Continuar </button> </div> </div> </div> </div>	


<div class="container mt-4 mb-5">

<div class="row">

    <div class="col-md-3">

        <div class="card shadow-sm">

            <div class="card-header bg-secondary text-white">

                Secciones

            </div>

            <div class="card-body">

                <div
                id="contadorSecciones"
                class="contador-seccion">
                </div>

                <ul
                class="lista-secciones"
                id="listaSecciones">

                <?php

                $sqlMenu = "
                SELECT *
                FROM secciones
                ORDER BY orden
                ";

                $menuSecciones =
                $cn->query($sqlMenu);

                $i = 0;

                while($sec = $menuSecciones->fetch_assoc()){

                    $i++;

                    ?>

                    <li
                    id="menuPaso<?php echo $i; ?>">

                        <?php echo $sec["nombre"]; ?>

                    </li>

                    <?php

                }

                ?>

                </ul>

            </div>

        </div>

    </div>

    <div class="col-md-9">

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

    $sqlOpciones = "
        SELECT *
        FROM opciones_pregunta
        WHERE id_pregunta = ?
        ORDER BY orden
    ";

    $stmtOpciones = $cn->prepare($sqlOpciones);

    $stmtOpciones->bind_param(
        "i",
        $pregunta["id_pregunta"]
    );

    $stmtOpciones->execute();

    $opciones = $stmtOpciones->get_result();

    while($opcion = $opciones->fetch_assoc()){

        echo '
        <option value="'.$opcion["valor"].'">
            '.$opcion["etiqueta"].'
        </option>';

    }

    echo '</select>';

break;

		case "checkbox":

    $sqlOpciones = "
        SELECT *
        FROM opciones_pregunta
        WHERE id_pregunta = ?
        ORDER BY orden
    ";

    $stmtOpciones = $cn->prepare($sqlOpciones);

    $stmtOpciones->bind_param(
        "i",
        $pregunta["id_pregunta"]
    );

    $stmtOpciones->execute();

    $opciones = $stmtOpciones->get_result();

    while($opcion = $opciones->fetch_assoc()){

        echo '

        <div class="form-check">

            <input
            class="form-check-input respuesta-obligatoria"
            type="checkbox"
            value="'.$opcion["valor"].'"
            name="pregunta_'.$pregunta["id_pregunta"].'[]">

            <label class="form-check-label">

                '.$opcion["etiqueta"].'

            </label>

        </div>';

    }

break;

  case "likert":

    echo '<select
            required
            class="form-select respuesta-obligatoria"
            name="pregunta_'.$pregunta["id_pregunta"].'">';

    echo '<option value="">Seleccione...</option>';

    $sqlOpciones = "
        SELECT *
        FROM opciones_pregunta
        WHERE id_pregunta = ?
        ORDER BY orden
    ";

    $stmtOpciones = $cn->prepare($sqlOpciones);

    $stmtOpciones->bind_param(
        "i",
        $pregunta["id_pregunta"]
    );

    $stmtOpciones->execute();

    $opciones = $stmtOpciones->get_result();

    while($opcion = $opciones->fetch_assoc()){

        echo '
        <option value="'.$opcion["valor"].'">
            '.$opcion["etiqueta"].'
        </option>';

    }

    echo '</select>';

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

</div>

</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>



<script>

let pasoActual = 1;
	
	
let modalConsentimiento =
new bootstrap.Modal(
    document.getElementById('modalConsentimiento')
);

$(document).ready(function(){

    modalConsentimiento.show();

});

$("#btnAceptarConsentimiento").click(function(){

    let respuesta =
    $('input[name="consentimiento"]:checked').val();

    if(!respuesta){

        $("#mensajeConsentimiento")
        .removeClass("d-none");

        return;
    }

    if(respuesta === "SI"){

        modalConsentimiento.hide();

    }else{

        window.location.href =
        "../../tablero.php";

    }

});



let totalPasos = $(".paso").length;

actualizarBarra();
	
actualizarNavegacion();

function actualizarBarra(){

    let porcentaje =
    Math.round(
        (pasoActual / totalPasos) * 100
    );

    $("#barraProgreso")
    .css("width", porcentaje+"%")
    .text(porcentaje+"%");
}

function actualizarNavegacion(){

    $("#contadorSecciones").html(
        "Sección <strong>" +
        pasoActual +
        "</strong> de <strong>" +
        totalPasos +
        "</strong>"
    );

    $(".lista-secciones li")
    .removeClass("activa");

    for(let i=1;i<pasoActual;i++){

        $("#menuPaso"+i)
        .addClass("completada");

    }

    $("#menuPaso"+pasoActual)
    .addClass("activa");

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
		actualizarNavegacion();

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
		actualizarNavegacion();
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