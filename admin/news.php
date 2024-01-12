<?php
 include 'auth_session.php';
 include 'header.php';
 require 'dbcon.php';
//  session_start();
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="./css./style.css"/>
    <link rel="stylesheet" href="index.css">
    <!-- Bootstrap CSS -->
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
        
        <title>News</title>
      </head>
      <body>

    <div class="container mt-4">

      <?php include('message.php'); ?>
      
      <div class="row">
        <div class="col-md-12"> 
          <div class="card border border-primary">
            <div class="card-header ">
              <h4>News
                <a href="news-create.php" class="btn btn-primary float-end">Add News</a>
              </h4>
            </div>
            <div class="card-body table-responsive  border-top border-primary">
           

              <table class="table table-bordered border-primary table-striped">
                <thead>
                  <tr class="text-center">
                    <th>ID</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Image</th>
                    <th>Status</th>
                   
                  </tr>
                </thead>
                <tbody>
                  <?php 
                                    $query = "SELECT * FROM news";
                                    $query_run = mysqli_query($con, $query);
                                    
                                    if(mysqli_num_rows($query_run) > 0)
                                    {
                                      foreach($query_run as $news)
                                      {
                                        ?>
                                            <tr>
                                              <td class="text-center"><?= $news['id']; ?></td>
                                              <td class="text-center "><?= $news['Title']; ?></td>
                                              <td class="text-center"><?= $news['Description']; ?></td>
                                              <td class="text-center"><img class="rounded-circle" src="<?= $news['Image']; ?>" alt="news image"  style="width: 40px; height: 40px;"></td>
                                              <td class="text-center"><?= $news['Status']; ?></td>                                
                                                <td class = "text-center">
                                                    <a href="news-edit.php?id=<?= $news['id']; ?>" class="btn btn-success btn-sm m-1">Edit</a>
                                                    <form action="code.php" method="POST" class="d-inline">
                                                      <button type="submit" name="delete_news" value="<?=$news['id'];?>" class="btn btn-danger btn-sm m-1">Delete</button>
                                                    </form>
                                                  </td>
                                                </tr>
                                                <?php
                                        }
                                      }
                                      else
                                      {
                                        echo "<h5> No Record Found </h5>";
                                      }
                                ?>

</tbody>
</table>

</div>
</div>
</div>
</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>