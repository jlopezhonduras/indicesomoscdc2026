<?php

require_once("../../includes/session.php");
require_once("../../controladores/conexion.php");

header('Content-Type: application/json');

try{

    $nombres   = trim($_POST["nombres"] ?? '');
    $apellidos = trim($_POST["apellidos"] ?? '');
    $usuario   = trim($_POST["usuario"] ?? '');
    $correo    = trim($_POST["correo"] ?? '');
    $password  = trim($_POST["password"] ?? '');
    $id_rol    = intval($_POST["id_rol"] ?? 0);

    if(
        empty($nombres) ||
        empty($apellidos) ||
        empty($usuario) ||
        empty($password) ||
        $id_rol == 0
    ){

        echo json_encode([
            "success" => false,
            "message" => "Todos los campos son necesarios."
        ]);

        exit;
    }

    $db = new Conexion();
    $cn = $db->conectar();

    $sql = "SELECT id_usuario
            FROM usuarios
            WHERE usuario=?";

    $stmt = $cn->prepare($sql);
    $stmt->bind_param("s",$usuario);
    $stmt->execute();

    $resultado = $stmt->get_result();

    if($resultado->num_rows > 0){

        echo json_encode([
            "success" => false,
            "message" => "El usuario ya existe."
        ]);

        exit;
    }

    if(!empty($correo)){

        $sql = "SELECT id_usuario
                FROM usuarios
                WHERE correo=?";

        $stmt = $cn->prepare($sql);
        $stmt->bind_param("s",$correo);
        $stmt->execute();

        $resultado = $stmt->get_result();

        if($resultado->num_rows > 0){

            echo json_encode([
                "success" => false,
                "message" => "El correo ya existe."
            ]);

            exit;
        }

    }

    $password_hash = password_hash(
        $password,
        PASSWORD_DEFAULT
    );

    $sql = "INSERT INTO usuarios
    (
        nombres,
        apellidos,
        usuario,
        correo,
        password_hash,
        id_rol,
        activo
    )
    VALUES
    (
        ?,?,?,?,?,?,1
    )";

    $stmt = $cn->prepare($sql);

    $stmt->bind_param(
        "sssssi",
        $nombres,
        $apellidos,
        $usuario,
        $correo,
        $password_hash,
        $id_rol
    );

    if($stmt->execute()){

        echo json_encode([
            "success" => true,
            "message" => "Usuario creado correctamente."
        ]);

    }else{

        echo json_encode([
            "success" => false,
            "message" => "No fue posible guardar el usuario."
        ]);
    }

}catch(Exception $e){

    echo json_encode([
        "success" => false,
        "message" => $e->getMessage()
    ]);
}