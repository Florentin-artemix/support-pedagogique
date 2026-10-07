<?php 
ini_set('display_errors','off');

require("connexion.php");


$select1="SELECT * from enseignant ";
$req1=$pdo->query($select1);
$execute1=$req1->fetchAll(PDO::FETCH_ASSOC);


require('ma_session.php');

include("fonctions.php");

$id		=$_SESSION['user']['idUt'];
$login	=$_SESSION['user']['email'];
$role	=$_SESSION['user']['role'];



$select4="SELECT * from utilisateur where idUt=$id ";
$req4=$pdo->query($select4);
$execute4=$req4->fetchAll(PDO::FETCH_ASSOC);

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
            <?php if($role=="Administrateur" ){?>
            <li class="sidebar-item">
              <a class="sidebar-link" href="affectation.php" aria-expanded="false">
                <span>
                  <i class="fas fa-tags"></i>
                </span>
                <span class="hide-menu ">Affectation</span>
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

                   <h1>Liste des Enseigants</h1>
                        <table class="table text-start align-middle table-bordered table-hover mb-0">
                            <thead>
                                <tr class="text-dark">
                                    <th scope="col"><input class="form-check-input" type="checkbox"></th>
                               
                                    <th scope="col">ID</th>
                                    <th scope="col">NOM COMPLET</th>
                                    <th scope="col">NIVEAU</th>
                                    <th scope="col">SPECIALITE</th>
                                    <th scope="col">SEXE</th>
                                    
                                    <th scope="col">MATRICULE</th>

                                    <th scope="col">ACTION</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                                    foreach ($execute1 as $enseignant):?>
                                <tr>
                                    <td><input class="form-check-input" type="checkbox"></td>

                                    <td><?= $enseignant['idEnse'];?></td>
                                    <td><?= $enseignant['noms'];?></td>
                                    <td><?= $enseignant['Niveau'];?></td>
                                    <td><?= $enseignant['specialite'];?></td>
                                    <td><?= $enseignant['sexe'];?></td>
                                    
                                    <td><?= $enseignant['matricule'];?></td>


                                    <td>
                                    <a href="#"><i class="fa fa-edit editBtn"  nom="updateBtn"data-bs-toggle="modal" data-bs-target="#editModal<?= $enseignant['idEnse']; ?>" data-bs-whatever="@mdo<? echo $etudiant['idEnse'];?>"></i></a>
                                        &nbsp;&nbsp;

                                        <a href="#"> <i class="fa fa-trash-alt red-icon" data-bs-toggle="modal" data-bs-target="#exampleModal5<?= $enseignant['idEnse']; ?>"<?= $enseignant['idEnse']; ?>></i></a>
                                    
<!-- 
                                        <a href="ficheId.php?idIng=<?php echo $etudiant['idIng']?>" >
                                        <span class="">|||Fiche</span>
                                        </a> -->
                                      </td>

                                </tr>

                                <?php 
                                    endforeach;?>
                            </tbody>
                        </table>


            </div>
            <!-- Table End -->
                    </div>

                    <div>
                            <div class="text-left">
                                <button type="button" class="bi bi-plus btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo">Ajouter un nouvel agent</button>
                             </div>
                    </div>
                    <!-- <button type="submit" class="btn btn-primary">Submit</button> -->
                  </form>
                </div>
              </div>


              <?php 
   foreach ($execute1 as $enseignant):?>
  <div class="modal fade" id="exampleModal5<?= $enseignant['idEnse'];?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <p>Voulez-vous supprimer cet enseignant? <?= $enseignant['noms'];?></p>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Non</button>
        <a href="supEnseignant.php?idEnse=<?= $enseignant['idEnse'];?>" class="m-2">
        <button type="submit" class="btn btn-secondary">OUI</button>
        </a>
      </div>
    </div>
  </div>
</div>
<?php 
   endforeach;?>

    <!-- fin supfin -->
    <?php 
   foreach ($execute1 as $enseignant):?>
        <div class="modal fade" id="editModal<?= $enseignant['idEnse'];?>" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="editModalLabel">MODIFIER UN ENSEIGNANT</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
          
                <div class="modal-body">
                      <form action="modEnseignant.php" method="POST" enctype="multipart/form-data">
                  <div class="col">
                      <label for="noms" class="col-form-label">Numero <?php echo $enseignant['idEnse']; ?> </label>
                      <input type="hidden" class="form-control" id="id_enseignant" value="<?php echo $enseignant['idEnse']; ?>" name="id_enseignant">
                    </div>
                  <div class="row">
                    <div class="col">
                    <label for="noms" class="col-form-label">*Noms: </label>
                  <input type="text"  required="required" class="form-control" id="nom" value="<?= $enseignant['noms'];?> " name="nom" >
                    </div>
                    <div class="col">
                      <label for="Postnom" class="col-form-label">*Niveau:</label>
                      <input type="text" required="required" class="form-control" id="Niveau" value="<?= $enseignant['Niveau'];?>" name="Niveau" >
                    </div>
                    </div>




                    <div class="row">
                    <div class="col-6">
                      <label for="departement" class="col-form-label">*Specialite:</label>

                      <input type="text" required="required" class="form-control" id="specialite" value="<?= $enseignant['specialite'];?>" name="specialite" >

                    </div>
                    <div class="col-6">
                        <label for="sexe" class="col-form-label">*Sexe:</label>

                        <select name="sexe" id="sexe" class="form-select">

                        <option   value="<?= $enseignant['sexe'] ?>"> <?= $enseignant['sexe']?> </option>
                        <option value="M">M</option>
                        <option value="F">F</option>

                        </select>
                    </div>
                    </div>
                    <div class="row">

                    <!-- </div> -->

                    <div class="col">
                      <label for="photo" class="col-form-label">*Matricule:</label>
                      <input type="text" required="required"   class="form-control" id="matricule" value="<?= $enseignant['matricule'];?>" name="matricule" >
                    </div>
                    <div class="col">
                      <label for="image" class="col-form-label">*Image:</label>
                      <input type="file" accept="image/jpeg,image/png,image/gif,image/webp"  class="form-control" id="image" value="" name="image" >

                    </div>
                    </div>
                    <hr>
                    <div class="text-center">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                  <button type="submit" name="updatefin" id="updatedata" class="btn btn-primary">Modifier</button>
                    </div>
                  </form>
              </div>
            </div>
          </div>
          </div>
           <?php 
   endforeach;?>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel" style="font-family:algerian, sans-serif";>Nouvel enseignant</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form action="insertEnseignant.php" method="POST" style="color:black" enctype="multipart/form-data">
                  <div class="col">
                      <label for="id_enseignant" class="col-form-label">Numero </label>
                      <input type="hidden" class="form-control" id="id_enseignant" value="" name="id_enseignant">
                    </div>
                  <div class="row">
                    <div class="col">
                  <label for="message-text" class="col-form-label">*Noms:</label>
                  <input type="text"  required="required" class="form-control" id="nom" value="" name="nom" >
                    </div>
                    <div class="col">
                      <label for="specialiste" class="col-form-label">*Specialite:</label>
                      <input type="text" required="required" class="form-control" id="specialite" value="" name="specialite" >
                    </div>
                    </div>
                    <div class="row">
                    <div class="col-6">
                    <label for="specialiste" class="col-form-label">*Niveau:</label>
                    <input type="text" required="required" class="form-control" id="Niveau" value="" name="Niveau" >
                    </div>
                    <div class="col-6">
                    <label for="sexe" class="col-form-label">*Sexe:</label>

                      <select name="sexe" id="sexe" class="form-select">

                      
                      <option value="M">M</option>
                      <option value="F">F</option>

                      </select>
                    </div>
                    </div>
                    <div class="row">

                    </div>
                    <div class="row">
  
                    <div class="col">
                      <label for="matricule" class="col-form-label">*Matricule:</label>
                      <input type="text" required="required"   class="form-control" id="matricule" value="" name="matricule">
                    </div>
                    <div class="col">
                      <label for="image" class="col-form-label">*Image:</label>
                      <input type="file" accept="image/jpeg,image/png,image/gif,image/webp"  class="form-control" id="image" value="" name="image" >

                    </div>
                    </div>
                <hr>
                <div class="text-center">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                  <button type="submit" name="finance" class="btn btn-primary">Ajouter</button>
                  </div>
                  </form>
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
  <script src="assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="assets/js/sidebarmenu.js"></script>
  <script src="assets/js/app.min.js"></script>
  <script src="assets/libs/simplebar/dist/simplebar.js"></script>
</body>

</html>