<?php

session_start();

require_once("conexion.php");

header("Content-Type: application/json");

try{

    $correo = trim($_POST["correo"] ?? '');
    $password = trim($_POST["password"] ?? '');

    if(
        empty($correo) ||
        empty($password)
    ){

        echo json_encode([
            "success" => false,
            "message" => "Debe ingresar correo y contraseña."
        ]);

        exit;
    }

    $db = new Conexion();
    $cn = $db->conectar();

    $sql = "
    SELECT
        u.*,
        r.nombre AS rol,
        o.nombre AS organizacion
    FROM usuarios u
    INNER JOIN roles r
        ON u.id_rol = r.id_rol
    LEFT JOIN organizaciones o
        ON u.id_organizacion = o.id_organizacion
    WHERE
        u.correo = ?
        AND u.activo = 1
    LIMIT 1
    ";

    $stmt = $cn->prepare($sql);

    $stmt->bind_param(
        "s",
        $correo
    );

    $stmt->execute();

    $resultado = $stmt->get_result();

    if($resultado->num_rows == 0){

        echo json_encode([
            "success" => false,
            "message" => "Usuario no encontrado o inactivo."
        ]);

        exit;
    }

    $usuario = $resultado->fetch_assoc();

	
    if(
        !password_verify(
            $password,
            $usuario["password_hash"]
        )
    ){

        echo json_encode([
            "success" => false,
            "message" => "Contraseña incorrecta."
        ]);

        exit;
    }

    $_SESSION["id_usuario"] =
        $usuario["id_usuario"];

    $_SESSION["correo"] =
        $usuario["correo"];

    $_SESSION["nombre"] =
        $usuario["nombres"] . " " .
        $usuario["apellidos"];

    $_SESSION["id_rol"] =
        $usuario["id_rol"];

    $_SESSION["rol"] =
        $usuario["rol"];

    $_SESSION["id_organizacion"] =
        $usuario["id_organizacion"];

    $_SESSION["organizacion"] =
        $usuario["organizacion"];

    $sqlUpdate = "
    UPDATE usuarios
    SET ultimo_acceso = NOW()
    WHERE id_usuario = ?
    ";

    $stmtUpdate = $cn->prepare($sqlUpdate);

    $stmtUpdate->bind_param(
        "i",
        $usuario["id_usuario"]
    );

    $stmtUpdate->execute();

    echo json_encode([
        "success" => true,
        "message" => "Acceso correcto."
    ]);

}catch(Exception $e){

    echo json_encode([
        "success" => false,
        "message" => $e->getMessage()
    ]);

}