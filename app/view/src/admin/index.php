<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <!-- Custom styles for this template -->
    <link href="../../assets/css/bootstrap-4.5.3.css" rel="stylesheet">
    <link href="../../assets/css/darkreader.css" rel="stylesheet">
    <link href="dashboard.css" rel="stylesheet">
  </head>
  <body>
    <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
  <a class="col-md-3 col-lg-2 mr-0 px-3" href="#"><h1 class="py-3">JusticiaLaw</h1></a>
  <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-toggle="collapse" data-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <ul class="navbar-nav px-3">
    <li class="nav-item text-nowrap">
      <a class="nav-link" href="#">Sign out</a>
    </li>
  </ul>
</nav>

<div class="container-fluid">
  <div class="row">
    <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
      <div class="sidebar-sticky pt-3">
        <ul class="nav flex-column">
          <li><a href="home" class="nav-item nav-link">Home</a>
          <li><a href="admin_view" class="nav-item nav-link <?php if ($uri === 'admin_view') {echo 'active';} ?>">Admin</a>
          <li><a href="admin_add_location" class="nav-item nav-link <?php if ($uri === 'admin_add_location') {echo 'active';} ?>">Add location</a>
          <li><a href="admin_add_education" class="nav-item nav-link <?php if ($uri === 'admin_add_education') {echo 'active';} ?>">Add education</a>
          <li><a href="admin_add_experience" class="nav-item nav-link <?php if ($uri === 'admin_add_experience') {echo 'active';} ?>">Add experience</a>
          <li><a href="admin_add_practice_areas" class="nav-item nav-link <?php if ($uri === 'admin_add_practice_areas') {echo 'active';} ?>">Add practice areas</a>
          <li>
            <label class="switch ml-5 mt-2">
              <input id="toggleDarkMode" type="checkbox">
              <span class="slider round"></span>
            </label>
          </li>
        </ul>
      </div>
    </nav>

  </div>
</div>
<script src="../../assets/lib/jquery/jquery.min.js"></script>
<script src="../../assets/lib/bootstrapbundlejs/bootstrap.bundle.min.js"></script>
<script src="dashboard.js"></script>
<script src="../../assets/js/main.js"></script>

<!-- Dark mode Api -->
<script src="../../assets/lib/darkreader/darkreader.min.js"></script>
<script src="../../assets/lib/darkreader/darkreader.config.js"></script>

</body>
</html>