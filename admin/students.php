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
        
        <title>Student CRUD</title>
      </head>
      <body>

    <div class="container mt-4">

      <?php include('message.php'); ?>
      
      <div class="row">
        <div class="col-md-12"> 
          <div class="card border border-primary">
            <div class="card-header ">
              <h4>Student Details
                <a href="student-create.php" class="btn btn-primary float-end">Add Students</a>
              </h4>
            </div>
            <div class="card-body table-responsive  border-top border-primary">
            <?php
                   $sql = "SELECT COUNT(id) AS student_count FROM students";
                   $result = $con->query($sql);
                    ?>

              <table class="table table-bordered border-primary table-striped">
                <thead>
                  <tr class="text-center">
                    <th>ID</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Grade</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Course</th>
                    <th>Date of Birth</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                                    $query = "SELECT * FROM students";
                                    $query_run = mysqli_query($con, $query);
                                    
                                    if(mysqli_num_rows($query_run) > 0)
                                    {
                                      foreach($query_run as $student)
                                      {
                                        ?>
                                            <tr>
                                              <td class="text-center"><?= $student['id']; ?></td>
                                              <td class="text-center"><img class="rounded-circle" src="uploads/<?= $student['image']; ?>" alt="student image"  style="width: 40px; height: 40px;"></td>
                                              <td class="text-center "><?= $student['name']; ?></td>
                                              <td class="text-center"><?= $student['grade']; ?></td>
                                              <td class="text-center"><?= $student['email']; ?></td>
                                              <td class="text-center"><?= $student['phone']; ?></td>
                                              <td class="text-center"><?= $student['course']; ?></td>
                                              <td class="text-center"><?= $student['dob']; ?></td>
                                                <td class = "text-center">
                                                    <a href="student-edit.php?id=<?= $student['id']; ?>" class="btn btn-success btn-sm m-1">Edit</a>
                                                    <a href="student-view.php?id=<?= $student['id']; ?>" class="btn btn-info btn-sm m-1">View</a>
                                                    <form action="code.php" method="POST" class="d-inline">
                                                      <button type="submit" name="delete_student" value="<?=$student['id'];?>" class="btn btn-danger btn-sm m-1">Delete</button>
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