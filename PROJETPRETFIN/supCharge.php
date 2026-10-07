<?php
	
	
	require('connexion.php');
	
	$idCharge=$_GET['idCharge'];		
	
	$requete="DELETE FROM chargeHor where idCharge=?";
	$valeur=array($idCharge);
	$resultat=$pdo->prepare($requete);
	$resultat->execute($valeur);
    ?>
    
    <meta http-equiv="refresh"content="0.5;url=affectation.php">