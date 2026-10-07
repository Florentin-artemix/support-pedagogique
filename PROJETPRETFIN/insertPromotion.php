<?php
ini_set('display_errors','off');
require('connexion.php');
$id=$_POST['id'];
$libelle=$_POST['libelle'];
$departement=$_POST['departement'];
// $datePub=$_POST['datePub'];
// $motCle=$_POST['motCle'];
// $niveau=$_POST['niveau'];
// $auteur=$_POST['auteur'];
// $categorie=$_POST['categorie'];


// $fichier=$_FILES['fichier']['name'];
// $fichier_tmp=$_FILES['fichier']['tmp_name'];
// $res=move_uploaded_file($fichier_tmp,'fichiers/supportFiles/'.$fichier);



  $valeurs=array($libelle,$departement);
          $requete_insert="INSERT INTO promotion VALUES(NULL,?,?)";                            
          $resultat=$pdo->prepare($requete_insert);
          $resultat->execute($valeurs);

    
    
          

      ?>
         <meta http-equiv="refresh"content="0.5;url=promotion.php">




