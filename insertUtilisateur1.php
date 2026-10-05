<?php


ini_set('display_errors','off');


require('connexion.php');
$email=$_POST['email'];
$password=$_POST['password'];

$role="Administrateur";


// $fichier=$_FILES['fichier']['name'];
$image=$_FILES['image']['name'];
$image_tmp=$_FILES['image']['tmp_name'];
$res=move_uploaded_file($image_tmp,'fichiers/imagesUt/'.$image);

// $statu=0;
$random_id=mt_rand(50, 500);
// $idAleatoire = mt_rand(50, 500);

  $valeurs=array($random_id,$email,$password,
    $image,$role);
  





          $requete_insert="INSERT INTO utilisateur VALUES(?,?,?,?,?,?)";                            
          $resultat=$pdo->prepare($requete_insert);
          $resultat->execute($valeurs);

    
    
          

      ?>
         <meta http-equiv="refresh"content="0.5;url=utilisateurs.php">