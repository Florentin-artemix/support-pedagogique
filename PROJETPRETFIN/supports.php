<?php 
// ini_set('display_errors','off');
require("connexion.php");

if(isset($_GET['Titre'])){
  $Titre=$_GET['Titre'];

}
else{

 
  $Titre="";
  // $requete=" SELECT * 
  // FROM support		  
  // WHERE Titre like '%$Titre%'
  //  ";


}



$select1="SELECT *  from support 
inner join promotion on support.idPromo=promotion.idProm
inner join categorie on support.categorie=categorie.idCat where Titre like '%$Titre%'";
$req1=$pdo->query($select1);
$execute1=$req1->fetchAll(PDO::FETCH_ASSOC);




$select="SELECT idProm, idDep, idSec, promotion.libelle as promotion2,
departement.libelle as departement2, section.libelle as section2 from promotion  
inner join departement on promotion.idDepa=departement.idDep 
inner join section on departement.idSect=section.idSec";
$req=$pdo->query($select);
$execute=$req->fetchAll(PDO::FETCH_ASSOC);

$select2="SELECT * from categorie";
$req2=$pdo->query($select2);
$execute2=$req2->fetchAll(PDO::FETCH_ASSOC);

require('ma_session.php');

include("fonctions.php");

$id		=$_SESSION['user']['idUt'];
$login	=$_SESSION['user']['email'];
$role	=$_SESSION['user']['role'];


$select4="SELECT * from utilisateur where idUt=$id ";
$req4=$pdo->query($select4);
$execute4=$req4->fetchAll(PDO::FETCH_ASSOC);

// $reqProm="SELECT * from etudiant 
// inner join promotion on promotion.idProm=etudiant.promotion 
// where idUt=$id ";
// $resultProm=$pdo->query($reqProm);
// $toutes_promotions=$resultProm->fetchAll(PDO::FETCH_ASSOC);

// $select111="SELECT *  from support 
// inner join promotion on support.idPromo=promotion.idProm
// inner join categorie on support.categorie=categorie.idCat where Titre like '%$Titre%' and ";
// $req111=$pdo->query($select111);
// $execute111=$req111->fetchAll(PDO::FETCH_ASSOC);


$select3="SELECT idProm, idDep, idSec, promotion.libelle as promotion2,
departement.libelle as departement2, section.libelle as section2 from promotion  
inner join departement on promotion.idDepa=departement.idDep 
inner join section on departement.idSect=section.idSec";
$req3=$pdo->query($select3);
$execute3=$req3->fetchAll(PDO::FETCH_ASSOC);


$select111="SELECT * from support 
inner join promotion on support.idPromo=promotion.idProm
inner join etudiant on etudiant.promotion=promotion.idProm
inner join categorie on support.categorie=categorie.idCat where idEt=$id";
$req111=$pdo->query($select111);
$execute111=$req111->fetchAll(PDO::FETCH_ASSOC);



$select88="SELECT * from support";
$req88=$pdo->query($select88);
$execute88=$req88->fetchAll(PDO::FETCH_ASSOC);

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
             BIENVENUE BUREAU ADMNISTRATIF DU DEPARTEMENT D'INFORMATIQUE ET GEST
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
                                    <th scope="col">FICHIER</th>
                                    <th scope="col">ACTION</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
            <?php if($role=="Enseignant" or $role=="Administrateur" or $role=="Etudiant" ){?>

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
                                    <td><?= $support['Fichier'];?></td>

                                    
                                    <td>
                                    <?php if($role=="Administrateur" ){?>
                                    <a href="#"><i class="fa fa-edit editBtn"  nom="updateBtn"data-bs-toggle="modal" data-bs-target="#editModal<?= $support['idSup']; ?>" data-bs-whatever="@mdo<? echo $support['idSup'];?>"></i></a>
                                    <a class='btn btn-primary btn-sm' href="envoie1.php?id=<?=$support['idSup'] ?>">JOINDESYL</a>
                                        &nbsp;&nbsp;
                                        &nbsp;&nbsp;
                                        
                                        <a href="#"> <i class="fa fa-trash-alt red-icon" data-bs-toggle="modal" data-bs-target="#exampleModal5<?= $support['idSup']; ?>"<?= $support['idSup']; ?>></i></a>
                                        <?php } ?>
                                        <?php if($role=="Enseignant" ){?>
                              
                                        <a class='btn btn-primary btn-sm' href="envoie1.php?id=<?=$support['idSup'] ?>">JOINDSYL</a>
                                        &nbsp;&nbsp;
                                        <?php } ?>
                                        <a href="fichiers/supportFiles/<?= $support['Fichier']; ?>" download="fichiers/supportFiles/<?= $support['Fichier']; ?>"><i class="fa fa-download"></i> </a>
                                        

                                        
                                        <?php endforeach;?> 
                                </tr>
                                <?php } ?>

            <?php if ($role=="Etudiant"){?>

              <?php foreach ($execute111 as $support1):?>
                                        

                                        <tr>

                                            <td><input class="form-check-input" type="checkbox"></td>
        
                                            <td ><?= $support1['idSup'];?></td>
                                            <td><?= $support1['Titre'];?></td>
                                            <td><?= $support1['volEx'];?></td>
                                            <td><?= $support1['volTD'];?></td>
                                            <!-- <td><?= $support1['dateMisLign'];?></td> -->
                                            
                                            <td><?= $support1['volTP'];?></td>
                                            <td><?= $support1['libelle'];?></td>
                                            <!-- <td><?= $support1['noms'];?></td> -->
                                            <td><?= $support1['nomCat'];?></td>
        
                                            
                                            <td>

                                                
                                                <a href="fichiers/supportFiles/<?= $support['Fichier']; ?>" download="fichiers/supportFiles/<?= $support['Fichier']; ?>"><i class="fa fa-download"></i> </a>
                                                
        
                                                
                                                <?php endforeach;?> 
                                        </tr>
                                        
        

            <?php }?>

  
                            </tbody>
                        </table>



            </div>
            <!-- Table End -->
                    </div>

                    <div>
                            <div class="text-left">
                            <?php if($role=="Administrateur"){?>
                              <button type="button" class="bi bi-plus btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo">Ajouter un nouveau support</button>
                                <?php } ?>
                              
                    </div>
                    <!-- <button type="submit" class="btn btn-primary">Submit</button> -->
                  </form>
                </div>
              </div>


              <?php 
   foreach ($execute1 as $support):?>
  <div class="modal fade" id="exampleModal5<?= $support['idSup'];?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <p>Voulez-vous supprimer ce support? <?= $support['Titre'];?></p>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Non</button>
        <a href="supSupport.php?idSup=<?= $support['idSup'];?>" class="m-2">
        <button type="submit" class="btn btn-secondary">OUI</button>
        </a>
      </div>
    </div>
  </div>
</div>
<?php 


   endforeach;?>
   <?php
      foreach ($execute1 as $support):?>
  <div class="modal fade" id="exampleModal4<?= $support['idSup'];?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
      <h5 class="modal-title" id="editModalLabel"> <p>Téléchargement de: <?= $support['Titre'];?></p></h5>
      </div>



      <form action="telecharger.php" method="POST" style="color:black" enctype="multipart/form-data">
                  <div class="col">
                      <label for="idCat" class="col-form-label">Numero</label>
                      <input type="hidden" class="form-control" id="idCat" value="" name="idCat">
                    </div>
                  <div class="row">


                    <div class="col-6">
                  <label for="message-text" class="col-form-label">*Support N°: </label>
                  <input type="" class="form-control" id="idSupport" disabled value="<?= $support['idSup'] ?>" name="idSupport" >

                    </div>

                    <div class="col-6">
                      <label for="idCat" class="col-form-label">Auteur: <?= $support['noms'] ?></label>
                      <input type="" class="form-control" disabled id="idAut" value="<?= $support['auteur'] ?>" name="idAut" >
                    </div>
                    </div>
                  <div class="row">
                  <div class="col-6">
                  <label for="message-text" class="col-form-label">*ID Etudiant:</label>
                  <input type="text"  required="required" class="form-control" id="idEtudiant" value="" name="idEtudiant" >
                    </div>
                    <div class="col-6">
                  <label for="message-text" class="col-form-label">*Commentaire:</label>
                  <input type="text"  required="required" class="form-control" id="commentaire" value=" " name="commentaire" >
                    </div>
                    </div>


                <hr>
                <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Annuler</button>
        <a href="supSupport.php?idSup=<?= $support['idSup'];?>" class="m-2">
        <button type="submit" class="btn btn-secondary">Télécharger</button>
        </a>
      </div>
                  </form>

      
                  <!-- <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Non</button>
        <a href="telecharger.php?idSup=<?= $support['idSup'];?>" class="m-2">
        <button type="submit" class="btn btn-secondary">OUI</button>
        </a>
      </div> -->


    </div>
  </div>
</div>
<?php 


   endforeach;?>

    <!-- fin supfin -->
    <?php 
   foreach ($execute1 as $support):?>
        <div class="modal fade" id="editModal<?= $support['idSup'];?>" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="editModalLabel">MODIFIER UN SUPPORT</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
          
                <div class="modal-body">
                      <form action="modSupport.php" method="POST" enctype="multipart/form-data">
                  <div class="col">
                      <label for="Idagent" class="col-form-label">Numero <?php echo $support['idSup']; ?> </label>
                      <input type="hidden" class="form-control" id="idSup" value="<?php echo $support['idSup']; ?>" name="idSup">
                    </div>
                  <div class="row">
                    <div class="col">
                  <label for="message-text" class="col-form-label">*Titre:</label>
                  <input type="text"  required="required" class="form-control" id="titre" value="<?= $support['Titre'];?> " name="titre" >
                    </div>
                    <div class="col">
                      <label for="description" class="col-form-label">*Description:</label>
                      <input type="text" required="required" class="form-control" id="description" value="<?= $support['Description'];?>" name="description" >
                    </div>
                    </div>




                    <div class="row">
                    <div class="col-6">
                      <label for="fichier" class="col-form-label">*Fichier:</label>
                      <input type="file" accept=".pdf,.docx,.txt,.doc"  class="form-control" id="fichier" value="
                      <?= $support['Fichier'];?>" name="fichier" >

                    </div>
                    <div class="col-6">
                        <label for="dateCre" class="col-form-label">*VOLUME TP:</label>
                        <input type="text" required="required" class="form-control" id="dateCre" value="<?= $support['volTP'];?>" name="dateCre" >

                    </div>
                    </div>

                    <div class="row">
                    <div class="col-6">
                      <label for="dateMisLign" class="col-form-label">*VOLUME TD:</label>
                      <input type="text" required="required" class="form-control" id="datePub" value="<?= $support['volTD'];?>" name="datePub" >

                    </div>
                    
                    <div class="col-6">
                        <label for="motCle" class="col-form-label">*VOLUME CMI:</label>
                        <input type="text" required="required" class="form-control" id="motCle" value="<?= $support['volEx'];?>" name="motCle" >

                    </div>
                    </div>

                    <div class="row">
                    <div class="col-6">
                      <label for="niveau" class="col-form-label">*Niveau:</label>
                      <select name="promotion" id="promotion" class="form-select">
                                    <option  value="<?= $support['idPromo'] ?>" ><?= $support['idPromo'].' '.$support['libelle'] ?></option>
                                            <?php 
                                                foreach ($execute as $promotion):?>
                                        
                                
                                    <option value="<?= $promotion['idProm'] ?>"> <?= $promotion['idProm'].' '.$promotion['promotion2'].' '.$promotion['departement2'] ?> </option>
                                        <?php 
                                            endforeach;?> 
                            </select>
                    </div>
                    <label for="categorie" class="col-form-label">*Catégorie:</label>
                      <select name="categorie" id="categorie" class="form-select">
                                    <option value="<?= $support['categorie']?>"><?= $support['categorie'].' '.$support['nomCat'] ?></option>
                                            <?php 
                                                foreach ($execute2 as $cat):?>
                                        
                                
                                    <option value="<?= $cat['idCat'] ?>"> <?= $cat['idCat'].' '.$cat['nomCat'] ?> </option>
                                        <?php 
                                            endforeach;?> 
                            </select>

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
                  <h5 class="modal-title" id="exampleModalLabel" style="font-family:algerian, sans-serif";>Nouveau support</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form action="insertSupport.php" method="POST" style="color:black" enctype="multipart/form-data">
                  <div class="col">
                      <!-- <label for="Idagent" class="col-form-label">Numero  </label>
                      <input type="hidden" class="form-control" id="idSup" value="" name="idSup"> -->
                    </div>
                  <div class="row">
                    <div class="col">
                  <label for="message-text" class="col-form-label">*Titre:</label>
                  <input type="text"  required="required" class="form-control" id="titre" value=" " name="titre" >
                    </div>
                    <div class="col">
                      <label for="description" class="col-form-label">*Description:</label>
                      <input type="text" required="required" class="form-control" id="description" value="" name="description" >
                    </div>
                    </div>




                    <div class="row">
                    <div class="col-6">
                    <label for="niveau" class="col-form-label">*Niveau:</label>
                    <select name="promotion" id="promotion" class="form-select">
                                    <option  disabled selected >Sélectionner ici:</option>
                                            <?php 
                                                foreach ($execute as $promotion):?>
                                        
                                
                                    <option value="<?= $promotion['idProm'] ?>"> <?= $promotion['idProm'].' '.$promotion['promotion2'].' '.$promotion['departement2'] ?> </option>
                                        <?php 
                                            endforeach;?> 
                            </select>
                    
                    </div>

                    <div class="col">
                      <label for="categorie" class="col-form-label">*Catégorie:</label>
                      <select name="categorie" id="categorie" class="form-select">
                                    <option disabled selected>Sélectionner ici</option>
                                            <?php 
                                                foreach ($execute2 as $cat):?>
                                        
                                
                                    <option value="<?= $cat['idCat'] ?>"> <?= $cat['idCat'].' '.$cat['nomCat'] ?> </option>
                                        <?php 
                                            endforeach;?> 
                            </select>                    
                    </div>
                    </div>

                    <div class="row">
                    <div class="col-6">
                    <label for="dateCre" class="col-form-label">*VOLUME TP:</label>
                        <input type="text" required="required" class="form-control" id="dateCre" value="" name="dateCre" >

                     
                    </div>
                    
                    <div class="col-6">
                    <label for="dateMisLign" class="col-form-label">*VOLUME TD:</label>
                      <input type="text" required="required" class="form-control" id="datePub" value="" name="datePub" >

                       
                    </div>
                    </div>

                    <div class="row">
                    <div class="col-6">
                    <label for="motCle" class="col-form-label">*VOLUME CMI:</label>
                        <input type="text" required="required" class="form-control" id="motCle" value="" name="motCle" >

                      
              

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


          <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel" style="font-family:algerian, sans-serif";>Nouveau support TEACHER</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form action="insertSupport.php" method="POST" style="color:black" enctype="multipart/form-data">
                  <div class="col">
                      <!-- <label for="Idagent" class="col-form-label">Numero  </label>
                      <input type="hidden" class="form-control" id="idSup" value="" name="idSup"> -->
                    </div>
                  <div class="row">
                    <div class="col">
                  <label for="message-text" class="col-form-label">*Titre:</label>
                  <select name="titre" id="titre" class="form-select">
                  <option value="<?= $support['Titre']?>"><?= $support['Titre'] ?></option>
                                            <?php 
                                                foreach ($execute88 as $cat):?>
                                        
                                
                                    <option value="<?= $cat['Titre'] ?>"> <?= $cat['Titre'].' '.$cat['Titre'] ?> </option>
                                        <?php 
                                            endforeach;?> 
                            </select>

                    </div>
                    <div class="col">
                      <label for="description" class="col-form-label">*Description:</label>
                      <input type="text" required="required" class="form-control" id="description" value="" name="description" >
                    </div>
                    </div>




                    <div class="row">
                    <div class="col-6">
                    <label for="niveau" class="col-form-label">*Niveau:</label>
                    <select name="promotion" id="promotion" class="form-select">
                                    <option  disabled selected >Sélectionner ici:</option>
                                            <?php 
                                                foreach ($execute as $promotion):?>
                                        
                                
                                    <option value="<?= $promotion['idProm'] ?>"> <?= $promotion['idProm'].' '.$promotion['promotion2'].' '.$promotion['departement2'] ?> </option>
                                        <?php 
                                            endforeach;?> 
                            </select>
                    

                    </div>

                    <div class="col">
                      <label for="categorie" class="col-form-label">*Catégorie:</label>
                      <select name="categorie" id="categorie" class="form-select">
                                    <option disabled selected>Sélectionner ici</option>
                                            <?php 
                                                foreach ($execute2 as $cat):?>
                                        
                                
                                    <option value="<?= $cat['idCat'] ?>"> <?= $cat['idCat'].' '.$cat['nomCat'] ?> </option>
                                        <?php 
                                            endforeach;?> 
                            </select>                    
                    </div>
                    </div>

                    <div class="row">
                    <div class="col-6">
                    <label for="dateCre" class="col-form-label">*VOLUME TP:</label>
                        <input type="text" required="required" class="form-control" id="dateCre" value="" name="dateCre" >

                     
                    </div>
                    
                    <div class="col-6">
                    <label for="dateMisLign" class="col-form-label">*VOLUME TD:</label>
                      <input type="text" required="required" class="form-control" id="datePub" value="" name="datePub" >

                       
                    </div>
                    </div>

                    <div class="row">
                    <div class="col-6">
                    <label for="motCle" class="col-form-label">*VOLUME CMI:</label>
                        <input type="text" required="required" class="form-control" id="motCle" value="" name="motCle" >

                      
                    </div>
                    <!-- </div> -->
                    <div class="col-6">
                      <label for="fichier" class="col-form-label">*Fichier:</label>
                      <input type="file" accept=".pdf,.docx,.txt,.doc"  class="form-control" id="fichier" name="fichier" >

                    </div>

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