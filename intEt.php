
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Accès aux support</title>
  <link rel="stylesheet" href="public/fontawesome-free-6.2.0-web/css/all.min.css">
  <!-- <link rel="shortcut icon" type="image/png" href="assets/images/logos/favicon.png" /> -->
  <link rel="stylesheet" href="assets/css/styles.min.css" />
  <!-- <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="assets/css/monStyle.css">
		<link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
		

  		<script src="../js/jquery-1.10.2.js"></script>
		<script src="../js/bootstrap.min.js"></script> -->
</head>
<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <!-- Sidebar Start -->
    <aside class="left-sidebar">
      <!-- Sidebar scroll-->
      <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
          <h3 class="modal-title"  style="font-family:algerian, sans-serif";>
             BIENVENUE
            </h3>
          <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
            <i class="ti ti-x fs-8"></i>
          </div>
        </div>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
        <ul id="sidebarnav">
            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">Accueil</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="dashboard.php" aria-expanded="false">
                <span>
                  <i class="ti ti-layout-dashboard"></i>
                </span>
                <span class="hide-menu">Tableau de bord</span>
              </a>
            </li>
            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">Nos Menus</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="etudiants.php" aria-expanded="false">
                <span>
                  <i class="fas fa-graduation-cap"></i>
                </span>
                <span class="hide-menu ">Etudiants</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="av-item sidebar-link " href="enseignants.php" aria-expanded="false">
                <span>
                  <i class="fas fa-chalkboard-teacher"></i>
                </span>
                <span class="hide-menu">Enseigants</span>
              </a>
            </li>
            <?php  ?>
            <li class="sidebar-item">
              <a class="sidebar-link " href="supports.php" aria-expanded="false">
                <span>
                  <i class="fas fa-book"></i>
                </span>
                <span class="hide-menu">Supports</span>
              </a>
            </li>
            <?php  ?>
            <li class="sidebar-item">
              <a class="sidebar-link" href="categories.php" aria-expanded="false">
                <span>
                  <i class="fas fa-tags"></i>
                </span>
                <span class="hide-menu active">Catégories</span>
              </a>
            </li>
            
            <li class="sidebar-item">
              <a class="sidebar-link " href="promotion.php" aria-expanded="false">
                <span>
                  <i class="fas fa-chalkboard"></i>
                </span>
                <span class="hide-menu">Promotion</span>
              </a>
            </li>

            <li class="sidebar-item">
              <a class="sidebar-link " href="section.php" aria-expanded="false">
                <span>
                  <i class="fas fa-building "></i>
                </span>
                <span class="hide-menu">Section</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link " href="affectation.php" aria-expanded="false">
                <span>
                  <i class="fas fa-building "></i>
                </span>
                <span class="hide-menu">VISUALISER L'AFFECTATION</span>
              </a>
            </li>

            <li class="sidebar-item">
              <a class="sidebar-link" href="utilisateurs.php" aria-expanded="false">
                <span>
                  <i class="fas fa-users"></i>
                </span>
                <span class="hide-menu">Utilisateurs</span>
              </a>
            </li>
            <?php ?>
            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">AUTH</span>
            </li>
            <li class="sidebar-item">
            <a class="sidebar-link" href="seDeconnecter.php" aria-expanded="false">
                <span>
                  <i class="ti ti-login"></i>
                </span>
                <span class="hide-menu">Déconnexion</span>
              </a>
            </li>
            
          </ul>

        </nav>
        <!-- End Sidebar navigation -->
      </div>
      <!-- End Sidebar scroll-->
    </aside>
    <!--  Sidebar End -->
    <!--  Main wrapper -->
    <div class="body-wrapper">
      <!--  Header Start -->
      <header class="app-header">
      <nav class="navbar navbar-expand-lg navbar-light">
          <ul class="navbar-nav">
            <li class="nav-item d-block d-xl-none">
              <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse" href="javascript:void(0)">
                <i class="ti ti-menu-2"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link nav-icon-hover" href="javascript:void(0)">
                <i class="ti ti-bell-ringing"></i>
                <div class="notification bg-primary rounded-circle"></div>
              </a>
            </li>
          </ul>
          <?php foreach($execute4 as $oeuvre):?>

          <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
            <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
            <h3><span class="d-none d-lg-inline-flex"><?php echo $oeuvre['email']; ?></span></h3>

              <li class="nav-item dropdown">
                <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown"
                  aria-expanded="false">
                        <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
                  <img src="<?= 'fichiers/imagesUt/'.$oeuvre['image'] ?>" alt="" width="35" height="35" class="rounded-circle">

                  <!-- <img class="rounded-circle" src="<?= 'images/utilisateur/'.$oeuvre['image'] ?>" alt="" style="width: 40px; height: 40px;"> -->
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                  <div class="message-body">


  
                    <a href="seDeconnecter.php" class="btn btn-outline-primary mx-3 mt-2 d-block">Logout</a>
                  </div>
                </div>
              </li>
            </ul>
          </div>
          <?php endforeach; ?>
        </nav>
      </header>
      <!--  Header End -->
      
      <div class="container-fluid">
        <div class="container-fluid">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title fw-semibold mb-4">Accès aux supports en ligne</h5>
              <div class="card">
                <div class="card-body">
                  <form>
                    <div class="mb-3">

            <!-- Table Start -->
            <div class="container-fluid pt-4 px-4">

                   <h1>Liste des supports</h1>
                        <table class="table text-start align-middle table-bordered table-hover mb-0">
                <!-- <form class="d-none d-md-flex ms-4"> -->
                <div class="row">
                  <div class="col-6">
                    <input class="form-control " value="<?php echo $Titre ?>" type="search" placeholder="Tapez le titre du document" id="Titre" name="Titre">
                    
                  
                  </div>
                    <div class="col-6">
                    <button type="submit" class="bi bi-plus btn btn-primary" >Rechecher</button>
                    </div>
                    <thead>
                                <tr class="text-dark">
                                    <th scope="col"><input class="form-check-input" type="checkbox"></th>
                               
                                    <th scope="col">ID</th>
                                    <th scope="col">TITRE</th>
                                    <th scope="col">VOLUME CMI</th>
                                    <th scope="col">VOLUME TD</th>
                                    <!-- <th scope="col">DATE PUB</th> -->
                                    
                                    <th scope="col">VOLUME TP</th>
                                    <th scope="col">NIVEAU</th>
                                    <!-- <th scope="col">AUTEUR</th> -->
                                    <th scope="col">CATEGORIE</th>
                                    <th scope="col">ACTION</th>
                                    
                                </tr>
                            </thead>
                            <tbody>

                            <?php foreach ($execute1 as $support):?>
                                        

                                <tr>

                                    <td><input class="form-check-input" type="checkbox"></td>

                                    <td ><?= $support['idSup'];?></td>
                                    <td><?= $support['Titre'];?></td>
                                    <td><?= $support['volEx'];?></td>
                                    <td><?= $support['volTD'];?></td>
                                    <!-- <td><?= $support['dateMisLign'];?></td> -->
                                    
                                    <td><?= $support['volTP'];?></td>
                                    <td><?= $support['libelle'];?></td>
                                    <!-- <td><?= $support['noms'];?></td> -->
                                    <td><?= $support['nomCat'];?></td>

                                    
                                    <td>
                                    <?php if($role=="Administrateur" ){?>
                                    <a href="#"><i class="fa fa-edit editBtn"  nom="updateBtn"data-bs-toggle="modal" data-bs-target="#editModal<?= $support['idSup']; ?>" data-bs-whatever="@mdo<? echo $support['idSup'];?>"></i></a>
                                        &nbsp;&nbsp;
                                        
                                        <a href="#"> <i class="fa fa-trash-alt red-icon" data-bs-toggle="modal" data-bs-target="#exampleModal5<?= $support['idSup']; ?>"<?= $support['idSup']; ?>></i></a>
                                        <?php } ?>
                                        
                                        <a href="fichiers/supportFiles/<?= $support['Fichier']; ?>" download="fichiers/supportFiles/<?= $support['Fichier']; ?>"><i class="fa fa-download"></i> </a>
                                        

                                        
                                        <?php endforeach;?> 
                                </tr>
                                <?php  ?>

    <script src="assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="assets/js/sidebarmenu.js"></script>
  <script src="assets/js/app.min.js"></script>
  <script src="assets/libs/simplebar/dist/simplebar.js"></script>
</body>
</html>