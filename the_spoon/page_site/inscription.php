<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../styles_site/styles_inscription.css" rel="stylesheet" >
    <title>Inscription</title>

</head>
<body>
    <div class="container">
            <h1>Inscription</h1>
            <?php
    // Code PHP ajouté par SGR pour connecter à la base
    // Vérification si le formulaire a été soumis
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Récupérer les données du formulaire
        $nom = $_POST["nom"];
        $email = $_POST["email"];
        $prenom=$_POST["prenom"];
        $password=$_POST["password"];
        $num_tel=$_POST["num_tel"];
        if (isset($_POST['restaurateur'])) {
            $restaurateur=TRUE;
         } else {
            $restaurateur=FALSE;
         }
        

        // Connexion à la base de données
        $serveur = "localhost"; // Remplacez par l'adresse de votre serveur MySQL
        $utilisateur = "root"; // Remplacez par votre nom d'utilisateur MySQL
        $motDePasse = ""; // Remplacez par votre mot de passe MySQL
        $baseDeDonnees = "the_spoon"; // Remplacez par le nom de votre base de données

        // Création de la connexion
        $connexion = new mysqli($serveur, $utilisateur, $motDePasse, $baseDeDonnees);

        // Vérification de la connexion
        if ($connexion->connect_error) {
            die("La connexion a échoué : " . $connexion->connect_error);
        }

        // Préparation de la requête d'insertion
        $requete = $connexion->prepare('INSERT INTO individu (nom, prenom, adresse_mail,numero_tel,role,mot_de_passe) VALUES ("' . $nom . '", "' . $prenom . '", "' . $email . '", "' . $num_tel . '", "' . $restaurateur . '", "' . $password . '")'); // (?, ?, ?)

        // Liaison des paramètres et exécution de la requête
        // $requete->bind_param("ss", $nom, $prenom, $email);

        if ($requete->execute()) {
            echo "Données insérées avec succès.";
        } else {
            echo "Erreur lors de l'insertion des données : " . $requete->error;
        }

        // Fermeture de la connexion
        $connexion->close();
    }
    ?>
        <form class="inscription-form animate-top" method="post" action="inscription.php" >
            <h1>Inscription</h1>
            <label for="nom">Nom</label>
            <input type="text" id="nom" name="nom" required>

            <label for="prenom">Prenom</label>
            <input type="text" id="prenom" name="prenom" required>

            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>

            <label for="num_tel">Numéro de téléphone</label>
            <input type="num_tel" id="num_tel" name="num_tel" required>

            <label for="password">Mot de passe</label>
            <input type="password" id="password" name="password" required>

            <label for="restaurateur">Je suis restaurateur</label>
            <input type="checkbox" id="restaurateur" name="restaurateur">

            <button type="submit">S'inscrire</button>
            <a href="../index.html">retour Accueil</a>
        </form>
    </div>
</body>
</html>