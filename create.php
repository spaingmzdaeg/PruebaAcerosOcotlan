<?php
// Archivo de configuracion
require_once "config.php";
 
// Definir variables vacias
$nombre = $primer_apellido = $segundo_apellido = $rfc = "";
$departamento_id=NULL;
$nombre_err = $primer_apellido_err = $segundo_apellido_err = $rfc_err = "";

// 

// Procesar info del formulario
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validar Nombre
    $input_nombre = trim($_POST["nombre"]);
    if(empty($input_nombre)){
        $nombre_err = "Por favor ingrese el nombre del empleado.";
    } elseif(!filter_var($input_nombre, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $nombre_err = "Por favor ingrese un nombre válido.";
    } else{
        $nombre = $input_nombre;
    }

    // Validar Primer Apellido
    $input_primer_apellido = trim($_POST["primer_apellido"]);
    if(empty($input_primer_apellido)){
        $primer_apellido_err = "Por favor ingrese el apellido del empleado.";
    } elseif(!filter_var($input_primer_apellido, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $primer_apellido_err = "Por favor ingrese un primer apellido válido.";
    } else{
        $primer_apellido = $input_primer_apellido;
    }

    // Validar Segundo Apellido
    $input_segundo_apellido = trim($_POST["segundo_apellido"]);
    if(empty($input_segundo_apellido)){
        $segundo_apellido_err = "Por favor ingrese el segundo apellido del empleado.";
    } elseif(!filter_var($input_segundo_apellido, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $segundo_apellido_err = "Por favor ingrese un segundo apellido válido.";
    } else{
        $segundo_apellido = $input_segundo_apellido;
    }

    // Validar RFC
    $input_rfc = trim($_POST["rfc"]);
    if(empty($input_rfc)){
        $rfc_err = "Por favor ingrese el segundo rfc del empleado.";
    }  else{
        $rfc = $input_rfc;
    }

    
    // Validar departamento
    $departamento_id = trim($_POST["departamento_id"]);
    // Aqui iria el codigo para validar el combo box
    
    // Verificar errores de entrada antes de insertar a la base de datos
    if(empty($nombre_err) && empty($primer_apellido_err) && empty($segundo_apellido_err) && empty($rfc_err)){
        // Preparando la insercion
        $sql = "INSERT INTO colaboradores (nombre, primer_apellido, segundo_apellido, rfc , departamento_id) VALUES (?,?,?,?,?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Vincular variables a la declaración preparada como parámetros
            mysqli_stmt_bind_param($stmt, "sssss", $param_nombre, $param_primer_apellido, $param_segundo_apellido, $param_rfc, $param_departamento);
            
            // Establecer Parametros
            $param_nombre = $nombre;
            $param_primer_apellido = $primer_apellido;
            $param_segundo_apellido = $segundo_apellido;
            $param_rfc = $rfc;
            $param_departamento = $departamento_id;

            
            // Ejecuta prepared stamment
            if(mysqli_stmt_execute($stmt)){
                // Redirige a landing page
                header("location: index.php");
                exit();
            } else{
                echo "Algo salio mal con la base de datos";
                printf("Error: %s.\n", $stmt->error);
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($link);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Agregar Empleado</title>
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper{
            width: 500px;
            margin: 0 auto;
        }
    </style>
    <script src="function.js"></script>
    
   
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h2>Agregar Colaborador</h2>
                    </div>
                    <p>Favor llenar siguiente formulario, para agregar el colaborador.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" id="registerForm">
                        <div class="form-group <?php echo (!empty($nombre_err)) ? 'has-error' : ''; ?>">
                            <label>Nombre</label>
                            <input type="text" name="nombre" class="form-control" id=nombre value="<?php echo $nombre; ?>">
                            <span class="help-block"><?php echo $nombre_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($primer_apellido_err)) ? 'has-error' : ''; ?>">
                            <label>Primer Apellido</label>
                            <input type="text" name="primer_apellido" id="primer_apellido" class="form-control" value="<?php echo $primer_apellido; ?>">
                            <span class="help-block"><?php echo $primer_apellido_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($segundo_apellido_err)) ? 'has-error' : ''; ?>">
                            <label>Segundo Apellido</label>
                            <input type="text" name="segundo_apellido" id="segundo_apellido" class="form-control" value="<?php echo $segundo_apellido; ?>">
                            <span class="help-block"><?php echo $segundo_apellido_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($rfc_err)) ? 'has-error' : ''; ?>">
                            <label>RFC</label>
                            <input type="text" name="rfc" id="rfc" class="form-control" value="<?php echo $rfc; ?>">
                            <span class="help-block"><?php echo $rfc_err;?></span>
                        </div>            

                         
                        <div class="form-group">
                        <label for="cars">Selecciona un departamento:</label>
                        <select name="departamento_id" id="departamento_id">
                            <?php 
                           
                            $consulta_departamentos = "SELECT * FROM departamentos";
                            if($result = mysqli_query($link, $consulta_departamentos)) {
                                if(mysqli_num_rows($result) > 0){
                                    while($row = mysqli_fetch_array($result)){
                                        
                                        echo "<option value='".$row['id']."'>".$row['nombre']."</option>";
                                    }                                    
                                }
                            }                            
                            ?>

                        </select>
                        </div>
                        
                        
                       
                        <input type="submit" class="btn btn-primary" value="Agregar Colaborador" onclick="return mostrarDatos()">
                        <a href="index.php" class="btn btn-default">Cancelar</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>