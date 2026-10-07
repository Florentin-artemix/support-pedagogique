<?php 
// ini_set('display_errors','off');

require("connexion.php");




?>



<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Accès au support</title>
  <link rel="stylesheet" href="public/fontawesome-free-6.2.0-web/css/all.min.css">
  <!-- <link rel="shortcut icon" type="image/png" href="assets/images/logos/favicon.png" /> -->
  <link rel="stylesheet" href="assets/css/styles.min.css" />
</head>

<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <div
      class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
      <div class="d-flex align-items-center justify-content-center w-100">
        <div class="row justify-content-center w-100">
          <div class="col-md-8 col-lg-6 col-xxl-3">
            <div class="card mb-0">
              <div class="card-body">
               
                <h2><p class="text-center">AUTHENTIFICATION</p></h2>
                <form action="login.php" method="POST" enctype="multipart/form-data">
                  <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Login (C'est votre adresse mail)</label>
                    <input type="text" class="form-control" id="email" aria-describedby="emailHelp" name="email">
                  </div>
                  <div class="mb-4">
                    <label for="exampleInputPassword1" class="form-label">Password (Par défaut Matricule)</label>
                    <input type="password" class="form-control" id="password" name="password">
                  </div>
                  <div class="d-flex align-items-center justify-content-between mb-4">
                    <div class="form-check">
                      <input class="form-check-input primary" type="checkbox" value="" id="flexCheckChecked" checked>
                      <label class="form-check-label text-dark" for="flexCheckChecked">
                        Se rappeler
                      </label>
                    </div>
                    <!-- <a class="text-primary fw-bold" href="./index.html">Forgot Password ?</a> -->
                  </div>
                  <button class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2">Sign In</button>
                  <div class="d-flex align-items-center justify-content-center">
                    <p class="fs-4 mb-0 fw-bold">C'est la première fois de se connecter?</p>
                    <!-- <a class="text-primary fw-bold ms-2" href="./authentication-register.html">Create an account</a> -->
                    <a href="#"><i class=""  nom="updateBtn"data-bs-toggle="modal" data-bs-target="#editModal" data-bs-whatever="@mdo">Confirmer d'abord l'inscription</i> </a>
                                        &nbsp;&nbsp;
                  
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>



        // c'est le debut du code de la fenêtre de creation compte

       <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
           <div class="modal-dialog">
             <div class="modal-content">
               <div class="modal-header">
                 <h5 class="modal-title" id="editModalLabel">CONFIRMER VOTRE INSCRIPTION</h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
               </div>
         
               <div class="modal-body">
                     <form action="insertUtilisateurEnse.php" method="POST" enctype="multipart/form-data">
                 <div class="col">
                     <!-- <label for="Idagent" class="col-form-label">Numero  </label>
                     <input type="hidden" class="form-control" id="idUt" value="" name="idUt"> -->
                   </div>
                 <div class="row">
                   <div class="col">
                 <label for="message-text" class="col-form-label">*E-mail:</label>
                 <input type="email"  required="required" class="form-control" id="email" value=" " name="email" >
                   </div>
                   <div class="col">
                     <label for="password" class="col-form-label">*Mot de pass:</label>
                     <input type="password" required="required" class="form-control" id="password" value="" name="password" >
                   </div>
                   </div>




                   <div class="row">
                   <div class="col-6">
                     <label for="image" class="col-form-label">*Image:</label>
                     <input type="file" accept="image/jpeg,image/png,image/gif"  class="form-control" id="image" value="" name="image" >

                   </div>
                   <div class="col-6">
                   <!-- <label for="role" class="col-form-label">*Rôle:</label>
                     <select name="role" id="role" class="form-select">

                     
                     <option  disabled selected value="<?= $utilisateur['role'] ?>"> <?= $utilisateur['role']?> </option>
                       <option value="Administrateur">Administrateur</option>
                       <option value="Etudiant">Etudiant</option>
                       <option value="Enseignant">Enseignant</option>

                     </select> -->
                   </div>
                   </div>

                   <div class="row">
                   <div class="col-6">

                   <!-- <label for="motCle" class="col-form-label">Identifiant Etudiant:</label>
                       <input type="text"  class="form-control" id="idEt" value="<?= $utilisateur['idEtudiant'];?>" name="idEt" > -->


                   </div>
                   <div class="col-6">
                   <!-- <label for="enseignant" class="col-form-label">Identifiant Enseignant:</label>
                     <input type="text"  class="form-control" id="idEns" value="<?= $utilisateur['idEnseignant'];?>" name="idEns" > -->

                   </div>
                   </div>

                   <div class="row">
                   <div class="col-6">

                   </div>
                   <!-- <div class="col-6">
                       <label for="auteur" class="col-form-label">*Auteur:</label>
                       <select name="auteur" id="auteur" class="form-select">
                                   <option disabled selected><?= $support['auteur'].' '.$support['NomsEnse'] ?></option>
                                           <?php 
                                               foreach ($execute as $auteur):?>
                                       
                               
                                   <option value="<?= $auteur['idEnse'] ?>"> <?= $auteur['idEnse'].' '.$auteur['noms'] ?> </option>
                                       <?php 
                                           endforeach;?> 
                           </select>
                   </div>
                   </div>
                   <div class="row">

                   </div> -->

                   <!-- <div class="col">
                     <label for="categorie" class="col-form-label">*Matricule:</label>
                     <select name="categorie" id="categorie" class="form-select">
                                   <option disabled selected><?= $support['categorie'].' '.$support['nomCateg'] ?></option>
                                           <?php 
                                               foreach ($execute2 as $cat):?>
                                       
                               
                                   <option value="<?= $cat['idCat'] ?>"> <?= $cat['idCat'].' '.$cat['nomCat'] ?> </option>
                                       <?php 
                                           endforeach;?> 
                           </select>                    </div>
                   </div> -->
                   <hr>
                   <div class="text-center">
                   <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                 <button type="submit" name="updatefin" id="updatedata" class="btn btn-primary">Valider</button>
                   </div>
                 </form>
             </div>
           </div>
         </div>
         </div>





  <script src="assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>


  <script src="assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="assets/js/sidebarmenu.js"></script>
  <script src="assets/js/app.min.js"></script>
  <script src="assets/libs/simplebar/dist/simplebar.js"></script>
</body>

</html>