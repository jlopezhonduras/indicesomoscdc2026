<?php

require_once("../../includes/session.php");
require_once("../../controladores/conexion.php");

header("Content-Type: application/json");

try{

$id = intval($_POST["id"] ?? 0);

if($id <= 0){

echo json_encode([
"success"=>false,
"message"=>"Usuario inválido."
]);

exit;
}

$db = new Conexion();
$cn = $db->conectar();

$sql = "
UPDATE usuarios
SET activo = 0
WHERE id_usuario = ?
";

$stmt = $cn->prepare($sql);

$stmt->bind_param(
"i",
$id
);

if($stmt->execute()){

echo json_encode([
"success"=>true,
"message"=>"Usuario desactivado correctamente."
]);

}else{

echo json_encode([
"success"=>false,
"message"=>"No fue posible desactivar."
]);

}

}catch(Exception $e){

echo json_encode([
"success"=>false,
"message"=>$e->getMessage()
]);

}