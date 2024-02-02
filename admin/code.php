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

if(isset($_POST['delete_news']))
{
    $news_id = mysqli_real_escape_string($con, $_POST['delete_news']);
    $query = "DELETE FROM news WHERE id='$news_id' ";
    $query_run = mysqli_query($con, $query);
    if($query_run)
    {
        $_SESSION['message'] = "News Card Deleted Successfully";
        header("Location: news.php");
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "News Card Not Deleted";
        header("Location: news.php");
        exit(0);
    }
}
if (isset($_POST['news_update'])) {
  $news_id = mysqli_real_escape_string($con, $_POST['news_id']);
  $Title = mysqli_real_escape_string($con, $_POST['Title']);
  $Description = mysqli_real_escape_string($con, $_POST['Description']);
  $Status = mysqli_real_escape_string($con, $_POST['Status']);

  // Check if a new image is being uploaded
    if(isset($_FILES["Image"]) && $_FILES["Image"]["error"] == 0) {
        $Image = basename($_FILES["Image"]["name"]);
        // Specify the target directory for file upload
        $target_dir = "uploads/";
        $target_file = $target_dir . $Image;
        // Move the uploaded file to the target directory
        if(move_uploaded_file($_FILES["Image"]["tmp_name"], $target_file)) {
            // Update the database with the new image path
            $query = "UPDATE news SET Image='uploads/$Image', Title='$Title', Description='$Description', Status='$Status' WHERE id='$news_id'";
        } else {
            // Handle file upload error
            $_SESSION['message'] = "Error uploading file.";
            header("Location: news.php");
            exit(0);
        }
    } else {
        // If no new image is uploaded, update other fields only
        $query = "UPDATE news SET Title='$Title', Description='$Description', Status='$Status' WHERE id='$news_id'";
    }
    // Execute the query
    $query_run = mysqli_query($con, $query);
    if($query_run)
    {
        $_SESSION['message'] = "News Updated Successfully";
        header("Location: news.php");
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "News Not Updated";
        header("Location: news.php");
        exit(0);
    }


  $query_run = mysqli_query($con, $query);

  if ($query_run) {
      $_SESSION['message'] = "News Updated Successfully";
      header("Location: news.php");
      exit(0);
  } else {
      $_SESSION['message'] = "News Not Updated";
      header("Location: news.php");
      exit(0);
  }
} 

  
$curl = curl_init();
curl_setopt_array($curl, array(
    CURLOPT_URL => 'http://universities.hipolabs.com/search?country=United+States',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'GET',
    CURLOPT_HTTPHEADER => array(
        'API_KEY: AIzaSyBvoXxD47x6-FrO3UztXKAPwVUlhKne9Qc'
    ),
));
$response = curl_exec($curl);
curl_close($curl);

header('Content-Type: application/json');
echo $response;
