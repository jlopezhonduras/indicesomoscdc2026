<?php

require_once("../../controladores/conexion.php");

$db = new Conexion();
$cn = $db->conectar();

$where = " WHERE 1=1 ";

if(!empty($_POST["fecha_inicio"])){

    $fi = $cn->real_escape_string(
        $_POST["fecha_inicio"]
    );

    $where .= "
    AND DATE(e.fecha_encuesta)>='$fi'
    ";
}

if(!empty($_POST["fecha_fin"])){

    $ff = $cn->real_escape_string(
        $_POST["fecha_fin"]
    );

    $where .= "
    AND DATE(e.fecha_encuesta)<='$ff'
    ";
}

if(!empty($_POST["buscar"])){

    $buscar =
    $cn->real_escape_string(
        $_POST["buscar"]
    );

    $where .= "
    AND (
        o.nombre LIKE '%$buscar%'
        OR CONCAT(
            u.nombres,
            ' ',
            u.apellidos
        ) LIKE '%$buscar%'
    )
    ";
}

$sql = "
SELECT

e.id_encuesta,
e.fecha_encuesta,

o.nombre AS organizacion,

CONCAT(
u.nombres,
' ',
u.apellidos
) AS usuario

FROM encabezado_encuesta e

INNER JOIN usuarios u
ON e.id_usuario=u.id_usuario

INNER JOIN organizaciones o
ON e.id_organizacion=o.id_organizacion

$where

ORDER BY e.id_encuesta DESC
";

$r = $cn->query($sql);

?>

<table class="table table-bordered table-hover">

<thead class="table-dark">

<tr>

<th>ID</th>
<th>Fecha</th>
<th>Organización</th>
<th>Usuario</th>
<th width="120">Acciones</th>

</tr>

</thead>

<tbody>

<?php while($fila = $r->fetch_assoc()){ ?>

<tr>

<td>
<?php echo $fila["id_encuesta"]; ?>
</td>

<td>
<?php echo $fila["fecha_encuesta"]; ?>
</td>

<td>
<?php echo $fila["organizacion"]; ?>
</td>

<td>
<?php echo $fila["usuario"]; ?>
</td>

<td>

<button
class="btn btn-primary btn-sm btnVer"
data-id="<?php echo $fila["id_encuesta"]; ?>">

Ver

</button>

</td>

</tr>

<?php } ?>

</tbody>

</table>

<script>

$(document).off("click",".btnVer");

$(document).on("click",".btnVer",function(){

    let id =
    $(this).data("id");

    $.ajax({

        url:"ver.php",

        type:"POST",

        data:{
            id:id
        },

        success:function(html){

            $("#contenidoEncuesta")
            .html(html);

            let modal =
            new bootstrap.Modal(
                document.getElementById("modalVer")
            );

            modal.show();

        }

    });

});

</script>