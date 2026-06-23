<?php

require_once("../../includes/session.php");
require_once("../../controladores/conexion.php");

header("Content-Type: application/json");

try{

    $nombre       = trim($_POST["nombre"] ?? '');
    $departamento = trim($_POST["departamento"] ?? '');
    $municipio    = trim($_POST["municipio"] ?? '');
    $direccion    = trim($_POST["direccion"] ?? '');
    $telefono     = trim($_POST["telefono"] ?? '');
    $correo       = trim($_POST["correo"] ?? '');

    if(
        empty($nombre) ||
        empty($departamento) ||
        empty($municipio) ||
        empty($direccion) ||
        empty($telefono) ||
        empty($correo)
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
    INSERT INTO organizaciones
    (
        nombre,
        departamento,
        municipio,
        direccion,
        telefono,
        correo,
        activa
    )
    VALUES
    (
        ?,?,?,?,?,?,1
    )";

    $stmt = $cn->prepare($sql);

    $stmt->bind_param(
        "ssssss",
        $nombre,
        $departamento,
        $municipio,
        $direccion,
        $telefono,
        $correo
    );

    if($stmt->execute()){

        echo json_encode([
            "success"=>true,
            "message"=>"Organización creada correctamente."
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