<?php

    $busqueda= $_GET["psearch"];
    
    require("conec.php");

//conección de base de datos por procedimientos.
    $conexion = mysqli_connect($db_host, $db_usuario, $db_pass);

    if (mysqli_connect_errno()) {
        echo "Fallo al conectar con la BBDD";
        exit();
    }
   
//conectarnos a la base de datos.
    mysqli_select_db($conexion, $db_nombre) or die("no se encuentra la BBDD");
    mysqli_set_charset($conexion, "utf8");

    $sql = "select  num_ss, nombre_apellidos, sexo from trabajador where DNI=? ";
   
    $resultado = mysqli_prepare($conexion, $sql); //prepara la consulta
    $ok = mysqli_stmt_bind_param($resultado, "s", $busqueda); //unir parámetros
    $ok= mysqli_stmt_execute($resultado); //ejeutamos la consulta
    
    if($ok=false){
        echo "error al ejecutar la consulta";
    }else{
        $ok=  mysqli_stmt_bind_result($resultado, $num_ss, $nombre_apellidos, $sexo); //asociar variables
        echo "Datos encontrados: <br> <br>";
        
//cuando acceda a un registro que no existe no se ejecuta sera igual a false
    while ($fila = mysqli_stmt_fetch($resultado)) {
        
        echo' <div class="container">
            <br/>
            <div class="row justify-content-center">
                <div class="col-12 col-md-10 col-lg-8">
                    <h1 class="display-2"> Datos Trabajador</h1>
                    <form method="get" action="">
                    <div class="form-group">
                            <label for="exampleFormControlInput1">Número de Seguridad Social</label>';
                    echo " <input type='text' class='form-control' value='" .$num_ss."' name= 'num_ss'>
                    </div>";
                    echo'    <div class="form-group">
                            <label for="exampleFormControlInput1">Nombre y apellidos</label>';
                    echo "<input type='text' class='form-control' id='' value='". $nombre_apellidos ."' name='nombre_apellidos'>
                        </div>
                        <div class='form-group'> ";
                    echo     '  <label for="exampleFormControlSelect1" >Sexo</label>';
                    echo     " <select class='form-control' id='' ' name='sexo'>";       
                    if($sexo = 'H'){
                        echo     " <option>  M </option>";
                        
                    }
                    echo     " <option> " . $sexo.  "</option>";  
                    echo     '   </select>';
            
                    echo    '</div>';
                    echo "    <div class='col-auto'>
                            <button class='btn btn-lg btn-success' type='submit'>Actualizar</button>
                        </div>";
                        
               echo " </div>
                </form>
            </div>
            <!--end of col-->
        </div>";
    echo '</div> ';
    }  
    

        
    }
    

 
    mysqli_close($conexion);


?>
