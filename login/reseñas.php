
<?php include("template/cabecera.php");?>

<?php include("../db.php");

session_start();
error_reporting(0);

$SQL_sentence = $conexion->prepare("SELECT * FROM mispelis WHERE fk_userID=:id_user");
$SQL_sentence->bindparam(":id_user", $_SESSION["id_user"]);
$SQL_sentence->execute();
$misfilms = $SQL_sentence->fetchAll(pdo::FETCH_ASSOC);

?>

<?php 
    if(empty($misfilms)){
        echo "No tiene películas arrendadas";
    }
    else{
        $SQL_sentence2 = $conexion->prepare("SELECT * FROM reseñas WHERE fk_userID=:id_user");
        $SQL_sentence2->bindparam(":id_user", $_SESSION["id_user"]);
        $SQL_sentence2->execute();
        $misreseñas = $SQL_sentence2->fetchAll(pdo::FETCH_ASSOC);

        if(empty($misreseñas)){
            echo "No ha realizado reseñas";
        }
        else{
            foreach (array_reverse($misreseñas) as $reseña){
                $SQL_sentence3 = $conexion->prepare("SELECT * FROM peliculas WHERE id=:id_film");
                $SQL_sentence3->bindparam(":id_film", $reseña["fk_filmID"]);
                $SQL_sentence3->execute();
                $film = $SQL_sentence3->fetch(pdo::FETCH_LAZY);
?>
<div class="col-md-3">
    <div class="card">
        <img class="card-img-top" src="../img/<?php echo $film["imagen"];?>.webp" alt="">
        <div class="card-body">
            <h4 class="card-title"><?php echo $reseña["calificación"];?></h4>
            <p class="card-text"><?php echo $reseña["comentario"];?></p>
        </div>
    </div>
</div>
<?php }}}?>

<?php include("template/pie.php");?>