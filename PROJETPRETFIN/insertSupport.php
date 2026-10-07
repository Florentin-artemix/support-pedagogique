<?php
ini_set('display_errors','off');
require('connexion.php');
$titre=$_POST['titre'];
$description=$_POST['description'];
$dateCre=$_POST['dateCre'];
$datePub=$_POST['datePub'];
$motCle=$_POST['motCle'];
// $niveau=$_POST['niveau'];
$promotion=$_POST['promotion'];
$categorie=$_POST['categorie'];


$fichier=$_FILES['fichier']['name'];
$fichier_tmp=$_FILES['fichier']['tmp_name'];
$res=move_uploaded_file($fichier_tmp,'fichiers/supportFiles/'.$fichier);



  $valeurs=array($titre,$description,$fichier,$promotion,
 $dateCre,$datePub,$motCle,$categorie);
          $requete_insert="INSERT INTO support VALUES(NULL,?,?,?,?,?,?,?,?)";                            
          $resultat=$pdo->prepare($requete_insert);
          $resultat->execute($valeurs);

    
    
          

      ?>
         <meta http-equiv="refresh"content="0.5;url=supports.php">




