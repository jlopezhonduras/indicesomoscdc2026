<?php

require_once("../../controladores/conexion.php");

$id = intval($_POST["id"] ?? 0);

if($id <= 0){
    exit;
}

$db = new Conexion();
$cn = $db->conectar();

/*
    Primero desactiva todos
*/

$cn->query("
UPDATE periodos_encuesta
SET activo = 0
");

/*
    Luego activa el seleccionado
*/

$stmt = $cn->prepare("
UPDATE periodos_encuesta
SET activo = 1
WHERE id_periodo = ?
");

$stmt->bind_param(
    "i",
    $id
);

$stmt->execute();

echo json_encode([
    "success"=>true
]);