<?php

require_once("../../controladores/conexion.php");

header("Content-Type: application/json");

$db = new Conexion();
$cn = $db->conectar();

$nombre = trim($_POST["nombre"]);
$anio = intval($_POST["anio"]);
$fecha_inicio = $_POST["fecha_inicio"];
$fecha_fin = $_POST["fecha_fin"];
$observaciones = trim($_POST["observaciones"]);

$sql = "
INSERT INTO periodos_encuesta
(
nombre,
anio,
fecha_inicio,
fecha_fin,
observaciones
)
VALUES
(
?,?,?,?,?
)
";

$stmt = $cn->prepare($sql);

$stmt->bind_param(
"sisss",
$nombre,
$anio,
$fecha_inicio,
$fecha_fin,
$observaciones
);

if($stmt->execute()){

echo json_encode([
"success"=>true,
"message"=>"Periodo creado correctamente."
]);

}else{

echo json_encode([
"success"=>false,
"message"=>"No fue posible guardar."
]);

}