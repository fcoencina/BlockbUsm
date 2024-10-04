
<?php include("template/cabecera.php");?>
<?php include("db.php");?>

<?php

$id_movie = $_REQUEST['id'];

$SQL_sentence = $conexion->prepare("SELECT * FROM peliculas WHERE id=:id");
$SQL_sentence->bindparam(":id", $id_movie);
$SQL_sentence->execute();
$movie = $SQL_sentence->fetch(pdo::FETCH_LAZY);

?>

<div class="container">
  <div class="row">
    <div class="col-md-6">
      <div class="card">
        <h4 class="card-title"><?php echo $movie["nombre"];?> - $<?php echo $movie["precio"];?></h4>
        <img class="card-img-top" src="img/<?php echo $movie["imagen"];?>.webp" alt="">
      </div>
    </div>
    <div class="col-md-6">
      <div class="accordion" id="accordionExample">
        <div class="accordion-item">
          <h2 class="accordion-header" id="headingOne">
            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
              Descripción
            </button>
          </h2>
          <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
            <div class="accordion-body">
              <?php echo $movie["descripcion"];?>
            </div>
          </div>
        </div>
        <div class="accordion-item">
          <h2 class="accordion-header" id="headingTwo">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
              Reparto
            </button>
          </h2>
          <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
            <div class="accordion-body">
              <?php echo $movie["reparto"];?>
            </div>
          </div>
        </div>
        <div class="accordion-item">
          <h2 class="accordion-header" id="headingThree">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
              Info. Extra
            </button>
          </h2>
          <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
            <div class="accordion-body">
              Género: <?php echo $movie["genero"];?>
              <br>
              Clasificación: <?php echo $movie["tipo_publico"];?>
              <br>
              Duración: <?php echo $movie["duracion"];?>Min.
              <br>
              Ejemplares disponibles: <?php echo $movie["ejem_disp"];?>
              <br>
              Ejemplares totales: <?php echo $movie["ejem_totales"];?>
              <br>
              Cantidad de veces rentada: <?php echo $movie["veces_rent"];?>
              <br>
              Calificación media BlockbUsm: <?php echo $movie["cm_sitio"];?>
              <br>
              Calificación media UsmTomatoes: <?php echo $movie["cm_usmtomatoes"];?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include("template/pie.php");?>