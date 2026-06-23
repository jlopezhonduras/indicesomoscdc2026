<?php

require_once("../../includes/session.php");
require_once("../../controladores/conexion.php");

header("Content-Type: application/json");

try{

$id_usuario = intval($_POST["id_usuario"] ?? 0);

$nombres = trim($_POST["nombres"] ?? '');
$apellidos = trim($_POST["apellidos"] ?? '');
$correo = trim($_POST["correo"] ?? '');
$telefono = trim($_POST["telefono"] ?? '');

$id_rol = intval($_POST["id_rol"] ?? 0);
$id_organizacion = intval($_POST["id_organizacion"] ?? 0);
$activo = intval($_POST["activo"] ?? 0);

if(
$id_usuario <= 0 ||
empty($nombres) ||
empty($apellidos) ||
empty($correo) ||
empty($telefono)
){

echo json_encode([
"success"=>false,
"message"=>"Todos los campos son obligatorios."
]);

exit;
}

$db = new Conexion();
$cn = $db->conectar();

$sql = "
SELECT id_usuario
FROM usuarios
WHERE correo=?
AND id_usuario<>?
";

$stmt = $cn->prepare($sql);

$stmt->bind_param(
"si",
$correo,
$id_usuario
);

$stmt->execute();

$r = $stmt->get_result();

if($r->num_rows > 0){

echo json_encode([
"success"=>false,
"message"=>"Ya existe otro usuario con ese correo."
]);

exit;
}

$sql = "
UPDATE usuarios
SET
usuario=?,
correo=?,
nombres=?,
apellidos=?,
telefono=?,
id_rol=?,
id_organizacion=?,
activo=?
WHERE id_usuario=?
";

$stmt = $cn->prepare($sql);

$usuario = $correo;

$stmt->bind_param(
"sssssiiii",
$usuario,
$correo,
$nombres,
$apellidos,
$telefono,
$id_rol,
$id_organizacion,
$activo,
$id_usuario
);

if($stmt->execute()){

echo json_encode([
"success"=>true,
"message"=>"Usuario actualizado correctamente."
]);

}else{

echo json_encode([
"success"=>false,
"message"=>"No fue posible actualizar."
]);

}

}catch(Exception $e){

echo json_encode([
"success"=>false,
"message"=>$e->getMessage()
]);

}
