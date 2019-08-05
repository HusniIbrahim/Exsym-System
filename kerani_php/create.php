<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$course1 = $course2 = $course3 = $course_name = $student_bil = $section_bil = $course_status = $exam =
$dean_confirm=$terima= "";
$course1_err = $course2_err = $course3_err = $course_name_err = $student_bil_err = $section_bil_err = $course_status_err = $exam_err =$dean_confirm_err=$terima_err= "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
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
    if(empty($course1_err) && empty($course2_err)&& empty($course3_err) && empty             ($course_name_err) && empty($student_bil_err) && empty($section_bil_err)
         && empty($course_status_err)&&empty($exam_err)&&empty($dean_confirm_err)&&empty($terima_err)){
        // Prepare an insert statement
        $sql = "INSERT INTO trel (course1, course2, course3,course_name,
        student_bil,section_bil,course_status,exam,dean_confirm,terima) VALUES (?,?,?,?,?,?,?,?,?,?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssssssssss", $param_course1, $param_course2, 
                $param_course3, $param_course_name, $student_bil, $section_bil, 
                $param_course_status,$param_exam,$param_dean_confirm,$param_terima);
            
            // Set parameters
            $param_course1 = $course1;
            $param_course2 = $course2;
            $param_course3 = $course3;
            $param_course_name = $course_name;
            $param_student_bil = $student_bil;
            $param_section_bil = $section_bil;
            $param_course_status = $course_status;
            $param_exam = $exam;
            $param_dean_confirm=$dean_confirm;
            $param_terima=$terima;
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records created successfully. Redirect to landing page
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
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Record</title>
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
                        <h2>KURSUS BARU</h2>
                    </div>
                    <p></p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group <?php echo (!empty($course1_err)) ? 'has-error' : ''; ?>">
                            <label>SILA MASUKKAN KOD KURSUS SETARA 1</label>
                            <input type="text" name="course1" class="form-control" value="<?php echo $course1; ?>">
                            <span class="help-block"><?php echo $course1_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($course2_err)) ? 'has-error' : ''; ?>">
                            <label>SILA MASUKKAN KOD KURSUS SETARA 2</label>
                            <input type="text" name="course2" class="form-control" value="<?php echo $course2; ?>">
                            <span class="help-block"><?php echo $course2_err;?></span>
                        </div>
                         <div class="form-group <?php echo (!empty($course3_err)) ? 'has-error' : ''; ?>">
                            <label>SILA MASUKKAN KOD KURSUS SETARA 3</label>
                            <input type="text" name="course3" class="form-control" value="<?php echo $course3; ?>">
                            <span class="help-block"><?php echo $course3_err;?></span>
                        </div>
                         <div class="form-group <?php echo (!empty($course_name_err)) ? 'has-error' : ''; ?>">
                            <label>SILA MASUKKAN NAMA KURSUS</label>
                            <input type="text" name="course_name" class="form-control" value="<?php echo $course_name; ?>">
                            <span class="help-block"><?php echo $course_name_err;?></span>
                        </div>
                       
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="index.php" class="btn btn-default">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>