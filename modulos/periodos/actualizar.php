<?php

require_once("../../controladores/conexion.php");

header("Content-Type: application/json");

$id = intval($_POST["id_periodo"] ?? 0);

$nombre = trim($_POST["nombre"] ?? '');
$anio = intval($_POST["anio"] ?? 0);
$fecha_inicio = $_POST["fecha_inicio"] ?? '';
$fecha_fin = $_POST["fecha_fin"] ?? '';
$observaciones = trim($_POST["observaciones"] ?? '');

$db = new Conexion();
$cn = $db->conectar();

$stmt = $cn->prepare("
UPDATE periodos_encuesta
SET
nombre=?,
anio=?,
fecha_inicio=?,
fecha_fin=?,
observaciones=?
WHERE id_periodo=?
");

$stmt->bind_param(
"sisssi",
$nombre,
$anio,
$fecha_inicio,
$fecha_fin,
$observaciones,
$id
);

if($stmt->execute()){

echo json_encode([
"success"=>true,
"message"=>"Período actualizado correctamente."
]);

}else{

echo json_encode([
"success"=>false,
"message"=>"No fue posible actualizar."
]);

}
