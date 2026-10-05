<?php
ini_set('display_errors','off');
	require('connexion.php');
    $idSupport=$_POST['idSupport'];  
    $idAut=$_POST['idAut'];
    $idEtudiant=$_POST['idEtudiant'];
    $commentaire=$_POST['commentaire'];


    
    

		
    $valeurs=array($commentaire,$idEtudiant,
    $idAut,$idSupport);
  





          $requete_insert="INSERT INTO telechragement VALUES(NULL,?,?,?,?)";                            
          $resultat=$pdo->prepare($requete_insert);
          $resultat->execute($valeurs);

    
    
?>

<meta http-equiv="refresh"content="0.5;url=supports.php">


