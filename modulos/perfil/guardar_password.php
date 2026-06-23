<?php

require_once("../../includes/session.php");
require_once("../../controladores/conexion.php");

header("Content-Type: application/json");

try{

$id_usuario =
$_SESSION["id_usuario"];

$password_actual =
trim($_POST["password_actual"] ?? '');

$password_nueva =
trim($_POST["password_nueva"] ?? '');

$password_confirmar =
trim($_POST["password_confirmar"] ?? '');

if(
empty($password_actual) ||
empty($password_nueva) ||
empty($password_confirmar)
){

echo json_encode([
"success"=>false,
"message"=>"Todos los campos son obligatorios."
]);

exit;
}

if(
$password_nueva !=
$password_confirmar
){

echo json_encode([
"success"=>false,
"message"=>"Las contraseñas no coinciden."
]);

exit;
}

$db = new Conexion();
$cn = $db->conectar();

$sql = "
SELECT password_hash
FROM usuarios
WHERE id_usuario=?
";

$stmt = $cn->prepare($sql);

$stmt->bind_param(
"i",
$id_usuario
);

$stmt->execute();

$r = $stmt->get_result();

$usuario =
$r->fetch_assoc();

if(
!password_verify(
$password_actual,
$usuario["password_hash"]
)
){

echo json_encode([
"success"=>false,
"message"=>"La contraseña actual es incorrecta."
]);

exit;
}

$nuevoHash =
password_hash(
$password_nueva,
PASSWORD_DEFAULT
);

$sql = "
UPDATE usuarios
SET password_hash=?
WHERE id_usuario=?
";

$stmt = $cn->prepare($sql);

$stmt->bind_param(
"si",
$nuevoHash,
$id_usuario
);

if($stmt->execute()){

echo json_encode([
"success"=>true,
"message"=>"Contraseña actualizada correctamente."
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
