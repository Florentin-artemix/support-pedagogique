<?php
ini_set('display_errors','off');
	require('connexion.php');
    $nomCat=$_POST['nomCat'];
    $idCat=$_POST['idCat'];
    
    

		
		$requete="UPDATE categorie SET nomCat=?
    WHERE idCat=$idCat";

$nouvelles_valeurs=array($nomCat);

	
$resultat=$pdo->prepare($requete);

$resultat->execute($nouvelles_valeurs);

?>

<meta http-equiv="refresh"content="0.5;url=categories.php">