
<?php include("template/cabecera.php");?>

<?php include("../db.php");

session_start();
error_reporting(0);

$SQL_sentence = $conexion->prepare("SELECT * FROM misfav WHERE fk_userID=:id_user");
$SQL_sentence->bindparam(":id_user", $_SESSION["id_user"]);
$SQL_sentence->execute();
$misfav = $SQL_sentence->fetchAll(pdo::FETCH_ASSOC);

?>

<?php 
    if(empty($misfav)){
        echo "No tiene películas favoritas";
    }
    else{
        foreach ($misfav as $movie){
            $SQL_sentence2 = $conexion->prepare("SELECT * FROM peliculas WHERE id=:id_film");
            $SQL_sentence2->bindparam(":id_film", $movie["fk_filmID"]);
            $SQL_sentence2->execute();
            $film = $SQL_sentence2->fetch(pdo::FETCH_LAZY);
?>
<div class="col-md-3">
    <div class="card">
        <img class="card-img-top" src="../img/<?php echo $film["imagen"];?>.webp" alt="">
        <div class="card-body">
            <h4 class="card-title"><?php echo $film["nombre"];?></h4>
            <!--<p class="card-text">Thomas Shelby</p>-->
        </div>
    </div>
</div>
<?php }}?>

<?php include("template/pie.php");?>