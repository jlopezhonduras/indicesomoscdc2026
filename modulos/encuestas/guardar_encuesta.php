<?php

session_start();

require_once("../../controladores/conexion.php");

header("Content-Type: application/json");

try{

    if(!isset($_SESSION["id_usuario"])){

        throw new Exception(
            "Sesión no válida."
        );

    }

    $db = new Conexion();
    $cn = $db->conectar();

    $id_usuario =
    intval($_SESSION["id_usuario"]);

    /*
        Obtener usuario
    */

    $stmt = $cn->prepare("
    SELECT id_organizacion
    FROM usuarios
    WHERE id_usuario=?
    ");

    $stmt->bind_param(
        "i",
        $id_usuario
    );

    $stmt->execute();

    $r = $stmt->get_result();

    if($r->num_rows==0){

        throw new Exception(
            "Usuario no encontrado."
        );

    }

    $usuario =
    $r->fetch_assoc();

    $id_organizacion =
    $usuario["id_organizacion"];

    /*
        Obtener período activo
    */

    $r = $cn->query("
    SELECT *
    FROM periodos_encuesta
    WHERE activo=1
    AND CURDATE()
    BETWEEN fecha_inicio
    AND fecha_fin
    LIMIT 1
    ");

    if($r->num_rows==0){

        throw new Exception(
            "No existe un período activo."
        );

    }

    $periodo =
    $r->fetch_assoc();

    $id_periodo =
    $periodo["id_periodo"];

    $anio =
    $periodo["anio"];

    /*
        Transacción
    */

    $cn->begin_transaction();

    /*
        Encabezado
    */

    $stmt = $cn->prepare("
    INSERT INTO encabezado_encuesta
    (
        id_periodo,
        id_usuario,
        id_organizacion,
        fecha_encuesta,
        anio,
        estado
    )
    VALUES
    (
        ?,
        ?,
        ?,
        NOW(),
        ?,
        'COMPLETA'
    )
    ");

    $stmt->bind_param(
        "iiii",
        $id_periodo,
        $id_usuario,
        $id_organizacion,
        $anio
    );

    $stmt->execute();

    $id_encuesta =
    $cn->insert_id;

    /*
        Detalle
    */

    $stmtDetalle =
    $cn->prepare("
    INSERT INTO detalle_encuesta
    (
        id_encuesta,
        id_pregunta,
        valor,
        fecha_registro
    )
    VALUES
    (
        ?,
        ?,
        ?,
        NOW()
    )
    ");

    foreach($_POST as $campo=>$valor){

        if(
            strpos(
                $campo,
                'pregunta_'
            ) !== 0
        ){
            continue;
        }

        $id_pregunta =
        intval(
            str_replace(
                'pregunta_',
                '',
                $campo
            )
        );

        if(is_array($valor)){

            $valor =
            implode(
                '|',
                $valor
            );

        }

        $stmtDetalle->bind_param(
            "iis",
            $id_encuesta,
            $id_pregunta,
            $valor
        );

        $stmtDetalle->execute();

    }

    $cn->commit();

    echo json_encode([
        "success"=>true,
        "message"=>"Encuesta guardada correctamente."
    ]);

}catch(Exception $e){

    if(isset($cn)){
        $cn->rollback();
    }

    echo json_encode([
        "success"=>false,
        "message"=>$e->getMessage()
    ]);

}