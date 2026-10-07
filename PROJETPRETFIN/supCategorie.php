<?php
	
	
	require('connexion.php');
	
	$idCat=$_GET['idCat'];		
	
	$requete="DELETE FROM categorie where idCat=?";
	$valeur=array($idCat);
	$resultat=$pdo->prepare($requete);
	$resultat->execute($valeur);
    ?>
    
    <meta http-equiv="refresh"content="0.5;url=categories.php">