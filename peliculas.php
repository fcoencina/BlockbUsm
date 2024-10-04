
<?php include("template/cabecera.php");?>
<?php include("db.php");

$SQL_sentence = $conexion->prepare("SELECT * FROM peliculas");
$SQL_sentence->execute();
$movies = $SQL_sentence->fetchAll(pdo::FETCH_ASSOC);

?>

<?php foreach ($movies as $movie){?>
<div class="col-md-3">
    <div class="card">
        <img class="card-img-top" src="img/<?php echo $movie["imagen"];?>.webp" alt="">
        <div class="card-body">
            <h4 class="card-title"><?php echo $movie["nombre"];?></h4>
            <!--<p class="card-text">Thomas Shelby</p>-->
            <form action="ver_mas.php" method="post">
                <button name="id" type="submit" class="btn btn-primary" value="<?php echo $movie["id"];?>">
                    Ver más
                </button>
            </form>
        </div>
    </div>
</div>
<?php } ?>

<?php include("template/pie.php");?>