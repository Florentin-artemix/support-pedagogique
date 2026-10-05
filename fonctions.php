<?php
ini_set('display_errors','off');
//Recherche par login
function recherche_user_byLogin($login)
{
    global $pdo;
    $req = $pdo->prepare("select * from utilisateur where email=?");
    $valeur = array($login);
    $req->execute($valeur);
    $nbr_user = $req->rowCount();
    return $nbr_user;
}

//Recherche par login et id
function recherche_user_byLoginId($login, $id)
{
     global $pdo;
    $req = $pdo->prepare("select * from utilisateur where email=? and idUt=?");
    $valeur = array($login, $id);
    $req->execute($valeur);
    $nbr_user = $req->rowCount();
    return $nbr_user;
}

//Recherche par login et pwd (Soit l'utilisateur soit NULL)
function recherche_user_byLoginPwd($login, $pwd)
{
     global $pdo;
	 
    $req = $pdo->prepare("SELECT * from utilisateur where email=? and password=? and statut=1");
    $valeur = array($login, $pwd);
    $req->execute($valeur);
    $nbr_user = $req->rowCount();

    if ($nbr_user == 1) // si l'utilisateur existe
        return $req->fetch(); //Retourner l'utilisateur(id_utilisateur,login,pwd et role)
    else // si l'utilisateur n'existe pas
        return 0;
}
?>