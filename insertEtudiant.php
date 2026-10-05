<?php


// ini_set('display_errors','off');


require('connexion.php');
$nom=$_POST['nom'];
$promotion=$_POST['promotion'];
// $departement=$_POST['departement'];
$sexe=$_POST['sexe'];
$matricule=$_POST['matricule'];

$role="Etudiant";


$image=$_FILES['image']['name'];
$image_tmp=$_FILES['image']['tmp_name'];
$res=move_uploaded_file($image_tmp,'fichiers/imagesUt/'.$image);

$statu=0;

$sql = "SELECT COUNT(*) AS nombre FROM etudiant WHERE matricule = '$matricule'";
$result = $pdo->query($sql);
$row = $result->fetch();
if ($row['nombre'] > 0) {
 
            echo "<script> alert('Ce matricule est deja utilise'); </script>";

} else {
  $valeurs=array($nom,$promotion,
    $sexe,$matricule);
  





          $requete_insert="INSERT INTO etudiant VALUES(NULL,?,?,?,?)";                            
          $resultat=$pdo->prepare($requete_insert);
          $resultat->execute($valeurs);
          $idUt = $pdo->lastInsertId();

          $valeurs1=array($idUt,$matricule,$matricule,
          $image,$role,$statu);
        
      
      
      
      
      
                $requete_insert1="INSERT INTO utilisateur VALUES(?,?,?,?,?,?)";                            
                $resultat1=$pdo->prepare($requete_insert1);
                $resultat1->execute($valeurs1);

    
    
          
}
      ?>
         <meta http-equiv="refresh"content="0.5;url=etudiants.php">