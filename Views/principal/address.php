<?php include "Views/template/header.php"; ?>

<section class="shoping-cart spad">
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title mb-5">Dirección de Envío</h5>
                <div class="card">
                    <div class="card-body">
                        <form autocomplete="off" id="frmEnvio">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text">Nombres</span>
                                        <input type="text" id="nombre" name="nombre" class="form-control" value="<?php echo (!empty($_SESSION['address']['nombre'])) ? $_SESSION['address']['nombre'] : ''; ?>" placeholder="Nombres *">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text">Apellidos</span>
                                        <input type="text" id="apellido" name="apellido" class="form-control" value="<?php echo (!empty($_SESSION['address']['apellido'])) ? $_SESSION['address']['apellido'] : ''; ?>" placeholder="Apellidos *">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text">Dirección</span>
                                        <input type="text" id="direccion" name="direccion" class="form-control" value="<?php echo (!empty($_SESSION['address']['direccion'])) ? $_SESSION['address']['direccion'] : ''; ?>" placeholder="Dirección *">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text">Ciudad</span>
                                        <input type="text" id="ciudad" name="ciudad" class="form-control" value="<?php echo (!empty($_SESSION['address']['ciudad'])) ? $_SESSION['address']['ciudad'] : ''; ?>" placeholder="Ciudad *">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text">Código postal</span>
                                        <input type="text" id="cod" name="cod" class="form-control" value="<?php echo (!empty($_SESSION['address']['cod'])) ? $_SESSION['address']['cod'] : ''; ?>" placeholder="Cod postal *">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text">Pais</span>
                                        <input type="text" id="pais" name="pais" class="form-control" value="<?php echo (!empty($_SESSION['address']['pais'])) ? $_SESSION['address']['pais'] : ''; ?>" placeholder="Pais *">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text">Telefono</span>
                                        <input type="text" id="telefono" name="telefono" class="form-control" value="<?php echo (!empty($_SESSION['address']['telefono'])) ? $_SESSION['address']['telefono'] : ''; ?>" placeholder="Telefono *">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text">Estado</span>
                                        <select class="form-control list_estado_select" name="estado_id" id="estado_id" onchange="lista_select_ciudad(this.value)" aria-label="Default select example"></select>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="btn-group" role="group" aria-label="Button group name">
                                <button type="submit" class="btn btn-primary">
                                    Siguiente
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include "Views/template/footer.php"; ?>
<script src="<?php echo BASE_URL . 'public/js/axios.min.js'; ?>"></script>
<script src="<?php echo BASE_URL; ?>public/admin/js/jquery.min.js"></script>
<script>
  const  base_url = '<?php echo BASE_URL; ?>';
    const frmEnvio = document.querySelector("#frmEnvio");
    document.addEventListener("DOMContentLoaded", function() {

        frmEnvio.onsubmit = function(e) {
            e.preventDefault();
            if (
                frmEnvio.nombre.value == "" ||
                frmEnvio.apellido.value == "" ||
                frmEnvio.direccion.value == "" ||
                frmEnvio.ciudad.value == "" ||
                frmEnvio.cod.value == "" ||
                frmEnvio.pais.value == "" ||
                frmEnvio.telefono.value == ""
            ) {
                alerta("TODO LOS CAMPOS SON REQUERIDOS", 2);
            } else {
                const url = ruta + "principal/envio";
                const http = new XMLHttpRequest();
                http.open("POST", url, true);
                http.send(new FormData(this));
                http.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        const res = JSON.parse(this.responseText);
                        if (res.icono == "success") {
                            setTimeout(function() {
                                window.location = ruta + 'principal/pagos';
                            }, 1500);
                        }
                        let type = res.icono == "success" ? 1 : 2;
                        alerta(res.msg.toUpperCase(), type);
                    }
                };
            }
        };
        lista_select_stados();
    });

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
      for (const key in resp.data.data) {
        // console.log(resp.data[key]);
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