
<?php include("template/cabecera.php");?>
<?php include("../db.php");?>

<?php

session_start();
error_reporting(0);

$seguido_id = (isset($_REQUEST["iduser"]))?$_REQUEST["iduser"]:"";

$SQL_sentence = $conexion->prepare("SELECT * FROM usuarios_seguidores WHERE fk_userID=:id_user and fk_segID=:id_seg;");
$SQL_sentence->bindparam(":id_user", $_SESSION["id_user"]);
$SQL_sentence->bindparam(":id_seg", $seguido_id);
$SQL_sentence->execute();
$seguido = $SQL_sentence->fetch(pdo::FETCH_LAZY);

if($seguido == false){
    #Ir a buscar el seguido.
    $SQL_sentence2 = $conexion->prepare("SELECT * FROM usuarios WHERE id=:id_seg;");
    $SQL_sentence2->bindparam(":id_seg", $seguido_id);
    $SQL_sentence2->execute();
    $user_seg = $SQL_sentence2->fetch(pdo::FETCH_LAZY);

    #Updatear el n_seguidores del seguido en usuarios.
    $cont = $user_seg["n_seguidores"] + 1;
    $SQL_sentence3 = $conexion->prepare("UPDATE usuarios
    SET n_seguidores=:actualizado WHERE id=:id_seg;");
    $SQL_sentence3->bindparam(":id_seg", $seguido_id);
    $SQL_sentence3->bindparam(":actualizado", $cont);
    $SQL_sentence3->execute();

    #Ir a buscar el seguidor
    $SQL_sentence4 = $conexion->prepare("SELECT * FROM usuarios WHERE id=:id_user;");
    $SQL_sentence4->bindparam(":id_user", $_SESSION["id_user"]);
    $SQL_sentence4->execute();
    $seguidor = $SQL_sentence4->fetch(pdo::FETCH_LAZY);

    #Updatear el nc_seguidas del seguidor en usuarios.
    $cont2 = $seguidor["nc_seguidas"] + 1;
    $SQL_sentence5 = $conexion->prepare("UPDATE usuarios
    SET nc_seguidas=:actualizado WHERE id=:id_user;");
    $SQL_sentence5->bindparam(":id_user", $_SESSION["id_user"]);
    $SQL_sentence5->bindparam(":actualizado", $cont2);
    $SQL_sentence5->execute();

    #Insertar en usuarios_seguidores.
    $SQL_sentence6 = $conexion->prepare("INSERT INTO usuarios_seguidores (fk_userID, fk_segID) 
    VALUES (:id_user, :id_seg);");
    $SQL_sentence6->bindparam(":id_user", $_SESSION["id_user"]);
    $SQL_sentence6->bindparam(":id_seg", $seguido_id);
    $SQL_sentence6->execute();
    header("Location:seguidos.php");
}
else{
    echo "Usted ya sigue a este usuario";
}

?>


<?php include("template/pie.php");?>