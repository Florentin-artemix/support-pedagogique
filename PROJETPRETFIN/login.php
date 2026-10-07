<!-- en fin voici mon code php -->


<?php
// ini_set('display_errors','off');


	session_start();
	
	require('connexion.php');
	include('fonctions.php');

	
	$login=$_POST['email'];
	$pwd=$_POST['password'];
	
	
		
	$user=recherche_user_byLoginPwd($login,$pwd); 		
		
    if ($user != 0) {
        $_SESSION['user'] = $user;
        header("location:dashboard.php");
    } else {
        



    }
	
?>

<meta http-equiv="refresh"content="0.5;url=index.php">







