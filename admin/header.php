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
            <li><a class="dropdown-item text-white" href="news.php">News</a></li>
            <li><a class="dropdown-item text-white" href="#second-service">Contact</a></li>
          </ul>
        </li>
        <li class="nav-item ms-lg-3">
        <form class="form-inline m-0">
    <div class="input-group">
      <input type="text" class="form-control rounded  outline-0 " placeholder="Search by Name" aria-label="Search" aria-describedby="basic-addon2">
      <div class="input-group-append bg-white ms-1 rounded">
        <button class="btn btn-outline-secondary  border-0 p-3" type="button">
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