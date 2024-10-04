
<?php include("template/cabecera.php");?>

<?php include("../db.php");

session_start();
error_reporting(0);

$SQL_sentence = $conexion->prepare("SELECT * FROM wishlist WHERE fk_userID=:id_user");
$SQL_sentence->bindparam(":id_user", $_SESSION["id_user"]);
$SQL_sentence->execute();
$mi_wish = $SQL_sentence->fetchAll(pdo::FETCH_ASSOC);
?>

<?php 
    if(empty($mi_wish)){
        echo "No tiene películas en su wishlist";
    }
    else{
        foreach ($mi_wish as $movie){
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
            <form action="delete_wish.php" method="post">
                <button name="peli_id" value="<?php echo $film["id"]?>" type="submit" class="btn btn-primary">Quitar de Wishlist</button>
            </form>
        </div>
    </div>
</div>
<?php }}?>

<?php include("template/pie.php");?>