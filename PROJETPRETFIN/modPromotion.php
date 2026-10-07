<?php
ini_set('display_errors','off');
	require('connexion.php');
    $id=$_POST['id'];
    $libelle=$_POST['libelle'];
    $departement=$_POST['departement'];
    // if(!empty($fichier)  ) { 
	// 	$requete="UPDATE support SET Titre=?,Description=?,Fichier=?,volTP=?,
    //     volTD=?,volEx=?,Niveau=?,auteur=?,categorie=?
	// 	where idSup=$idSup";

$nouvelles_valeurs=array($libelle,$departement);


	


// } else {
    $requete="UPDATE promotion SET libelle=?,idDepa=?
    where idProm=$id";


$resultat=$pdo->prepare($requete);

$resultat->execute($nouvelles_valeurs);
?>
  <meta http-equiv="refresh"content="0.5;url=promotion.php">