<?php

require_once("../../includes/session.php");
require_once("../../controladores/conexion.php");

header("Content-Type: application/json");

try{

    $id = intval($_POST["id"] ?? 0);

    if($id <= 0){

        echo json_encode([
            "success" => false,
            "message" => "Organización inválida."
        ]);

        exit;
    }

    $db = new Conexion();
    $cn = $db->conectar();

    $sql = "
    DELETE FROM organizaciones
    WHERE id_organizacion = ?
    ";

    $stmt = $cn->prepare($sql);

    $stmt->bind_param(
        "i",
        $id
    );

    if($stmt->execute()){

        echo json_encode([
            "success" => true,
            "message" => "Organización eliminada correctamente."
        ]);

    }else{

        echo json_encode([
            "success" => false,
            "message" => "No fue posible eliminar."
        ]);

    }

}catch(Exception $e){

    echo json_encode([
        "success" => false,
        "message" => $e->getMessage()
    ]);

}