<?php
	
	
	require('connexion.php');
	
	// $idSup=$_GET['idSup'];
    
    $idSupport=$_POST['idSupport'];  
    $idAut=$_POST['idAut'];
    $idEtudiant=$_POST['idEtudiant'];
    $commentaire=$_POST['commentaire'];


    
    

		
    $valeurs=array($commentaire,$idEtudiant,
    $idAut,$idSupport);
	
	$requete="SELECT Fichier FROM support where idSup=?";
	$valeur=array($idSupport);
	$resultat=$pdo->prepare($requete);
	$resultat->execute($valeur);
if($valeur==true){
    $valeur=mysql_fetch_assoc($requete);
    header("Content-description: File tranfer");
    header("Content-type:application/octet-stream");
    header("Content-Disposition:attachment; filename=".$valeur['Fichier']);
    header("Content-length:".filesize("fichiers/supportFiles/".$valeur['Fichier']));
    ob_clean();
    readfile("fichiers/supportFiles/".$valeur['Fichier']);




}else{

}
$requete_insert="INSERT INTO telechargement VALUES(NULL,?,?,?,?)";                            
$resultat1=$pdo->prepare($requete_insert);
$resultat1->execute($valeurs);

    ?>
    
    <meta http-equiv="refresh"content="0.5;url=supports.php">


