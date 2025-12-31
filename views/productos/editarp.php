<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Registro</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mb-3 mt-4">
        <h1>Editar Registro de Persona</h1>
        <hr>
        
        <h3>Registro Actual (Referencia)</h3>
        <table class="table table-bordered table-light mt-3" id="tabla-descripcion-id">
            <thead class="table-dark">
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
                
        <h3 class="mt-5">Nuevos Datos</h3>
        <form id="form-actualizar">
            <table class="table table-bordered mt-3">
                <thead class="table-primary">
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
                <tbody id="fila-editable">
                </tbody>
            </table>
            <div class="text-end">
                <button type="submit" class="btn btn-success">Actualizar Registro</button>
                <a href="listar.php" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const urlParams = new URLSearchParams(window.location.search);
            const idPersona = urlParams.get('id');

            // 1. CARGAR DATOS
            function cargarDatos() {
                const fdatos = new FormData();
                fdatos.append('operacion', 'buscarPorID'); 
                fdatos.append('id', idPersona);

                fetch('../../app/controllers/Personas.controller.php', {
                    method: 'POST',
                    body: fdatos
                })
                .then(response => response.json())
                .then(data => {
                    console.log("Datos recibidos:", data);

                    const persona = data[0];

                    // Tabla de referencia
                    document.querySelector("#tabla-descripcion-id tbody").innerHTML = `
                        <tr>
                            <td>${persona.clasificacion}</td>
                            <td>${persona.nombre}</td>
                            <td>${persona.apellidos}</td>
                            <td>${persona.telefono}</td>
                            <td>${persona.direccion}</td>
                            <td>${persona.idanimal}</td>
                            <td>${persona.fecha}</td>
                        </tr>
                    `;

                    // Inputs editables
                    document.querySelector("#fila-editable").innerHTML = `
                        <tr>
                            <td><input type="text" id="clasificacion" class="form-control" value="${persona.clasificacion}"></td>
                            <td><input type="text" id="nombre" class="form-control" value="${persona.nombre}"></td>
                            <td><input type="text" id="apellidos" class="form-control" value="${persona.apellidos}"></td>
                            <td><input type="text" id="telefono" class="form-control" value="${persona.telefono}"></td>
                            <td><input type="text" id="direccion" class="form-control" value="${persona.direccion}"></td>
                            <td><input type="number" id="idanimal" class="form-control" value="${persona.idanimal}"></td>
                            <td><input type="date" id="fecha" class="form-control" value="${persona.fecha}"></td>
                        </tr>
                    `;
                })
                .catch(error => console.error("Error:", error));
            }

            cargarDatos();

            // 2. ESCUCHAR FORMULARIO
            document.querySelector("#form-actualizar").addEventListener("submit", function(e) {
                e.preventDefault();
                if(confirm("¿Confirmar actualización?")) {
                    actualizarDatos();
                }
            });

            // 3. ACTUALIZAR
            function actualizarDatos() {
                const datos = new FormData();
                datos.append('operacion', 'actualizar');
                datos.append('id', idPersona);
                datos.append('clasificacion', document.querySelector('#clasificacion').value);
                datos.append('nombre', document.querySelector('#nombre').value);
                datos.append('apellidos', document.querySelector('#apellidos').value);
                datos.append('telefono', document.querySelector('#telefono').value);
                datos.append('direccion', document.querySelector('#direccion').value);
                datos.append('idanimal', document.querySelector('#idanimal').value);
                datos.append('fecha', document.querySelector('#fecha').value);

                fetch('../../app/controllers/Personas.controller.php', {
                    method: 'POST',
                    body: datos
                })
                .then(response => response.json())
                .then(res => {
                    if (res > 0) {
                        alert("¡Registro actualizado!");
                        window.location.href = 'listar.php';
                    } else {
                        alert("No se guardaron cambios.");
                    }
                });
            }
        });
    </script>
</body>
</html>
