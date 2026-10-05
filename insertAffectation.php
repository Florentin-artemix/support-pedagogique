<?php
ini_set('display_errors','off');
require('connexion.php');
$idCharge=$_POST['idCharge'];
$annee=$_POST['annee'];
$auteur=$_POST['auteur'];
$support=$_POST['support'];





  $valeurs=array($annee,$support,$auteur);
          $requete_insert="INSERT INTO chargeHor VALUES(NULL,?,?,?)";                            
          $resultat=$pdo->prepare($requete_insert);
          $resultat->execute($valeurs);

    
    
          

      ?>
         <meta http-equiv="refresh"content="0.5;url=affectation.php">




