<!-- vamos a crear la conexion a la base de datos-->
<!--tratar de almacenar nuestro datos en nuestro formulario de registro
primero vamos requerir de la base de datos, osea este archivo-->
<?php
    require 'database.php';



    //aqui creamos variable locales ahora vamos a hacer variables globales
    $message = '';

//vamos a agregar los datos, para agregar los datos el formulario de signup tiene todos los campos que hay que llaenar
//y decimos si este campo 'email' no esta vacio y asu vez el otro campo puedo continuar  
if(!empty($_POST['user']) && !empty($_POST['email']) && !empty($_POST['password'])) {
//vamos a agregarli a la base de datos
//anadimos dentro de users email, passsword los valores , los valores los vamos agregar a traves de interpolaciones o digamos :email :password los valores que vamos a reemplazar
    $sql = "INSERT INTO users (user, email, password) VALUES(:user, :email, :password)";
    //y vamos a decirle que esta conexion que tenemos requerida gracias database.php va,os a decirle que vamos a ejecutar de la variable $conn el metodo prepare que ejecuta una consulta sql
    //a traves de la variable sql
    $stmt = $conn->prepare($sql);

    $stmt->bindParam(':user',$_POST['user']);

    //vamos a vincular el email y el password a trves de este $stmt en su metodo bindParm de vincular parametros vamos a pasarle el email a traves del metodo $_POST
    $stmt->bindParam(':email',$_POST['email']);
    //y ahacemos lo mismo con password pero antes guardamos en la variable password para cifrarlas
    //lo que hace esto es a traves del metodo post le enviamos password y le pasamos la opcion en la cual queremos cifrarlo
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $stmt->bindParam(':password',$password);    
    //con esto ya tenemos la base de datos que cifra los datos
    //ahora vamos a probar si esto se ejecuta correctamente
// si esta variable $stmt lo ejecuta imprimimos el memsaje
    if($stmt->execute()) {
        $message = 'Succesfully created new user';
    } else {
        $message = 'Sorry there must have been an issue creating you account';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Sign Up</title>
     <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
<link rel="stylesheet" href="assets/css/style.css">

</head>
<body>
<?php require 'partials/header.php'?>

<!-- //vamos a crear una condicional en la cual atraves de php -->



<?php    if(!empty($message)): ?>
    <!-- <p><php// $message ?></p> -->
    <p><?= $message ?></p>
    <?php endif; ?>

    <!-- <php if(!empty($message)); ?> -->
    <!-- <p><php $message ?></p> -->
 


<h1>SignUp</h1>
 <!--vamos a crear la funcionalidad -->
<!-- creamos un span para que me muestre un pequeno enlace a logearme si tengo otra cuenta -->
<span>or <a href="login.php">Login</a></span>


<form action="signup.php" method="POST">
    <br>
    Username:
    <input name="user" type="text" placeholder="Enter your username">
    Email:
    <input name="email" type="text" placeholder="Enter your email">
    Password:  
    <input name="password" type="password" placeholder="Enter your Password">
    Confirm Password:  
    <input name="confirm_password" type="password" placeholder="Confirm Password">
      <input type="submit" value="Save">
</form>
</body>
</html>