let tabla = document.querySelector("#tabla");
let notificacion = document.querySelector("#notification");
let fam_count;
let conexion;

const toastLiveExample = document.getElementById('liveToast');
const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastLiveExample);
eventos();

// Eliminar
let confirmar = document.querySelector("#delete");
let nombres = "";

function borrar(e) {
  e.preventDefault();
  nombres = e.target.getAttribute('id');
  console.log(nombres);

  confirmar.addEventListener("click", () => {
    ajaxBorrar(nombres);
    toastBootstrap.show();
    nombres = "";
    filtroVal = 10;
    filtro.value = "10";
  })
}

function ajaxBorrar(nombres) {
  conexion = new XMLHttpRequest();
  conexion.open('GET', `/php/delete.php?name=${nombres}&page=${page}&filter=${filtroVal}`, true);
  conexion.send();

  conexion.onreadystatechange = () => {
    if (conexion.readyState == 4 && conexion.status == 200) {
      tabla.innerHTML = conexion.responseText;
      notificacion.innerHTML = "Se eliminó la persona";
      eventos();
    } else {
      notificacion.innerHTML = `<div class="spinner-border" role="status"></div>`;
    }
  }
}

//filter
let filtro = document.querySelector("#filtro");
let filtroVal = 10;

filtro.addEventListener("change", () => {
  filtroVal = filtro.value;
  ajaxFilter(filtroVal);
  console.log(filtroVal);
  page = 0;
})

function ajaxFilter() {
  conexion = new XMLHttpRequest();
  conexion.open('GET', `/php/act.php?filter=${filtroVal}&page=0`, true);
  conexion.send();

  conexion.onreadystatechange = () => {
    if(conexion.readyState == 4 && conexion.status == 200) {
      tabla.innerHTML = conexion.responseText;
      eventos();
    }
  }
}

// pagination
let atras = document.querySelector("#back");
let sig = document.querySelector("#next");
let page = 0;

atras.addEventListener("click", () => {
  page -= 5;
  if (page < 0) {
    page = 0;
  }
  ajaxPag(page);
  filtroVal = 10;
  filtro.value = "10";
})


sig.addEventListener("click", () => {
  page += 5;
  ajaxPag(page);
  filtroVal = 10;
  filtro.value = "10";
})

function ajaxPag(page) {
  conexion = new XMLHttpRequest();
  conexion.open('GET', `/php/act.php?page=${page}&filter=${10}`, true);
  conexion.send();

  conexion.onreadystatechange = () => {
    if (conexion.readyState == 4 && conexion.status == 200) {
      tabla.innerHTML = conexion.responseText;
      eventos();
    }
  }
}

function eventos() {
  let btn_borrar = document.querySelectorAll(".borrar");

  for (let i = 0; i < btn_borrar.length; i++) {
    btn_borrar[i].addEventListener("click", borrar, false);
  }
}