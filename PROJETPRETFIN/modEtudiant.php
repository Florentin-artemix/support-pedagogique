<?php
ini_set('display_errors','off');
	require('connexion.php');
    $id_etudiant=$_POST['id_etudiant'];  
    $nom=$_POST['nom'];
    $promotion=$_POST['promotion'];
    // $departement=$_POST['departement'];
    $sexe=$_POST['sexe'];
    $matricule=$_POST['matricule'];

    // $role="E";
    // $idEt=$_POST['idEt'];
    // $idEns=$_POST['idEns'];
    
    // $fichier=$_FILES['fichier']['name'];
    $image=$_FILES['image']['name'];
    $image_tmp=$_FILES['image']['tmp_name'];
    $res=move_uploaded_file($image_tmp,'fichiers/imagesUt/'.$image);
    $statu=0;

//     $sql = "SELECT COUNT(*) FROM etudiant WHERE matricule = '$matricule'";
// $result = $pdo->query($sql);
// $row = $result->fetch();
// if ($row["COUNT(*)"] > 0) {
 
//             echo "<script> alert('Ce matricule est deja utilise'); </script>";

// } else {

		
		$requete="UPDATE etudiant SET idEt=?, nom=?, promotion=?,sexe=?,
		matricule=?
		where idEt=$id_etudiant";

$nouvelles_valeurs=array($id_etudiant,$nom,$promotion,
$sexe,$matricule);

	
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

<meta http-equiv="refresh"content="0.5;url=etudiants.php">