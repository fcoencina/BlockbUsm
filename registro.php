
<?php include("template/cabecera.php");?>
<?php include("db.php");?>

<?php 

$usuario = (isset($_POST["user"]))?$_POST["user"]:"";
$pswd = (isset($_POST["password"]))?$_POST["password"]:"";
$saldo = (isset($_POST["saldo"]))?$_POST["saldo"]:"";
$desc_per = (isset($_POST["desc_per"]))?$_POST["desc_per"]:"";
$n_seg = 0;
$nc_seg = 0;

if(($usuario != "") and ($pswd != "") and ($saldo != "") and ($desc_per != "")){
    $SQL_sentence = $conexion->prepare("SELECT * FROM usuarios WHERE nombre=:nombre");
    $SQL_sentence->bindparam(":nombre", $usuario);
    $SQL_sentence->execute();
    $user = $SQL_sentence->fetch(pdo::FETCH_LAZY);

    if($user == false){
        $SQL_sentence2 = $conexion->prepare("INSERT INTO usuarios (nombre, pswd, saldo, n_seguidores, nc_seguidas, desc_personal) 
        VALUES (:nombre, :pswd, :saldo, :n_seg, :nc_seg, :descp);");
        $SQL_sentence2->bindparam(":nombre", $usuario);
        $SQL_sentence2->bindparam(":pswd", $pswd);
        $SQL_sentence2->bindparam(":saldo", $saldo);
        $SQL_sentence2->bindparam(":n_seg", $n_seg);
        $SQL_sentence2->bindparam(":nc_seg", $nc_seg);
        $SQL_sentence2->bindparam(":descp", $desc_per);
        $SQL_sentence2->execute();
        header("Location:index.php");
    }
    else{
        echo "El usuario ingresado ya se encuentra registrado, ingrese otro...";
    }
}

?>

<div class="container">
        <div class="row">
            <div class="col-md-4">
            </div>
            <div class="col-md-5">
              <br>
                <div class="card">
                    <div class="card-header">
                        Registrarse
                    </div>
                    <div class="card-body">
                        <form method="POST">
                            <div class = "form-group">
                                <label for="user">Usuario</label>
                                <input type="text" class="form-control" name="user" placeholder="Ingrese usuario">
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="password">Contraseña(5 caracteres máx.)</label>
                                <br>
                                <input type="password" class="form-control" name="password" placeholder="Ingrese contraseña">
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="saldo">Saldo</label>
                                <br>
                                <input type="number" class="form-control" name="saldo" placeholder="Ingrese depósito">
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="desc_per">Descripción personal</label>
                                <br>
                                <input type="text" class="form-control" name="desc_per" placeholder="Ingrese descripcion personal">
                            </div>
                            <br>
                            <small id="emailHelp" class="form-text text-muted">Nunca compartiremos tus datos con nadie.</small>
                            <br><br>
                            <button type="submit" class="btn btn-primary">Registrarse</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


<?php include("template/pie.php");?>