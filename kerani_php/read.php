<?php
// Check existence of id parameter before processing further
if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
    // Include config file
    require_once "config.php";
    
    // Prepare a select statement
    $sql = "SELECT * FROM trel WHERE id = ?";
    
    if($stmt = mysqli_prepare($link, $sql)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "i", $param_id);
        
        // Set parameters
        $param_id = trim($_GET["id"]);
        
        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);
    
            if(mysqli_num_rows($result) == 1){
                /* Fetch result row as an associative array. Since the result set contains only one row, we don't need to use while loop */
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                
                // Retrieve individual field value
                $course1 = $row["course1"];
                $course2 = $row["course2"];
                $course3 = $row["course3"];
                $course_name = $row["course_name"];
                $student_bil = $row["student_bil"];
                $section_bil = $row["section_bil"];
                $course_status = $row["course_status"];
                $exam = $row["exam"];
                $deam_confirm = $row["dean_confirm"];
                $terima = $row["terima"];
            } else{
                // URL doesn't contain valid id parameter. Redirect to error page
                header("location: error.php");
                exit();
            }
            
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
    }
     
    // Close statement
    mysqli_stmt_close($stmt);
    
    // Close connection
    mysqli_close($link);
} else{
    // URL doesn't contain id parameter. Redirect to error page
    header("location: error.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Record</title>
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
                        <h1>View Record</h1>
                    </div>
                    <div class="form-group">
                        <label>Kod kursus setara 1</label>
                        <p class="form-control-static"><?php echo $row["course1"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Kod kursus setara 2</label>
                        <p class="form-control-static"><?php echo $row["course2"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Kod kursus setara 3</label>
                        <p class="form-control-static"><?php echo $row["course3"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Nama kursus</label>
                        <p class="form-control-static"><?php echo $row["course_name"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Bil. pelajar</label>
                        <p class="form-control-static"><?php echo $row["student_bil"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Bil. seksyen</label>
                        <p class="form-control-static"><?php echo $row["section_bil"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Status kursus</label>
                        <p class="form-control-static"><?php echo $row["course_status"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Status peperiksaan</label>
                        <p class="form-control-static"><?php echo $row["exam"]; ?></p>
                    </div>
                     <div class="form-group">
                        <label>Dean confirm</label>
                        <p class="form-control-static"><?php echo $row["dean_confirm"]; ?></p>
                    </div>
                     <div class="form-group">
                        <label>Terima</label>
                        <p class="form-control-static"><?php echo $row["terima"]; ?></p>
                    </div>
                    <p><a href="index.php" class="btn btn-primary">Back</a></p>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>