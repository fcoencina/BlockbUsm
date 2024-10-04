
<?php include("template/cabecera.php");?>
<?php include("../db.php");?>

<?php

$id_pelicula = (isset($_REQUEST["peli_id"]))?$_REQUEST["peli_id"]:"";
$calificacion = (isset($_REQUEST["cal"]))?$_REQUEST["cal"]:"";
$comentario = (isset($_REQUEST["comment"]))?$_REQUEST["comment"]:"";


if(($calificacion != "")){
    $SQL_sentence = $conexion->prepare("SELECT * FROM reseñas WHERE fk_userID=:id_user and fk_filmID=:id_movie");
    $SQL_sentence->bindparam(":id_user", $_SESSION["id_user"]);
    $SQL_sentence->bindparam(":id_movie", $id_pelicula);
    $SQL_sentence->execute();
    $reseña = $SQL_sentence->fetch(pdo::FETCH_LAZY);

    if($reseña == false){
        $SQL_sentence2 = $conexion->prepare("INSERT INTO reseñas (fk_userID, fk_filmID, calificación, comentario) 
        VALUES (:id_user, :id_movie, :cal, :comment);");
        $SQL_sentence2->bindparam(":id_user", $_SESSION["id_user"]);
        $SQL_sentence2->bindparam(":id_movie", $id_pelicula);
        $SQL_sentence2->bindparam(":cal", $calificacion);
        $SQL_sentence2->bindparam(":comment", $comentario);
        $SQL_sentence2->execute();
        header("Location:reseñas.php");
    }
    else{
        echo "Usted ya ingreso una reseña en esta película";
    }
}

?>

<?php include("template/pie.php");?>