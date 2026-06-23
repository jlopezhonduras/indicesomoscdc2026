<?php

require_once("../../controladores/conexion.php");

$db = new Conexion();
$cn = $db->conectar();

$sql = "
SELECT *
FROM organizaciones
ORDER BY nombre
";

$resultado = $cn->query($sql);

?>

<table class="table table-bordered table-hover table-striped">

<thead class="table-dark">

<tr>

<th>ID</th>
<th>Nombre</th>
<th>Departamento</th>
<th>Municipio</th>
<th>Teléfono</th>
<th>Correo</th>
<th>Estado</th>
<th width="150">Acciones</th>

</tr>

</thead>

<tbody>

<?php

if($resultado->num_rows > 0){

    while($fila = $resultado->fetch_assoc()){

?>

<tr>

<td>
<?php echo $fila["id_organizacion"]; ?>
</td>

<td>
<?php echo htmlspecialchars($fila["nombre"]); ?>
</td>

<td>
<?php echo htmlspecialchars($fila["departamento"]); ?>
</td>

<td>
<?php echo htmlspecialchars($fila["municipio"]); ?>
</td>

<td>
<?php echo htmlspecialchars($fila["telefono"]); ?>
</td>

<td>
<?php echo htmlspecialchars($fila["correo"]); ?>
</td>

<td>

<?php

if($fila["activa"]==1){

    echo '<span class="badge bg-success">Activa</span>';

}else{

    echo '<span class="badge bg-danger">Inactiva</span>';

}

?>

</td>

<td>

<button
class="btn btn-sm btn-warning btnEditar"
data-id="<?php echo $fila["id_organizacion"]; ?>">

Editar

</button>

<button
class="btn btn-sm btn-danger btnEliminar"
data-id="<?php echo $fila["id_organizacion"]; ?>">

Eliminar

</button>

</td>

</tr>

<?php

    }

}else{

?>

<tr>

<td colspan="8" class="text-center">

No existen organizaciones registradas

</td>

</tr>

<?php

}

?>

</tbody>

</table>

<script>
$(".btnEditar").click(function(){

    let id = $(this).data("id");

    $.ajax({

        url:"editar.php",

        type:"POST",

        data:{
            id:id
        },

        success:function(html){

            $("#contenidoEditar")
            .html(html);

            let modal =
            new bootstrap.Modal(
                document.getElementById("modalEditar")
            );

            modal.show();

        }

    });

});
	
	
$(".btnEliminar").click(function(){

    let id = $(this).data("id");

    if(!confirm(
        "¿Desea eliminar esta organización?"
    )){
        return;
    }

    $.ajax({

        url:"eliminar.php",

        type:"POST",

        data:{
            id:id
        },

        dataType:"json",

        success:function(r){

            if(r.success){

                cargarOrganizaciones();

            }else{

                alert(r.message);

            }

        }

    });

});

</script>