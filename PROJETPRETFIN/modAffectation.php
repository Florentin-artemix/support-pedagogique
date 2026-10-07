<?php
ini_set('display_errors','off');
	require('connexion.php');
    $idCharge=$_POST['idCharge'];
    $annee=$_POST['annee'];
    $auteur=$_POST['auteur'];
    $support=$_POST['support'];
    
    



$nouvelles_valeurs=array($annee,$support,$auteur);


	



    $requete1="UPDATE chargeHor SET annee=?,idSupo=?,idEns=?
    
    where idCharge=$idCharge";


$resultat=$pdo->prepare($requete1);

$resultat->execute($nouvelles_valeurs);
?>
  <meta http-equiv="refresh"content="0.5;url=affectation.php">