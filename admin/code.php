<?php
 include 'auth_session.php';
require 'dbcon.php';

if(isset($_POST['delete_student']))
{
    $student_id = mysqli_real_escape_string($con, $_POST['delete_student']);

    $query = "DELETE FROM students WHERE id='$student_id' ";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $_SESSION['message'] = "Student Deleted Successfully";
        header("Location: students.php");
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "Student Not Deleted";
        header("Location: students.php");
        exit(0);
    }
}

if(isset($_POST['update_student']))
{
    $student_id = mysqli_real_escape_string($con, $_POST['student_id']);

    $name = mysqli_real_escape_string($con, $_POST['name']);
    $grade = mysqli_real_escape_string($con, $_POST['grade']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $phone = mysqli_real_escape_string($con, $_POST['phone']);
    $course = mysqli_real_escape_string($con, $_POST['course']);
    $dob = mysqli_real_escape_string($con, $_POST['dob']);


    if(isset($_FILES['the_file']) && $_FILES['the_file']['error'] == 0) {

        //print "Ima slika";
        //exit(0);

        $currentDirectory = getcwd();
        $uploadDirectory = "/uploads/";
    
        $errors = []; // Store errors here
    
        $fileExtensionsAllowed = ['jpeg','jpg','png']; // These will be the only file extensions allowed 
    
        $fileName = $_FILES['the_file']['name'];
        //print($fileName);
        //exit(0);
        $fileSize = $_FILES['the_file']['size'];
        $fileTmpName  = $_FILES['the_file']['tmp_name'];
        $fileType = $_FILES['the_file']['type'];
        $fileExtension = strtolower(end(explode('.',$fileName)));

        $uploadPath = $currentDirectory . $uploadDirectory . basename($fileName); 


        if (! in_array($fileExtension,$fileExtensionsAllowed)) {
            $errors[] = "This file extension is not allowed. Please upload a JPEG or PNG file";
          }
    
          if ($fileSize > 4000000) {
            $errors[] = "File exceeds maximum size (4MB)";
          }
    
          if (empty($errors)) {
            $didUpload = move_uploaded_file($fileTmpName, $uploadPath);
    
            if ($didUpload) {
              echo "The file " . basename($fileName) . " has been uploaded";
            } else {
              echo "An error occurred. Please contact the administrator.";
            }
          } else {
            foreach ($errors as $error) {
              echo $error . "These are the errors" . "\n";
            }
          }

          $query = "UPDATE students SET name='$name',grade='$grade', email='$email', phone='$phone', course='$course', image='$fileName', dob='$dob' WHERE id='$student_id' ";

    }
    else {
        $query = "UPDATE students SET name='$name', grade='$grade', email='$email', phone='$phone', course='$course', dob='$dob' WHERE id='$student_id' ";
        //print "Nema Slika";
        //exit(0);

    }

    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $_SESSION['message'] = "Student Updated Successfully";
        header("Location: students.php");
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "Student Not Updated";
        header("Location: students.php");
        exit(0);
    }

}


if(isset($_POST['save_student']))
{

    $name = mysqli_real_escape_string($con, $_POST['name']);
    $grade = mysqli_real_escape_string($con, $_POST['grade']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $phone = mysqli_real_escape_string($con, $_POST['phone']);
    $course = mysqli_real_escape_string($con, $_POST['course']);
    $dob = mysqli_real_escape_string($con, $_POST['dob']);

    if(isset($_FILES['the_file']) && $_FILES['the_file']['error'] == 0) {
        
        $currentDirectory = getcwd();
        $uploadDirectory = "/uploads/";
        
        $errors = []; // Store errors here
    
        $fileExtensionsAllowed = ['jpeg','jpg','png']; // These will be the only file extensions allowed 
    
        $fileName = $_FILES['the_file']['name'];
        //print($fileName);
        //exit(0);
        $fileSize = $_FILES['the_file']['size'];
        $fileTmpName  = $_FILES['the_file']['tmp_name'];
        $fileType = $_FILES['the_file']['type'];
        $fileExtension = strtolower(end(explode('.',$fileName)));

        $uploadPath = $currentDirectory . $uploadDirectory . basename($fileName); 


        if (! in_array($fileExtension,$fileExtensionsAllowed)) {
            $errors[] = "This file extension is not allowed. Please upload a JPEG or PNG file";
          }
    
          if ($fileSize > 4000000) {
            $errors[] = "File exceeds maximum size (4MB)";
          }
    
          if (empty($errors)) {
            $didUpload = move_uploaded_file($fileTmpName, $uploadPath);
    
            if ($didUpload) {
              echo "The file " . basename($fileName) . " has been uploaded";
            } else {
              echo "An error occurred. Please contact the administrator.";
            }
          } else {
            foreach ($errors as $error) {
              echo $error . "These are the errors" . "\n";
            }
          }

          $query = "INSERT INTO students (name,grade,email,phone,course,image,dob) VALUES ('$name','$grade','$email','$phone','$course','$fileName','$dob')";

    

    }
    else {
        $query = "INSERT INTO students (name,grade,email,phone,course,dob) VALUES ('$name','$grade','$email','$phone','$course', '$dob')";
        
    }

    $query_run = mysqli_query($con, $query);
    if($query_run)
    {
        $_SESSION['message'] = "Student Created Successfully";
        header("Location: student-create.php");
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "Student Not Created";
        header("Location: student-create.php");
        exit(0);
    }
}

?>