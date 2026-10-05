<?php
ini_set('display_errors','off');
	require('connexion.php');
    $idSup=$_POST['idSup'];
    $titre=$_POST['titre'];
    $description=$_POST['description'];
    $dateCre=$_POST['dateCre'];
    $datePub=$_POST['datePub'];
    $motCle=$_POST['motCle'];
    // $niveau=$_POST['niveau'];
    $promotion=$_POST['promotion'];
    $categorie=$_POST['categorie'];
    
    
    $fichier=$_FILES['fichier']['name'];
    $fichier_tmp=$_FILES['fichier']['tmp_name'];
    $res=move_uploaded_file($fichier_tmp,'fichiers/supportFiles/'.$fichier);
    
    if(!empty($fichier)  ) { 
		$requete="UPDATE support SET Titre=?,Description=?,Fichier=?,volTP=?,
        volTD=?,volEx=?,idPromo=?,categorie=?
		where idSup=$idSup";

$nouvelles_valeurs=array($titre,$description,$fichier,$promotion,
$dateCre,$datePub,$motCle,$categorie);


	
$resultat=$pdo->prepare($requete);

$resultat->execute($nouvelles_valeurs);

} else {
    $requete1="UPDATE support SET Titre=?,Description=?,volTP=?,
    volTD=?,volEx=?,idPromo=?,categorie=?
    where idSup=$idSup";

$nouvelles_valeurs1=array($titre,$description,$dateCre,
$datePub,$motCle,$promotion,
$categorie);



$resultat1=$pdo->prepare($requete1);

$resultat1->execute($nouvelles_valeurs1);

 }
	
?>
  <meta http-equiv="refresh"content="0.5;url=supports.php">