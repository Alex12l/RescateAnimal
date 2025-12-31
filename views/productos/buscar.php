<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscador</title>
    <!-- Estilos boostrap -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
  
  <!-- Iconos de bootstrap -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
</head>
<body>
   
    <div class="container mt-3">
             <div class="p-3 mb-2 bg-info text-dark"> <h1>Buscador</h1></div>
         <a href="./listar.php" class = "btn btn-sm btn-primary"><i class="bi bi-table"></i> Listar</a>
         <hr>
        <h3>Busqueda por ID</h3>
        <form action="" id="form-busqueda-1">
            <div class="mb-3">
                <label for="idbuscado">ID Buscado</label>
                <div class="input-group">
                    <span class="input-group-text">Escriba solo números</span>
                    <input type="text" class="form-control" id="idbuscado">
                    <button class="btn btn-success" type="submit"><i class="bi bi-search"></i>Buscar</button>
                </div>
            </div>

            <div>
                <label for="descripcion">Descripción de la busqueda</label>
            </div>
            <table class="table table-bordered mt-3" id="tabla-descripcion-id">
                <thead>
                    <tr>
                    <th>Clasifiacion</th>
                    <th>Nombre</th>
                    <th>Especie</th>
                    <th>Raza</th>
                    <th>Genero</th>
                    <th>Condiciones</th>
                    <th>Vacunas</th>
                    <th>Estado</th>
                    <th>Ingreso</th>
                    <th>Foto</th>
                    </tr>
                </thead>
                <tbody></tbody>

            </table>
        </form>
        <hr>

         <h3>Busqueda por estado</h3>
         <form action="" id="form-busqueda-2">
            <div>
                <label for="estados">Estado de consulta</label>
            <div class="input-group">
                <select id="estado" class="form-select">
                    <option value="">Seleccione un estado</option>
                    <option value="Disponible">Disponible</option>
                    <option value="Adoptado">Adoptado</option>
                    <option value="En tratamiento">En tratamiento</option>
                </select>
                <button class="btn btn-success" type="submit"><i class="bi bi-search"></i>Buscar</button>
            </div>
        </div>
         </form>

         <table class="table table-bordered mt-3" id="tabla-descripcion">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Clasifiacion</th>
                    <th>Nombre</th>
                    <th>Especie</th>
                    <th>Raza</th>
                    <th>Genero</th>
                    <th>Condiciones</th>
                    <th>Vacunas</th>
                    <th>Estado</th>
                    <th>Ingreso</th>
                    <th>Foto</th>
                </tr>
            </thead>
            <tbody></tbody>
         </table>

    </div>
    <script>
        //pedimos al navegador que espere al HTML antes de ejecutar el codigo
        document.addEventListener("DOMContentLoaded", function(){
            //Creamos la funcion buscarAnimalID
            function buscarAnimalID(){
                //creamos un contenedor
                const datos = new FormData()
                //LE damos los datos que debe buscar
                //LE decimos al servidor que queremos hacer
                datos.append("operacion", "buscarPorID")
                //Le damos el dato con el que debe trabajar (buscar)
                datos.append("id", document.querySelector("#idbuscado").value)

                //le damos la ruta
                fetch(`../../app/controllers/Animales.controller.php`, {
                    method: 'POST',
                    body: datos
                })
                //LE decimos que hacer luego de extraer los datos
                .then(response => response.json())
                .then(data => {
                    if(data){
                        document.querySelector("#tabla-descripcion-id tbody").innerHTML = ""

                        data.forEach(element => {
                            document.querySelector("#tabla-descripcion-id tbody").innerHTML += `
                            <tr>
                            <td>${element.id}</td>
                            <td>${element.clasificacion}</td>
                            <td>${element.nombre}</td>
                            <td>${element.especie}</td>
                            <td>${element.raza}</td>
                            <td>${element.genero}</td>
                            <td>${element.Condiciones}</td>
                            <td>${element.vacunas}</td>
                            <td>${element.estado}</td>
                            <td>${element.ingreso}</td>
                            <td>
                            <img src="/animal/public/images/${element.foto}" 
                             width="80" 
                            class="img-thumbnail">
                            </td>
                            </tr>
                            `

                        });

                    }
                })
                .catch(error => {
                     console.log("error")
                })
            }

            function buscarAnimalEstado(){
                //creamos un contenedor
                const datos = new FormData()
                //LE damos los datos que debe buscar
                //LE decimos al servidor que queremos hacer
                datos.append("operacion", "buscarPorEstado")
                //Le damos el dato con el que debe trabajar (buscar)
                datos.append("estado", document.querySelector("#estado").value)

                //le damos la ruta del controlador
                fetch(`../../app/controllers/Animales.controller.php`, {
                    method: 'POST',
                    body: datos
                })
                .then(response => response.json())
                .then(data => {
                    if(data){
                        //Contiene datos
                        document.querySelector("#tabla-descripcion tbody").innerHTML = ""


                        data.forEach(element => {
                            document.querySelector("#tabla-descripcion tbody").innerHTML += `
                            <tr>
                            <td>${element.id}</td>
                            <td>${element.clasificacion}</td>
                            <td>${element.nombre}</td>
                            <td>${element.especie}</td>
                            <td>${element.raza}</td>
                            <td>${element.genero}</td>
                            <td>${element.Condiciones}</td>
                            <td>${element.vacunas}</td>
                            <td>${element.estado}</td>
                            <td>${element.ingreso}</td>
                            <td>
                            <img src="/animal/public/images/${element.foto}" 
                            width="80" 
                            class="img-thumbnail">
                            </td>
                            </tr>
                            `
                        });
                        }
                })
                .catch(error =>{
                    console.log("error")
                })
            }
             document.querySelector("#form-busqueda-1").addEventListener("submit", function(event){
        event.preventDefault()
        buscarAnimalID()
      })
       document.querySelector("#form-busqueda-2").addEventListener("submit", function(event){
        event.preventDefault()
        buscarAnimalEstado()
      })
        })
    </script>
</body>
</html>