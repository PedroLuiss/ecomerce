<?php include "Views/template/header.php"; ?>
<div class="container">
    <div class="card">
        <div class="card-header">
            <h2 class="text-muted text-center">Información Cliente</h2>
        </div>
        <div class="card-body">
            <!--<a class="btn btn-danger mb-2" href="<?php echo BASE_URL . 'profile/salir'; ?>" role="button">Cerrar Sesion</a>-->
            <form class="row" id="formInfoClient" method="POST" action="<?php echo BASE_URL . 'profile/updateinfocliente'; ?>">
                <input type="hidden" name="id" class="id" value="1">
                <input type="hidden" name="opt_form" id="opt_form" value="1">
                <div class="form-group col-md-6">
                    <label for="correo">Correo</label>
                    <input disabled type="email" class="form-control" id="correo" name="correo">
                </div>
                <div class="form-group col-md-6">
                    <label for="nombre">Nombre</label>
                    <input type="text" class="form-control" id="nombre" name="nombre">
                </div>

                <div class="form-group col-md-6">
                    <label for="apellido">Apellido</label>
                    <input type="text" class="form-control" id="apellido" name="apellido">
                </div>
                <div class="form-group col-md-6">
                    <label for="clave">Contraseña</label>
                    <input type="password" class="form-control" id="clave" name="clave">
                </div>
                <div class=" col-md-12">
                    <button onclick="sendUpdate(1)" type="button" class="btn_send_info btn btn-success " data-opt-form="1">Guardar</button>
                </div>


            </form>
        </div>
    </div>
    <div class="card mb-4">
        <div class="card-header">
            <h2 class="text-muted text-center">Derección cliente</h2>
        </div>
        <div class="card-body row">
            <!--<a class="btn btn-danger mb-2" href="<?php echo BASE_URL . 'profile/salir'; ?>" role="button">Cerrar Sesion</a>-->
            <div class="col-md-6">
                <ul class="list-group">
                    <li class="list-group-item"><span><b>Estado:</b></span> <span id="txtEstado"></span></li>
                    <li class="list-group-item"><span><b>Ciudad:</b></span> <span id="txtCiudad"></span></li>
                    <li class="list-group-item"><span><b>Municipio:</b></span> <span id="txtMunicipio"></span></li>
                    <li class="list-group-item"><span><b>Parroquia:</b></span> <span id="txtParroquia"></span></li>
                    <li class="list-group-item"><span><b>Dirreción:</b></span> <span id="txtDirección"></span></li>
                </ul>
            </div>
            <div class="col-md-6">
                <form class="row" id="formInfodireccion" method="POST" action="<?php echo BASE_URL . 'profile/updateinfocliente'; ?>">
                    <input type="hidden" name="id" id="id" class="id" value="1">
                    <input type="hidden" name="opt_form" id="opt_form" value="2">
                    <div class="form-group col-lg-6 mb-2">
                        <label for="clave">Estado</label>
                        <select class="form-control list_estado_select" name="estado_id" id="estado_id" onchange="lista_select_ciudad(this.value)" aria-label="Default select example">

                        </select>
                    </div>
                    <div class="form-group col-lg-6 mb-2">
                        <label for="clave">Ciudad</label>
                        <select class="form-control list_ciudad_select" name="ciudade_id" id="ciudade_id" aria-label="Default select example">
                        </select>
                    </div>
                    <div class="form-group col-lg-6 mb-2">
                        <label for="clave">Municipio</label>
                        <select class="form-control list_municipio_select" name="municipio_id" id="municipio_id" onchange="lista_select_parroquia(this.value)" aria-label="Default select example">
                        </select>
                    </div>

                    <div class="form-group col-lg-6 mb-2">
                        <label for="clave">Parroquia</label>
                        <select class="form-control list_parroquia_select" name="parroquia_id" id="parroquia_id" aria-label="Default select example">
                        </select>
                    </div>
                    <div class="col-md-12 mb-3">
                        <div class="form-group">
                            <label for="direccion">Dirreción <span class="text-danger">*</span></label>
                            <textarea id="direccion" class="form-control" name="direccion" rows="3" placeholder="Dirección"></textarea>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <button type="button" onclick="sendUpdate(2)" class="btn btn-success btn_send_info" data-opt-form="2">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


</div>

<?php include "Views/template/footer.php"; ?>

<script src="<?php echo BASE_URL; ?>public/admin/js/jquery.min.js"></script>
<script>
    const base_url = '<?php echo BASE_URL; ?>';
</script>
<script type="text/javascript" src="<?php echo BASE_URL . 'public/admin/DataTables/datatables.min.js'; ?>"></script>
<script src="<?php echo BASE_URL; ?>public/admin/js/es-ES.js"></script>
<script src="<?php echo BASE_URL; ?>public/js/pedidos.js"></script>
<script src="<?php echo BASE_URL . 'public/js/axios.min.js'; ?>"></script>
<script>
    $(document).ready(function() {
        const base_url = '<?php echo BASE_URL; ?>';
        const cliente = <?php echo  json_encode($data['cliente']); ?>;
        // Informacion cliente
        $('.id').val(cliente.id);
        $('#correo').val(cliente.correo);
        $('#nombre').val(cliente.nombre);
        $('#apellido').val(cliente.apellido);

        //Informacion cliente direccion

        if (cliente.estado===1&&cliente.ciudad===1&&cliente.municipio===1&&cliente.parroquia===1) {
            $('#txtEstado').text("");
            $('#txtCiudad').text("");
            $('#txtMunicipio').text("");
            $('#txtParroquia').text("");
            $('#txtDirección').text("");
        }else{
            $('#txtEstado').text(cliente.estado);
            $('#txtCiudad').text(cliente.ciudad);
            $('#txtMunicipio').text(cliente.municipio);
            $('#txtParroquia').text(cliente.parroquia);
            $('#txtDirección').text(cliente.direccion == null ? "" : cliente.direccion);
        }

        console.log(cliente);
        lista_select_stados();
        console.log(base_url);
    });

    function sendUpdate(opt) {
        console.log("Hola");
        console.log(opt);
        if (opt == 1) {
            if ($('#correo').val() == "" || $('#nombre').val() == "" || $('#apellido').val() == "") {
                    alert("Tienes campos vacios")
                    return false
            }
        } else {

            if ($('#estado_id').val() == "" || $('#ciudade_id').val() == "" || $('#municipio_id').val() == "" || $('#parroquia_id').val() == "" ||
                $('#direccion').val() == "") {
                    alert("Tienes campos vacios")
                    return false
            }
        }
        let form = opt == 1 ? "#formInfoClient" : "#formInfodireccion";
        $.ajax({
            url: $(form).attr('action'),
            data: $(form).serialize(),
            type: $(form).attr('method'),
            dataType: 'JSON',
            success: function(resp) {
                console.log(resp);
                location.reload();

            },
            error: function(xhr, ajaxOptions, thrownError) {
                // Error de formulario validacion
                if (xhr.status == 422) {
                    // Elimina el mensaje de error de los campos que estan correctos
                    $(form).find("strong[id]").text('');
                    // Estilo de bootstrap para marcar que estan correctos los datos
                    $(form).find('input:text, input:password, input:file, input:hidden  , input[name="email"],select, textarea').removeClass('is-invalid').addClass('is-valid');
                    // Definido en el archivo general.js, muestra los campos que contienen errores en el formulario
                } else //Errores web
                {
                    if (xhr.status == 404) {
                        mensaje = "Página no encontrada";
                    } else if (xhr.status == 500) {
                        mensaje = "Error interno, intente de nuevo mas tarde o contacte al administrador del portal.";
                    } else if (xhr.status == 0) {
                        mensaje = "No hay conexión a internet, por favor revise su conexión.";
                    } else {
                        mensaje = xhr.responseText;
                    }

                    // swal("Error "+xhr.status,mensaje, "error");
                }
            }

        });
    }

    function lista_select_stados(id = "") {
        console.log("Funcion ejecutado");
        const sendGetRequest = async () => {
            const url = base_url + "principal/estados/" + id;
            try {
                const resp = await axios.get(url);
                console.log("Lista estado");
                console.log(resp.data.data);
                var cadena = "";
                cadena += '<option value="">Seleccionar Estados</option>';
                let i = 0;

                for (const key in resp.data.data) {

                    if (Object.hasOwnProperty.call(resp.data.data, key)) {
                        const element = resp.data.data[key];

                        cadena +=
                            '<option value="' +
                            element.id_estado +
                            '">' +
                            element.estado + "</option>";
                    }
                }
                $(".list_estado_select").html(cadena);
            } catch (err) {
                // Handle Error Here
                console.error(err);
            }
        };
        sendGetRequest();
    }

    function lista_select_ciudad(id = "") {

        console.log("Funcion ejecutado");
        const sendGetRequest = async () => {
            const url = base_url + "principal/ciudad/" + id;
            try {
                const resp = await axios.get(url);
                console.log("Lista estado");
                console.log(resp.data.data);
                var cadena = "";
                cadena += '<option value="">Seleccionar ciudad</option>';
                for (const key in resp.data.data) {
                    // console.log(resp.data[key]);
                    if (Object.hasOwnProperty.call(resp.data.data, key)) {
                        const element = resp.data.data[key];
                        cadena +=
                            '<option value="' +
                            element.id_ciudad +
                            '">' +
                            element.ciudad + "</option>";
                    }
                }
                $(".list_ciudad_select").html(cadena);
            } catch (err) {
                // Handle Error Here
                console.error(err);
            }
        };
        sendGetRequest();
        lista_select_municipio(id);
    }

    function lista_select_municipio(id = "") {
        console.log(id);
        console.log("Lista estado lista_select_municipio");
        const sendGetRequest = async () => {
            const url = base_url + "principal/municipio/" + id;
            try {
                const resp = await axios.get(url);

                console.log(resp.data.data);
                var cadena = "";
                cadena += '<option value="">Seleccionar municipio</option>';
                for (const key in resp.data.data) {
                    // console.log(resp.data[key]);
                    if (Object.hasOwnProperty.call(resp.data.data, key)) {
                        const element = resp.data.data[key];
                        cadena +=
                            '<option value="' +
                            element.id_municipio +
                            '">' +
                            element.municipio + "</option>";
                    }
                }
                $(".list_municipio_select").html(cadena);
            } catch (err) {
                // Handle Error Here
                console.error(err);
            }
        };
        sendGetRequest();
    }

    function lista_select_parroquia(id) {
        console.log(id);
        const sendGetRequest = async () => {
            const url = base_url + "principal/parroquia/" + id;
            try {
                const resp = await axios.get(url);

                console.log(resp.data.data);
                var cadena = "";
                cadena += '<option value="">Seleccionar parroquia</option>';
                for (const key in resp.data.data) {
                    // console.log(resp.data[key]);
                    if (Object.hasOwnProperty.call(resp.data.data, key)) {
                        const element = resp.data.data[key];
                        cadena +=
                            '<option value="' +
                            element.id_parroquia +
                            '">' +
                            element.parroquia + "</option>";
                    }
                }
                $(".list_parroquia_select").html(cadena);
            } catch (err) {
                // Handle Error Here
                console.error(err);
            }
        };
        sendGetRequest();
    }
</script>
</body>

</html>