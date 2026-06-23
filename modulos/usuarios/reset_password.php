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

    $passwordTemporal =
        "SOMOS" .
        rand(1000,9999);

    $passwordHash =
        password_hash(
            $passwordTemporal,
            PASSWORD_DEFAULT
        );

    $db = new Conexion();
    $cn = $db->conectar();

    $sql = "
    UPDATE usuarios
    SET password_hash = ?
    WHERE id_usuario = ?
    ";

    $stmt = $cn->prepare($sql);

    $stmt->bind_param(
        "si",
        $passwordHash,
        $id
    );

    if($stmt->execute()){

        echo json_encode([
            "success"=>true,
            "password"=>$passwordTemporal
        ]);

    }else{

        echo json_encode([
            "success"=>false,
            "message"=>"No fue posible actualizar la contraseña."
        ]);

    }

}catch(Exception $e){

    echo json_encode([
        "success"=>false,
        "message"=>$e->getMessage()
    ]);

}