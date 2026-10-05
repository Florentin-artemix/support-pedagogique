<?php
	
	
	require('connexion.php');
	
	$idSup=$_GET['idDep'];		
	
	$requete="DELETE FROM departement where idDep=?";
	$valeur=array($idSup);
	$resultat=$pdo->prepare($requete);
	$resultat->execute($valeur);
    ?>
    
    <meta http-equiv="refresh"content="0.5;url=departement.php">