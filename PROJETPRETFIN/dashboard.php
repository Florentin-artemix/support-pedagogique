<?php 
ini_set('display_errors','off');

require("connexion.php");



require('ma_session.php');

include("fonctions.php");

$id		=$_SESSION['user']['idUt'];
$login	=$_SESSION['user']['email'];
$role	=$_SESSION['user']['role'];

$select4="SELECT * from utilisateur where idUt=$id ";
$req4=$pdo->query($select4);
$execute4=$req4->fetchAll(PDO::FETCH_ASSOC);

$req1 = "SELECT COUNT(*) from enseignant";

$res1 = $pdo->query($req1);
$Ens = $res1->fetchColumn();

$req11 = "SELECT COUNT(*) from etudiant";

$res11 = $pdo->query($req11);
$et = $res11->fetchColumn();

$req111 = "SELECT COUNT(*) from support";

$res111 = $pdo->query($req111);
$sup = $res111->fetchColumn();

?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Accès aux support</title>
  <link rel="stylesheet" href="public/fontawesome-free-6.2.0-web/css/all.min.css">
  <!-- <link rel="shortcut icon" type="image/png" href="assets/images/logos/favicon.png" /> -->
  <link rel="stylesheet" href="assets/css/styles.min.css" />
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
            BIENVENUE AU BUREAU ADMNISTRATIF DU DEPARTEMENT
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

            <?php if($role=="Administrateur" ){?>
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
            <?php } ?>

            <?php if($role=="Administrateur" or $role=="Enseignant" or  $role=="Etudiant"){?>
            <li class="sidebar-item">
              <a class="sidebar-link " href="supports.php" aria-expanded="false">
                <span>
                  <i class="fas fa-book"></i>
                </span>
                <span class="hide-menu">Supports</span>
              </a>
            </li>
            <?php } ?>
            <?php if($role=="Administrateur"){?>
            <li class="sidebar-item">
              <a class="sidebar-link" href="affectation.php" aria-expanded="false">
                <span>
                  <i class="fas fa-tags"></i>
                </span>
                <span class="hide-menu ">Affectation</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="inscription.php" aria-expanded="false">
                <span>
                  <i class="fas fa-tags"></i>
                </span>
                <span class="hide-menu ">INSCRIPTION ETUDIANTS</span>
              </a>
            </li>
            <?php } ?>
            <?php if($role=="Enseignant"){?>
            <li class="sidebar-item">
              <a class="sidebar-link" href="affectation2.php" aria-expanded="false">
                <span>
                  <i class="fas fa-tags"></i>
                </span>
                <span class="hide-menu ">Affectation</span>
              </a>
            </li>
            <?php } ?>
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
        <!--  Row 1 -->
          <!-- <div class="col-lg-4"> -->
            <div class="row">
              <div class="col-lg-8">
                <!-- Yearly Breakup -->
                <div class="card overflow-hidden">
                  <div class="card-body p-4">
                    <h5 class="card-title mb-9 fw-semibold">Les enseignants</h5>
                    <div class="row align-items-center">
                      <div class="col-8">
                        <h4 class="fw-semibold mb-3"><?php echo $Ens." Enseignant (s)"; ?></h4>

                        <div class="d-flex align-items-center">

                        </div>
                      </div>
                      <div class="col-4">
                        <div class="d-flex justify-content-center">
                       
                        </div>
                      </div>
                    </div>
                  </div>




                <!-- </div> -->





                </div>
                
                <div class="col-lg-8">
                <!-- Yearly Breakup -->
                <div class="card overflow-hidden">
                  <div class="card-body p-4">
                    <h5 class="card-title mb-9 fw-semibold">Les étudiants</h5>
                    <div class="row align-items-center">
                      <div class="col-8">
                        <h4 class="fw-semibold mb-3"><?php echo $et." Etudiant(s)"; ?></h4>

                        <div class="d-flex align-items-center">

                        </div>
                      </div>
                      <div class="col-4">
                        <div class="d-flex justify-content-center">
                          
                        </div>
                      </div>
                    </div>
                  </div>
              </div>




              <div class="col-lg-8">
                <!-- Yearly Breakup -->
                <div class="card overflow-hidden">
                  <div class="card-body p-4">
                    <h5 class="card-title mb-9 fw-semibold">Les Supports</h5>
                    <div class="row align-items-center">
                      <div class="col-8">
                        <h4 class="fw-semibold mb-3"><?php echo $sup." Support(s)"; ?></h4>

                        <div class="d-flex align-items-center">

                        </div>
                      </div>
                      <div class="col-4">
                        <div class="d-flex justify-content-center">
                          
                        </div>
                      </div>
                    </div>
                  </div>
              </div>

                  
                </div>
              </div>
            </div>
          </div>
        </div>
        
          </div>
        </div>
        <div class="py-6 px-6 text-center">
          <p class="mb-0 fs-4">Design and Developed by <a href="https://isp-bkv.ac.cd/" target="_blank" class="pe-1 text-primary text-decoration-underline">Irs PRINCE ABIBU;YOSHUA AYAMBA;ZIGASHANE BALUNGWE</a> Distributed by <a href="https://isp-bkv.ac.cd">ISP-BUKAVU</a></p>
        </div>
      </div>
    </div>
  </div>
  <script src="assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="assets/js/sidebarmenu.js"></script>
  <script src="assets/js/app.min.js"></script>
  <script src="assets/libs/apexcharts/dist/apexcharts.min.js"></script>
  <script src="assets/libs/simplebar/dist/simplebar.js"></script>
  <script src="assets/js/dashboard.js"></script>
</body>

</html>