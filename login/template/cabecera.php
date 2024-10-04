
<?php include("../db.php");

session_start();
error_reporting(0);

$SQL_sentence = $conexion->prepare("SELECT * FROM usuarios WHERE id=:id_usuario;");
$SQL_sentence->bindparam(":id_usuario", $_SESSION["id_user"]);
$SQL_sentence->execute();
$user = $SQL_sentence->fetch(pdo::FETCH_LAZY);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"/>
    <link rel="icon" href="../img/AnyConvlogo.png"/>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
                <img src="../img/AnyConvlogo.png" width="50px"/>
            </li>
            <li class="nav-item">
            <a class="nav-link"><?php echo $_SESSION["usuario"];?>($<?php echo $user["saldo"];?>)</a>
            </li>
            <div class="dropdown open">
                <button class="btn btn-primary dropdown-toggle" type="button" id="triggerId" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Mi cuenta
                </button>
                <div class="dropdown-menu" aria-labelledby="triggerId">
                    <a class="dropdown-item" href="./miperfil.php">Editar perfil</a>
                    <a class="dropdown-item" href="./mispelis.php">Mis películas</a>
                    <a class="dropdown-item" href="./wishlist.php">Mi Wishlist</a>
                    <a class="dropdown-item" href="./misfavs.php">Mis favoritos</a>
                    <a class="dropdown-item" href="./reseñas.php">Mis reseñas</a>
                    <a class="dropdown-item" href="./seguidores.php">Seguidores</a>
                    <a class="dropdown-item" href="./seguidos.php">Seguidos</a>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="./Cerrar_sesion.php">Cerrar sesión</a></li>
                </div>
            </div>
            <li class="nav-item">
                <a class="nav-link" href="./index.php">Inicio</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="./peliculas.php">Películas</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="./tops.php">Tops</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="./show_gente.php">Conocer usuarios</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="./nosotros.php">BlockbUsm</a>
            </li>
        </ul>
        <form class="d-flex" role="search" method="POST" action="search.php">
            <input name="mibusqueda" class="form-control me-2" type="text" placeholder="Búsqueda" aria-label="Search">
            <button  class="btn btn-outline-success" type="submit">Search</button>
        </form>
    </nav>
    <div class="container">
        <br>
        <div class="row">