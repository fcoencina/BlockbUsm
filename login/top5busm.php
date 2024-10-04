
<?php include("template/cabecera.php");?>
<?php include("../db.php");?>

<?php

$SQL_sentence = $conexion->prepare("SELECT * FROM peliculas ORDER BY cm_usmtomatoes DESC;");
$SQL_sentence->execute();
$top5 = $SQL_sentence->fetchAll(pdo::FETCH_ASSOC);
$cont = 1;

?>
<?php foreach ($top5 as $movie){
    if($cont != 6){ ?>
        <div class="col-md-3">
            <div class="card">
                <?php echo $cont;?>
                <img class="card-img-top" src="../img/<?php echo $movie["imagen"];?>.webp" alt="">
                <div class="card-body">
                    <h4 class="card-title"><?php echo $movie["nombre"];?></h4>
                    <p class="card-text"><?php echo $movie["cm_usmtomatoes"];?></p>
                    <form action="ver_mas.php" method="post">
                        <button name="id" type="submit" class="btn btn-primary" value="<?php echo $movie["id"];?>">
                            Ver más
                        </button>
                    </form>
                </div>
            </div>
        </div>
<?php $cont += 1;} }?>

<?php include("template/pie.php");?>