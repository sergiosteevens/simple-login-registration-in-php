 <!-- dentro del database voy a conectarme a la base de datos 
 localhost/myadmin administrador de base datos a traves de mysql 
y no muestra una interfaz para crear nuestra base de datos
le damos en base de datos
y debajo de crear base de datos
En el cotejamiento , es decir,que tanto la codificacion de caracteres 
en este caso utf8mbi_unicode_ci
ademas le ponemos un nombre, que tenemos que guardar para ponerlo en database.php
y le damos en crear
ahora vamos a crear una tabla
de tres filas
en nombre de la tabla le coloco users
y pongo 3 columnas, le doy en continuar
vamos a ingresarle
nombre=id tipo=int A_I=si indice=PRIMARY
nombre=email tipo=VARCHAR longitud=200
nombre=password tipo=VARCHAR Longitud=200,
y le damos en guardar -->
<?php
//vamos a definir la conexion
/*creamos una variable llamada server en la que almacenaremos el nobre de la base de datos 
username en ete caso es root password y lo dejamos sin contrasena 
creamos la vaariable database y le ponemos el nombre de la base de datos que pusimos en mySQL*/
    $server ='localhost';
    $username = 'root';
    $password = '';
    //en este caso coloco login_database
    $database = 'login_database';

    //vamos a intentar conectarnos
    //usamos un try catch
    //creamoa la variable $conn en la que vamos a decir atraves de PDO conectarnos a mysql,y le vamos a decir el host osea el server,
    //bien vamos a decirle que el nombre de la base de datos dbname esigual a la variable $database,
    //y luego vamos a pasarle los parametros de conexion fuera del parentesis con una coma en este caso $username, $password
    try {
        //en una variable $conn nos va almacenar la conexion a la base de datos
        $conn = new PDO("mysql:host=$server;dbname=$database;", $username, $password);
        //en caso contrario que nos muestre a traves de PDOException el error y que no s lo muestre a traves de la variable $e 
    } catch(PDOException $e) {
        //vamos a decirle si obtiene un error que acabe con el proceso y le diga Connected failed y luego que lo concatene cone error entonces le hacemos un punto y que lo concatene con el error en su metodo getMessage ahora vamos a ver si tenemos un error o no
        die('Connected failed: '.$e->getMessage());
        //vamos a guardarlo y requerirlo en nuestro archivo
    }
?>