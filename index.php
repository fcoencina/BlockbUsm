
<?php include("template/cabecera.php");?>

<?php

if($_POST){#Si hay un envío POST, redireccionare a un lugar con header()
    $usuario = (isset($_POST["user"]))?$_POST["user"]:"";
    $password = (isset($_POST["password"]))?$_POST["password"]:"";

    #Conexión a la base de datos
    include("db.php");
    $SQL_sentence = $conexion->prepare("SELECT * FROM usuarios WHERE nombre=:nombre and pswd=:pswd");
    $SQL_sentence->bindparam(":nombre", $usuario);
    $SQL_sentence->bindparam(":pswd", $password);
    $SQL_sentence->execute();
    $user = $SQL_sentence->fetch(pdo::FETCH_LAZY);

    if($user == false){
        echo "Usuario no registrado...";
    }
    else{
        session_start();
        $_SESSION["usuario"] = $usuario;
        $_SESSION["pswd"] = $password;
        $_SESSION["id_user"] = $user["id"];
        header("Location:login/index.php");
    }
}
?>

<div class="container">
        <div class="row">
            <div class="col-md-4">
            </div>
            <div class="col-md-5">
              <br><br><br>
                <div class="card">
                    <div class="card-header">
                        Login
                    </div>
                    <div class="card-body">
                        <form method="POST">
                            <div class = "form-group">
                                <label for="user">Usuario</label>
                                <input type="text" class="form-control" name="user" placeholder="Ingrese usuario">
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="password">Contraseña</label>
                                <br>
                                <input type="password" class="form-control" name="password" placeholder="Ingrese contraseña">
                            </div>
                            <br>
                            <small id="emailHelp" class="form-text text-muted">Nunca compartiremos tus datos con nadie.</small>
                            <br><br>
                            <button type="submit" class="btn btn-primary">Iniciar sesión</button>
                            <a class="btn btn-primary" href="registro.php" role="button">Registrarse</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


<?php include("template/pie.php");?>