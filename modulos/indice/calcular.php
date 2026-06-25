<?php

require_once("../../controladores/conexion.php");

if(!isset($_POST["id_periodo"]))
{
    die("
        <div class='alert alert-danger'>
            No se recibió el período.
        </div>
    ");
}

$id_periodo = intval($_POST["id_periodo"]);

$db = new Conexion();
$cn = $db->conectar();


/*
|--------------------------------------------------------------------------
| Obtener información del período
|--------------------------------------------------------------------------
*/

$sql = "
SELECT *
FROM periodos_encuesta
WHERE id_periodo=?
";

$stmt = $cn->prepare($sql);

$stmt->bind_param("i",$id_periodo);

$stmt->execute();

$periodo = $stmt->get_result()->fetch_assoc();

if(!$periodo)
{

    die("
        <div class='alert alert-danger'>
            El período seleccionado no existe.
        </div>
    ");

}


/*
|--------------------------------------------------------------------------
| Total de encuestas
|--------------------------------------------------------------------------
*/

$sql = "
SELECT COUNT(*) total
FROM encabezado_encuesta
WHERE id_periodo=?
";

$stmt = $cn->prepare($sql);

$stmt->bind_param("i",$id_periodo);

$stmt->execute();

$total = $stmt->get_result()->fetch_assoc()["total"];

?>

<div class="card mt-3">

<div class="card-header bg-primary text-white">

Resultado del cálculo

</div>

<div class="card-body">

<table class="table table-bordered">

<tr>

<th width="250">

Período

</th>

<td>

<?php echo $periodo["nombre"]; ?>

</td>

</tr>

<tr>

<th>

Año

</th>

<td>

<?php echo $periodo["anio"]; ?>

</td>

</tr>

<tr>

<th>

Estado

</th>

<td>

<?php

echo ($periodo["activo"]==1)
?
"<span class='badge bg-success'>ACTIVO</span>"
:
"<span class='badge bg-secondary'>INACTIVO</span>";

?>

</td>

</tr>

<tr>

<th>

Fecha inicio

</th>

<td>

<?php echo $periodo["fecha_inicio"]; ?>

</td>

</tr>

<tr>

<th>

Fecha fin

</th>

<td>

<?php echo $periodo["fecha_fin"]; ?>

</td>

</tr>

<tr>

<th>

Encuestas encontradas

</th>

<td>

<strong>

<?php echo number_format($total); ?>

</strong>

</td>

</tr>

</table>

<?php

if($total==0)
{

?>

<div class="alert alert-warning">

No existen encuestas para este período.
	

</div>

<?php

exit;

}

?>
<?php

/*=========================================================
CARGAR TODAS LAS RESPUESTAS DE LAS ENCUESTAS
=========================================================*/

$sql = "
SELECT
    e.id_encuesta,
    d.id_pregunta,
    d.valor
FROM encabezado_encuesta e
INNER JOIN detalle_encuesta d
    ON e.id_encuesta = d.id_encuesta
WHERE e.id_periodo = ?
ORDER BY e.id_encuesta, d.id_pregunta
";

$stmt = $cn->prepare($sql);
$stmt->bind_param("i", $id_periodo);
$stmt->execute();

$resultado = $stmt->get_result();

$respuestas = [];

while($fila = $resultado->fetch_assoc())
{
    $respuestas[$fila["id_encuesta"]][$fila["id_pregunta"]] = $fila["valor"];
}

?>
	
	
	<!-- ==========================================================
ÍNDICE DE INCLUSIÓN LGTBI+
========================================================== -->

<h3 class="mb-4">

Índice de Inclusión LGTBI+

</h3>


<!-- ==========================================================
DIMENSIÓN 1
========================================================== -->

<div class="card border-primary mb-4">

    <div class="card-header bg-primary text-white">

        <h5 class="mb-0">

            DIMENSIÓN 1

            <br>

            <small>Educación Inclusiva</small>

        </h5>

    </div>

    <div class="card-body">

        <p><strong>Peso de la dimensión:</strong> 9.8%</p>

<?php

/*----------------------------------------------------------
INDICADOR 1
Acceso a educación formal
----------------------------------------------------------*/
$totalConSecundariaOMas = 0;
$totalValidos = 0;
$totalPrimaria = 0;
$totalSecundaria = 0;
$totalSuperior = 0;
$totalPosgrado = 0;
$totalNS = 0;

foreach($respuestas as $encuesta)
{

    if(!isset($encuesta[83]))
        continue;

    $nivel = trim($encuesta[83]);

    // Excluir respuestas no válidas
if(in_array($nivel,["NS","NR","NA"])){
    $totalNS++;
    continue;
}
	

    $totalValidos++;

if($nivel=="Primaria")
{
    $totalPrimaria++;
}

if($nivel=="Secundaria")
{
    $totalSecundaria++;
    $totalConSecundariaOMas++;
}

if($nivel=="Superior (universitaria)")
{
    $totalSuperior++;
    $totalConSecundariaOMas++;
}

if($nivel=="Pos-Grado")
{
    $totalPosgrado++;
    $totalConSecundariaOMas++;
}


}

/* Resultado del indicador */

$indicador1 = null;

if($totalValidos>0)
{

 $indicador1 =
	 $totalConSecundariaOMas /
	 $totalValidos;
}

?>

        <div class="alert alert-light border">

            <h6>Indicador 1. Acceso a educación formal</h6>

            <table class="table table-bordered table-sm">

<tr>

<th width="22%">

Pregunta

</th>

<td>

<strong>P83.</strong>

¿Cuál fue el último nivel de educación formal alcanzado?

</td>

</tr>

<tr>

<th>

Criterio

</th>

<td>

Se consideran respuestas positivas:

<ul class="mb-1">

<li>Secundaria</li>

<li>Superior (universitaria)</li>

<li>Pos-Grado</li>

</ul>

Se excluyen NS, NR y NA.

</td>

</tr>

<tr>

<th>

Construcción

</th>

<td>

<table class="table table-sm table-borderless mb-0">

<tr>
<td width="60%">Total de encuestas</td>
<td><strong><?php echo count($respuestas); ?></strong></td>
</tr>

<tr>
<td>Respuestas válidas</td>
<td><strong><?php echo $totalValidos; ?></strong></td>
</tr>

<tr>
<td>Primaria</td>
<td><strong><?php echo $totalPrimaria; ?></strong></td>
</tr>

<tr>
<td>Secundaria</td>
<td><strong><?php echo $totalSecundaria; ?></strong></td>
</tr>

<tr>
<td>Superior (universitaria)</td>
<td><strong><?php echo $totalSuperior; ?></strong></td>
</tr>

<tr>
<td>Pos-Grado</td>
<td><strong><?php echo $totalPosgrado; ?></strong></td>
</tr>

<tr>
<td>NS / NR / NA</td>
<td><strong><?php echo $totalNS; ?></strong></td>
</tr>

<tr class="table-light">

<td>

Fórmula

</td>

<td>

<strong>

<?php echo $totalConSecundariaOMas; ?>

/

<?php echo $totalValidos; ?>

</strong>

</td>

</tr>

</table>

</td>

</tr>

<tr>

<th>

Resultado

</th>

<td>

<h4 class="text-success">

<?php

if($indicador1===null)
{

    echo "<span class='text-secondary'>N/D</span>";

}
else
{

    echo "<span class='text-success'><strong>"
        .number_format($indicador1*100,2).
        "%</strong></span>";

}

?>

</h4>

</td>

</tr>

</table>

        </div>

        <?php

/*----------------------------------------------------------
INDICADOR 2
Experiencia de discriminación en el sistema educativo
----------------------------------------------------------*/

$totalValidosP88 = 0;

$sinDiscriminacion = 0;
		
		$conDiscriminacion = 0;

$totalNS = 0;

foreach($respuestas as $encuesta)
{

    if(!isset($encuesta[88]))
        continue;

    $respuesta = trim($encuesta[88]);

if(in_array($respuesta,["NS","NR","NA"]))
{
    $totalNS++;
    continue;
}

    $totalValidosP88++;

if($respuesta=="No")
{

    $sinDiscriminacion++;

}
else
{

    $conDiscriminacion++;

}

}

/* Resultado del indicador */

$indicador2 = null;

if($totalValidosP88>0)
{

    $indicador2 =
    $sinDiscriminacion /
    $totalValidosP88;

}

?>

        <div class="alert alert-light border">

            <h6>Indicador 2. Experiencia de discriminación en el sistema educativo</h6>

            <table class="table table-bordered table-sm">

<tr>

<th width="22%">

Pregunta

</th>

<td>

<strong>P88.</strong>

¿Ha experimentado acoso, discriminación o violencia en un centro educativo por su orientación sexual, identidad o expresión de género?

</td>

</tr>

<tr>

<th>

Criterio

</th>

<td>

Se consideran respuestas positivas:

<ul class="mb-1">

<li>No</li>

</ul>

Se excluyen NS, NR y NA.

</td>

</tr>

<tr>

<th>

Construcción

</th>

<td>

<table class="table table-sm table-borderless mb-0">

<tr>
<td width="55%">Total de encuestas</td>
<td><strong><?php echo count($respuestas); ?></strong></td>
</tr>

<tr>
<td>Respuestas válidas</td>
<td><strong><?php echo $totalValidosP88; ?></strong></td>
</tr>

<tr>
<td>Sin discriminación (No)</td>
<td><strong><?php echo $sinDiscriminacion; ?></strong></td>
</tr>

<tr>
<td>Con discriminación (Sí)</td>
<td><strong><?php echo $conDiscriminacion; ?></strong></td>
</tr>

<tr>
<td>NS / NR / NA</td>
<td><strong><?php echo $totalNS; ?></strong></td>
</tr>

<tr class="table-light">

<td>

Fórmula

</td>

<td>

<strong>

<?php echo $sinDiscriminacion; ?>

/

<?php echo $totalValidosP88; ?>

</strong>

</td>

</tr>

</table>

</td>

</tr>

<tr>

<th>

Resultado

</th>

<td>

<h4 class="text-success">

<?php

if($indicador2===null)
{

    echo "<span class='text-secondary'>N/D</span>";

}
else
{

    echo "<span class='text-success'><strong>"
        .number_format($indicador2*100,2).
        "%</strong></span>";

}

?>

</h4>

</td>

</tr>

</table>

        </div>

        <?php

/*----------------------------------------------------------
DIMENSIÓN 1
Educación Inclusiva
----------------------------------------------------------*/

$peso1 = 0.58;
$peso2 = 0.42;

$sumaPesos = 0;
$dimension1 = 0;

if($indicador1 !== null)
{
    $dimension1 += ($indicador1 * $peso1);
    $sumaPesos += $peso1;
}

if($indicador2 !== null)
{
    $dimension1 += ($indicador2 * $peso2);
    $sumaPesos += $peso2;
}

/* Redistribuir pesos si algún indicador no pudo calcularse */

if($sumaPesos > 0)
{
    $dimension1 = $dimension1 / $sumaPesos;
}
else
{
    $dimension1 = null;
}

?>

        <div class="alert alert-success">

            <h5>Resultado de la dimensión</h5>

            <table class="table table-bordered">

<tr>

<th width="30%">

Indicador 1

</th>

<td>

<?php echo number_format($indicador1*100,2); ?>%

× 58%

</td>

</tr>

<tr>

<th>

Indicador 2

</th>

<td>

<?php echo number_format($indicador2*100,2); ?>%

× 42%

</td>

</tr>

<tr class="table-success">

<th>

Resultado de la dimensión

</th>

<td>

<strong>

<?php echo number_format($dimension1*100,2); ?>%

</strong>

</td>

</tr>

</table>

        </div>

    </div>

</div>



<!-- ==========================================================
DIMENSIÓN 2
========================================================== -->

<div class="card border-primary mb-4">

    <div class="card-header bg-primary text-white">

        <h5 class="mb-0">

            DIMENSIÓN 2

            <br>

            <small>Empleo y condiciones laborales</small>

        </h5>

    </div>

    <div class="card-body">

        <p><strong>Peso de la dimensión:</strong> 12.6%</p>

        <?php /* CÁLCULO INDICADOR 3 */ ?>

        <div class="alert alert-light border">
            <h6>Indicador 3. Tasa de empleo</h6>
        </div>

        <?php /* CÁLCULO INDICADOR 4 */ ?>

        <div class="alert alert-light border">
            <h6>Indicador 4. Ausencia de discriminación laboral</h6>
        </div>

        <?php /* CÁLCULO RESULTADO DIMENSIÓN 2 */ ?>

        <div class="alert alert-success">
            <h5>Resultado de la dimensión</h5>
        </div>

    </div>

</div>



<!-- ==========================================================
DIMENSIÓN 3
========================================================== -->

<div class="card border-primary mb-4">

<div class="card-header bg-primary text-white">

<h5 class="mb-0">DIMENSIÓN 3<br><small>Salud integral</small></h5>

</div>

<div class="card-body">

<p><strong>Peso:</strong> 11.0%</p>

<?php /* CÁLCULO INDICADOR 5 */ ?>

<div class="alert alert-light border">

<h6>Indicador 5. Acceso a servicios de salud</h6>

</div>

<?php /* CÁLCULO INDICADOR 6 */ ?>

<div class="alert alert-light border">

<h6>Indicador 6. Atención respetuosa de la identidad</h6>

</div>

<?php /* RESULTADO DIMENSIÓN */ ?>

<div class="alert alert-success">

<h5>Resultado de la dimensión</h5>

</div>

</div>

</div>



<!-- ==========================================================
DIMENSIÓN 4
========================================================== -->

<div class="card border-primary mb-4">

<div class="card-header bg-primary text-white">

<h5 class="mb-0">DIMENSIÓN 4<br><small>Salud mental y bienestar</small></h5>

</div>

<div class="card-body">

<p><strong>Peso:</strong> 11.2%</p>

<?php /* CÁLCULO INDICADOR 7 */ ?>

<div class="alert alert-light border">

<h6>Indicador 7. Acceso a atención psicológica</h6>

</div>

<?php /* CÁLCULO INDICADOR 8 */ ?>

<div class="alert alert-light border">

<h6>Indicador 8. Ausencia de depresión reportada</h6>

</div>

<?php /* RESULTADO DIMENSIÓN */ ?>

<div class="alert alert-success">

<h5>Resultado de la dimensión</h5>

</div>

</div>

</div>



<!-- ==========================================================
DIMENSIÓN 5
========================================================== -->

<div class="card border-primary mb-4">

<div class="card-header bg-primary text-white">

<h5 class="mb-0">DIMENSIÓN 5<br><small>Seguridad y violencia</small></h5>

</div>

<div class="card-body">

<p><strong>Peso:</strong> 20.6%</p>

<?php /* CÁLCULO INDICADOR 9 */ ?>

<div class="alert alert-light border">

<h6>Indicador 9. Ausencia de violencia basada en orientación sexual o identidad de género</h6>

</div>

<?php /* CÁLCULO INDICADOR 10 */ ?>

<div class="alert alert-light border">

<h6>Indicador 10. Ausencia de violencia institucional</h6>

</div>

<?php /* RESULTADO DIMENSIÓN */ ?>

<div class="alert alert-success">

<h5>Resultado de la dimensión</h5>

</div>

</div>

</div>



<!-- ==========================================================
DIMENSIÓN 6
========================================================== -->

<div class="card border-primary mb-4">

<div class="card-header bg-primary text-white">

<h5 class="mb-0">DIMENSIÓN 6<br><small>Acceso a justicia</small></h5>

</div>

<div class="card-body">

<p><strong>Peso:</strong> 16.4%</p>

<?php /* CÁLCULO INDICADOR 11 */ ?>

<div class="alert alert-light border">

<h6>Indicador 11. Confianza en el sistema de justicia</h6>

</div>

<?php /* RESULTADO DIMENSIÓN */ ?>

<div class="alert alert-success">

<h5>Resultado de la dimensión</h5>

</div>

</div>

</div>



<!-- ==========================================================
DIMENSIÓN 7
========================================================== -->

<div class="card border-primary mb-4">

<div class="card-header bg-primary text-white">

<h5 class="mb-0">DIMENSIÓN 7<br><small>Participación y organización social</small></h5>

</div>

<div class="card-body">

<p><strong>Peso:</strong> 6.4%</p>

<?php /* CÁLCULO INDICADOR 12 */ ?>

<div class="alert alert-light border">

<h6>Indicador 12. Participación organizativa</h6>

</div>

<?php /* RESULTADO DIMENSIÓN */ ?>

<div class="alert alert-success">

<h5>Resultado de la dimensión</h5>

</div>

</div>

</div>



<!-- ==========================================================
DIMENSIÓN 8
========================================================== -->

<div class="card border-primary mb-4">

<div class="card-header bg-primary text-white">

<h5 class="mb-0">DIMENSIÓN 8<br><small>Migración y desplazamiento forzado</small></h5>

</div>

<div class="card-body">

<p><strong>Peso:</strong> 5.8%</p>

<?php /* CÁLCULO INDICADOR 13 */ ?>

<div class="alert alert-light border">

<h6>Indicador 13. Ausencia de desplazamiento forzado por violencia o discriminación</h6>

</div>

<?php /* RESULTADO DIMENSIÓN */ ?>

<div class="alert alert-success">

<h5>Resultado de la dimensión</h5>

</div>

</div>

</div>



<!-- ==========================================================
DIMENSIÓN 9
========================================================== -->

<div class="card border-primary mb-4">

<div class="card-header bg-primary text-white">

<h5 class="mb-0">DIMENSIÓN 9<br><small>Percepción social y bienestar subjetivo</small></h5>

</div>

<div class="card-body">

<p><strong>Peso:</strong> 6.2%</p>

<?php /* CÁLCULO INDICADOR 14 */ ?>

<div class="alert alert-light border">

<h6>Indicador 14. Percepción positiva de bienestar general</h6>

</div>

<?php /* RESULTADO DIMENSIÓN */ ?>

<div class="alert alert-success">

<h5>Resultado de la dimensión</h5>

</div>

</div>

</div>



<!-- ==========================================================
RESULTADO FINAL
========================================================== -->

<?php
/*
==========================================================
CÁLCULO DEL ÍNDICE FINAL
==========================================================
*/
?>

<div class="card border-success mb-5">

<div class="card-header bg-success text-white">

<h4 class="mb-0">

ÍNDICE DE INCLUSIÓN LGTBI+

</h4>

</div>

<div class="card-body">

<!-- AQUÍ MOSTRAREMOS EL RESUMEN DE LAS 9 DIMENSIONES -->

<!-- AQUÍ MOSTRAREMOS EL ÍNDICE FINAL -->

<!-- AQUÍ MOSTRAREMOS LA CATEGORÍA SEGÚN LA ESCALA -->

</div>

</div>

