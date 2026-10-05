<?php
ini_set('display_errors','off');
require('connexion.php');
$id=$_POST['id'];
$libelle=$_POST['libelle'];
// $departement=$_POST['departement'];


  $valeurs=array($libelle);
          $requete_insert="INSERT INTO section VALUES(NULL,?)";                            
          $resultat=$pdo->prepare($requete_insert);
          $resultat->execute($valeurs);

    
    
          

      ?>
         <meta http-equiv="refresh"content="0.5;url=section.php">




