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
<link rel="stylesheet" href="index.css">
    <!-- Bootstrap CSS -->
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <title>Student View</title>
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

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Student View Details 
                            <a href="students.php" class="btn btn-danger float-end">BACK</a>
                        </h4>
                    </div>
                    <div class="card-body">

                        <?php
                        if(isset($_GET['id']))
                        {
                            $student_id = mysqli_real_escape_string($con, $_GET['id']);
                            $query = "SELECT * FROM students WHERE id='$student_id' ";
                            $query_run = mysqli_query($con, $query);

                            if(mysqli_num_rows($query_run) > 0)
                            {
                                $student = mysqli_fetch_array($query_run);
                                ?>
                                   <div class="mb-3">
                                        <label>Student Image</label>
                                        <p class="form-control" >
                                            <img class="rounded-circle" src="uploads/<?= $student['image']; ?>" alt="" style="width: 150px; height: 150px;">
                                        </p>
                                    </div>
                                    <div class="mb-3">
                                        <label>Student Name</label>
                                        <p class="form-control">
                                            <?=$student['name'];?>
                                        </p>
                                    </div>
                                    <div class="mb-3">
                                        <label>Student Grade</label>
                                        <p class="form-control">
                                            <?=$student['grade'];?>
                                        </p>
                                    </div>
                                    <div class="mb-3">
                                        <label>Student Email</label>
                                        <p class="form-control">
                                            <?=$student['email'];?>
                                        </p>
                                    </div>
                                    <div class="mb-3">
                                        <label>Student Phone</label>
                                        <p class="form-control">
                                            <?=$student['phone'];?>
                                        </p>
                                    </div>
                                    <div class="mb-3">
                                        <label>Student Course</label>
                                        <p class="form-control">
                                            <?=$student['course'];?>
                                        </p>
                                    </div>
                                    <div class="mb-3">
                                        <label>Date of Birth</label>
                                        <p class="form-control">
                                            <?=$student['dob'];?>
                                        </p>
                                    </div>

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