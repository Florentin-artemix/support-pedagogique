<?php


ini_set('display_errors','off');


require('connexion.php');
$nomCat=$_POST['nomCat'];
$idCat=$_POST['idCat'];



  $valeurs=array($nomCat);
  





          $requete_insert="INSERT INTO categorie VALUES(NULL,?)";                            
          $resultat=$pdo->prepare($requete_insert);
          $resultat->execute($valeurs);

    
    
          

      ?>
         <meta http-equiv="refresh"content="0.5;url=categories.php">