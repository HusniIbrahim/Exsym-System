<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$course1 = $course2 =$course3 =$course_name =$student_bil = $section_bil = $course_status =$exam = "";
$course1_err = $course2_err =$course3_err =$course_name_err =$student_bil_err = $section_bil_err = 
$course_status_err =$exam_err =$dean_confirm_err=$terima_err= "";
 
// Processing form data when form is submitted
if(isset($_POST["id"]) && !empty($_POST["id"])){
    // Get hidden input value
    $id = $_POST["id"];
    
  
    // Validate course1
    $input_course1 = trim($_POST["course1"]);
    if(empty($input_course1)){
        $course1_err = "Sila masukkan kod kursus setara 1.";     
    } else{
        $course1 = $input_course1;
    }
    // Validate course2
    $input_course2 = trim($_POST["course2"]);
    if(empty($input_course2)){
           
    } else{
        $course2 = $input_course2;
    }
    // Validate course3
    $input_course3 = trim($_POST["course3"]);
    if(empty($input_course3)){
            
    } else{
        $course3 = $input_course3;
    }
    // Validate course_name
    $input_course_name = trim($_POST["course_name"]);
    if(empty($input_course_name)){
        $course_name_err = "Sila masukkan nama kursus.";     
    } else{
        $course_name = $input_course_name;
    }
   
    // Check input errors before inserting in database
    if(empty($course1_err) && empty($course2_err)&& empty($course3_err) && empty($course_name_err) 
        && empty($student_bil_err)&& empty($section_bil_err)&& empty($course_status_err)
        &&empty($exam_err) &&empty($dean_confirm_err) &&empty($terima_err)){
        // Prepare an update statement
        $sql = "UPDATE trel SET course1=?,course2=?,course3=?,course_name=?,student_bil=?, section_bil=?, course_status=?,exam=?,dean_confirm=?,terima=? WHERE id=?";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssssssssssi", $param_course1, $param_course2, $param_course3,$param_course_name,$param_student_bil, $param_section_bil, $param_course_status,$param_exam,$param_dean_confirm,$param_terima, $param_id);
            
            // Set parameters
            $param_course1 = $course1;
            $param_course2 = $course2;
            $param_course3 = $course3;
            $param_course_name = $course_name;
            $param_student_bil = $student_bil;
            $param_section_bil = $section_bil;
            $param_course_status = $course_status;
            $param_exam = $exam;
            $param_id = $id;
            $param_dean_confirm=$dean_confirm;
            $param_terima=$terima;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records updated successfully. Redirect to landing page
                header("location: index.php");
                exit();
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($link);
} else{
    // Check existence of id parameter before processing further
    if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
        // Get URL parameter
        $id =  trim($_GET["id"]);
        
        // Prepare a select statement
        $sql = "SELECT * FROM trel WHERE id = ?";
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "i", $param_id);
            
            // Set parameters
            $param_id = $id;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);
    
                if(mysqli_num_rows($result) == 1){
                    /* Fetch result row as an associative array. Since the result set contains only one row, we don't need to use while loop */
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    
                    // Retrieve individual field value
                    $course1       = $row["course1"];
                    $course2       = $row["course2"];
                    $course3       = $row["course3"];
                    $course_name   = $row["course_name"];
                    $student_bil   = $row["student_bil"];
                    $section_bil   = $row["section_bil"];
                    $course_status = $row["course_status"];
                    $exam          = $row["exam"];
                    $dean_confirm  = $row["dean_confirm"];
                    $terima        = $row["terima"];
                } else{
                    // URL doesn't contain valid id. Redirect to error page
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
    }  else{
        // URL doesn't contain id parameter. Redirect to error page
        header("location: error.php");
        exit();
    }
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Record</title>
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
                        <h2>KEMASKINI MAKLUMAT KURSUS</h2>
                    </div>
                    <p></p>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                        <div class="form-group <?php echo (!empty($course1_err)) ? 'has-error' : ''; ?>">
                            <label>SILA MASUKKAN KOD KURSUS SETARA 1</label>
                            <input type="text" name="course1" class="form-control" value="<?php echo 
                            $course1; ?>">
                            <span class="help-block"><?php echo $course1_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($course2_err)) ? 'has-error' : ''; ?>">
                            <label>SILA MASUKKAN KOD KURSUS SETARA 2</label>
                            <input type="text" name="course2" class="form-control" value="<?php echo 
                            $course2; ?>">
                            <span class="help-block"><?php echo $course2_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($course3_err)) ? 'has-error' : ''; ?>">
                            <label>SILA MASUKKAN KOD KURSUS SETARA 3</label>
                            <input type="text" name="course3" class="form-control" value="<?php echo 
                            $course3; ?>">
                            <span class="help-block"><?php echo $course3_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($course_name_err)) ? 'has-error' : ''; ?>">
                            <label>SILA MASUKKAN NAMA KURSUS</label>
                            <input type="text" name="course_name" class="form-control" value="<?php echo $course_name; ?>">
                            <span class="help-block"><?php echo $course_name_err;?></span>
                        </div>
                       
                        <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="index.php" class="btn btn-default">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>