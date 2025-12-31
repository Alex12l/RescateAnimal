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
        <h1>Editar Registro de Mascota</h1>
        <hr>
        
        <h3>Registro Actual (Referencia)</h3>
        <table class="table table-bordered table-light mt-3" id="tabla-descripcion-id">
            <thead class="table-dark">
                <tr>
                    <th>Clasificación</th>
                    <th>Nombre</th>
                    <th>Especie</th>
                    <th>Raza</th>
                    <th>Género</th>
                    <th>Condiciones</th>
                    <th>Vacunas</th>
                    <th>Estado</th>
                    <th>Ingreso</th>
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
                        <th>Especie</th>
                        <th>Raza</th>
                        <th>Género</th>
                        <th>Condiciones</th>
                        <th>Vacunas</th>
                        <th>Estado</th>
                        <th>Ingreso</th>
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
            const idAnimal = urlParams.get('id');


            // 1. CARGAR DATOS
            function cargarDatos() {
                const fdatos = new FormData();
                fdatos.append('operacion', 'buscarPorID'); 
                fdatos.append('id', idAnimal);

                fetch('../../app/controllers/Animales.controller.php', {
                    method: 'POST',
                    body: fdatos
                })
                .then(response => response.json())
.then(data => {
    console.log("Datos recibidos:", data);

    // Como recibiste [{...}], extraemos la primera posición
    const animal = data[0]; 

    // 1. Llenar tabla de REFERENCIA (Arriba)
    document.querySelector("#tabla-descripcion-id tbody").innerHTML = `
        <tr>
            <td>${animal.clasificacion}</td>
            <td>${animal.nombre}</td>
            <td>${animal.especie}</td>
            <td>${animal.raza}</td>
            <td>${animal.genero}</td>
            <td>${animal.condiciones}</td>
            <td>${animal.vacunas}</td>
            <td>${animal.estado}</td>
            <td>${animal.ingreso}</td>
        </tr>
    `;

    // 2. Llenar los INPUTS para editar (Abajo)
    // Usamos innerHTML para asegurar que los IDs existan antes de asignarles valor
    document.querySelector("#fila-editable").innerHTML = `
        <tr>
            <td><input type="text" id="clasificacion" class="form-control" value="${animal.clasificacion}"></td>
            <td><input type="text" id="nombre" class="form-control" value="${animal.nombre}"></td>
            <td><input type="text" id="especie" class="form-control" value="${animal.especie}"></td>
            <td><input type="text" id="raza" class="form-control" value="${animal.raza}"></td>
            <td><input type="text" id="genero" class="form-control" value="${animal.genero}"></td>
            <td><input type="text" id="condiciones" class="form-control" value="${animal.condiciones}"></td>
            <td><input type="text" id="vacunas" class="form-control" value="${animal.vacunas}"></td>
            <td><input type="text" id="estado" class="form-control" value="${animal.estado}"></td>
            <td><input type="date" id="ingreso" class="form-control" value="${animal.ingreso}"></td>
        </tr>
    `;
})
                .catch(error => console.error("Error:", error));
            }

            // [IMPORTANTE] Ejecutar la función
            cargarDatos();

            // 2. ESCUCHAR EL FORMULARIO
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
                datos.append('id', idAnimal);
                datos.append('clasificacion', document.querySelector('#clasificacion').value);
                datos.append('nombre', document.querySelector('#nombre').value);
                datos.append('especie', document.querySelector('#especie').value);
                datos.append('raza', document.querySelector('#raza').value);
                datos.append('genero', document.querySelector('#genero').value);
                datos.append('condiciones', document.querySelector('#condiciones').value);
                datos.append('vacunas', document.querySelector('#vacunas').value);
                datos.append('estado', document.querySelector('#estado').value);
                datos.append('ingreso', document.querySelector('#ingreso').value);

                fetch('../../app/controllers/Animales.controller.php', {
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