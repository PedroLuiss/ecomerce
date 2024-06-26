//LOGIN
console.clear();

const loginBtn = document.getElementById('loginForm');
const signupBtn = document.getElementById('signup');

loginBtn.addEventListener('click', (e) => {
	let parent = e.target.parentNode.parentNode;
	Array.from(e.target.parentNode.parentNode.classList).find((element) => {
		if(element !== "slide-up") {
			parent.classList.add('slide-up')
		}else{
			signupBtn.parentNode.classList.add('slide-up')
			parent.classList.remove('slide-up')
		}
	});
});

signupBtn.addEventListener('click', (e) => {
	let parent = e.target.parentNode;
	Array.from(e.target.parentNode.classList).find((element) => {
		if(element !== "slide-up") {
			parent.classList.add('slide-up')
		}else{
			loginBtn.parentNode.parentNode.classList.add('slide-up')
			parent.classList.remove('slide-up')
		}
	});
});
//FIN LOGIN

const email = document.querySelector("#email");
const password = document.querySelector("#password");
const btnLogin = document.querySelector("#btnLogin");

//REGISTER
const nameRegister = document.querySelector("#nameRegister");
const emailRegister = document.querySelector("#emailRegister");
const passwordRegister = document.querySelector("#passwordRegister");
const btnRegister = document.querySelector("#btnRegister");

document.addEventListener("DOMContentLoaded", function () {
  btnLogin.onclick = function (e) {
    e.preventDefault();
    if (email.value == "" || password.value == "") {
      alerta("INGRESA CORREO Y CONTRASEÑA", 2);
    } else {
      let data = new FormData();
      data.append("email", email.value);
      data.append("clave", password.value);
      const url = ruta + "profile/validar";
      const http = new XMLHttpRequest();
      http.open("POST", url, true);
      http.send(data);
      http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          const res = JSON.parse(this.responseText);
          if (res.icono == "success") {
            setTimeout(function () {
              window.location = ruta + 'principal/ordenes';
            }, 1500);
          }
          let type = res.icono == "success" ? 1 : 2;
          alerta(res.msg.toUpperCase(), type);
        }
      };
    }
  };
  btnRegister.onclick = function (e) {
    e.preventDefault();
    if (nameRegister.value == "" || emailRegister.value == "" || passwordRegister.value == "") {
      alerta("TODO LOS CAMPOS SON REQUERIDOS", 2);
    } else {
      let data = new FormData();
      data.append("nombre", nameRegister.value);
      data.append("email", emailRegister.value);
      data.append("clave", passwordRegister.value);
      const url = ruta + "registro/save";
      const http = new XMLHttpRequest();
      http.open("POST", url, true);
      http.send(data);
      http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          const res = JSON.parse(this.responseText);
          if (res.icono == "success") {
            setTimeout(function () {
              window.location = ruta + 'profile';
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
