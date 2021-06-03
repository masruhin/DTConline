<nav class="navbar navbar-expand-md navbar-light fixed-top" style="padding-top: 1px; margin-top:0px; background-color: #06d2bf; box-shadow: 0px 4px 10px #999;">
  <!-- <div class="container"> -->
  <div class="container-fluid">

    <h6 class="mb-2 mb-md-0" style="color:black; font-weight:normal; font-size:x-small;">
      <a href="javascript:void(0)" class="brand-link">
        <img src="dist/img/<?php echo $TampilProfil['gambar'] ?>" class="img-circle elevation-2" alt="User Image" class="avatar" style="vertical-align: middle; width: 40px; height: 40px;">
        <span class="brand-text font-weight-light"><?php echo $TampilProfil['nama'] ?></span>
      </a>
    </h6>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarCollapse">
      <ul class="navbar-nav me-auto mb-2 mb-md-0">
        <li class="nav-item">
          <a href="Dashboard.php" class="nav-link"><i class="fa fa-home"> Home</i></a>
        </li>

        <li class="nav-item dropdown">
          <a href="" class="nav-link dropdown-toggle" href="" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-cog"> Master Data</i>
          </a>

          <!-- <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-list-ul text-dark"></i>
            Dropdown
          </a> -->
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="DataGuru.php">Data Accessor </a>
            <a class="dropdown-item" href="DataSiswa.php">Data Students</a>
            <a class="dropdown-item" href="DataKelas.php">Data Class</a>
          </div>
        </li>

        <li class="nav-item dropdown">
          <a href="" class="nav-link dropdown-toggle" href="" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-cog"> Configurasi</i></a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="SetApp.php">Setting Application </a>
            <a class="dropdown-item" href="SetDocs.php">Setting Document</a>
            <!-- <a class="dropdown-item" href="SetAdmin.php">Setting Account</a> -->
          </div>
        </li>

        <li class="nav-item dropdown">
          <a href="" class="nav-link dropdown-toggle" href="" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-database"> Database</i></a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="Restart.php"> Restart Database </a>
          </div>
        </li>
      </ul>

      <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
          <a href="" class="nav-link dropdown-toggle" href="" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-comments text-dark"> Message</i></a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="PesanGuru.php">Accessor Message </a>
            <a class="dropdown-item" href="PesanSiswa.php">Students Message</a>
          </div>
        </li>
        <li class="nav-item dropdown">
          <a href="#" class="nav-link dropdown-toggle" id="dropdown-2" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-user-edit text-dark"></i>
            Accessor</a>
          <div class="dropdown-menu" aria-labelledby="dropdown-2">
            <a class="dropdown-item" href="SetAdmin.php">Setting Account</a>
            <a href='../../login.php' class="dropdown-item">Log-out</a>
          </div>
        </li>
      </ul>

      <!-- <form action="" style="width: 150px;">
          <div class="input-group input-group-sm">
            <input type="text" class="form-control">
            <div class="input-group-append">
              <button class="btn btn-primary">Cari</button>
            </div>
          </div>
        </form> -->

    </div>
  </div>
</nav>