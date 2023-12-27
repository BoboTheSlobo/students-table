<?php
   include 'auth_session.php';
   include 'header.php';
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
          <h2 class="card-title">Student's <?php echo $studentCount; ?> </h2>
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

