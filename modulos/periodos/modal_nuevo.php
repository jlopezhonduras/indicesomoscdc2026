<div class="modal fade" id="modalNuevo">

<div class="modal-dialog">

<div class="modal-content">

<div class="modal-header">

<h5 class="modal-title">

Nuevo Período

</h5>

<button
type="button"
class="btn-close"
data-bs-dismiss="modal">
</button>

</div>

<div class="modal-body">

<div id="mensajePeriodo"></div>

<form id="frmPeriodo">

<div class="mb-3">

<label>Nombre</label>

<input
type="text"
name="nombre"
class="form-control"
required>

</div>

<div class="mb-3">

<label>Año</label>

<input
type="number"
name="anio"
class="form-control"
required>

</div>

<div class="mb-3">

<label>Fecha Inicio</label>

<input
type="date"
name="fecha_inicio"
class="form-control"
required>

</div>

<div class="mb-3">

<label>Fecha Fin</label>

<input
type="date"
name="fecha_fin"
class="form-control"
required>

</div>

<div class="mb-3">

<label>Observaciones</label>

<textarea
name="observaciones"
class="form-control"></textarea>

</div>

<button
type="submit"
class="btn btn-primary">

Guardar

</button>

</form>

</div>

</div>

</div>

</div>

<script>

document.addEventListener("DOMContentLoaded", function(){

    $("#frmPeriodo").submit(function(e){

        e.preventDefault();

        $.ajax({

            url:"guardar.php",

            type:"POST",

            data:$(this).serialize(),

            dataType:"json",

            success:function(r){

                if(r.success){

                    $("#mensajePeriodo").html(
                        '<div class="alert alert-success">'+
                        r.message+
                        '</div>'
                    );

                    $("#frmPeriodo")[0].reset();

                    cargarPeriodos();

                }else{

                    $("#mensajePeriodo").html(
                        '<div class="alert alert-danger">'+
                        r.message+
                        '</div>'
                    );

                }

            }

        });

    });

});

</script>