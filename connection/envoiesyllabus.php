<?php
// Connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cours";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);   

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);   


    // Requête pour récupérer tous les intitulés (remplacez 'votre_table' et 'intitule' par vos noms)
    $stmt = $conn->prepare("SELECT intitule FROM bac1");
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Affichage de la liste déroulante
    echo "<select name='intitule'>";
    foreach ($result as $row) {
        echo "<option value='" . $row['intitule'] . "'>" . $row['intitule'] . "</option>";
    }
    echo "</select>";

    // Traitement du formulaire (si un intitulé est sélectionné)
    if (isset($_POST['intitule'])) {
        $intitule_selectionne = $_POST['intitule'];

        // Requête pour récupérer les propriétés de l'élément sélectionné
        $stmt = $conn->prepare("SELECT enseignant, credits FROM bac1 WHERE intitule = :intitule");
        $stmt->bindParam(':intitule', $intitule_selectionne);
        $stmt->execute();
        $resultat = $stmt->fetch(PDO::FETCH_ASSOC);

        // Affichage des propriétés (adaptez selon la structure de votre table)
        
        echo "<ul>";
        echo "<li>enseignant : " .$resultat['enseignant'] . "<li>";
        echo "<li>credits : " .$resultat['credits'] . "<li>";
        echo "</ul>";
    }
} catch(PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}
?>
