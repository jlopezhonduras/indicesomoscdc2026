<?php

require_once("../../controladores/conexion.php");

$id =
intval($_POST["id"]);

$db = new Conexion();
$cn = $db->conectar();

$sql = "
SELECT

p.pregunta,
d.valor

FROM detalle_encuesta d

INNER JOIN preguntas p
ON d.id_pregunta=p.id_pregunta

WHERE d.id_encuesta=?

ORDER BY
p.id_seccion,
p.orden
";

$stmt =
$cn->prepare($sql);

$stmt->bind_param(
"i",
$id
);

$stmt->execute();

$r =
$stmt->get_result();

?>

<table class="table table-bordered">

<thead class="table-light">

<tr>

<th width="60%">
Pregunta

</th>

<th>
Respuesta

</th>

</tr>

</thead>

<tbody>

<?php while($fila = $r->fetch_assoc()){ ?>

<tr>

<td>

<?php
echo $fila["pregunta"];
?>

</td>

<td>

<?php

$respuesta =
str_replace(
"|",
"<br>• ",
htmlspecialchars(
$fila["valor"]
)
);

echo $respuesta;

?>

</td>

</tr>

<?php } ?>

</tbody>

</table>