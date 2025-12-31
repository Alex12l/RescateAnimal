<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Menú Principal</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
</head>
<body>

<div class="container-fluid min-vh-100 d-flex justify-content-center align-items-center">

  <div class="card shadow-lg" style="width: 50rem;">
    <div class="card-header text-center fw-bold p-3 mb-2 bg-info text-dark">
      Sistema de Rescate Animal
    </div>


   <div class="card-body text-center">
  <p class="mb-4">Seleccione el módulo</p>

  <div class="row">
    
  <div class="col-6 d-flex justify-content-center">
    <div class="card" style="width: 18rem;">
        <h5 class="card-title">Registros de Animales</h5>
  <img src="/Animal/public/images/iconAni.png" class="card-img-top" alt="...">
  <div class="card-body">
    <a href="./productos/listar.php" class="btn btn-primary">Ir</a>
  </div>
</div>
</div>


<div class="col-6 d-flex justify-content-center">
    <div class="card" style="width: 18rem;">
        <h5 class="card-title">Registros de Personas</h5>
  <img src="/Animal/public/images/iconPer.png" class="card-img-top" alt="...">
  <div class="card-body">
    <a href="./productos/listarp.php" class="btn btn-primary">Ir</a>
  </div>
</div>
</div>


</div>
  </div>
</div>

</div>

</body>
</html>
