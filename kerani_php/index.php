<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.js"></script>
    <style type="text/css">
        .wrapper{
            width: 950px;
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
	<div class="col-sm-12" style="text-align: right;">
      <br><a class="btn btn-warning" href="/exsym/logout.php">LOGOUT</a>
    </div>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header clearfix">
                        <h2 class="pull-left">DIPLOMA PENGURUSAN PENYELENGARAAN REL</h2>
                        <a href="create.php" class="btn btn-success pull-right">KURSUS BARU</a>
                    </div>
                    <?php
                    // Include config file
                    require_once "config.php";
                    
                    // Attempt select query execution
                    $sql = "SELECT * FROM trel";
                    if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo "<table class='table table-bordered table-striped'>";
                                echo "<thead>";
                                    echo "<tr>";
                                         echo "<tr>";
                                        echo "<th rowspan=\"3\">ID</th>";
                                        echo "</tr>";
                                        echo "<tr>";
                                        echo "<th colspan=\"3\"><center>KOD KURSUS</center></th>";
                                        echo "</tr>";
                                        echo "<th><center>SETARA1</center></th>";
                                        echo "<th><center>SETARA2</center></th>";
                                        echo "<th><center>SETARA3</center></th>";
                                        echo "<th><center>NAMA KURSUS</center></th>";
                                        echo "<th><center>KEMASKINI</center></th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr>";
                                        echo "<td>" . $row['id'] . "</td>";
                                        echo "<td>" . $row['course1'] . "</td>";
                                        echo "<td>" . $row['course2'] . "</td>";
                                        echo "<td>" . $row['course3'] . "</td>";
                                        echo "<td>" . $row['course_name'] . "</td>";
                                         echo "<td>";
                                            
                                            echo "<center><a href='update.php?id=". $row['id'] ."' title='Update Record' data-toggle='tooltip'><span class='glyphicon glyphicon-pencil'></span></a></center>";
                                            echo "<center><a href='delete.php?id=". $row['id'] ."' title='Delete Record' data-toggle='tooltip'><span class='glyphicon glyphicon-trash'></span></a></center>";
                                        echo "</td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";                            
                            echo "</table>";
                            // Free result set
                            mysqli_free_result($result);
                        } else{
                            echo "<p class='lead'><em>No records were found.</em></p>";
                        }
                    } else{
                        echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
                    }
 
                    // Close connection
                    mysqli_close($link);
                    ?>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>