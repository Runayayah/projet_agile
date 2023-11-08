<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="../styles_site/styles_connexion.css" rel="stylesheet" >
        <title>Connexion</title>

    </head>
    <body>
        <div class="container">
          <?php
          // Connexion à la base de données
          $db = new mysqli("localhost", "root", "", "the_spoon");

          if ($db->connect_error) {
              die("La connexion à la base de données a échoué : " . $db->connect_error);
          }

          // Récupération des données soumises par le formulaire
          $email = $_POST["email"];
          $password = $_POST["password"];

          // Requête SQL pour récupérer le mot de passe associé à l'utilisateur
          $request = 'SELECT mot_de_passe  FROM individu WHERE adresse_mail = "'.$email.'"';
          $reponse = $db->query($request);

              // Vérification du mot de passe
              if ($password == $reponse) {
                  // Authentification réussie, redirigez l'utilisateur vers une page sécurisée
                  header("index_client.html");

              } else {
                  // Authentification échouée, affichez un message d'erreur
                  echo "Adresse e-mail ou mot de passe incorrect.";
              }


          $db->close();
          ?>
            <form class="inscription-form animate-top" method="post" action="connexion.php">
                <h1>Connexion</h1>
                <label for="email">Email</label>
                <input type="text" id="email" name="email" required>

                <label for="password">Mot de passe</label>
                <input type="password" id="password" name="password" required>

                <button type="submit">Se connecter</button>
                <a href="../index.html">retour Accueil</a>
            </form>

        </div>
    </body>
    </html>
