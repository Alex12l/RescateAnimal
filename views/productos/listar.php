<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Animales</title>

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
</head>
<body>

  <div class="container">
    
   
    <div class="p-3 mb-2 bg-info text-dark"> <h1>Lista de Animales</h1></div>

    <a href="./crear.php" class="btn btn-sm btn-primary">
      <i class="bi bi-card-checklist"></i> Registrar
    </a>

    <a href="./buscar.php" class="btn btn-sm btn-primary">
      <i class="bi bi-search"></i> Buscar
    </a>

   <a href="./../index.php" class="btn btn-sm btn-primary">
      <i class="bi bi-menu-button-wide-fill"></i> Menu
    </a>

    <hr>

    <table class="table table-striped" id="tabla-animales">
      <thead>
        <tr>
          <th>ID</th>
          <th>Clasificación</th>
          <th>Nombre</th>
          <th>Especie</th>
          <th>Raza</th>
          <th>Genero</th>
          <th>Condiciones</th>
          <th>Vacunas</th>
          <th>Estado</th>
          <th>Ingreso</th>
          <th>Foto</th>
          <th>Operaciones</th>
        </tr>
      </thead>
      <tbody>
        <!-- Contenido dinámico -->
      </tbody>
    </table>
  </div>

<script>
document.addEventListener("DOMContentLoaded", function(){

  function obtenerDatos(){
    const datos = new FormData()
    datos.append("operacion", "listar")

    fetch('../../app/controllers/Animales.controller.php', {
      method: 'POST',
      body: datos
    })
    .then(response => response.json())
    .then(data => {

      const tabla = document.querySelector("#tabla-animales tbody")
      tabla.innerHTML = ""

      data.forEach(element => {
        tabla.innerHTML += `
          <tr>
            <td>${element.id}</td>
            <td>${element.clasificacion}</td>
            <td>${element.nombre}</td>
            <td>${element.especie}</td>
            <td>${element.raza}</td>
            <td>${element.genero}</td>
            <td>${element.condiciones}</td>
            <td>${element.vacunas}</td>
            <td>${element.estado}</td>
            <td>${element.ingreso}</td>
            <td>
              <img src="/animal/public/images/${element.foto}" 
     width="80" 
     class="img-thumbnail">
            </td>
            <td>
              <a href="/animal/public/images/${element.foto}" 
                 class="btn btn-sm btn-info">Editar</a>

              <a href="#" 
                 class="btn btn-sm btn-danger"
                 onclick="eliminarAnimal(${element.id})">Eliminar</a>
            </td>
          </tr>
        `
      })
    })
  }

  obtenerDatos()
})

function eliminarAnimal(id){
  if(confirm("Confirme para eliminar el registro con ID: " + id)){
    const datos = new FormData()
    datos.append("operacion", "eliminar")
    datos.append("id", id)

    fetch('../../app/controllers/Animales.controller.php', {
      method: 'POST',
      body: datos
    })
    .then(response => response.text())
    .then(res => {
      if (parseInt(res) > 0) {
        alert("Registro eliminado con éxito")
        location.reload()
      } else {
        alert("No se pudo eliminar el registro")
      }
    })
  }
}
</script>

</body>
</html>
