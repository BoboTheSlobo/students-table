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
          <h3 class="card-title text-light m-0 "><i class="bi bi-people text-light"></i> Student's <?php echo $studentCount; ?> </h3>
            </h3>
          </div>
      </div>
    </div>
    <!-- Card 2 -->
    <div class="col-md-4 mt-2">
      <div class="card bg-success bg-gradient">
        <div class="card-body py-4 px-3">
        <?php
            include 'dbcon.php'; // Include the database connection file

            $query = "SELECT COUNT(*) as news_count FROM news"; // Count the number of news
            $result = mysqli_query($con, $query);
            if ($result === false) {
              echo "Error executing the query: " . $con->error;
          } else {
              $row = $result->fetch_assoc();
              $newsCount = $row['news_count'];
          }
          $con->close();
          ?>
        <h3 class="card-title text-start text-light">Total News <?php echo $newsCount; ?> </h3>
        <h3 class="text-start"><i class="bi bi-newspaper text-light"></i></h3>
            
        </div>
      </div>
    </div>

    <!-- Card 3 -->
    <div class="col-md-4 mt-2">
      <div class="card bg-primary bg-gradient">
        <div class="card-body py-4 px-3">
        <?php
        include 'dbcon.php'; // Include the database connection file

        // Count the number of active news (status = 1)
        $activeNewsQuery = "SELECT COUNT(*) as active_news_count FROM news WHERE STATUS = 1";
        $activeNewsResult = mysqli_query($con, $activeNewsQuery);
        
        if ($activeNewsResult === false) {
          echo "Error executing the query: " . $con->error;
        } else {
          $activeNewsRow = $activeNewsResult->fetch_assoc();
          $activeNewsCount = $activeNewsRow['active_news_count'];
        }

        $con->close();
      ?>
        <h3 class="card-title text-start text-light">Active News <?php echo $activeNewsCount; ?></h3>
        <h3 class="text-start"><i class="bi bi-newspaper text-light"></i></h3>


        </div>
      </div>
    </div>

    <!-- Card 4 -->
    <div class="col-md-4 mt-2">
      <div class="card bg-success bg-gradient">
        <div class="card-body py-4 px-3">
        <?php
        include 'dbcon.php'; // Include the database connection file

        // Count the number of active news (status = 1)
        $inactiveNewsQuery = "SELECT COUNT(*) as inactive_news_count FROM news WHERE STATUS = 0";
        $inactiveNewsResult = mysqli_query($con, $inactiveNewsQuery);
        
        if ($inactiveNewsResult === false) {
          echo "Error executing the query: " . $con->error;
        } else {
          $inactiveNewsRow = $inactiveNewsResult->fetch_assoc();
          $inactiveNewsCount = $inactiveNewsRow['inactive_news_count'];
        }

        $con->close();
      ?>
        <h3 class="card-title text-start text-light">Inactive News <?php echo $inactiveNewsCount; ?></h3>
        <h3 class="text-start"><i class="bi bi-newspaper text-light"></i></h3>


        </div>
      </div>
    </div>
  </div>
</div>
</body>
</html>
<?php
?>

