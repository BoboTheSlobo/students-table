<?php
require 'dbcon.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="home_page.css">
    <title>Public</title>
    <style>
        /* Custom CSS for equal-sized cards */
        .card {
            height: 100%;
        }
        .card-img-top {
            object-fit: cover;
            height: 200px; /* Set the desired height */
        }
        .news_container{
          margin-top:100px;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg bg-dark fixed-top" aria-label="Twelfth navbar example">
  <div class="container-fluid">
    <h1 class="text-light">
     YourDailyNews
  </h1>
    <button class="navbar-toggler bg-white border-0 outline-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample10" aria-controls="navbarsExample10" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-md-end" id="navbarsExample10">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link  fs-2 text-light fw-light news_link " aria-current="page" href="#">News</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
<!-- Display News Cards -->
<div class="container news_container">
    <?php
    if (isset($con) && !empty($con)) {
        // Fetch news with status 1
        $status_query = "SELECT * FROM news WHERE Status = 1";
        $status_query_run = mysqli_query($con, $status_query);

        // Display news cards
        $counter = 0;
        echo '<div class="row">';
        while ($status_news = mysqli_fetch_assoc($status_query_run)) {
            ?>
            <div class="col-12 col-md-6 col-lg-3 mb-4">
                <div class="card border-dark">
                    <img src="<?= $status_news['Image']; ?>" class="card-img-top" alt="news image">
                    <div class="card-body">
                        <h5 class="card-title"><?= $status_news['Title']; ?></h5>
                        <p class="card-text"><?php echo substr($status_news['Description'], 0, 50); ?>...</p>
                        <!-- Button to Open Modal -->
                        <button class="btn btn-dark" type="button" data-bs-toggle="modal" data-bs-target="#myModal<?= $status_news['id']; ?>">
                            View Details
                        </button>
                    </div>
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="myModal<?= $status_news['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel"><?= $status_news['Title']; ?></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <img src="<?= $status_news['Image']; ?>" class="img-fluid" alt="news image">
                            <p><?= $status_news['Description']; ?></p>
                            <!-- Add other information as needed -->
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            $counter++;
            if ($counter % 4 == 0) {
                echo '</div><div class="row">'; // Start a new row after every 4 cards
            }
        }
        echo '</div>'; // Close the last row if not closed
    } else {
        echo "Error: Database connection not established.";
    }
    ?>
</div>
  </body>
</html>