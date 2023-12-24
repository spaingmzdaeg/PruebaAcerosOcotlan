<?php
// Procesar la eliminacion despues de la confirmacion
if(isset($_POST["id"]) && !empty($_POST["id"])){
    // Incuir archivo de configuracion
    require_once "config.php";
    
    // Preparar un delete statement
    $sql = "DELETE FROM colaboradores WHERE id = ?";
    
    if($stmt = mysqli_prepare($link, $sql)){
        // Vincular variables a la declaración preparada como parámetros
        mysqli_stmt_bind_param($stmt, "i", $param_id);
        
        // Establecer Parametros
        $param_id = trim($_POST["id"]);
        
        // Ejecutar un prepared statement
        if(mysqli_stmt_execute($stmt)){
            // eLIMINAR REGISTRO Y REDIRIGIR A LANDING PAGE
            header("location: index.php");
            exit();
        } else{
            echo "Algo salio mal con la base de datos";
                printf("Error: %s.\n", $stmt->error);
        }
    }
     
    
    mysqli_stmt_close($stmt);
    
    
    mysqli_close($link);
} else{
    // Verificar existencia del ID
    if(empty(trim($_GET["id"]))){
        // Mandar a url de error
        header("location: error.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Borrar</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper{
            width: 500px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h1>Borrar Registro</h1>
                    </div>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="alert alert-danger fade in">
                            <input type="hidden" name="id" value="<?php echo trim($_GET["id"]); ?>"/>
                            <p>Está seguro que deseas borrar el registro</p><br>
                            <p>
                                <input type="submit" value="Si" class="btn btn-danger">
                                <a href="index.php" class="btn btn-default">No</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>