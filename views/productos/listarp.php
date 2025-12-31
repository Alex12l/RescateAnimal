<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Personas</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
</head>
<body>
  <div class="container">
    <div class="p-3 mb-2 bg-info text-dark "> <h1>Lista de Personas</h1></div>
    <a href="./crearp.php" class="btn btn-sm btn-primary">
      <i class="bi bi-card-checklist"></i> Registrar
    </a>
    <a href="./buscarp.php" class="btn btn-sm btn-primary">
      <i class="bi bi-search"></i> Buscar
    </a>
       <a href="./../index.php" class="btn btn-sm btn-primary">
      <i class="bi bi-menu-button-wide-fill"></i> Menu
    </a>
    <hr>

    <table class="table table-striped" id="tabla-personas">
      <thead>
        <tr>
          <th>ID</th>
          <th>Clasificación</th>
          <th>Nombre</th>
          <th>Apellidos</th>
          <th>Teléfono</th>
          <th>Dirección</th>
          <th>ID Animal</th>
          <th>Fecha</th>
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

        fetch('/animal/app/controllers/Personas.controller.php', {
          method: 'POST',
          body: datos
        })
        .then(response => response.json())
        .then(data => {
          console.log(data)
          const tabla = document.querySelector("#tabla-personas tbody")

          data.forEach(element => {
            tabla.innerHTML += `
              <tr>
                <td>${element.id}</td>
                <td>${element.clasificacion}</td>
                <td>${element.nombre}</td>
                <td>${element.apellidos}</td>
                <td>${element.telefono}</td>
                <td>${element.direccion}</td>
                <td>${element.idanimal}</td>
                <td>${element.fecha}</td>
                <td>
                  <a href="./editarp.php?id=${element.id}" class="btn btn-sm btn-info">Editar</a>
                  <a href="#" class="btn btn-sm btn-danger" onclick="eliminarPersona(${element.id})">Eliminar</a>
                </td>
              </tr>
            `;
          });
        })
      }
      obtenerDatos()
    })

    function eliminarPersona(id){
      if(confirm("Confirme para eliminar el registro con ID: " + id)){
        const datos = new FormData()
        datos.append("operacion", "eliminar")
        datos.append("id", id)

        fetch('../../app/controllers/Personas.controller.php', {
          method: 'POST',
          body: datos
        })
        .then(response => response.text())
        .then(res => {
          if (parseInt(res) > 0) {
            alert("Registro eliminado con éxito");
            location.reload();
          } else {
            alert("No se pudo eliminar el registro (Respuesta: " + res + ")");
          }
        })
      }
    }
  </script>
</body>
</html>
