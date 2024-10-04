
<?php include("../template/cabecera.php");?>
<?php
#Recibiendo...
$txtID = (isset($_POST["txtID"]))?$_POST["txtID"]:"";
$txtName = (isset($_POST["txtName"]))?$_POST["txtName"]:"";
$txtImage = (isset($_FILES["txtImage"]["name"]))?$_FILES["txtImage"]["name"]:"";
$accion = (isset($_POST["accion"]))?$_POST["accion"]:"";

include("../config/db.php");

switch($accion){
    case "Agregar":
        #INSERT INTO `productos` (`id`, `nombre`, `imagen`) VALUES (NULL, 'Libro de PHP', 'imagen.jpg');
        $SQL_sentence = $conexion->prepare("INSERT INTO productos (nombre, imagen) VALUES (:nombre, :imagen);");
        $SQL_sentence->bindparam(":nombre", $txtName);

        #Adjuntar imagen
        /*Creamos una fecha. Esto es importante porque imagina que se suben 2 imágenes con
        el mismo nombre, debemos utilizar las fechas para que los nuevos nombres de las 
        imagenes no coincidan. Si subo una "mifoto.jpg" y después otro usuario sube una con el 
        mismo nombre, pues este se va sobreescribir.
        */
        $fecha = new DateTime();
        $nombre_arch = ($txtImage != "")?$fecha->getTimestamp()."_".$_FILES["txtImage"]["name"]:"imagen.jpg";

        $tmp_Image = $_FILES["txtImage"]["tmp_name"];

        if($tmp_Image != ""){
            move_uploaded_file($tmp_Image, "../../img/".$nombre_arch);
        }

        $SQL_sentence->bindparam(":imagen", $nombre_arch);
        $SQL_sentence->execute();
        #echo "Presionando botón Agregar";
        break;
    case "Modificar":
        #echo "Presionando botón Modificar";
        $SQL_sentence = $conexion->prepare("UPDATE Productos SET nombre=:nombre WHERE id=:id");
        $SQL_sentence->bindparam(":nombre", $txtName);
        $SQL_sentence->bindparam(":id", $txtID);
        $SQL_sentence->execute();

        if($txtImage != ""){
            $fecha = new DateTime();
            $nombre_arch = ($txtImage != "")?$fecha->getTimestamp()."_".$_FILES["txtImage"]["name"]:"imagen.jpg";

            $tmp_Image = $_FILES["txtImage"]["tmp_name"];
            move_uploaded_file($tmp_Image, "../../img/".$nombre_arch);

            $SQL_sentence = $conexion->prepare("SELECT * FROM Productos WHERE id=:id");
            $SQL_sentence->bindparam(":id", $txtID);
            $SQL_sentence->execute();
            $list_Producto = $SQL_sentence->fetch(pdo::FETCH_LAZY);

            if(isset($list_Producto["imagen"]) && ($list_Producto["imagen"] != "imagen.jpg")){
                if(file_exists("../../img/".$list_Producto["imagen"])){
                    #Borramos la imágen con unlink()
                    unlink("../../img/".$list_Producto["imagen"]);
                }
            }

            $SQL_sentence = $conexion->prepare("UPDATE Productos SET imagen=:imagen WHERE id=:id");
            $SQL_sentence->bindparam(":imagen", $nombre_arch);
            $SQL_sentence->bindparam(":id", $txtID);
            $SQL_sentence->execute();
        }
        break;
    case "Seleccionar":
        #echo "Presionando botón Seleccionar";
        $SQL_sentence = $conexion->prepare("SELECT * FROM Productos WHERE id=:id");
        $SQL_sentence->bindparam(":id", $txtID);
        $SQL_sentence->execute();
        $list_Producto = $SQL_sentence->fetch(pdo::FETCH_LAZY);
        $txtName = $list_Producto["nombre"];
        $txtImage = $list_Producto["imagen"];
        break;
    case "Borrar":
        #echo "Presionando botón Borrar";

        $SQL_sentence = $conexion->prepare("SELECT * FROM Productos WHERE id=:id");
        $SQL_sentence->bindparam(":id", $txtID);
        $SQL_sentence->execute();
        $list_Producto = $SQL_sentence->fetch(pdo::FETCH_LAZY);

        if(isset($list_Producto["imagen"]) && ($list_Producto["imagen"] != "imagen.jpg")){
            if(file_exists("../../img/".$list_Producto["imagen"])){
                #Borramos la imágen con unlink()
                unlink("../../img/".$list_Producto["imagen"]);
            }
        }

        $SQL_sentence = $conexion->prepare("DELETE FROM Productos WHERE id=:id");
        $SQL_sentence->bindparam(":id", $txtID);
        $SQL_sentence->execute();
        
        break;
}

$SQL_sentence = $conexion->prepare("SELECT * FROM Productos");
$SQL_sentence->execute();
$list_Productos = $SQL_sentence->fetchAll(pdo::FETCH_ASSOC);
?>

<div class="col-md-5">
    <div class="card">

        <div class="card-header"> 
            Datos de Libro
        </div>
 
        <div class="card-body">
            <form method="POST" enctype="multipart/form-data" >

            <div class = "form-group">
            <label for="txtID">ID</label>
            <input type="text" class="form-control" value="<?php echo $txtID;?>" name="txtID" id="txtID" aria-describedby="emailHelp">
            </div>

            <div class = "form-group">
            <label for="txtName">Name</label>
            <input type="text" class="form-control" value="<?php echo $txtName;?>" name="txtName" id="txtName" aria-describedby="emailHelp">
            </div>

            <div class = "form-group">
            <label for="txtImage">Image</label>
            <?php echo $txtImage;?>
            <input type="file" class="form-control" name="txtImage" id="txtImage" aria-describedby="emailHelp">
            </div>

            <div class="btn-group" role="group" aria-label="">
                <button type="submit" name="accion" value="Agregar" class="btn btn-success">Agregar</button>
                <button type="submit" name="accion" value="Modificar" class="btn btn-warning">Modificar</button>
                <button type="submit" name="accion" value="Cancelar" class="btn btn-info">Cancelar</button>
            </div>

            </form>
        </div>
    </div>
    
</div>

<div class="col-md-7">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Image</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($list_Productos as $producto){?>
            <tr>
                <td><?php echo $producto["id"]?></td>
                <td><?php echo $producto["nombre"]?></td>
                <td>
                    <img src="../../img/<?php echo $producto["imagen"];?>" widht="40px" height="40px"alt="" srcset="">
                    <!--<td>echo $producto["imagen"];?></td>-->
                <td>
                    <form method="post">
                        <input type="hidden" name="txtID" id="txtID" value="<?php echo $producto["id"];?>"/>
                        <input type="submit" name="accion" value="Seleccionar" class="btn btn-primary"/>
                        <input type="submit" name="accion" value="Borrar" class="btn btn-danger"/>
                    </form>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
<?php include("../template/pie.php");?>