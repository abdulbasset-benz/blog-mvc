<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8" />
      <title>Le blog de l'AVBN</title>
      <link href="style.css" rel="stylesheet" />
   </head>

   <body>
      <h1>Le super blog de l'AVBN !</h1>
      <p>Derniers billets du blog :</p>

      <?php
      $host = 'localhost';
      $dbname = 'blog';
      $user = 'root';
      $pass = 'root';
      
      try {
          $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
          $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          echo "Connected successfully";
      } catch (PDOException $e) {
          echo "Connection failed: " . $e->getMessage();
      }

      // On récupère les 5 derniers billets
      $req = $pdo->query('SELECT id, titre, contenu, DATE_FORMAT(date_creation, \'%d/%m/%Y à %Hh%imin%ss\') AS date_creation_fr FROM billets ORDER BY date_creation DESC LIMIT 0, 5');

      while ($donnees = $req->fetch()) {
      ?>
      <div class="news">
         <h3>
            <?php echo htmlspecialchars($donnees['titre']); ?>
            <em>le <?php echo $donnees['date_creation_fr']; ?></em>
         </h3>
         <p>
            <?php
            // On affiche le contenu du billet
            echo nl2br(htmlspecialchars($donnees['contenu']));
            ?>
            <br />
            <em><a href="#">Commentaires</a></em>
         </p>
      </div>
      <?php
      } // Fin de la boucle des billets
      $req->closeCursor();
      ?>
   </body>
</html>
