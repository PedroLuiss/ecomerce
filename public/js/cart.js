const numerito = document.querySelector("#numerito");
const numerito1 = document.querySelector("#numerito1");
const search = document.querySelector("#buscarproducto");
let productos;
document.addEventListener("DOMContentLoaded", function () {
  if (localStorage.getItem("productos-en-carrito") != null) {
    productos = JSON.parse(localStorage.getItem("productos-en-carrito"));
  } else {
    productos = [];
  }

  cantidadCarrito();

  cargarBotones()
});

function cargarBotones(){
  let botonesAgregar = document.querySelectorAll(".producto-agregar");
  for (let i = 0; i < botonesAgregar.length; i++) {
    botonesAgregar[i].addEventListener("click", function (e) {
        e.preventDefault();
      let idProducto = botonesAgregar[i].id;
      let stock = botonesAgregar[i].getAttribute("stock");
      agregarCarrito(idProducto, 1, stock);
    });
  }


  let botonesFavorito = document.querySelectorAll(".producto-favorito");
  for (let i = 0; i < botonesFavorito.length; i++) {
    botonesFavorito[i].addEventListener("click", function (e) {
        e.preventDefault();
      let idProducto = botonesFavorito[i].id;
      let stock = botonesFavorito[i].getAttribute("stock");
      let user_id = botonesFavorito[i].getAttribute("id-user");
      console.log(idProducto);
      console.log(user_id);
      agregarFavorito(idProducto, user_id);
    });
  }
}


function agregarFavorito(id_producto, id_user) {
  const sendGetRequest = async () => {

    const url_base = document.getElementById("url_base").value;
    const url = url_base + "principal/AddFavorito"; // Asegúrate de que la URL sea correcta

    const formData = new FormData();
    formData.append('id_producto', id_producto);
    formData.append('id_user', id_user); 

    const http = new XMLHttpRequest();
    http.open("POST", url, true);
    http.send(formData);

    http.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        const res = JSON.parse(this.responseText);
        console.log(res);
        alerta(res.msg, 1);
        localStorage.setItem("numn_favorito", res.coun);
      }
    };
  };
  sendGetRequest();
}

//agregar productos al carrito
function agregarCarrito(idProducto, cantidad, stock) {
  for (let i = 0; i < productos.length; i++) {
    if (productos[i]["id"] == idProducto) {
      productos[i]["cantidad"] = parseInt(productos[i]["cantidad"]) + 1;
      if (parseInt(stock) >= parseInt(productos[i]["cantidad"])) {
        alerta("PRODUCTO AGREGADO AL CARRITO", 1);
        localStorage.setItem("productos-en-carrito", JSON.stringify(productos));
      } else {
        alerta("STOCK AGOTADO", 2);
      }
      return;
    }
  }
  if (parseInt(stock) >= parseInt(1)) {
    productos.concat(localStorage.getItem("productos-en-carrito"));
    productos.push({
      id: idProducto,
      cantidad: cantidad,
    });
    localStorage.setItem("productos-en-carrito", JSON.stringify(productos));
    alerta("PRODUCTO AGREGADO AL CARRITO", 1);
    cantidadCarrito();
  } else {
    alerta("STOCK AGOTADO", 2);
  }
}

function cantidadCarrito() {
  numerito.textContent = productos.length;
  numerito1.textContent = productos.length;
}

function alerta(mensaje, type) {
  let color = (type == 1) ? '#46cd93' : '#f24734';
  Toastify({
    text: mensaje,
    duration: 3000,
    close: true,
    gravity: "top", // `top` or `bottom`
    position: "right", // `left`, `center` or `right`
    stopOnFocus: true, // Prevents dismissing of toast on hover
    style: {
      background: color,
      borderRadius: "2rem",
      textTransform: "uppercase",
      fontSize: ".75rem",
    },
    offset: {
      x: "1.5rem", // horizontal axis - can be a number or a string indicating unity. eg: '2em'
      y: "1.5rem", // vertical axis - can be a number or a string indicating unity. eg: '2em'
    },
    onClick: function () {}, // Callback after click
  }).showToast();
}
