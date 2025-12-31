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
   <div class="p-3 mb-2 bg-info text-dark "> <h1>Registro de Personas</h1></div>
    <a href="./listarp.php" class="btn btn-sm btn-primary">
      <i class="bi bi-table"></i> Lista de personas
    </a>
    <hr>

    <form action="" id="formulario-persona">
      <div class="card">
        <div class="card-header">Complete el registro</div>
        <div class="card-body">

          <div class="form-floating mb-2">
            <input type="text" id="clasificacion" class="form-control" required>
            <label for="clasificacion">Clasificación</label>
          </div>

          <div class="form-floating mb-2">
            <input type="text" id="nombre" class="form-control" required>
            <label for="nombre">Nombre</label>
          </div>

          <div class="form-floating mb-2">
            <input type="text" id="apellidos" class="form-control" required>
            <label for="apellidos">Apellidos</label>
          </div>

          <div class="form-floating mb-2">
            <input type="text" id="telefono" class="form-control" required>
            <label for="telefono">Teléfono</label>
          </div>

          <div class="form-floating mb-2">
            <input type="text" id="direccion" class="form-control" required>
            <label for="direccion">Dirección</label>
          </div>

          <div class="form-floating mb-2">
            <input type="number" id="idanimal" class="form-control" required>
            <label for="idanimal">ID Animal</label>
          </div>

          <div class="form-floating mb-2">
            <input type="date" id="fecha" class="form-control" required>
            <label for="fecha">Fecha</label>
          </div>

        </div>
        <div class="card-footer text-end">
          <button class="btn btn-primary" type="submit">Guardar</button>
          <button class="btn btn-outline-secondary" type="reset">Cancelar</button>
        </div>
      </div>
    </form>
  </div>

  <script>
    document.addEventListener("DOMContentLoaded", function(){

      document.querySelector("#formulario-persona").addEventListener("submit", function(event){
        event.preventDefault()

        if(confirm("Confirme para registrar")){
          guardarDatos()
        }
      })

      function guardarDatos(){
        const datos = new FormData()
        datos.append('operacion', 'registrar')
        datos.append('clasificacion', document.querySelector("#clasificacion").value)
        datos.append('nombre', document.querySelector("#nombre").value)
        datos.append('apellidos', document.querySelector("#apellidos").value)
        datos.append('telefono', document.querySelector("#telefono").value)
        datos.append('direccion', document.querySelector("#direccion").value)
        datos.append('idanimal', document.querySelector("#idanimal").value)
        datos.append('fecha', document.querySelector("#fecha").value)

        fetch('../../app/controllers/Personas.controller.php', {
          method: 'POST',
          body: datos
        })
        .then(response => response.json())
        .then(data => {
          if (data.id > 0){
            document.querySelector("#formulario-persona").reset()
            alert("Datos guardados correctamente")
          } else {
            alert("Error al guardar los datos")
          }
        })
      }
    })
  </script>

</body>
</html>
