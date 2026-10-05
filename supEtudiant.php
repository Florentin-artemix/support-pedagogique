<?php
	
	
	require('connexion.php');
	
	$idEt=$_GET['idEt'];		
	
	$requete="DELETE FROM etudiant where idEt=?";
	$valeur=array($idEt);
	$resultat=$pdo->prepare($requete);
	$resultat->execute($valeur);
    ?>
    
    <meta http-equiv="refresh"content="0.5;url=etudiants.php">