<?php

require_once("../../controladores/conexion.php");

$db = new Conexion();
$cn = $db->conectar();

$sql = "
SELECT
u.*,
r.nombre AS rol,
o.nombre AS organizacion
FROM usuarios u
INNER JOIN roles r
ON u.id_rol = r.id_rol
INNER JOIN organizaciones o
ON u.id_organizacion = o.id_organizacion
ORDER BY u.nombres,u.apellidos
";

$resultado = $cn->query($sql);

?>

<table class="table table-bordered table-hover">

<thead class="table-dark">

<tr>

<th>ID</th>
<th>Nombre</th>
<th>Correo</th>
<th>Teléfono</th>
<th>Rol</th>
<th>Organización</th>
<th>Estado</th>
<th width="180">Acciones</th>

</tr>

</thead>

<tbody>

<?php while($fila = $resultado->fetch_assoc()){ ?>

<tr>

<td>
<?php echo $fila["id_usuario"]; ?>
</td>

<td>
<?php echo $fila["nombres"]." ".$fila["apellidos"]; ?>
</td>

<td>
<?php echo $fila["correo"]; ?>
</td>

<td>
<?php echo $fila["telefono"]; ?>
</td>

<td>
<?php echo $fila["rol"]; ?>
</td>

<td>
<?php echo $fila["organizacion"]; ?>
</td>

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
data-id="<?php echo $fila["id_usuario"]; ?>">

Editar

</button>

<button
class="btn btn-info btn-sm btnPassword"
data-id="<?php echo $fila["id_usuario"]; ?>">

Clave

</button>

<button
class="btn btn-danger btn-sm btnEliminar"
data-id="<?php echo $fila["id_usuario"]; ?>">

Eliminar

</button>
</td>

</tr>

<?php } ?>

</tbody>

</table>

<script>
	
$(".btnEditar").click(function(){

	let id=$(this).data("id");

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

	let id=$(this).data("id");

	if(!confirm(
	"¿Desea desactivar este usuario?"
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

	cargarUsuarios();

	}else{

	alert(r.message);

	}

	}

	});

});
	
$(".btnPassword").click(function(){

    let id = $(this).data("id");

    if(
        !confirm(
            "¿Generar una nueva contraseña temporal?"
        )
    ){
        return;
    }

    $.ajax({

        url:"reset_password.php",

        type:"POST",

        data:{
            id:id
        },

        dataType:"json",

        success:function(r){

            if(r.success){

                alert(
                    "Nueva contraseña temporal:\n\n" +
                    r.password
                );

            }else{

                alert(r.message);

            }

        }

    });

});

</script>