<?php

require_once("../../includes/session.php");
require_once("../../controladores/conexion.php");

$db = new Conexion();
$cn = $db->conectar();

$id_usuario = intval($_POST["id_usuario"]);

$nombres = trim($_POST["nombres"]);
$apellidos = trim($_POST["apellidos"]);
$usuario = trim($_POST["usuario"]);
$correo = trim($_POST["correo"]);
$id_rol = intval($_POST["id_rol"]);

$sql = "UPDATE usuarios
        SET
            nombres=?,
            apellidos=?,
            usuario=?,
            correo=?,
            id_rol=?
        WHERE id_usuario=?";

$stmt = $cn->prepare($sql);

$stmt->bind_param(
    "ssssii",
    $nombres,
    $apellidos,
    $usuario,
    $correo,
    $id_rol,
    $id_usuario
);

$stmt->execute();

echo json_encode([
    "success" => true
]);