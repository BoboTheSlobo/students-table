<?php
include("auth_session.php");
require 'dbcon.php';
include("header.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Gather form data
    $Title = $_POST["Title"];
    $Description = $_POST["Description"];
    $Status = $_POST["Status"];
    // File upload handling
    $targetDir = "uploads/";
    $targetFile = $targetDir . basename($_FILES["Image"]["name"]);
    $uploadOk = 1;
    $ImageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
    // Check if the file is an actual Image
    $check = getImagesize($_FILES["Image"]["tmp_name"]);
    if ($check === false) {
        echo "File is not an Image.";
        $uploadOk = 0;
    }
    // Check file size (optional)
    if ($_FILES["Image"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }
    // Allow certain file formats
    if ($ImageFileType != "jpg" && $ImageFileType != "png" && $ImageFileType != "jpeg" && $ImageFileType != "gif") {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    } else {
        // Move the uploaded file to the specified directory
        if (move_uploaded_file($_FILES["Image"]["tmp_name"], $targetFile)) {
            // File uploaded successfully, now insert data into database or perform other actions as needed
            // Example: Insert data into the database
            $sql = "INSERT INTO news (Title, Description, Image, Status) VALUES ('$Title', '$Description', '$targetFile', '$Status')";
            $query_run = mysqli_query($con, $sql);
    if($query_run)
    {
        $_SESSION['message'] = "News Created Successfully";
        header("Location: news-create.php");
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "News Not Created";
        header("Location: news-create.php");
        exit(0);
    }
            if ($con->query($sql) === TRUE) {
                echo '<div style="background-color: #D4EDDA; color: #155724; border-color: #C3E6CB; padding: 10px; margin: 10px 0; border: 1px solid; border-radius: 5px;">';
                echo "News added successfully.";
                echo '</div>';
            } else {
                echo "Error: " . $sql . "<br>" . $con->error;
            }
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="./css./style.css"/>
<link rel="stylesheet" href="index.css">
    <!-- Bootstrap CSS -->
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <Title>News Create</Title>
</head>
<body>
<div class="container mt-5">
<?php include('message.php'); ?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>Add News
                    <a href="news.php" class="btn btn-danger float-end">BACK</a>
                </h4>
            </div>
            <div class="card-body">
                <form action="news-create.php" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label>Title</label>
                        <input type="text" name="Title" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label>Description</label>
                        <input type="text" name="Description" class="form-control">
                    </div>                            
                    <div class="mb-3">
                     <label for="Image">Choose Image:</label>
                     <input type="file" class="form-control" id="Image" name="Image" accept="Image/*" required>
                </div>
                <select id="Status" name="Status">
                    <option value="1">Active</option>
                    <option value="0">Inactive</option>
                </select>  
                <div class="mb-3 mt-3">
                        <button type="submit" name="save_news" class="btn btn-success">Save</button>
                    </div>              
                </form>
            </div>
        </div>
    </div>
</div>
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>