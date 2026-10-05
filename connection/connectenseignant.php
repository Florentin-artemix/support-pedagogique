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
 
    $noms = $_POST['noms'];
    $matricule = $_POST['matricule'];   


    // Préparer et exécuter la requête SQL pour vérifier les informations de connexion
    $sql = "SELECT * FROM enseignant WHERE noms='$noms' AND matricule='$matricule'";
    $result = $connection->query($sql);

    if ($result->num_rows > 0)   
 {
        // Informationsd'identification correctes   
 
        session_start();
        $_SESSION['noms'] = $noms;
        header("Location:../connectionUserEnse.php"); // Rediriger vers la page d'accueil après connexion
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
    <h2>POUR ACCEDER A UN COMPTE ENSEIGNANT OU SA CREATION IL FAUT ENTRER LES INFORMATIONS CONNUES PAR LE DEPARTEMENT D'INFORMATIQUE DE GESTION ISP/BKV</h2>
    <h2>AUTHENTIFICATION AU DEPARTEMENT</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <input type="text" name="noms"><br>
         <input type="password" name="matricule"><br>
        <input type="submit" value="Se connecter">
    </form>
</body>
</html> 