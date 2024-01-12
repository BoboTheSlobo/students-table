<?php
 include 'auth_session.php';
 include 'header.php';
  if(!isset($_SESSION["username"])) {
      header("Location: login.php");
      exit();
  }
require 'dbcon.php';
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="./css./style.css"/>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="index.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <title>News Edit</title>
</head>
<body>

    <div class="container mt-5">

        <?php include('message.php'); ?>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>News Edit 
                            <a href="news.php" class="btn btn-danger float-end">BACK</a>
                        </h4>
                    </div>
                    <div class="card-body">

                    <?php
                if(isset($_GET['id']))
                {
                    $news_id = mysqli_real_escape_string($con, $_GET['id']);
                    $query = "SELECT * FROM news WHERE id='$news_id' ";
                    $query_run = mysqli_query($con, $query);
                    if(mysqli_num_rows($query_run) > 0)
                    {
                        $news = mysqli_fetch_array($query_run);
                        ?>
                        <form action="code.php" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="news_id" value="<?= $news['id']; ?>">
                            <div class="mb-3">
                                <label>Title</label>
                                <input type="text" name="Title" value="<?=$news['Title'];?>" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label> Description</label>
                                <input type="text" name="Description" value="<?=$news['Description'];?>" class="form-control">
                            </div>
                            <div class="mb-3">
                             <label for="Image">Choose Image:</label>
                             <input type="file" class="form-control" id="Image" name="Image" accept="Image/*" >
                        </div>
                        <select id="Status" name="Status">
                    <option value="1">Active</option>
                    <option value="0">Inactive</option>
                </select>
               
                            <div class="mb-3 mt-3">
                                <button type="submit" name="news_update" class="btn btn-success">
                                    Update News
                                </button>
                            </div>
                        </form>
                        <?php
                    }
                    else
                    {
                        echo "<h4>No Such Id Found</h4>";
                    }
                }
                ?>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>