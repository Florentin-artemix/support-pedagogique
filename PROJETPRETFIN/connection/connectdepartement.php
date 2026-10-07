<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "projet";

// create connection
$connection = new mysqli($servername, $username, $password, $database);

//verification de la connexion
if ($connection->connect_error) {
   die("connection failed: " . $connection->connect_error);
}
// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire   
 
    $nomdepartement = $_POST['nomdepartement'];
    $codedepartement = $_POST['codedepartement'];   


    // Préparer et exécuter la requête SQL pour vérifier les informations de connexion
    $sql = "SELECT * FROM departementV WHERE nomdepartement='$nomdepartement' AND codedepartement='$codedepartement'";
    $result = $connection->query($sql);

    if ($result->num_rows > 0)   
 {
        // Informationsd'identification correctes   
 
        session_start();
        $_SESSION['nomdepartement'] = $nomdepartement;
         header("Location:../connectionUserDep.php");
        
    } else {
        // Informations d'identification incorrectes
        echo "Nom d'utilisateur ou mot de passe incorrect.";
    }
}

// Fermer la connexion à la base de données

?>

<!DOCTYPE html>
<html>
<head>
<title>Page de connexion</title>
</head>
<body>
    <h3>POUR CREER OU ACCEDER AU COMPTE DEPARTEMENT ENTRER LE CODE ADMNISTRATEUR</h3>
    <h2>AUTHENTIFICATION A L'ADMNISTRATION</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <input type="text" name="nomdepartement"><br>
         <input type="password" name="codedepartement"><br>
        <input type="submit" value="VERIFIER IDENTITE">
    </form>
</body>
</html> 