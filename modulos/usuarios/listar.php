<?php

require_once("../../controladores/conexion.php");

$db = new Conexion();
$cn = $db->conectar();

$sql = "
SELECT
u.id_usuario,
u.nombres,
u.apellidos,
u.usuario,
u.correo,
r.nombre AS rol
FROM usuarios u
INNER JOIN roles r
ON u.id_rol=r.id_rol
ORDER BY u.nombres
";

$rs = $cn->query($sql);

?>

<table class="table table-bordered table-hover">

<thead>

<tr>

<th>ID</th>
<th>Nombre</th>
<th>Usuario</th>
<th>Correo</th>
<th>Rol</th>
<th></th>

</tr>

</thead>

<tbody>

<?php while($row = $rs->fetch_assoc()){ ?>

<tr>

<td><?= $row["id_usuario"] ?></td>

<td>
<?= $row["nombres"] ?>&nbsp
<?= $row["apellidos"] ?>
</td>

<td><?= $row["usuario"] ?></td>

<td><?= $row["correo"] ?></td>

<td><?= $row["rol"] ?></td>

<td>

<button
class="btn btn-danger btn-sm"
onclick="eliminarUsuario(<?= $row['id_usuario'] ?>)">

Eliminar

</button>

</td>

</tr>

<?php } ?>

</tbody>

</table>

<script>

function eliminarUsuario(id){

    if(confirm("¿Eliminar usuario?")){

        $.post(
            "eliminar.php",
            {id:id},
            function(){

                cargarUsuarios();

            }
        );

    }

}

</script>