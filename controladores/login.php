<?php

session_start();

header('Content-Type: application/json');

require_once("conexion.php");

$usuario = trim($_POST["usuario"] ?? '');
$password = trim($_POST["password"] ?? '');

$db = new Conexion();
$cn = $db->conectar();

$sql = "SELECT *
        FROM usuarios
        WHERE usuario = ?
        AND activo = 1";

$stmt = $cn->prepare($sql);
$stmt->bind_param("s",$usuario);
$stmt->execute();

$resultado = $stmt->get_result();

if($resultado->num_rows > 0){

    $usuarioDB = $resultado->fetch_assoc();

    if(password_verify(
        $password,
        $usuarioDB["password_hash"]
    )){

        $_SESSION["id_usuario"] = $usuarioDB["id_usuario"];
        $_SESSION["usuario"] = $usuarioDB["usuario"];
        $_SESSION["nombre"] = $usuarioDB["nombres"];
        $_SESSION["id_rol"] = $usuarioDB["id_rol"];

        echo json_encode([
            "success" => true
        ]);

        exit;
    }
}

echo json_encode([
    "success" => false,
    "message" => "Usuario o contraseña incorrectos"
]);