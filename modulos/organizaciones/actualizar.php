<?php

require_once("../../includes/session.php");
require_once("../../controladores/conexion.php");

header("Content-Type: application/json");

try{

    $id            = intval($_POST["id_organizacion"]);
    $nombre        = trim($_POST["nombre"]);
    $departamento  = trim($_POST["departamento"]);
    $municipio     = trim($_POST["municipio"]);
    $correo        = trim($_POST["correo"]);
    $telefono      = trim($_POST["telefono"]);
    $direccion     = trim($_POST["direccion"]);

    if(
        empty($nombre) ||
        empty($departamento) ||
        empty($municipio) ||
        empty($correo) ||
        empty($telefono) ||
        empty($direccion)
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
    UPDATE organizaciones
    SET
        nombre=?,
        departamento=?,
        municipio=?,
        correo=?,
        telefono=?,
        direccion=?
    WHERE id_organizacion=?
    ";

    $stmt = $cn->prepare($sql);

    $stmt->bind_param(
        "ssssssi",
        $nombre,
        $departamento,
        $municipio,
        $correo,
        $telefono,
        $direccion,
        $id
    );

    if($stmt->execute()){

        echo json_encode([
            "success"=>true,
            "message"=>"Organización actualizada correctamente."
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