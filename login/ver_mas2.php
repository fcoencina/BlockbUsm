
<?php include("template/cabecera.php");?>
<?php include("../db.php");

session_start();
error_reporting(0);

$accion = (isset($_REQUEST["accion"]))?$_REQUEST["accion"]:"";

switch($accion){
    case "arrendar":
        $SQL_sentence2pre = $conexion->prepare("SELECT * FROM mispelis WHERE fk_userID=:id_user 
        AND fk_filmID=:id_film;");
        $SQL_sentence2pre->bindparam(":id_user", $_SESSION["id_user"]);
        $SQL_sentence2pre->bindparam(":id_film", $_SESSION["id_film"]);
        $SQL_sentence2pre->execute();
        $movie = $SQL_sentence2pre->fetch(pdo::FETCH_LAZY);
        if($movie == false){
            $SQL_sentence2 = $conexion->prepare("INSERT INTO mispelis (fk_userID, fk_filmID) VALUES (:id_user, :id_film);");
            $SQL_sentence2->bindparam(":id_user", $_SESSION["id_user"]);
            $SQL_sentence2->bindparam(":id_film", $_SESSION["id_film"]);
            $SQL_sentence2->execute();

            $SQL_sentence21pre = $conexion->prepare("SELECT * FROM peliculas WHERE id=:id_film;");
            $SQL_sentence21pre->bindparam(":id_film", $_SESSION["id_film"]);
            $SQL_sentence21pre->execute();
            $movie_consult = $SQL_sentence21pre->fetch(pdo::FETCH_LAZY);
            $update_disp = $movie_consult["ejem_disp"] - 1;
            $update_rent = $movie_consult["veces_rent"]+1;

            $SQL_sentence21 = $conexion->prepare("UPDATE peliculas 
            SET ejem_disp=:value1, veces_rent=:value2 WHERE id=:id_peli;");
            $SQL_sentence21->bindparam(":value1", $update_disp);
            $SQL_sentence21->bindparam(":value2", $update_rent);
            $SQL_sentence21->bindparam(":id_peli", $_SESSION["id_film"]);
            $SQL_sentence21->execute();

            $SQL_sentence22pre = $conexion->prepare("SELECT * FROM usuarios WHERE id=:id_usuario;");
            $SQL_sentence22pre->bindparam(":id_usuario", $_SESSION["id_user"]);
            $SQL_sentence22pre->execute();
            $user = $SQL_sentence22pre->fetch(pdo::FETCH_LAZY);
            $update_saldo = $user["saldo"] - $movie_consult["precio"];

            $SQL_sentence22 = $conexion->prepare("UPDATE usuarios 
            SET saldo=:value1 WHERE id=:id_usuario;");
            $SQL_sentence22->bindparam(":value1", $update_saldo);
            $SQL_sentence22->bindparam(":id_usuario", $_SESSION["id_user"]);
            $SQL_sentence22->execute();

            header("Location:mispelis.php");
        }
        else{
            echo "La película seleccionada ya se encuentra arrendada";
        }
        break;
    case "agregarw":
        $SQL_sentence3pre = $conexion->prepare("SELECT * FROM wishlist WHERE fk_userID=:id_user 
        AND fk_filmID=:id_film;");
        $SQL_sentence3pre->bindparam(":id_user", $_SESSION["id_user"]);
        $SQL_sentence3pre->bindparam(":id_film", $_SESSION["id_film"]);
        $SQL_sentence3pre->execute();
        $movie = $SQL_sentence3pre->fetch(pdo::FETCH_LAZY);
        if($movie == false){
            $SQL_sentence3 = $conexion->prepare("INSERT INTO wishlist (fk_userID, fk_filmID) VALUES (:id_user, :id_film);");
            $SQL_sentence3->bindparam(":id_user", $_SESSION["id_user"]);
            $SQL_sentence3->bindparam(":id_film", $_SESSION["id_film"]);
            $SQL_sentence3->execute();
            header("Location:wishlist.php");
        }
        else{
            echo "La película seleccionada ya se encuentra en su Wishlist";
        }
        break;
    case "agregarf":
        $SQL_sentence4pre = $conexion->prepare("SELECT * FROM misfav WHERE fk_userID=:id_user 
        AND fk_filmID=:id_film;");
        $SQL_sentence4pre->bindparam(":id_user", $_SESSION["id_user"]);
        $SQL_sentence4pre->bindparam(":id_film", $_SESSION["id_film"]);
        $SQL_sentence4pre->execute();
        $movie = $SQL_sentence4pre->fetch(pdo::FETCH_LAZY);
        if($movie == false){
            $SQL_sentence4 = $conexion->prepare("INSERT INTO misfav (fk_userID, fk_filmID) VALUES (:id_user, :id_film);");
            $SQL_sentence4->bindparam(":id_user", $_SESSION["id_user"]);
            $SQL_sentence4->bindparam(":id_film", $_SESSION["id_film"]);
            $SQL_sentence4->execute();
            header("Location:misfavs.php");
        }
        else{
            echo "La película seleccionada ya se encuentra en sus favoritos";
        }
        break;  
    case "devolver":
        $SQL_sentence5 = $conexion->prepare("DELETE FROM mispelis WHERE fk_userID=:id_user and fk_filmID=:id_film");
        $SQL_sentence5->bindparam(":id_user", $_SESSION["id_user"]);
        $SQL_sentence5->bindparam(":id_film", $_SESSION["id_film"]);
        $SQL_sentence5->execute();

        $SQL_sentence51pre = $conexion->prepare("SELECT * FROM peliculas WHERE id=:id_film;");
        $SQL_sentence51pre->bindparam(":id_film", $_SESSION["id_film"]);
        $SQL_sentence51pre->execute();
        $movie_consult = $SQL_sentence51pre->fetch(pdo::FETCH_LAZY);
        $update_disp = $movie_consult["ejem_disp"] + 1;

        $SQL_sentence51 = $conexion->prepare("UPDATE peliculas 
        SET ejem_disp=:value1 WHERE id=:id_peli;");
        $SQL_sentence51->bindparam(":value1", $update_disp);
        $SQL_sentence51->bindparam(":id_peli", $_SESSION["id_film"]);
        $SQL_sentence51->execute();

        header("Location:mispelis.php");
        break;
}
?>

<?php include("template/pie.php");?>