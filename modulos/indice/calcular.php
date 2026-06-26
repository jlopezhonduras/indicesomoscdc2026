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

        <?php

/*----------------------------------------------------------
INDICADOR 3
Acceso al empleo
----------------------------------------------------------*/

$totalValidosP95 = 0;

$conEmpleo = 0;

$sinEmpleo = 0;

$totalNSP95 = 0;

foreach($respuestas as $encuesta)
{

    if(!isset($encuesta[99]))
        continue;

    $respuesta = trim($encuesta[99]);

    if(
        $respuesta=="NS" ||
        $respuesta=="NR" ||
        $respuesta=="NA"
    )
    {
        $totalNSP95++;
        continue;
    }

    $totalValidosP95++;

    if($respuesta=="Sí")
    {
        $conEmpleo++;
    }
    else
    {
        $sinEmpleo++;
    }

}

$indicador3 = null;

if($totalValidosP95>0)
{
    $indicador3 =
    $conEmpleo /
    $totalValidosP95;
}

?>

        <div class="alert alert-light border">
            <h6>Indicador 3. Tasa de empleo</h6>
			
			<table class="table table-bordered table-sm">

<tr>

<th width="22%">
Pregunta
</th>

<td>

<strong>P95.</strong>

¿Actualmente se encuentra trabajando?

</td>

</tr>

<tr>

<th>
Criterio
</th>

<td>

Se consideran respuestas positivas:

<ul class="mb-1">
<li>Sí</li>
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
<td><strong><?php echo $totalValidosP95; ?></strong></td>
</tr>

<tr>
<td>Con empleo</td>
<td><strong><?php echo $conEmpleo; ?></strong></td>
</tr>

<tr>
<td>Sin empleo</td>
<td><strong><?php echo $sinEmpleo; ?></strong></td>
</tr>

<tr>
<td>NS / NR / NA</td>
<td><strong><?php echo $totalNSP95; ?></strong></td>
</tr>

<tr class="table-light">
<td>Fórmula</td>
<td>
<strong>
<?php echo $conEmpleo; ?>
/
<?php echo $totalValidosP95; ?>
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

<?php

if($indicador3===null)
{
    echo "<span class='text-secondary'>N/D</span>";
}
else
{
    echo "<h4 class='text-success'>".
         number_format($indicador3*100,2).
         "%</h4>";
}

?>

</td>

</tr>

</table>
        </div>

       <?php

$totalEmpleados = 0;
$sinDiscriminacionLaboral = 0;
$conDiscriminacionLaboral = 0;
$totalNSLaboral = 0;

foreach($respuestas as $encuesta)
{
    // Solo personas con empleo
    if(!isset($encuesta[99]))
        continue;

    if(trim($encuesta[99]) != "Sí")
        continue;

    // Debe existir respuesta a discriminación laboral
    if(!isset($encuesta[101]))
        continue;

    $respuesta = trim($encuesta[101]);

    if(
        $respuesta=="NS" ||
        $respuesta=="NR" ||
        $respuesta=="NA"
    )
    {
        $totalNSLaboral++;
        continue;
    }

    $totalEmpleados++;

    if($respuesta=="No")
    {
        $sinDiscriminacionLaboral++;
    }
    else
    {
        $conDiscriminacionLaboral++;
    }
}

$indicador4 = null;

if($totalEmpleados>0)
{
    $indicador4 =
    $sinDiscriminacionLaboral /
    $totalEmpleados;
}

?>

        <div class="alert alert-light border">
            <h6>Indicador 4. Ausencia de discriminación laboral</h6>
			
			<table class="table table-bordered table-sm">

    <tr>
        <th width="22%">
            Pregunta
        </th>
        <td>
            <strong>P101.</strong>
            ¿Ha sufrido discriminación en el empleo?
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

            <br>

            El indicador únicamente se calcula para personas que reportaron contar con empleo.

        </td>
    </tr>

    <tr>
        <th>
            Construcción
        </th>

        <td>

            <table class="table table-sm table-borderless mb-0">

                <tr>
                    <td width="65%">
                        Total de encuestas
                    </td>
                    <td>
                        <strong><?php echo count($respuestas); ?></strong>
                    </td>
                </tr>

                <tr>
                    <td>
                        Personas empleadas
                    </td>
                    <td>
                        <strong><?php echo $totalEmpleados; ?></strong>
                    </td>
                </tr>

                <tr>
                    <td>
                        Sin discriminación laboral (No)
                    </td>
                    <td>
                        <strong><?php echo $sinDiscriminacionLaboral; ?></strong>
                    </td>
                </tr>

                <tr>
                    <td>
                        Con discriminación laboral (Sí)
                    </td>
                    <td>
                        <strong><?php echo $conDiscriminacionLaboral; ?></strong>
                    </td>
                </tr>

                <tr>
                    <td>
                        NS / NR / NA
                    </td>
                    <td>
                        <strong><?php echo $totalNSLaboral; ?></strong>
                    </td>
                </tr>

                <tr class="table-light">
                    <td>
                        Fórmula
                    </td>
                    <td>
                        <strong>
                            <?php echo $sinDiscriminacionLaboral; ?>
                            /
                            <?php echo $totalEmpleados; ?>
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

            <?php
            if($indicador4 === null)
            {
                echo "<span class='text-secondary'>N/D (Sin respuestas válidas)</span>";
            }
            else
            {
                echo "<h4 class='text-success'>"
                    . number_format($indicador4 * 100,2)
                    . "%</h4>";
            }
            ?>

        </td>

    </tr>

</table>
        </div>

<?php

$pesoIndicador3 = 0.44;
$pesoIndicador4 = 0.56;

$sumaPesosDimension2 = 0;
$dimension2 = 0;

/* Indicador 3 */

if($indicador3 !== null)
{
    $dimension2 += ($indicador3 * $pesoIndicador3);
    $sumaPesosDimension2 += $pesoIndicador3;
}

/* Indicador 4 */

if($indicador4 !== null)
{
    $dimension2 += ($indicador4 * $pesoIndicador4);
    $sumaPesosDimension2 += $pesoIndicador4;
}

/* Redistribuir pesos si algún indicador es N/D */

if($sumaPesosDimension2 > 0)
{
    $dimension2 = $dimension2 / $sumaPesosDimension2;
}
else
{
    $dimension2 = null;
}

?>

 <div class="alert alert-success">

    <h5>Resultado de la dimensión</h5>

    <table class="table table-bordered mb-0">

        <tr>
            <th width="30%">Indicador 3</th>
            <td>

                <?php
                if($indicador3 === null)
                {
                    echo "N/D";
                }
                else
                {
                    echo number_format($indicador3*100,2)." % × 44%";
                }
                ?>

            </td>
        </tr>

        <tr>
            <th>Indicador 4</th>
            <td>

                <?php
                if($indicador4 === null)
                {
                    echo "N/D";
                }
                else
                {
                    echo number_format($indicador4*100,2)." % × 56%";
                }
                ?>

            </td>
        </tr>

        <tr class="table-success">
            <th>Resultado de la dimensión</th>
            <td>

                <strong>

                <?php

                if($dimension2 === null)
                {
                    echo "N/D";
                }
                else
                {
                    echo number_format($dimension2*100,2)." %";
                }

                ?>

                </strong>

            </td>
        </tr>

    </table>

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

<?php

$totalValidosP108 = 0;
$conAccesoSalud = 0;
$sinAccesoSalud = 0;
$totalNSP108 = 0;

foreach($respuestas as $encuesta)
{
    if(!isset($encuesta[108]))
        continue;

    $respuesta = trim($encuesta[108]);

    if(in_array($respuesta,["NS","NR","NA"]))
    {
        $totalNSP108++;
        continue;
    }

    $totalValidosP108++;

    if($respuesta=="Sí")
    {
        $conAccesoSalud++;
    }
    else
    {
        $sinAccesoSalud++;
    }
}

$indicador5 = null;

if($totalValidosP108>0)
{
    $indicador5 =
    $conAccesoSalud /
    $totalValidosP108;
}

?>

<div class="alert alert-light border">

<div class="alert alert-light border">

<h6>Indicador 5. Acceso a servicios de salud</h6>

<table class="table table-bordered table-sm">

<tr>
    <th width="22%">Pregunta</th>
    <td>
        <strong>P108.</strong>
        ¿Cuenta con una fuente específica de atención médica permanente?
    </td>
</tr>

<tr>
    <th>Criterio</th>
    <td>
        Se consideran respuestas positivas:
        <ul class="mb-1">
            <li>Sí</li>
        </ul>
        Se excluyen NS, NR y NA.
    </td>
</tr>

<tr>
    <th>Construcción</th>
    <td>

        <table class="table table-sm table-borderless mb-0">

            <tr>
                <td width="65%">Total de encuestas</td>
                <td><strong><?= count($respuestas) ?></strong></td>
            </tr>

            <tr>
                <td>Respuestas válidas</td>
                <td><strong><?= $totalValidosP108 ?></strong></td>
            </tr>

            <tr>
                <td>Con acceso a salud</td>
                <td><strong><?= $conAccesoSalud ?></strong></td>
            </tr>

            <tr>
                <td>Sin acceso a salud</td>
                <td><strong><?= $sinAccesoSalud ?></strong></td>
            </tr>

            <tr>
                <td>NS / NR / NA</td>
                <td><strong><?= $totalNSP108 ?></strong></td>
            </tr>

            <tr class="table-light">
                <td>Fórmula</td>
                <td>
                    <strong>
                        <?= $conAccesoSalud ?>
                        /
                        <?= $totalValidosP108 ?>
                    </strong>
                </td>
            </tr>

        </table>

    </td>
</tr>

<tr>
    <th>Resultado</th>
    <td>
        <?php
        if($indicador5===null)
        {
            echo "N/D";
        }
        else
        {
            echo "<h4 class='text-success'>".
                 number_format($indicador5*100,2).
                 "%</h4>";
        }
        ?>
    </td>
</tr>

</table>

</div>

</div>

<?php

/*----------------------------------------------------------
INDICADOR 6
Atención respetuosa de la identidad
----------------------------------------------------------*/

$totalAtendidosSalud = 0;

$atencionInclusiva = 0;

$atencionNoInclusiva = 0;

$totalNSP114 = 0;

foreach($respuestas as $encuesta)
{

    /*
    Solo personas que recibieron atención en salud
    */

    if(!isset($encuesta[113]))
        continue;

    if(trim($encuesta[113]) != "Sí")
        continue;

    /*
    Debe existir respuesta sobre si la atención
    consideró su orientación sexual e identidad
    */

    if(!isset($encuesta[114]))
        continue;

    $respuesta = trim($encuesta[114]);

    if(
        $respuesta=="NS" ||
        $respuesta=="NR" ||
        $respuesta=="NA"
    )
    {
        $totalNSP114++;
        continue;
    }

    $totalAtendidosSalud++;

    if($respuesta=="Sí")
    {
        $atencionInclusiva++;
    }
    else
    {
        $atencionNoInclusiva++;
    }

}

$indicador6 = null;

if($totalAtendidosSalud > 0)
{
    $indicador6 =
    $atencionInclusiva /
    $totalAtendidosSalud;
}

?>

<div class="alert alert-light border">

<h6>Indicador 6. Atención respetuosa de la identidad</h6>
	<table class="table table-bordered table-sm">

<tr>
    <th width="22%">
        Pregunta
    </th>

    <td>
        <strong>P114.</strong>

        ¿Esta atención tuvo en cuenta su orientación sexual e identidad de género?
    </td>
</tr>

<tr>
    <th>
        Criterio
    </th>

    <td>

        Se consideran respuestas positivas:

        <ul class="mb-1">
            <li>Sí</li>
        </ul>

        Se excluyen NS, NR y NA.

        <br>

        El indicador únicamente se calcula para personas que recibieron atención en salud.

    </td>
</tr>

<tr>

    <th>
        Construcción
    </th>

    <td>

        <table class="table table-sm table-borderless mb-0">

            <tr>
                <td width="65%">
                    Total de encuestas
                </td>

                <td>
                    <strong><?php echo count($respuestas); ?></strong>
                </td>
            </tr>

            <tr>
                <td>
                    Personas que recibieron atención en salud
                </td>

                <td>
                    <strong><?php echo $totalAtendidosSalud; ?></strong>
                </td>
            </tr>

            <tr>
                <td>
                    Atención respetuosa de la identidad
                </td>

                <td>
                    <strong><?php echo $atencionInclusiva; ?></strong>
                </td>
            </tr>

            <tr>
                <td>
                    Atención que no consideró identidad/orientación
                </td>

                <td>
                    <strong><?php echo $atencionNoInclusiva; ?></strong>
                </td>
            </tr>

            <tr>
                <td>
                    NS / NR / NA
                </td>

                <td>
                    <strong><?php echo $totalNSP114; ?></strong>
                </td>
            </tr>

            <tr class="table-light">

                <td>
                    Fórmula
                </td>

                <td>

                    <strong>

                        <?php echo $atencionInclusiva; ?>

                        /

                        <?php echo $totalAtendidosSalud; ?>

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

        <?php

        if($indicador6 === null)
        {
            echo "<span class='text-secondary'>N/D (Sin respuestas válidas)</span>";
        }
        else
        {
            echo "<h4 class='text-success'>"
                . number_format($indicador6 * 100,2)
                . "%</h4>";
        }

        ?>

    </td>

</tr>

</table>

</div>

<?php

$pesoIndicador5 = 0.53;
$pesoIndicador6 = 0.47;

$sumaPesosDimension3 = 0;
$dimension3 = 0;

/* Indicador 5 */

if($indicador5 !== null)
{
    $dimension3 += ($indicador5 * $pesoIndicador5);
    $sumaPesosDimension3 += $pesoIndicador5;
}

/* Indicador 6 */

if($indicador6 !== null)
{
    $dimension3 += ($indicador6 * $pesoIndicador6);
    $sumaPesosDimension3 += $pesoIndicador6;
}

/* Redistribución automática de pesos */

if($sumaPesosDimension3 > 0)
{
    $dimension3 = $dimension3 / $sumaPesosDimension3;
}
else
{
    $dimension3 = null;
}

?>

<div class="alert alert-success">

<div class="alert alert-success">

    <h5>Resultado de la dimensión</h5>

    <table class="table table-bordered mb-0">

        <tr>
            <th width="30%">
                Indicador 5
            </th>

            <td>

                <?php

                if($indicador5 === null)
                {
                    echo "N/D";
                }
                else
                {
                    echo number_format($indicador5*100,2)." % × 53%";
                }

                ?>

            </td>
        </tr>

        <tr>

            <th>
                Indicador 6
            </th>

            <td>

                <?php

                if($indicador6 === null)
                {
                    echo "N/D";
                }
                else
                {
                    echo number_format($indicador6*100,2)." % × 47%";
                }

                ?>

            </td>

        </tr>

        <tr class="table-success">

            <th>
                Resultado de la dimensión
            </th>

            <td>

                <strong>

                <?php

                if($dimension3 === null)
                {
                    echo "N/D";
                }
                else
                {
                    echo number_format($dimension3*100,2)." %";
                }

                ?>

                </strong>

            </td>

        </tr>

    </table>

</div>
	
	

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

<?php

$totalValidosP116 = 0;
$conAtencionPsicologica = 0;
$sinAtencionPsicologica = 0;
$totalNSP116 = 0;

foreach($respuestas as $encuesta)
{
    if(!isset($encuesta[116]))
        continue;

    $respuesta = trim($encuesta[116]);

    if(in_array($respuesta,["NS","NR","NA"]))
    {
        $totalNSP116++;
        continue;
    }

    $totalValidosP116++;

    if($respuesta=="Sí")
    {
        $conAtencionPsicologica++;
    }
    else
    {
        $sinAtencionPsicologica++;
    }
}

$indicador7 = null;

if($totalValidosP116 > 0)
{
    $indicador7 =
    $conAtencionPsicologica /
    $totalValidosP116;
}

?>

<div class="alert alert-light border">

<h6>Indicador 7. Acceso a atención psicológica</h6>
	<table class="table table-bordered table-sm">

<tr>
    <th width="22%">Pregunta</th>
    <td>
        <strong>P116.</strong>
        ¿Ha asistido a recibir atención psicológica en los últimos 12 meses?
    </td>
</tr>

<tr>
    <th>Criterio</th>
    <td>

        Se consideran respuestas positivas:

        <ul class="mb-1">
            <li>Sí</li>
        </ul>

        Se excluyen NS, NR y NA.

    </td>
</tr>

<tr>
    <th>Construcción</th>

    <td>

        <table class="table table-sm table-borderless mb-0">

            <tr>
                <td width="65%">Total de encuestas</td>
                <td><strong><?php echo count($respuestas); ?></strong></td>
            </tr>

            <tr>
                <td>Respuestas válidas</td>
                <td><strong><?php echo $totalValidosP116; ?></strong></td>
            </tr>

            <tr>
                <td>Recibieron atención psicológica</td>
                <td><strong><?php echo $conAtencionPsicologica; ?></strong></td>
            </tr>

            <tr>
                <td>No recibieron atención psicológica</td>
                <td><strong><?php echo $sinAtencionPsicologica; ?></strong></td>
            </tr>

            <tr>
                <td>NS / NR / NA</td>
                <td><strong><?php echo $totalNSP116; ?></strong></td>
            </tr>

            <tr class="table-light">
                <td>Fórmula</td>
                <td>
                    <strong>
                        <?php echo $conAtencionPsicologica; ?>
                        /
                        <?php echo $totalValidosP116; ?>
                    </strong>
                </td>
            </tr>

        </table>

    </td>

</tr>

<tr>

    <th>Resultado</th>

    <td>

        <?php

        if($indicador7 === null)
        {
            echo "N/D";
        }
        else
        {
            echo "<h4 class='text-success'>".
                 number_format($indicador7*100,2).
                 "%</h4>";
        }

        ?>

    </td>

</tr>

</table>

</div>

<?php

$totalValidosP119 = 0;

$conDepresion = 0;

$sinDepresion = 0;

$totalNSP119 = 0;

foreach($respuestas as $encuesta)
{
    if(!isset($encuesta[119]))
        continue;

    $respuesta = trim($encuesta[119]);

    if(
        $respuesta=="NS" ||
        $respuesta=="NR" ||
        $respuesta=="NA"
    )
    {
        $totalNSP119++;
        continue;
    }

    $totalValidosP119++;

    if($respuesta=="Sí")
    {
        $conDepresion++;
    }
    else
    {
        $sinDepresion++;
    }
}

$indicador8 = null;

if($totalValidosP119 > 0)
{
    $indicador8 =
    $sinDepresion /
    $totalValidosP119;
}

?>

<div class="alert alert-light border">

<h6>Indicador 8. Ausencia de depresión reportada</h6>
	
<table class="table table-bordered table-sm">

<tr>
    <th width="22%">Pregunta</th>
    <td>
        <strong>P119.</strong>
        ¿Ha padecido algún cuadro de depresión en los últimos 12 meses?
    </td>
</tr>

<tr>
    <th>Criterio</th>
    <td>

        Se consideran respuestas positivas:

        <ul class="mb-1">
            <li>No</li>
        </ul>

        Se excluyen NS, NR y NA.

    </td>
</tr>

<tr>
    <th>Construcción</th>

    <td>

        <table class="table table-sm table-borderless mb-0">

            <tr>
                <td width="65%">Total de encuestas</td>
                <td><strong><?php echo count($respuestas); ?></strong></td>
            </tr>

            <tr>
                <td>Respuestas válidas</td>
                <td><strong><?php echo $totalValidosP119; ?></strong></td>
            </tr>

            <tr>
                <td>Sin depresión reportada</td>
                <td><strong><?php echo $sinDepresion; ?></strong></td>
            </tr>

            <tr>
                <td>Con depresión reportada</td>
                <td><strong><?php echo $conDepresion; ?></strong></td>
            </tr>

            <tr>
                <td>NS / NR / NA</td>
                <td><strong><?php echo $totalNSP119; ?></strong></td>
            </tr>

            <tr class="table-light">
                <td>Fórmula</td>
                <td>
                    <strong>
                        <?php echo $sinDepresion; ?>
                        /
                        <?php echo $totalValidosP119; ?>
                    </strong>
                </td>
            </tr>

        </table>

    </td>

</tr>

<tr>

    <th>Resultado</th>

    <td>

        <?php

        if($indicador8 === null)
        {
            echo "N/D";
        }
        else
        {
            echo "<h4 class='text-success'>".
                 number_format($indicador8*100,2).
                 "%</h4>";
        }

        ?>

    </td>

</tr>

</table>

</div>

<?php

$pesoIndicador7 = 0.48;
$pesoIndicador8 = 0.52;

$sumaPesosDimension4 = 0;
$dimension4 = 0;

/* Indicador 7 */

if($indicador7 !== null)
{
    $dimension4 += ($indicador7 * $pesoIndicador7);
    $sumaPesosDimension4 += $pesoIndicador7;
}

/* Indicador 8 */

if($indicador8 !== null)
{
    $dimension4 += ($indicador8 * $pesoIndicador8);
    $sumaPesosDimension4 += $pesoIndicador8;
}

/* Redistribución automática de pesos */

if($sumaPesosDimension4 > 0)
{
    $dimension4 = $dimension4 / $sumaPesosDimension4;
}
else
{
    $dimension4 = null;
}

?>

<div class="alert alert-success">

    <h5>Resultado de la dimensión</h5>

    <table class="table table-bordered mb-0">

        <tr>
            <th width="30%">
                Indicador 7
            </th>

            <td>

                <?php

                if($indicador7 === null)
                {
                    echo "N/D";
                }
                else
                {
                    echo number_format($indicador7*100,2)." % × 48%";
                }

                ?>

            </td>
        </tr>

        <tr>

            <th>
                Indicador 8
            </th>

            <td>

                <?php

                if($indicador8 === null)
                {
                    echo "N/D";
                }
                else
                {
                    echo number_format($indicador8*100,2)." % × 52%";
                }

                ?>

            </td>

        </tr>

        <tr class="table-success">

            <th>
                Resultado de la dimensión
            </th>

            <td>

                <strong>

                <?php

                if($dimension4 === null)
                {
                    echo "N/D";
                }
                else
                {
                    echo number_format($dimension4*100,2)." %";
                }

                ?>

                </strong>

            </td>

        </tr>

    </table>

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

<?php

$totalValidosP121 = 0;

$sinViolencia = 0;

$conViolencia = 0;

$totalNSP121 = 0;

foreach($respuestas as $encuesta)
{
    if(!isset($encuesta[121]))
        continue;

    $respuesta = trim($encuesta[121]);

    if(
        $respuesta=="NS" ||
        $respuesta=="NR" ||
        $respuesta=="NA"
    )
    {
        $totalNSP121++;
        continue;
    }

    $totalValidosP121++;

    if($respuesta=="No")
    {
        $sinViolencia++;
    }
    else
    {
        $conViolencia++;
    }
}

$indicador9 = null;

if($totalValidosP121 > 0)
{
    $indicador9 =
    $sinViolencia /
    $totalValidosP121;
}

?>

<div class="alert alert-light border">

<h6>Indicador 9. Ausencia de violencia basada en orientación sexual o identidad de género</h6>
	<table class="table table-bordered table-sm">

<tr>
    <th width="22%">Pregunta</th>
    <td>
        <strong>P121.</strong>
        ¿Ha sido víctima de violencia basada en su orientación sexual, identidad o expresión de género en los últimos 12 meses?
    </td>
</tr>

<tr>
    <th>Criterio</th>
    <td>

        Se consideran respuestas positivas:

        <ul class="mb-1">
            <li>No</li>
        </ul>

        Se excluyen NS, NR y NA.

    </td>
</tr>

<tr>
    <th>Construcción</th>

    <td>

        <table class="table table-sm table-borderless mb-0">

            <tr>
                <td width="65%">Total de encuestas</td>
                <td><strong><?php echo count($respuestas); ?></strong></td>
            </tr>

            <tr>
                <td>Respuestas válidas</td>
                <td><strong><?php echo $totalValidosP121; ?></strong></td>
            </tr>

            <tr>
                <td>Sin violencia reportada</td>
                <td><strong><?php echo $sinViolencia; ?></strong></td>
            </tr>

            <tr>
                <td>Con violencia reportada</td>
                <td><strong><?php echo $conViolencia; ?></strong></td>
            </tr>

            <tr>
                <td>NS / NR / NA</td>
                <td><strong><?php echo $totalNSP121; ?></strong></td>
            </tr>

            <tr class="table-light">
                <td>Fórmula</td>
                <td>
                    <strong>
                        <?php echo $sinViolencia; ?>
                        /
                        <?php echo $totalValidosP121; ?>
                    </strong>
                </td>
            </tr>

        </table>

    </td>

</tr>

<tr>

    <th>Resultado</th>

    <td>

        <?php

        if($indicador9 === null)
        {
            echo "N/D";
        }
        else
        {
            echo "<h4 class='text-success'>".
                 number_format($indicador9*100,2).
                 "%</h4>";
        }

        ?>

    </td>

</tr>

</table>

</div>

<?php

$totalDetenidos = 0;

$sinViolenciaDetencion = 0;

$conViolenciaDetencion = 0;

$totalNSP126 = 0;

foreach($respuestas as $encuesta)
{
    /* Solo personas detenidas */

    if(!isset($encuesta[124]))
        continue;

    if(trim($encuesta[124]) != "Sí")
        continue;

    /* Debe existir respuesta sobre violencia */

    if(!isset($encuesta[126]))
        continue;

    $respuesta = trim($encuesta[126]);

    if(
        $respuesta=="NS" ||
        $respuesta=="NR" ||
        $respuesta=="NA"
    )
    {
        $totalNSP126++;
        continue;
    }

    $totalDetenidos++;

    if($respuesta=="No")
    {
        $sinViolenciaDetencion++;
    }
    else
    {
        $conViolenciaDetencion++;
    }
}

$indicador10 = null;

if($totalDetenidos > 0)
{
    $indicador10 =
    $sinViolenciaDetencion /
    $totalDetenidos;
}

?>

<div class="alert alert-light border">

<h6>Indicador 10. Ausencia de violencia institucional</h6>
<table class="table table-bordered table-sm">

<tr>
    <th width="22%">Pregunta</th>
    <td>
        <strong>P126.</strong>
        Durante su detención ¿Fue víctima de discriminación o violencia?
    </td>
</tr>

<tr>
    <th>Criterio</th>
    <td>

        Se consideran respuestas positivas:

        <ul class="mb-1">
            <li>No</li>
        </ul>

        Se excluyen NS, NR y NA.

        <br>

        El indicador únicamente se calcula para personas que reportaron haber sido detenidas.

    </td>
</tr>

<tr>
    <th>Construcción</th>

    <td>

        <table class="table table-sm table-borderless mb-0">

            <tr>
                <td width="65%">Total de encuestas</td>
                <td><strong><?php echo count($respuestas); ?></strong></td>
            </tr>

            <tr>
                <td>Personas detenidas</td>
                <td><strong><?php echo $totalDetenidos; ?></strong></td>
            </tr>

            <tr>
                <td>Sin violencia durante la detención</td>
                <td><strong><?php echo $sinViolenciaDetencion; ?></strong></td>
            </tr>

            <tr>
                <td>Con violencia durante la detención</td>
                <td><strong><?php echo $conViolenciaDetencion; ?></strong></td>
            </tr>

            <tr>
                <td>NS / NR / NA</td>
                <td><strong><?php echo $totalNSP126; ?></strong></td>
            </tr>

            <tr class="table-light">
                <td>Fórmula</td>
                <td>
                    <strong>
                        <?php echo $sinViolenciaDetencion; ?>
                        /
                        <?php echo $totalDetenidos; ?>
                    </strong>
                </td>
            </tr>

        </table>

    </td>

</tr>

<tr>

    <th>Resultado</th>

    <td>

        <?php

        if($indicador10 === null)
        {
            echo "<span class='text-secondary'>N/D (Sin personas detenidas)</span>";
        }
        else
        {
            echo "<h4 class='text-success'>"
                . number_format($indicador10 * 100,2)
                . "%</h4>";
        }

        ?>

    </td>

</tr>

</table>

</div>

<?php

$pesoIndicador9 = 0.55;
$pesoIndicador10 = 0.45;

$sumaPesosDimension5 = 0;
$dimension5 = 0;

/* Indicador 9 */

if($indicador9 !== null)
{
    $dimension5 += ($indicador9 * $pesoIndicador9);
    $sumaPesosDimension5 += $pesoIndicador9;
}

/* Indicador 10 */

if($indicador10 !== null)
{
    $dimension5 += ($indicador10 * $pesoIndicador10);
    $sumaPesosDimension5 += $pesoIndicador10;
}

/* Redistribución automática de pesos */

if($sumaPesosDimension5 > 0)
{
    $dimension5 =
    $dimension5 /
    $sumaPesosDimension5;
}
else
{
    $dimension5 = null;
}

?>

<div class="alert alert-success">

    <h5>Resultado de la dimensión</h5>

    <table class="table table-bordered mb-0">

        <tr>
            <th width="35%">
                Indicador 9
            </th>

            <td>

                <?php

                if($indicador9 === null)
                {
                    echo "N/D";
                }
                else
                {
                    echo number_format($indicador9 * 100,2)." % × 55%";
                }

                ?>

            </td>

        </tr>

        <tr>

            <th>
                Indicador 10
            </th>

            <td>

                <?php

                if($indicador10 === null)
                {
                    echo "N/D";
                }
                else
                {
                    echo number_format($indicador10 * 100,2)." % × 45%";
                }

                ?>

            </td>

        </tr>

        <tr class="table-success">

            <th>
                Resultado de la dimensión
            </th>

            <td>

                <strong>

                <?php

                if($dimension5 === null)
                {
                    echo "N/D";
                }
                else
                {
                    echo number_format($dimension5 * 100,2)." %";
                }

                ?>

                </strong>

            </td>

        </tr>

    </table>

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

<?php

$sumaConfianza = 0;
$totalValidosP123 = 0;

$respuesta1 = 0;
$respuesta2 = 0;
$respuesta3 = 0;
$respuesta4 = 0;
$respuesta5 = 0;

$totalNSP123 = 0;

foreach($respuestas as $encuesta)
{
    if(!isset($encuesta[123]))
        continue;

    $respuesta = trim($encuesta[123]);

    if(
        $respuesta=="NS" ||
        $respuesta=="NR" ||
        $respuesta=="NA"
    )
    {
        $totalNSP123++;
        continue;
    }

    $valor = intval($respuesta);

    $sumaConfianza += $valor;
    $totalValidosP123++;

    switch($valor)
    {
        case 1:
            $respuesta1++;
            break;

        case 2:
            $respuesta2++;
            break;

        case 3:
            $respuesta3++;
            break;

        case 4:
            $respuesta4++;
            break;

        case 5:
            $respuesta5++;
            break;
    }
}

$promedioConfianza = null;
$indicador11 = null;

if($totalValidosP123 > 0)
{
    $promedioConfianza =
        $sumaConfianza /
        $totalValidosP123;

    $indicador11 =
        ($promedioConfianza - 1) / 4;
}

?>

<div class="alert alert-light border">

<h6>Indicador 11. Confianza en el sistema de justicia</h6>
	
	<table class="table table-bordered table-sm">

<tr>
    <th width="22%">Pregunta</th>

    <td>
        <strong>P123.</strong>

        ¿Qué tanto confía en que el sistema judicial hondureño
        responda ante la violencia que viven las personas LGTBI+?
    </td>
</tr>

<tr>
    <th>Criterio</th>

    <td>

        Escala de confianza:

        <ul class="mb-1">
            <li>5 = Totalmente</li>
            <li>4 = Mucha</li>
            <li>3 = Regular</li>
            <li>2 = Poco</li>
            <li>1 = Nada</li>
        </ul>

        Se excluyen NS, NR y NA.

        <br>

        Fórmula metodológica:

        <strong>
            (Promedio - 1) / 4
        </strong>

    </td>
</tr>

<tr>

    <th>Construcción</th>

    <td>

        <table class="table table-sm table-borderless mb-0">

            <tr>
                <td width="65%">Total de encuestas</td>
                <td><strong><?= count($respuestas) ?></strong></td>
            </tr>

            <tr>
                <td>Respuestas válidas</td>
                <td><strong><?= $totalValidosP123 ?></strong></td>
            </tr>

            <tr>
                <td>Totalmente (5)</td>
                <td><strong><?= $respuesta5 ?></strong></td>
            </tr>

            <tr>
                <td>Mucha (4)</td>
                <td><strong><?= $respuesta4 ?></strong></td>
            </tr>

            <tr>
                <td>Regular (3)</td>
                <td><strong><?= $respuesta3 ?></strong></td>
            </tr>

            <tr>
                <td>Poco (2)</td>
                <td><strong><?= $respuesta2 ?></strong></td>
            </tr>

            <tr>
                <td>Nada (1)</td>
                <td><strong><?= $respuesta1 ?></strong></td>
            </tr>

            <tr>
                <td>NS / NR / NA</td>
                <td><strong><?= $totalNSP123 ?></strong></td>
            </tr>

            <tr class="table-light">
                <td>Promedio obtenido</td>
                <td>
                    <strong>
                        <?= number_format($promedioConfianza,2) ?>
                    </strong>
                </td>
            </tr>

            <tr class="table-light">
                <td>Normalización</td>
                <td>
                    <strong>
                        (<?= number_format($promedioConfianza,2) ?> - 1) / 4
                    </strong>
                </td>
            </tr>

        </table>

    </td>

</tr>

<tr>

    <th>Resultado</th>

    <td>

        <?php
        if($indicador11 === null)
        {
            echo "N/D";
        }
        else
        {
            echo "<h4 class='text-success'>".
                number_format($indicador11*100,2).
                "%</h4>";
        }
        ?>

    </td>

</tr>

</table>

</div>

<?php

$dimension6 = $indicador11;

?>

<div class="alert alert-success">

<div class="alert alert-success">

    <h5>Resultado de la dimensión</h5>

    <table class="table table-bordered mb-0">

        <tr>

            <th width="35%">
                Indicador 11
            </th>

            <td>

                <?php

                if($indicador11 === null)
                {
                    echo "N/D";
                }
                else
                {
                    echo number_format($indicador11 * 100,2)." %";
                }

                ?>

            </td>

        </tr>

        <tr class="table-success">

            <th>
                Resultado de la dimensión
            </th>

            <td>

                <strong>

                <?php

                if($dimension6 === null)
                {
                    echo "N/D";
                }
                else
                {
                    echo number_format($dimension6 * 100,2)." %";
                }

                ?>

                </strong>

            </td>

        </tr>

    </table>

</div>


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

<?php

$totalValidosP76 = 0;

$conParticipacionOrganizativa = 0;

$sinParticipacionOrganizativa = 0;

$totalNSP76 = 0;

foreach($respuestas as $encuesta)
{
    if(!isset($encuesta[76]))
        continue;

    $respuesta = trim($encuesta[76]);

    if(
        $respuesta=="NS" ||
        $respuesta=="NR" ||
        $respuesta=="NA"
    )
    {
        $totalNSP76++;
        continue;
    }

    $totalValidosP76++;

    if($respuesta=="Sí")
    {
        $conParticipacionOrganizativa++;
    }
    else
    {
        $sinParticipacionOrganizativa++;
    }
}

$indicador12 = null;

if($totalValidosP76 > 0)
{
    $indicador12 =
        $conParticipacionOrganizativa /
        $totalValidosP76;
}

?>

<div class="alert alert-light border">

<h6>Indicador 12. Participación organizativa</h6>
<table class="table table-bordered table-sm">

<tr>
    <th width="22%">Pregunta</th>

    <td>
        <strong>P76.</strong>
        ¿Pertenece a alguna organización o colectivo?
    </td>
</tr>

<tr>
    <th>Criterio</th>

    <td>

        Se consideran respuestas positivas:

        <ul class="mb-1">
            <li>Sí</li>
        </ul>

        Se excluyen NS, NR y NA.

    </td>
</tr>

<tr>

    <th>Construcción</th>

    <td>

        <table class="table table-sm table-borderless mb-0">

            <tr>
                <td width="65%">Total de encuestas</td>
                <td><strong><?= count($respuestas) ?></strong></td>
            </tr>

            <tr>
                <td>Respuestas válidas</td>
                <td><strong><?= $totalValidosP76 ?></strong></td>
            </tr>

            <tr>
                <td>Pertenecen a organizaciones</td>
                <td><strong><?= $conParticipacionOrganizativa ?></strong></td>
            </tr>

            <tr>
                <td>No pertenecen a organizaciones</td>
                <td><strong><?= $sinParticipacionOrganizativa ?></strong></td>
            </tr>

            <tr>
                <td>NS / NR / NA</td>
                <td><strong><?= $totalNSP76 ?></strong></td>
            </tr>

            <tr class="table-light">
                <td>Fórmula</td>
                <td>
                    <strong>
                        <?= $conParticipacionOrganizativa ?>
                        /
                        <?= $totalValidosP76 ?>
                    </strong>
                </td>
            </tr>

        </table>

    </td>

</tr>

<tr>

    <th>Resultado</th>

    <td>

        <?php

        if($indicador12 === null)
        {
            echo "N/D";
        }
        else
        {
            echo "<h4 class='text-success'>".
                 number_format($indicador12*100,2).
                 "%</h4>";
        }

        ?>

    </td>

</tr>

</table>

</div>
<?php

$dimension7 = $indicador12;

?>


<div class="alert alert-success">

    <h5>Resultado de la dimensión</h5>

    <table class="table table-bordered mb-0">

        <tr>

            <th width="35%">
                Indicador 12
            </th>

            <td>

                <?php

                if($indicador12 === null)
                {
                    echo "N/D";
                }
                else
                {
                    echo number_format($indicador12 * 100,2)." %";
                }

                ?>

            </td>

        </tr>

        <tr class="table-success">

            <th>
                Resultado de la dimensión
            </th>

            <td>

                <strong>

                <?php

                if($dimension7 === null)
                {
                    echo "N/D";
                }
                else
                {
                    echo number_format($dimension7 * 100,2)." %";
                }

                ?>

                </strong>

            </td>

        </tr>

    </table>

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

<?php

$totalValidosMigracion = 0;

$sinDesplazamiento = 0;

$conDesplazamientoInterno = 0;

$conMigracionInternacional = 0;

$totalNSMigracion = 0;

foreach($respuestas as $encuesta)
{
    if(
        !isset($encuesta[133]) ||
        !isset($encuesta[134])
    )
    {
        continue;
    }

    $p133 = trim($encuesta[133]);
    $p134 = trim($encuesta[134]);

    /* Excluir respuestas no válidas */

    if(
        in_array($p133,['NS','NR','NA']) ||
        in_array($p134,['NS','NR','NA'])
    )
    {
        $totalNSMigracion++;
        continue;
    }

    $totalValidosMigracion++;

    $desplazado = false;

    if($p133 == 'Sí')
    {
        $conDesplazamientoInterno++;
        $desplazado = true;
    }

    if($p134 == 'Sí')
    {
        $conMigracionInternacional++;
        $desplazado = true;
    }

    if(!$desplazado)
    {
        $sinDesplazamiento++;
    }
}

$indicador13 = null;

if($totalValidosMigracion > 0)
{
    $indicador13 =
        $sinDesplazamiento /
        $totalValidosMigracion;
}

?>

<div class="alert alert-light border">

<h6>Indicador 13. Ausencia de desplazamiento forzado por violencia o discriminación</h6>
<table class="table table-bordered table-sm">

<tr>
    <th width="22%">Preguntas</th>
    <td>
        <strong>P133.</strong>
        ¿Ha tenido que cambiar de lugar de residencia dentro de Honduras debido a discriminación, violencia o amenazas?

        <br><br>

        <strong>P134.</strong>
        ¿Ha migrado fuera de Honduras debido a discriminación, violencia o amenazas?
    </td>
</tr>

<tr>
    <th>Criterio</th>
    <td>

        Se considera desplazamiento forzado cuando ocurre cualquiera de los siguientes casos:

        <ul class="mb-1">
            <li>P133 = Sí</li>
            <li>P134 = Sí</li>
        </ul>

        Se consideran respuestas positivas:

        <ul class="mb-1">
            <li>No desplazamiento interno</li>
            <li>No migración internacional forzada</li>
        </ul>

        Se excluyen NS, NR y NA.

    </td>
</tr>

<tr>
    <th>Construcción</th>

    <td>

        <table class="table table-sm table-borderless mb-0">

            <tr>
                <td width="65%">Total de encuestas</td>
                <td><strong><?= count($respuestas) ?></strong></td>
            </tr>

            <tr>
                <td>Respuestas válidas</td>
                <td><strong><?= $totalValidosMigracion ?></strong></td>
            </tr>

            <tr>
                <td>Sin desplazamiento forzado</td>
                <td><strong><?= $sinDesplazamiento ?></strong></td>
            </tr>

            <tr>
                <td>Desplazamiento interno forzado</td>
                <td><strong><?= $conDesplazamientoInterno ?></strong></td>
            </tr>

            <tr>
                <td>Migración internacional forzada</td>
                <td><strong><?= $conMigracionInternacional ?></strong></td>
            </tr>

            <tr>
                <td>NS / NR / NA</td>
                <td><strong><?= $totalNSMigracion ?></strong></td>
            </tr>

            <tr class="table-light">
                <td>Fórmula</td>
                <td>
                    <strong>
                        <?= $sinDesplazamiento ?>
                        /
                        <?= $totalValidosMigracion ?>
                    </strong>
                </td>
            </tr>

        </table>

    </td>

</tr>

<tr>

    <th>Resultado</th>

    <td>

        <?php

        if($indicador13 === null)
        {
            echo "N/D";
        }
        else
        {
            echo "<h4 class='text-success'>"
                . number_format($indicador13 * 100,2)
                . "%</h4>";
        }

        ?>

    </td>

</tr>

</table>

</div>

<?php

$dimension8 = $indicador13;

?>

<div class="alert alert-success">

    <h5>Resultado de la dimensión</h5>

    <table class="table table-bordered mb-0">

        <tr>

            <th width="35%">
                Indicador 13
            </th>

            <td>

                <?php

                if($indicador13 === null)
                {
                    echo "N/D";
                }
                else
                {
                    echo number_format($indicador13 * 100,2)." %";
                }

                ?>

            </td>

        </tr>

        <tr class="table-success">

            <th>
                Resultado de la dimensión
            </th>

            <td>

                <strong>

                <?php

                if($dimension8 === null)
                {
                    echo "N/D";
                }
                else
                {
                    echo number_format($dimension8 * 100,2)." %";
                }

                ?>

                </strong>

            </td>

        </tr>

    </table>

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

<?php

$sumaBienestar = 0;
$totalValidosP141 = 0;

$respuestaBienestar1 = 0;
$respuestaBienestar2 = 0;
$respuestaBienestar3 = 0;
$respuestaBienestar4 = 0;
$respuestaBienestar5 = 0;

$totalNSP141 = 0;

foreach($respuestas as $encuesta)
{
    if(!isset($encuesta[141]))
        continue;

    $respuesta = trim($encuesta[141]);

    if(
        $respuesta=="NS" ||
        $respuesta=="NR" ||
        $respuesta=="NA"
    )
    {
        $totalNSP141++;
        continue;
    }

    $valor = intval($respuesta);

    $sumaBienestar += $valor;

    $totalValidosP141++;

    switch($valor)
    {
        case 1:
            $respuestaBienestar1++;
            break;

        case 2:
            $respuestaBienestar2++;
            break;

        case 3:
            $respuestaBienestar3++;
            break;

        case 4:
            $respuestaBienestar4++;
            break;

        case 5:
            $respuestaBienestar5++;
            break;
    }
}

$promedioBienestar = null;
$indicador14 = null;

if($totalValidosP141 > 0)
{
    $promedioBienestar =
        $sumaBienestar /
        $totalValidosP141;

    $indicador14 =
        ($promedioBienestar - 1) / 4;
}

?>

<div class="alert alert-light border">

<h6>Indicador 14. Percepción positiva de bienestar general</h6>
	
	<table class="table table-bordered table-sm">

<tr>
    <th width="22%">Pregunta</th>

    <td>
        <strong>P141.</strong>

        En general, ¿cómo evalúa su bienestar personal actualmente?
    </td>
</tr>

<tr>
    <th>Criterio</th>

    <td>

        Escala de bienestar:

        <ul class="mb-1">
            <li>5 = Muy bueno</li>
            <li>4 = Bueno</li>
            <li>3 = Regular</li>
            <li>2 = Malo</li>
            <li>1 = Muy malo</li>
        </ul>

        Se excluyen NS, NR y NA.

        <br>

        Fórmula metodológica:

        <strong>
            (Promedio de bienestar - 1) / 4
        </strong>

    </td>
</tr>

<tr>

    <th>Construcción</th>

    <td>

        <table class="table table-sm table-borderless mb-0">

            <tr>
                <td width="65%">Total de encuestas</td>
                <td><strong><?= count($respuestas) ?></strong></td>
            </tr>

            <tr>
                <td>Respuestas válidas</td>
                <td><strong><?= $totalValidosP141 ?></strong></td>
            </tr>

            <tr>
                <td>Muy bueno (5)</td>
                <td><strong><?= $respuestaBienestar5 ?></strong></td>
            </tr>

            <tr>
                <td>Bueno (4)</td>
                <td><strong><?= $respuestaBienestar4 ?></strong></td>
            </tr>

            <tr>
                <td>Regular (3)</td>
                <td><strong><?= $respuestaBienestar3 ?></strong></td>
            </tr>

            <tr>
                <td>Malo (2)</td>
                <td><strong><?= $respuestaBienestar2 ?></strong></td>
            </tr>

            <tr>
                <td>Muy malo (1)</td>
                <td><strong><?= $respuestaBienestar1 ?></strong></td>
            </tr>

            <tr>
                <td>NS / NR / NA</td>
                <td><strong><?= $totalNSP141 ?></strong></td>
            </tr>

            <tr class="table-light">
                <td>Promedio obtenido</td>
                <td>
                    <strong>
                        <?= number_format($promedioBienestar,2) ?>
                    </strong>
                </td>
            </tr>

            <tr class="table-light">
                <td>Normalización</td>
                <td>
                    <strong>
                        (<?= number_format($promedioBienestar,2) ?> - 1) / 4
                    </strong>
                </td>
            </tr>

        </table>

    </td>

</tr>

<tr>

    <th>Resultado</th>

    <td>

        <?php
        if($indicador14 === null)
        {
            echo "N/D";
        }
        else
        {
            echo "<h4 class='text-success'>".
                number_format($indicador14*100,2).
                "%</h4>";
        }
        ?>

    </td>

</tr>

</table>

</div>

<?php

$dimension9 = $indicador14;

?>

<div class="alert alert-success">

    <h5>Resultado de la dimensión</h5>

    <table class="table table-bordered mb-0">

        <tr>

            <th width="35%">
                Indicador 14
            </th>

            <td>

                <?php

                if($indicador14 === null)
                {
                    echo "N/D";
                }
                else
                {
                    echo number_format($indicador14 * 100,2)." %";
                }

                ?>

            </td>

        </tr>

        <tr class="table-success">

            <th>
                Resultado de la dimensión
            </th>

            <td>

                <strong>

                <?php

                if($dimension9 === null)
                {
                    echo "N/D";
                }
                else
                {
                    echo number_format($dimension9 * 100,2)." %";
                }

                ?>

                </strong>

            </td>

        </tr>

    </table>

</div>
</div>

</div>



<!-- ==========================================================
RESULTADO FINAL
========================================================== -->

<?php
/*
|--------------------------------------------------------------------------
| CÁLCULO FINAL DEL ÍNDICE
|--------------------------------------------------------------------------
*/

$indiceFinal = 0;

$indiceFinal += ($dimension1 * 0.098);
$indiceFinal += ($dimension2 * 0.126);
$indiceFinal += ($dimension3 * 0.110);
$indiceFinal += ($dimension4 * 0.112);
$indiceFinal += ($dimension5 * 0.206);
$indiceFinal += ($dimension6 * 0.164);
$indiceFinal += ($dimension7 * 0.064);
$indiceFinal += ($dimension8 * 0.058);
$indiceFinal += ($dimension9 * 0.062);

$indiceFinalPorcentaje = $indiceFinal * 100;
	
	?>

<div class="card border-success mb-5">

<div class="card-header bg-success text-white">

<hr class="my-4">

<div class="card border-primary shadow">

    <div class="card-header bg-primary text-white">
        <h3 class="mb-0">
            Índice de Inclusión LGTBI+
        </h3>
    </div>

    <div class="card-body">

        <table class="table table-bordered">

            <tr>
                <th width="50%">
                    Educación inclusiva
                </th>
                <td>
                    <?= number_format($dimension1*100,2) ?>% × 9.8%
                </td>
            </tr>

            <tr>
                <th>
                    Empleo y condiciones laborales
                </th>
                <td>
                    <?= number_format($dimension2*100,2) ?>% × 12.6%
                </td>
            </tr>

            <tr>
                <th>
                    Salud integral
                </th>
                <td>
                    <?= number_format($dimension3*100,2) ?>% × 11.0%
                </td>
            </tr>

            <tr>
                <th>
                    Salud mental y bienestar
                </th>
                <td>
                    <?= number_format($dimension4*100,2) ?>% × 11.2%
                </td>
            </tr>

            <tr>
                <th>
                    Seguridad y violencia
                </th>
                <td>
                    <?= number_format($dimension5*100,2) ?>% × 20.6%
                </td>
            </tr>

            <tr>
                <th>
                    Acceso a justicia
                </th>
                <td>
                    <?= number_format($dimension6*100,2) ?>% × 16.4%
                </td>
            </tr>

            <tr>
                <th>
                    Participación y organización social
                </th>
                <td>
                    <?= number_format($dimension7*100,2) ?>% × 6.4%
                </td>
            </tr>

            <tr>
                <th>
                    Migración y desplazamiento forzado
                </th>
                <td>
                    <?= number_format($dimension8*100,2) ?>% × 5.8%
                </td>
            </tr>

            <tr>
                <th>
                    Percepción social y bienestar subjetivo
                </th>
                <td>
                    <?= number_format($dimension9*100,2) ?>% × 6.2%
                </td>
            </tr>

            <tr class="table-primary">

                <th>
                    Índice de Inclusión LGTBI+
                </th>

                <td>
                    <h2 class="mb-0 text-primary">
                        <?= number_format($indiceFinalPorcentaje,2) ?>%
                    </h2>
                </td>

            </tr>

        </table>

    </div>

</div>

</div>

<div class="card-body">

<!-- AQUÍ MOSTRAREMOS EL RESUMEN DE LAS 9 DIMENSIONES -->

<!-- AQUÍ MOSTRAREMOS EL ÍNDICE FINAL -->

<!-- AQUÍ MOSTRAREMOS LA CATEGORÍA SEGÚN LA ESCALA -->

</div>

</div>

