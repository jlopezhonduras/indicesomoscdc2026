<?php

require_once("../../controladores/conexion.php");

$db = new Conexion();
$cn = $db->conectar();

$r = $cn->query("
SELECT *
FROM periodos_encuesta
ORDER BY fecha_inicio DESC
");

?>

<table class="table table-bordered">

<thead class="table-dark">

<tr>

<th>ID</th>
<th>Nombre</th>
<th>Año</th>
<th>Inicio</th>
<th>Fin</th>
<th>Estado</th>
<th>Acciones</th>

</tr>

</thead>

<tbody>

<?php while($fila = $r->fetch_assoc()){ ?>

<tr>

<td><?php echo $fila["id_periodo"]; ?></td>
<td><?php echo $fila["nombre"]; ?></td>
<td><?php echo $fila["anio"]; ?></td>
<td><?php echo $fila["fecha_inicio"]; ?></td>
<td><?php echo $fila["fecha_fin"]; ?></td>

<td>

	<?php if($fila["activo"]==1){ ?>

	<span class="badge bg-success">
	Activo
	</span>

	<?php }else{ ?>

	<span class="badge bg-danger">
	Inactivo
	</span>

	<?php } ?>

</td>

<td>

<button
class="btn btn-warning btn-sm btnEditar"
data-id="<?php echo $fila["id_periodo"]; ?>">

Editar

</button>

	<button
	class="btn btn-success btn-sm btnActivar"
	data-id="<?php echo $fila["id_periodo"]; ?>">

	Activar

	</button>

	<button
	class="btn btn-danger btn-sm btnEliminar"
	data-id="<?php echo $fila["id_periodo"]; ?>">

	Desactivar

	</button>

</td>

</tr>

<?php } ?>

</tbody>

</table>

<script>

$(document).off("click",".btnEliminar");
$(document).off("click",".btnActivar");
$(document).off("click",".btnEditar");

$(document).on("click",".btnEditar",function(){

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

$(document).on("click",".btnActivar",function(){

    let id = $(this).data("id");

    if(
        !confirm(
            "¿Desea activar este período?"
        )
    ){
        return;
    }

    $.ajax({

        url:"activar.php",

        type:"POST",

        data:{
            id:id
        },

        dataType:"json",

        success:function(r){

            cargarPeriodos();

        },

        error:function(){

            alert(
                "Error al activar."
            );

        }

    });

});

$(document).on("click",".btnEliminar",function(){

    let id = $(this).data("id");

    if(!confirm("¿Desea desactivar este período?")){
        return;
    }

    $.ajax({

        url:"eliminar.php",

        type:"POST",

        data:{
            id:id
        },

        success:function(){

            cargarPeriodos();

        },

        error:function(){

            alert("Error al desactivar.");

        }

    });

});

</script>