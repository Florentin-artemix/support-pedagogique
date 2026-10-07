<?php
// Connexion à la base de données
$servername = "votre_serveur";
$username = "votre_utilisateur";
$password = "votre_mot_de_passe";
$dbname = "votre_base_de_donnees";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);   

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);   


    // Requête pour récupérer tous les intitulés (remplacez 'votre_table' et 'intitule' par vos noms)
    $stmt = $conn->prepare("SELECT intitule FROM votre_table");
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
        $stmt = $conn->prepare("SELECT * FROM votre_table WHERE intitule = :intitule");
        $stmt->bindParam(':intitule', $intitule_selectionne);
        $stmt->execute();
        $resultat = $stmt->fetch(PDO::FETCH_ASSOC);

        // Affichage des propriétés (adaptez selon la structure de votre table)
        echo "<h2>Propriétés de " . $resultat['intitule'] . "</h2>";
        echo "<ul>";
        foreach ($resultat as $key => $value) {
            if ($key !== 'intitule') { // Éviter d'afficher l'intitulé une deuxième fois
                echo "<li>" . $key . ": " . $value . "</li>";
            }
        }
        echo "</ul>";
    }
} catch(PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}
?>
