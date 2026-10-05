<?php
ini_set('display_errors','off');
	require('connexion.php');
    $idUt=$_POST['idUt'];
    $email=$_POST['email'];
    $password=$_POST['password'];
 
    $role="Administrateur";
    // $idEt=$_POST['idEt'];
    // $idEns=$_POST['idEns'];
    
    // $fichier=$_FILES['fichier']['name'];
    $image=$_FILES['image']['name'];
    $image_tmp=$_FILES['image']['tmp_name'];
    $res=move_uploaded_file($image_tmp,'fichiers/imagesUt/'.$image);
    $statu=0;

    // $valeurs=array();
    if(!empty($image)  ) { 
		$requete="UPDATE utilisateur SET email=?,password=?,image=?,role=?
		where idUt=$idUt";

$nouvelles_valeurs=array($email,$password,
$image,$role);


	
$resultat=$pdo->prepare($requete);

$resultat->execute($nouvelles_valeurs);

} else {
    $requete1="UPDATE utilisateur SET email=?,password=?,role=?
    where idUt=$idUt";

$nouvelles_valeurs1=array($email,$password,
$role);



$resultat1=$pdo->prepare($requete1);

$resultat1->execute($nouvelles_valeurs1);

 }
	
?>
  <meta http-equiv="refresh"content="0.5;url=utilisateurs.php">