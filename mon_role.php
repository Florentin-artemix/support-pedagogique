<?php
ini_set('display_errors','off');
	if($_SESSION['user']['role']!='Adminstrateur' or $_SESSION['user']['role']!='Bailleur'){ //si le role n'est pas directeur
		$msg= "Opération non autorisée";
		$url=$_SERVER['HTTP_REFERER'];	
		//retourne a la page précédente	
		header("location:message.php?msg=$msg&color=r&url=$url");
		exit();
	}
?>