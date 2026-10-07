<?php

require_once('connexion.php');
$idUt=$_GET['idUt'];
$requete = "SELECT statut FROM utilisateur where idUt=$idUt ";

$resultat = $pdo->query($requete);
$statut = $resultat->fetchColumn();


if(($statut ==1)){
$st1=0;
    $requete="UPDATE utilisateur SET statut=?
    where idUt=$idUt";

$nouvelles_valeurs=array($st1);


$resultat=$pdo->prepare($requete);

$resultat->execute($nouvelles_valeurs);
}else
{

    $st=1;
    $requete1="UPDATE utilisateur SET statut=?
    where idUt=$idUt";

$nouvelles_valeurs1=array($st);


$resultat1=$pdo->prepare($requete1);

$resultat1->execute($nouvelles_valeurs1);
}

?>

<meta http-equiv="refresh"content="0.5;url=utilisateurs.php">