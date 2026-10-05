<?php
	
	
	require('connexion.php');
	
	$idSup=$_GET['idSec'];		
	
	$requete="DELETE FROM section where idSec=?";
	$valeur=array($idSup);
	$resultat=$pdo->prepare($requete);
	$resultat->execute($valeur);
    ?>
    
    <meta http-equiv="refresh"content="0.5;url=section.php">