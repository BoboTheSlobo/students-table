<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Dashboard - Client area</title>
    <link rel="stylesheet" href="./css./style.css"/>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<nav class="navbar navbar-expand-lg bg-body-secondary">
  <div class="container-fluid">
    <a class="navbar-brand me-5" href="#"><h2 class="">BrandName</h2></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav   mb-2 mb-lg-0 d-flex align-items-lg-center navbar_links_container">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#home">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#about">About</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#services" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Services
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#first-service">First Service</a></li>
            <li><a class="dropdown-item" href="#second-service">Second Service</a></li>
            <li><a class="dropdown-item" href="#something-else">Something else here</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#blog">Blog</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#contact">Contact</a>
        </li>
        <li class="nav-item ms-lg-3">
        <form class="form-inline">
    <div class="input-group">
      <input type="text" class="form-control " placeholder="Search by Name" aria-label="Search" aria-describedby="basic-addon2">
      <div class="input-group-append">
        <button class="btn btn-outline-secondary" type="button">
          <i class="bi bi-search"></i>
        </button>
      </div>
    </div>
  </form>
       </li>
       <li class="nav-item ms-lg-auto">
         <div class="align-items-center ps-lg-3">
           <ul class="mb-0 list-unstyled">
             <li class="nav-item dropdown ">
               <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                 <img class="rounded-circle me-1 user_image" src="./assets/profile-picture.png" alt="picture" > Slobodan Ivanovski
               </a>
               <ul class="dropdown-menu">
                 <li><a class="dropdown-item" href="#profile"><i class="bi bi-person-circle me-1"></i> Profile</a></li>
                 <li><a class="dropdown-item" href="logout.php"><i class="bi bi-box-arrow-right me-1"></i> Logout</a></li>
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
  <div class="row  gap-2 gap-sm-2 gap-md-0 ">

    <!-- Card 1 -->
    <div class="col-md-3">
      <div class="card bg-primary bg-gradient">
        <div class="card-body p-4">
          <h5 class="card-title">Student 0</h5>
          <p class="card-text">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Voluptate, officiis?</p>
        </div>
      </div>
    </div>

    <!-- Card 2 -->
    <div class="col-md-3">
      <div class="card bg-success bg-gradient">
        <div class="card-body p-4">
        <p class="card-text">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Voluptate, officiis?</p>
        </div>
      </div>
    </div>

    <!-- Card 3 -->
    <div class="col-md-3">
      <div class="card bg-warning bg-gradient">
        <div class="card-body p-4">
        <p class="card-text">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Voluptate, officiis?</p>
        </div>
      </div>
    </div>

    <!-- Card 4 -->
    <div class="col-md-3">
      <div class="card bg-danger bg-gradient">
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

