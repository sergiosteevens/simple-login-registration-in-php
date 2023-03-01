<!-- vamos a comprobar primero si existe esa variable de sesion que se registre o login -->
<?php
    //vamos iniciar la session
    session_start();

    //vamos a tener que comprobar que el id almacenado en esta sesion esta dentro de la base datos
    require 'database.php';

    // si existe la variable user_id dentro de $_SESSIOn vamos a realizar una consulta a la base de datos
    if(isset($_SESSION['user_id'])) {
        $records = $conn->prepare('SELECT id, user, email, password FROM users WHERE id = :id');
        $records->bindParam(':id', $_SESSION['user_id']);
        $records->execute();
        $results = $records->fetch(PDO::FETCH_ASSOC);

        $user = null;

        if(count($results) > 0) {
            $user = $results;
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to your App</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">

<link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <!-- <header> -->
        <!-- vamos a enviarlo a la ruta principal,para no configurar o cambiar nada-->
        <!-- <a href="/php-login">Your Name App</a>
    </header> -->
    <!-- vamos a llamar el header con require -->
    <?php require 'partials/header.php'?>
    <div id='section-1'>

    <?php if(!empty($user)):?>
        <br>Welcome, <?= $user['user']; ?>
        <br>You are Succesfully Logged In
        <a href="logout.php">Logout</a>
        <?php else: ?>

    <div class="container">
        <div class="center">        
    <h1>Please Login or Sign Up</h1>
    
    <hr>
<!-- creamos los links para que pueda acceder a una interfaz u otra login y sign up -->
    <br>
    <a href="login.php">Login</a> or
    <a href="signup.php">Sign Up</a>
    <?php endif;?>
    </div>
</div>


</div>
</body>
</html>