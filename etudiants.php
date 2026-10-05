<?php 
// ini_set('display_errors','off');

require("connexion.php");


$select1="SELECT *, idProm, idDep, idSec, promotion.libelle as promotion1,
 departement.libelle as departement1, section.libelle as section1 
from etudiant 
inner join promotion on promotion.idProm=etudiant.promotion 
inner join departement on promotion.idDepa=departement.idDep 
inner join section on departement.idSect=section.idSec";
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

// $select4="SELECT * from utilisateur where idUt=$id ";
// $req4=$pdo->query($select4);
// $execute4=$req4->fetchAll(PDO::FETCH_ASSOC);


$select3="SELECT idProm, idDep, idSec, promotion.libelle as promotion2,
departement.libelle as departement2, section.libelle as section2 from promotion  
inner join departement on promotion.idDepa=departement.idDep 
inner join section on departement.idSect=section.idSec";
$req3=$pdo->query($select3);
$execute3=$req3->fetchAll(PDO::FETCH_ASSOC);


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
             BIENVENUE A l'INTERFACE ETUDIANT
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
                <span class="hide-menu active">Etudiants</span>
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
              <a class="sidebar-link" href="categories.php" aria-expanded="false">
                <span>
                  <i class="fas fa-tags"></i>
                </span>
                <span class="hide-menu ">Catégories</span>
              </a>
            </li>
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

                   <h1>Liste des Etudiants</h1>
                        <table class="table text-start align-middle table-bordered table-hover mb-0">
                            <thead>
                                <tr class="text-dark">
                                    <th scope="col"><input class="form-check-input" type="checkbox"></th>
                               
                                    <th scope="col">ID</th>
                                    <th scope="col">NOM COMPLET</th>
                                    <th scope="col">PROMOTION</th>
                                    <th scope="col">DEPARTEMENT</th>
                                    <th scope="col">SECTION</th>
                                    <th scope="col">SEXE</th>
                                    
                                    <th scope="col">MATRICULE</th>

                                    <th scope="col">ACTION</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                                    foreach ($execute1 as $etudiant):?>
                                <tr>
                                    <td><input class="form-check-input" type="checkbox"></td>

                                    <td><?= $etudiant['idEt'];?></td>
                                    <td><?= $etudiant['nom'];?></td>
                                    <td><?= $etudiant['promotion1'];?></td>
                                    <td><?= $etudiant['departement1'];?></td>
                                    <td><?= $etudiant['section1'];?></td>
                                    <td><?= $etudiant['sexe'];?></td>
                                    
                                    <td><?= $etudiant['matricule'];?></td>


                                    <td>
                                    <a href="#"><i class="fa fa-edit editBtn"  nom="updateBtn"data-bs-toggle="modal" data-bs-target="#editModal<?= $etudiant['idEt']; ?>" data-bs-whatever="@mdo<? echo $etudiant['idEt'];?>"></i></a>
                                        &nbsp;&nbsp;

                                        <a href="#"> <i class="fa fa-trash-alt red-icon" data-bs-toggle="modal" data-bs-target="#exampleModal5<?= $etudiant['idEt']; ?>"<?= $etudiant['idEt']; ?>></i></a>
                                    
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
                                <button type="button" class="bi bi-plus btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo">Ajouter un étudiant</button>
                             </div>
                    </div>
                    <!-- <button type="submit" class="btn btn-primary">Submit</button> -->
                  </form>
                </div>
              </div>


              <?php 
   foreach ($execute1 as $etudiant):?>
  <div class="modal fade" id="exampleModal5<?= $etudiant['idEt'];?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <p>Voulez-vous supprimer cet étudiant? <?= $etudiant['nom'];?></p>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Non</button>
        <a href="supEtudiant.php?idEt=<?= $etudiant['idEt'];?>" class="m-2">
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
   foreach ($execute1 as $etudiant):?>
        <div class="modal fade" id="editModal<?= $etudiant['idEt'];?>" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="editModalLabel">MODIFIER UN ETUDIANT</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
          
                <div class="modal-body">
                      <form action="modEtudiant.php" method="POST" enctype="multipart/form-data">
                  <div class="col">
                      <label for="Idagent" class="col-form-label">Numero <?php echo $etudiant['idEt']; ?> </label>
                      <input type="hidden" class="form-control" id="idEt" value="<?php echo $etudiant['idEt']; ?>" name="id_etudiant">
                    </div>
                  <div class="row">
                    <div class="col">
                  <label for="message-text" class="col-form-label">*Nom:</label>
                  <input type="text"  required="required" class="form-control" id="nom" value="<?= $etudiant['nom'];?> " name="nom" >
                    </div>
                    <div class="col">
                      <label for="Postnom" class="col-form-label">*Promotion:</label>
                      <select name="promotion" id="promotion" class="form-select">

                      <option   value="<?= $etudiant['promotion'] ?>"> <?= $etudiant['promotion']?> </option>
                      <?php  foreach ($execute3 as $promotion):?>
                                        
                                
                                    <option value="<?= $promotion['idProm'] ?>"> <?= $promotion['promotion2'].' '.$promotion['departement2'].' '.$promotion['section2']?> </option>
                                        <?php 
                                            endforeach;?> 
                      
                      </select>
                    </div>
                    </div>
                    




                    <div class="row">
                    
                    <div class="col-6">
                        <label for="sexe" class="col-form-label">*Sexe:</label>

                        <select name="sexe" id="sexe" class="form-select">

                        <option   value="<?= $etudiant['sexe'] ?>"> <?= $etudiant['sexe']?> </option>
                        <option value="M">M</option>
                        <option value="F">F</option>

                        </select>
                    </div>
                    
                    <div class="col-6">
                      <label for="photo" class="col-form-label">*Matricule:</label>
                      <input type="text" required="required" readonly  class="form-control" id="matricule" value="<?= $etudiant['matricule'];?>" name="matricule" >
                    </div>
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
                  <h5 class="modal-title" id="exampleModalLabel" style="font-family:algerian, sans-serif";>Nouvel Etudiant</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form action="insertEtudiant.php" method="POST" style="color:black" enctype="multipart/form-data">
                  <div class="col">
                      <label for="Idagent" class="col-form-label">Numero </label>
                      <input type="hidden" class="form-control" id="idEt" value="" name="Idagent">
                    </div>
                  <div class="row">
                    <div class="col">
                  <label for="message-text" class="col-form-label">*Nom:</label>
                  <input type="text"  required="required" class="form-control" id="nom" value="" name="nom" >
                    </div>
                    <div class="col">
                      <label for="promotion" class="col-form-label">*Promotion:</label>
                    <select name="promotion" id="promotion" class="form-select">

                      <option   disabled selected value=""> Sélectionner ici </option>
                      <?php  foreach ($execute3 as $promotion):?>
                                        
                                
                                    <option value="<?= $promotion['idProm'] ?>"> <?= $promotion['promotion2'].' '.$promotion['departement2'].' '.$promotion['section2']?> </option>
                                        <?php 
                                            endforeach;?> 
                      
                      </select>                    </div>
                    </div>
                    <div class="row">
                    
                    <div class="col-6">
                    <label for="sexe" class="col-form-label">*Sexe:</label>

                      <select name="sexe" id="sexe" class="form-select">

                      
                      <option value="M">M</option>
                      <option value="F">F</option>

                      </select>
                    </div>
                    <div class="col">
                      <label for="photo" class="col-form-label">*Matricule:</label>
                      <input type="text" required="required"   class="form-control" id="matricule" value="" name="matricule">
                    </div>
                    </div>
                    <div class="col">
                      <label for="image" class="col-form-label">*Image:</label>
                      <input type="file" accept="image/jpeg,image/png,image/gif,image/webp"  class="form-control" id="image" value="" name="image" >

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