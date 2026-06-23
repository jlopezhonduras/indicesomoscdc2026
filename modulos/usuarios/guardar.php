<?php

require_once("../../includes/session.php");
require_once("../../controladores/conexion.php");

header("Content-Type: application/json");

try{

$nombres = trim($_POST["nombres"] ?? '');
$apellidos = trim($_POST["apellidos"] ?? '');
$correo = trim($_POST["correo"] ?? '');
$password = trim($_POST["password"] ?? '');
$telefono = trim($_POST["telefono"] ?? '');
$id_rol = intval($_POST["id_rol"] ?? 0);
$id_organizacion = intval($_POST["id_organizacion"] ?? 0);
$activo = intval($_POST["activo"] ?? 0);

if(
empty($nombres) ||
empty($apellidos) ||
empty($correo) ||
empty($password) ||
empty($telefono) ||
$id_rol <= 0 ||
$id_organizacion <= 0
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
";

$stmt = $cn->prepare($sql);

$stmt->bind_param(
"s",
$correo
);

$stmt->execute();

$r = $stmt->get_result();

if($r->num_rows > 0){

echo json_encode([
"success"=>false,
"message"=>"Ya existe un usuario con ese correo."
]);

exit;
}

$password_hash =
password_hash(
$password,
PASSWORD_DEFAULT
);

$usuario = $correo;

$sql = "
INSERT INTO usuarios
(
usuario,
correo,
nombres,
apellidos,
password_hash,
id_rol,
id_organizacion,
telefono,
activo
)
VALUES
(?,?,?,?,?,?,?,?,?)
";

$stmt = $cn->prepare($sql);

$stmt->bind_param(
"sssssiisi",
$usuario,
$correo,
$nombres,
$apellidos,
$password_hash,
$id_rol,
$id_organizacion,
$telefono,
$activo
);

if($stmt->execute()){

echo json_encode([
"success"=>true,
"message"=>"Usuario creado correctamente."
]);

}else{

echo json_encode([
"success"=>false,
"message"=>"No fue posible guardar."
]);

}

}catch(Exception $e){

echo json_encode([
"success"=>false,
"message"=>$e->getMessage()
]);

}
