<?php
    require("conec.php");

//conección de base de datos por procedimientos.
    $conexion = mysqli_connect($db_host, $db_usuario, $db_pass);
    $usuario= mysqli_real_escape_string($conexion,$_POST["name_usuario"]);
    $password= mysqli_real_escape_string($conexion,$_POST["password"]);

   
    if (mysqli_connect_errno()) {
        echo "Fallo al conectar con la BBDD";
        exit();
    }
   
//conectarnos a la base de datos.
    mysqli_select_db($conexion, $db_nombre) or die("no se encuentra la BBDD");
    mysqli_set_charset($conexion, "utf8");

    $consulta = "DELETE  from usuarios_login where usuarios='$usuario' and PASSWORD ='$password' ";
    echo $consulta;

    $resultado = mysqli_query($conexion, $consulta);
     if( mysqli_affected_rows($conexion) > 0){
         echo "Baja procesada";
     }else{
         echo "Usuario no encontrado";
     }

    mysqli_close($conexion);


?>
