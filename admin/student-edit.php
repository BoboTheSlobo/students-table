<?php
 include 'auth_session.php';
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
    <title>Student Edit</title>
</head>
<body>
<nav class="navbar navbar-expand-lg bg-primary">
  <div class="container-fluid">
    <a class="navbar-brand me-5 text-white " href="#"><h2 class="fw-bold">Internship Students</h2></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav   mb-2 mb-lg-0 d-flex align-items-lg-center navbar_links_container">
        <li class="nav-item">
          <a class="nav-link active text-white" aria-current="page" href="dashboard.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white text-white" href="students.php">Students</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle text-white" href="#services" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            More
          </a>
          <ul class="dropdown-menu bg-primary">
            <li><a class="dropdown-item text-white" href="#first-service">Blog</a></li>
            <li><a class="dropdown-item text-white" href="#second-service">Contact</a></li>
          </ul>
        </li>
        <li class="nav-item ms-lg-3">
        <form class="form-inline">
    <div class="input-group">
      <input type="text" class="form-control rounded  outline-0 " placeholder="Search by Name" aria-label="Search" aria-describedby="basic-addon2">
      <div class="input-group-append">
        <button class="btn btn-outline-secondary bg-white border-0 rounded-end ms-1 pt-2 pb-2" type="button">
          <i class="bi bi-search text-primary"></i>
          </button>
      </div>
    </div>
  </form>
       </li>
       <li class="nav-item ms-lg-auto">
         <div class="align-items-center ps-lg-3">
           <ul class="mb-0 list-unstyled">
             <li class="nav-item dropdown ">
               <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                 <img class="rounded-circle me-1 user_image" src="./assets/default-profile-picture.png" alt="picture" >  <?php
    // Check if the username is set in the session
    if (isset($_SESSION['username'])) {
      echo $_SESSION['username'];
    }
    ?>
               </a>
               <ul class="dropdown-menu bg-primary">
                 <li><a class="dropdown-item text-white" href="profile.php"><i class="bi bi-person-circle me-1"></i> Profile</a></li>
                 <li><a class="dropdown-item text-white" href="logout.php"><i class="bi bi-box-arrow-right me-1"></i> Logout</a></li>
               </ul>
             </li>
           </ul>
         </div>
       </li>
      </ul>
    </div>
  </div>
</nav>
    <div class="container mt-5">

        <?php include('message.php'); ?>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Student Edit 
                            <a href="students.php" class="btn btn-danger float-end">BACK</a>
                        </h4>
                    </div>
                    <div class="card-body">

                        <?php
                        if(isset($_GET['id']))
                        {
                            $student_id = mysqli_real_escape_string($con, $_GET['id']);
                            $query = "SELECT *, DATE_FORMAT(dob,'%D %M %Y') AS dob FROM students WHERE id='$student_id' ";
                            $query_run = mysqli_query($con, $query);

                            if(mysqli_num_rows($query_run) > 0)
                            {
                                $student = mysqli_fetch_array($query_run);
                                ?>
                                <form action="code.php" method="POST" enctype="multipart/form-data">
                                    <input type="hidden" name="student_id" value="<?= $student['id']; ?>">

                                    <div class="mb-3">
                                        <label>Student Name</label>
                                        <input type="text" name="name" value="<?=$student['name'];?>" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label>Student Grade</label>
                                        <input type="number" name="grade" value="<?=$student['grade'];?>" class="form-control" min="1" max="5">
                                    </div>
                                    <div class="mb-3">
                                        <label>Student Email</label>
                                        <input type="email" name="email" value="<?=$student['email'];?>" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label>Student Phone</label>
                                        <input type="text" name="phone" value="<?=$student['phone'];?>" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label>Student Course</label>
                                        <input type="text" name="course" value="<?=$student['course'];?>" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label>Date of Birth</label>
                                        <input type="date" name="dob" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label>Photo Upload</label>
                                        <input type="file" name="the_file">
                                    </div>
                                    <div class="mb-3">
                                        <button type="submit" name="update_student" class="btn btn-success">
                                            Update Student
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