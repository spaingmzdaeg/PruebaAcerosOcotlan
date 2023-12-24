<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Examen Aceros Ocotlan</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.js"></script>
    
    <style type="text/css">
        .wrapper{
            width: 650px;
            margin: 0 auto;
        }
        .page-header h2{
            margin-top: 0;
        }
        table tr td:last-child a{
            margin-right: 15px;
        }
    </style>
    <script type="text/javascript">
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();   
        });
    </script>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header clearfix">
                        <h2 class="pull-left">Colaboradores</h2>
                        <a href="create.php" class="btn btn-success pull-right">Agregar nuevo colaborador</a>
                    </div>
                    <?php
                    // Archivo de configuracion
                    require_once "config.php";
                    
                    // Intento de ejecucion de consulta
                    $sql = "SELECT * FROM colaboradores";
                    $consulta_sql_inner_join = "select colaboradores.id,concat(colaboradores.nombre, ' ', colaboradores.primer_apellido, ' ', colaboradores.segundo_apellido, ' ') as Nombre , colaboradores.rfc , departamentos.nombre as Departamento from colaboradores inner join departamentos where colaboradores.departamento_id = departamentos.id";
                    if($result = mysqli_query($link, $consulta_sql_inner_join)){
                        if(mysqli_num_rows($result) > 0){
                            echo "<table class='table table-bordered table-striped'>";
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>ID</th>";
                                        echo "<th>Nombre</th>";
                                        echo "<th>RFC</th>";
                                        echo "<th>Departamento</th>";
                                        echo "<th>Acción</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr>";
                                        echo "<td>" . $row['id'] . "</td>";
                                        echo "<td>" . $row['Nombre']. "</td>";
                                        echo "<td>" . $row['rfc'] . "</td>";
                                        echo "<td>" . $row['Departamento'] . "</td>";
                                        echo "<td>";
                                            echo "<a href='read.php?id=". $row['id'] ."' title='Ver' data-toggle='tooltip'><span class='glyphicon glyphicon-eye-open'></span></a>";
                    
                                            echo "<a href='delete.php?id=". $row['id'] ."' title='Borrar' data-toggle='tooltip'><span class='glyphicon glyphicon-trash'></span></a>";
                                        echo "</td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";                            
                            echo "</table>";
                            // Set de resultados
                            mysqli_free_result($result);
                        } else{
                            echo "<p class='lead'><em>No existen registros encontrados.</em></p>";
                        }
                    } else{
                        echo "ERROR: No se puede ejecutar $sql. " . mysqli_error($link);
                    }
 
                    // Cerrar conexion
                    mysqli_close($link);
                    ?>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>