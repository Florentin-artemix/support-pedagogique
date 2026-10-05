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
 
    $nom = $_POST['nom'];
    $matricule = $_POST['matricule'];   


    // Préparer et exécuter la requête SQL pour vérifier les informations de connexion
    $sql = "SELECT * FROM etudiant WHERE nom='$nom' AND matricule='$matricule'";
    $result = $connection->query($sql);

    if ($result->num_rows > 0)   
 {
        // Informationsd'identification correctes   
 
        session_start();
        $_SESSION['nom'] = $nom;
        header("Location:../connectionUser.php"); // Rediriger vers la page d'accueil après connexion
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
     <h4> CHER(E) ETUDIANT(E) POUR ACCEDER A CETTE PLATEFORME IL FAUT ETRE CONNU COMME ETUDIANT AU DEPARTEMENT D'INFORMATIQUE A L'ISP/BKV</h4>
     <h4>VEILLEZ ENTRER VOTRE NOM ET MATRICUL POUR LA VERIFICATION AU DEPARTEMENT</h4>
    <h2>AUTHENTIFICATION AU DEPARTEMENT</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <input type="text" name="nom" placeholder="votre nom"><br>
         <input type="password" name="matricule" placeholder="votre matricule"><br>
        <input type="submit" value="Se connecter">
    </form>
</body>
</html> 