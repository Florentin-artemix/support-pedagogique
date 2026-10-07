<?php
	
	
	require('connexion.php');
	
	$idSup=$_GET['idSup'];		
	
	$requete="DELETE FROM support where idSup=?";
	$valeur=array($idSup);
	$resultat=$pdo->prepare($requete);
	$resultat->execute($valeur);
    ?>
    
    <meta http-equiv="refresh"content="0.5;url=supports.php">