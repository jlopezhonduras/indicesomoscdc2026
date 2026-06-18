<div class="modal fade" id="modalNuevo" tabindex="-1" aria-hidden="true">

    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title">
                    Nuevo Usuario
                </h5>

                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    onclick="limpiarFormularioUsuario();">
                </button>

            </div>

            <div class="modal-body">

                <div id="mensajeUsuario"></div>

                <form id="frmUsuario">

                    <div class="mb-3">

                        <label class="form-label">
                            Nombres
                        </label>

                        <input
                            type="text"
                            name="nombres"
                            class="form-control">

                    </div>

                    <div class="mb-3">

                        <label class="form-label">
                            Apellidos
                        </label>

                        <input
                            type="text"
                            name="apellidos"
                            class="form-control">

                    </div>

                    <div class="mb-3">

                        <label class="form-label">
                            Usuario
                        </label>

                        <input
                            type="text"
                            name="usuario"
                            class="form-control">

                    </div>

                    <div class="mb-3">

                        <label class="form-label">
                            Correo Electrónico
                        </label>

                        <input
                            type="email"
                            name="correo"
                            class="form-control">

                    </div>

                    <div class="mb-3">

                        <label class="form-label">
                            Contraseña
                        </label>

                        <input
                            type="password"
                            name="password"
                            class="form-control">

                    </div>

                    <div class="mb-3">

                        <label class="form-label">
                            Rol
                        </label>

                        <select
                            name="id_rol"
                            class="form-select">

                            <option value="">
                                Seleccione...
                            </option>

                            <option value="1">
                                Administrador
                            </option>

                            <option value="2">
                                Recolector
                            </option>

                            <option value="3">
                                Consulta
                            </option>

                            <option value="4">
                                Descarga
                            </option>

                        </select>

                    </div>

                </form>

            </div>

            <div class="modal-footer">

                <button
                    type="button"
                    class="btn btn-secondary"
                    data-bs-dismiss="modal"
                    onclick="limpiarFormularioUsuario();">

                    Cancelar

                </button>

                <button
                    type="button"
                    class="btn btn-primary"
                    id="btnGuardar">

                    Guardar

                </button>

            </div>

        </div>

    </div>

</div>

<script>

function limpiarFormularioUsuario(){

    document.getElementById("frmUsuario").reset();

    $("#mensajeUsuario").html("");

    $("#frmUsuario input").removeClass("is-invalid");

    $("#frmUsuario select").removeClass("is-invalid");

}

document
.getElementById('modalNuevo')
.addEventListener('show.bs.modal', function () {

    limpiarFormularioUsuario();

});

$(document).on('click','#btnGuardar',function(){

    $("#mensajeUsuario").html("");

    $("#frmUsuario input").removeClass("is-invalid");

    $("#frmUsuario select").removeClass("is-invalid");

    let nombres   = $("input[name='nombres']").val().trim();
    let apellidos = $("input[name='apellidos']").val().trim();
    let usuario   = $("input[name='usuario']").val().trim();
    let password  = $("input[name='password']").val().trim();
    let id_rol    = $("select[name='id_rol']").val();

    let error = false;

    if(nombres == ""){
        $("input[name='nombres']").addClass("is-invalid");
        error = true;
    }

    if(apellidos == ""){
        $("input[name='apellidos']").addClass("is-invalid");
        error = true;
    }

    if(usuario == ""){
        $("input[name='usuario']").addClass("is-invalid");
        error = true;
    }

    if(password == ""){
        $("input[name='password']").addClass("is-invalid");
        error = true;
    }

    if(id_rol == ""){
        $("select[name='id_rol']").addClass("is-invalid");
        error = true;
    }

    if(error){

        $("#mensajeUsuario").html(
            '<div class="alert alert-danger">'+
            'Todos los campos son necesarios.'+
            '</div>'
        );

        return;

    }

    $.ajax({

        url:'guardar.php',

        type:'POST',

        data:$("#frmUsuario").serialize(),

        dataType:'json',

        success:function(r){

            if(r.success){

                $("#mensajeUsuario").html(
                    '<div class="alert alert-success">'+
                    r.message+
                    '</div>'
                );

                setTimeout(function(){

                    limpiarFormularioUsuario();

                    const modal =
                        bootstrap.Modal.getInstance(
                            document.getElementById('modalNuevo')
                        );

                    modal.hide();

                    cargarUsuarios();

                },1000);

            }
            else{

                $("#mensajeUsuario").html(
                    '<div class="alert alert-danger">'+
                    r.message+
                    '</div>'
                );

            }

        },

        error:function(){

            $("#mensajeUsuario").html(
                '<div class="alert alert-danger">'+
                'Error al comunicarse con el servidor.'+
                '</div>'
            );

        }

    });

});

</script>