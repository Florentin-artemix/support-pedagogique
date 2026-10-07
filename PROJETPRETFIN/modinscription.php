<?php

$conn = mysqli_connect("localhost","root","","projet");

if(isset($_POST['register']))
{
    $nomet = $_POST['nomet'];
    $promotion = $_POST['promotion'];
    $annee = $_POST['annee']; 

    $sql = "INSERT INTO inscription (nomet, promotion, annee) VALUES ('$nomet' ,'$promotion' ,'$annee')";
    $data=mysqli_query($conn,$sql);

    if ($data)
    {
        echo "<script>alert('information envoyée avec succès');</script>";
    }
    

    else
    {
        echo "<script>alert('information n'est pas envoyée');</script>";
    }
    $nomet = "";
    $promotion = "";
    $annee= "";


    
    


}
require("dashboard.php");
$role="Etudiant";
header("Location:./dashboard.php");


?>