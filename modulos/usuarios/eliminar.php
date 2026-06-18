<?php

require_once("../../includes/session.php");
require_once("../../controladores/conexion.php");

$db = new Conexion();
$cn = $db->conectar();

$id = intval($_POST["id"]);

$sql = "DELETE FROM usuarios
        WHERE id_usuario=?";

$stmt = $cn->prepare($sql);

$stmt->bind_param(
"i",
$id
);

$stmt->execute();

echo 1;