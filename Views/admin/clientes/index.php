<?php include_once 'Views/template/header-admin.php'; ?>

<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <h4 class="page-title m-0">Clientes</h4>
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- end page-title-box -->
    </div>
</div>
<!-- end page title -->

<button class="btn btn-primary mb-2" type="button" id="nuevo_registro">Nuevo</button>

<div class="card">
    <div class="card-body">
        <h5 class="card-title text-center"><i class="fas fa-users"></i> Listado de Clientes</h5>
        <hr>
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover align-middle nowrap" id="tblClientes" style="width: 100%;">
                <thead>
                    <tr>
                        <th>Item</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Correo</th>
                        <th>Dirección</th>
                        <th>Estado</th>
                        <th></th>
                    </tr>
                </thead>

                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div id="nuevoModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="titleModal"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="frmRegistro" autocomplete="off">
                <div class="modal-body">
                    <input type="hidden" id="id" name="id">
                    <div class="row mb-3">
                        <div class="col-md-6 mb-3">
                            <label for="nombre">Nombre <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-list"></i></span>
                                <input class="form-control" type="text" name="nombre" id="nombre" placeholder="Nombre">
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="apellido">Apellido <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-list"></i></span>
                                <input class="form-control" type="text" name="apellido" id="apellido" placeholder="Apellido">
                            </div>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="correo">Correo</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                <input class="form-control" type="text" name="correo" id="correo" placeholder="Correo Electrónico">
                            </div>
                        </div>
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
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" type="submit" id="btnAccion">Registrar</button>
                    <button class="btn btn-danger" type="button" data-dismiss="modal">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include_once 'Views/template/footer-admin.php'; ?>
<script src="<?php echo BASE_URL . 'public/js/axios.min.js'; ?>"></script>
<script src="<?php echo BASE_URL . 'public/admin/js/page/clientes.js'; ?>"></script>

</body>

</html>