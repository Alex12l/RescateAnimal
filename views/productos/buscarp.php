<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscador</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
</head>
<body>
   
    <div class="container mt-3">
       <div class="p-3 mb-2 bg-info text-dark "> <h1>Buscador</h1></div>
        <a href="./listarp.php" class="btn btn-sm btn-primary">
            <i class="bi bi-table"></i> Listar
        </a>
        <hr>

        <h3>Búsqueda por ID</h3>
        <form action="" id="form-busqueda-1">
            <div class="mb-3">
                <label for="idbuscado">ID Buscado</label>
                <div class="input-group">
                    <span class="input-group-text">Escriba solo números</span>
                    <input type="text" class="form-control" id="idbuscado">
                    <button class="btn btn-success" type="submit">
                        <i class="bi bi-search"></i> Buscar
                    </button>
                </div>
            </div>

            <table class="table table-bordered mt-3" id="tabla-descripcion-id">
                <thead>
                    <tr>
                        <th>Clasificación</th>
                        <th>Nombre</th>
                        <th>Apellidos</th>
                        <th>Teléfono</th>
                        <th>Dirección</th>
                        <th>ID Animal</th>
                        <th>Fecha</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </form>

        <hr>

        <h3>Búsqueda por Clasificación</h3>
        <form action="" id="form-busqueda-2">
            <div>
                <label for="estados">Estado de consulta</label>
                <div class="input-group">
                    <select  id="clasificacion" class="form-select">Seleccione
                    <option value="Voluntario">Seleccione</option>
                    <option value="Voluntario">Voluntario</option>
                    <option value="Adoptante">Adoptante</option>
                    <option value="Veterinario">Veterinario</option>
                    <option value="Donante">Donante</option>
                    </select>
                 <button class="btn btn-success" type="submit"><i class="bi bi-search"></i>Buscar</button>
                </div>
            </div>

        </form>

        <table class="table table-bordered mt-3" id="tabla-descripcion">
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
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function(){

            function buscarPersonaID(){
                const datos = new FormData()
                datos.append("operacion", "buscarPorID")
                datos.append("id", document.querySelector("#idbuscado").value)

                fetch('../../app/controllers/Personas.controller.php', {
                    method: 'POST',
                    body: datos
                })
                .then(response => response.json())
                .then(data => {
                    document.querySelector("#tabla-descripcion-id tbody").innerHTML = ""
                    if(data){
                        data.forEach(element => {
                            document.querySelector("#tabla-descripcion-id tbody").innerHTML += `
                                <tr>
                                    <td>${element.clasificacion}</td>
                                    <td>${element.nombre}</td>
                                    <td>${element.apellidos}</td>
                                    <td>${element.telefono}</td>
                                    <td>${element.direccion}</td>
                                    <td>${element.idanimal}</td>
                                    <td>${element.fecha}</td>
                                </tr>
                            `
                        })
                    }
                })
            }

            function buscarPersonaClasificacion(){
                const datos = new FormData()
                datos.append("operacion", "buscarPorClasificacion")
                datos.append("clasificacion", document.querySelector("#clasificacion").value)

                fetch('../../app/controllers/Personas.controller.php', {
                    method: 'POST',
                    body: datos
                })
                .then(response => response.json())
                .then(data => {
                    document.querySelector("#tabla-descripcion tbody").innerHTML = ""
                    if(data){
                        data.forEach(element => {
                            document.querySelector("#tabla-descripcion tbody").innerHTML += `
                                <tr>
                                    <td>${element.id}</td>
                                    <td>${element.clasificacion}</td>
                                    <td>${element.nombre}</td>
                                    <td>${element.apellidos}</td>
                                    <td>${element.telefono}</td>
                                    <td>${element.direccion}</td>
                                    <td>${element.idanimal}</td>
                                    <td>${element.fecha}</td>
                                </tr>
                            `
                        })
                    }
                })
            }

            document.querySelector("#form-busqueda-1").addEventListener("submit", function(e){
                e.preventDefault()
                buscarPersonaID()
            })

            document.querySelector("#form-busqueda-2").addEventListener("submit", function(e){
                e.preventDefault()
                buscarPersonaClasificacion()
            })
        })
    </script>
</body>
</html>
