<?php
	
	
	require('connexion.php');
	
	$idEnse=$_GET['idEnse'];		
	
	$requete="DELETE FROM enseignant where idEnse=?";
	$valeur=array($idEnse);
	$resultat=$pdo->prepare($requete);
	$resultat->execute($valeur);
    ?>
    
    <meta http-equiv="refresh"content="0.5;url=enseignants.php">