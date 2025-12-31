<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Productos</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
</head>
<body>
  <div class="container">
        <div class="p-3 mb-2 bg-info text-dark "> <h1>Registro de Animales</h1></div>
    <a href="./listar.php" class="btn btn-sm btn-primary"><i class="bi bi-table"></i> Lista de Animales</a>
    <hr>

    <form action="" id="formulario-producto">
      <div class="card">
        <div class="card-header">Complete el registro</div>
        <div class="card-body">
          
        <div class="form-floating mb-2">
          <select id="clasificacion" class="form-select" required>
            <option value="">Seleccione</option>
            <option value="Cachorro">Cachorro</option>
            <option value="Adulto">Adulto</option>
            <option value="Senior">Senior</option>
            <option value="Discapacitado">Discapacitado</option>
          </select>
          <label for="clasificacion" class="form-label">Clasificación</label>
          </div>

          <div class="form-floating mb-2">
            <input type="text" id="nombre" class="form-control" required>
            <label for="nombre" class="form-label">Nombre</label>
          </div>

          <div class="form-floating mb-2">
            <input type="text" id="especie" class="form-control" required>
            <label for="especie" class="form-label">Especie</label>
          </div>

          <div class="form-floating mb-2">
            <input type="text" id="raza" class="form-control" required>
            <label for="raza" class="form-label">Raza</label>
          </div>

          <div class="form-floating mb-2">
            <input type="text" id="genero" class="form-control" required>
            <label for="genero" class="form-label">Genero</label>
          </div>

          <div class="form-floating mb-2">
            <input type="text" id="condiciones" class="form-control" required>
            <label for="condiciones" class="form-label">Condiciones</label>
          </div>

          <div class="form-floating mb-2">
            <input type="text" id="vacunas" class="form-control" required>
            <label for="vacunas" class="form-label">Vacunas</label>
          </div>

          <div class="form-floating mb-2">
            <input type="text" id="estado" class="form-control" required>
            <label for="estado" class="form-label">Estado</label>
          </div>

        <div class="mb-2">
          <label for="imagen" class="form-label">Imagen</label>
          <input type="file" id="imagen" class="form-control" accept="image/*" required>
        </div>

        <div class="form-floating mb-2">
            <input type="date" id="ingreso" class="form-control" required>
            <label for="ingreso" class="form-label">Ingreso</label>
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

      document.querySelector("#formulario-producto").addEventListener("submit", function(event){
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
        datos.append('especie', document.querySelector("#especie").value)
        datos.append('raza', document.querySelector("#raza").value)
        datos.append('genero', document.querySelector("#genero").value)
        datos.append('condiciones', document.querySelector("#condiciones").value)
        datos.append('vacunas', document.querySelector("#vacunas").value)
        datos.append('estado', document.querySelector("#estado").value)
        datos.append('ingreso', document.querySelector("#ingreso").value)
        datos.append('foto', document.querySelector("#imagen").files[0])

        fetch('../../app/controllers/Animales.controller.php', {
          method: 'POST',
          body: datos
        })
        .then(response => response.json())
        .then(data => {

          if (data.id > 0){
            document.querySelector("#formulario-producto").reset()
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