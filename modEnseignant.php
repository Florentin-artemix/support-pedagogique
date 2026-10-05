<?php
ini_set('display_errors','off');
	require('connexion.php');
    $id_enseignant=$_POST['id_enseignant'];  
    $nom=$_POST['nom'];
    $Niveau=$_POST['Niveau'];
    $specialite=$_POST['specialite'];
    $sexe=$_POST['sexe'];
    $matricule=$_POST['matricule'];

    
    $image=$_FILES['image']['name'];
    $image_tmp=$_FILES['image']['tmp_name'];
    $res=move_uploaded_file($image_tmp,'fichiers/imagesUt/'.$image);
    $statu=0;

		
		$requete="UPDATE enseignant SET idEnse=?, noms=?
    ,Niveau=?, sexe=?, specialite=?, matricule=? 
    WHERE idEnse=$id_enseignant";

$nouvelles_valeurs=array($id_enseignant,$nom,$Niveau,
$sexe,$specialite,$matricule);

	
$resultat=$pdo->prepare($requete);

$resultat->execute($nouvelles_valeurs);


if(!empty($image)  ) { 
  $requete2="UPDATE utilisateur SET email=?,password=?,image=?
   where idUt=$id_etudiant";

$nouvelles_valeurs2=array($matricule,$matricule,
$image);



$resultat2=$pdo->prepare($requete2);

$resultat2->execute($nouvelles_valeurs2);

} else {
  $requete12="UPDATE utilisateur SET email=?,password=?
  where idUt=$id_etudiant";

$nouvelles_valeurs12=array($matricule,$matricule);



$resultat12=$pdo->prepare($requete12);

$resultat12->execute($nouvelles_valeurs12);

}
// }
?>

<meta http-equiv="refresh"content="0.5;url=enseignants.php">