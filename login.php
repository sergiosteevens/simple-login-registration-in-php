<!-- vamos a hacer el formulario  -->
<?php
    //inicializamos la sesion en caso de que este guardada o creada
    session_start();

    //comprobar
    if(isset($_SESSION['user_id'])) {
        header('Location: /registro_login');
    }

    require 'database.php';

    //vamos a comprrobar el envio de los datos
    if(!empty($_POST['email']) && !empty($_POST['password'])) {
       //una vez que comprobamos que email y password no estan vacios
       //vamos a ejecutar la consulta 
       //prepare el metodo ->prepare sirvew para ejecutar la consulta SQL
    //    donde seleccionamos el nombre id, email y password desde users donde sea igual al parametro que creamos llamado email que no he creado pero que pronto creo
        $records = $conn->prepare('SELECT id, email, password FROM users WHERE email = :email');
    // una vez creado el parametro lo vamos a reemplazar 
    //y vamos a vincular ese parametro email que le pasamos y lo vamos a reemplazar lo que envia el metodo $_POST con ese mismo email
        $records->bindParam(':email', $_POST['email']);
        $records->execute();//ejecutamos la consulta
        //una vez ejecute vamos a tener datos y los ponemos en la variable 
        //$ results utilizando a traves del metodo fetch
        //vamos a obtener los datos de usuario
        $results = $records->fetch(PDO::FETCH_ASSOC);

        // vamos a jugar con los datos creando una variable llamada message
        //cuando se registro y a ocurrido un error vamos a signarlo a esta variable
        $message = '';
        //una ves lo obtenemos vamos a validar si este resultado esta vacio
        //vamos a contar los reultados
        // si la respuesta que obtengo es mayor a cero
        //vamos a vrificar las contrasenas
        //vamos a verificar las contrasenas
        //primero vamos a comparar la contrasenas con results la password de la base de datos, es decir vamos a comparar la contrasena de la base de datos con la contrasena que me esta dando el  usuario
        if (is_countable($results) > 0 && password_verify($_POST['password'], $results['password'])) {
            //una vez ungresen lo asignamos a una memoria en sesion
           //vamos a guardar el id del usuario 
           //de estos results quiero el id
            $_SESSION['user_id'] =  $results['id'];
            //luego cuando ya lo tenga lo redireccionamos
            //a la pagina inicial
            header("Location: /registro_login");
            /*lo que hacemos es si el usuario es correcto almacenarlo en una session 
            y luego redirigirlo a la pagina inicial*/
            // pero esta variable de session tengo que requerir algo arriba y esque tengo que inicializarla a traves de un metodo
        } else {
           /*que pasa si la contrasena no existe o no es correcta y el usuario tampoco
           vamos a decirle */
           $message = 'Sorry, those credentials do not match';
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="assets/css/style.css">

</head>
<body>
<?php require 'partials/header.php'?>

   

    <!-- en caso contrario tenga un error no esta vacio muestrelo a traves de un parrafo-->
    <?php if(!empty($message)):?>
         <p><?= $message?></p>
        <?php endif;?>
<div>
        <h1>Login</h1>

<span>or <a href="signup.php">Sign Up</a></span>

    <form action="login.php" method="post">
        <br>
        Email:
    <input type="text" name="email" placeholder="Enter your Email">
    Password:
    <input type="password" name="password" placeholder="Enter your password">
    <input type="submit" value="Submit">
    </form>
    </div>
</body>
</html>