<?php


// ini_set('display_errors','off');


require('connexion.php');
$nom=$_POST['nom'];
$Niveau=$_POST['Niveau'];
$specialite=$_POST['specialite'];
$sexe=$_POST['sexe'];
$matricule=$_POST['matricule'];

$image=$_FILES['image']['name'];
$image_tmp=$_FILES['image']['tmp_name'];
$res=move_uploaded_file($image_tmp,'fichiers/imagesUt/'.$image);
$random_id=mt_rand(600, 1000);

$statu=0;
$role="Enseignant";

$sql = "SELECT COUNT(*) AS nombre FROM enseignant WHERE matricule = '$matricule'";
$result = $pdo->query($sql);
$row = $result->fetch();
if ($row['nombre'] > 0) {

            echo "<script> alert('Ce matricule est deja utilise'); </script>";

} else {
  $valeurs=array($random_id,$nom,$Niveau,
    $sexe,$specialite,$matricule);
  





          $requete_insert="INSERT INTO enseignant VALUES(?,?,?,?,?,?)";                            
          $resultat=$pdo->prepare($requete_insert);
          $resultat->execute($valeurs);
          $idUt = $pdo->lastInsertId();

    
          $valeurs1=array($random_id,$matricule,$matricule,
          $image,$role,$statu);
        
      
      
      
      
      
                $requete_insert1="INSERT INTO utilisateur VALUES(?,?,?,?,?,?)";                            
                $resultat1=$pdo->prepare($requete_insert1);
                $resultat1->execute($valeurs1);
          
}
      ?>
         <meta http-equiv="refresh"content="0.5;url=enseignants.php">