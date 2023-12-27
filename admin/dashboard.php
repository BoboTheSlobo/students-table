<?php
   include 'auth_session.php';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Dashboard - Client area</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="index.css">
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
<div class="text-center mt-3 p-2"><h2>Welcome <?php
    // Check if the username is set in the session
    if (isset($_SESSION['username'])) {
      echo $_SESSION['username'];
    }
    ?>!</h2></div>
<div class="container mt-5">
  <div class="row  gap-2 gap-sm-2 gap-md-0 ">

    <!-- Card 1 -->
    <div class="col-md-12">
      <div class="card bg-primary bg-gradient">
        <div class="card-body pt-4 pb-4">
        <?php
            include 'dbcon.php'; // Include the database connection file

            $query = "SELECT COUNT(*) as student_count FROM students"; // Count the number of students
            $result = mysqli_query($con, $query);
            if ($result === false) {
              echo "Error executing the query: " . $con->error;
          } else {
              $row = $result->fetch_assoc();
              $studentCount = $row['student_count'];
          }
          $con->close();
          ?>
          <h2 class="card-title">Student <?php echo $studentCount; ?> </h2>
            </h2>
         
        <p class="card-text">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Voluptate, officiis?</p>
        </div>
      </div>
    </div>
    <!-- Card 2 -->
    <div class="col-md-4 mt-2">
      <div class="card bg-success bg-gradient">
        <div class="card-body p-4">
        <p class="card-text">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Voluptate, officiis?</p>
        </div>
      </div>
    </div>

    <!-- Card 3 -->
    <div class="col-md-4 mt-2">
      <div class="card bg-primary bg-gradient">
        <div class="card-body p-4">
        <p class="card-text">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Voluptate, officiis?</p>
        </div>
      </div>
    </div>

    <!-- Card 4 -->
    <div class="col-md-4 mt-2">
      <div class="card bg-success bg-gradient">
        <div class="card-body p-4">
        <p class="card-text">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Voluptate, officiis?</p>
        </div>
      </div>
    </div>
  </div>
</div>
</body>
</html>
<?php
?>

