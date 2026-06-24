<?php

require_once("../../controladores/conexion.php");

$id = intval($_POST["id"]);

$db = new Conexion();
$cn = $db->conectar();

$stmt = $cn->prepare("
UPDATE periodos_encuesta
SET activo=0
WHERE id_periodo=?
");

$stmt->bind_param(
"i",
$id
);

$stmt->execute();