<?php
      $host = 'localhost';
      $dbname = 'blog';
      $user = 'root';
      $pass = 'root';
      
      try {
          $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
          $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      } catch (PDOException $e) {
          echo "Connection failed: " . $e->getMessage();
      }

      // On récupère les 5 derniers billets
      $req = $pdo->query("SELECT id, titre, contenu, DATE_FORMAT(date_creation, '%d/%m/%Y à %Hh%imin%ss') AS date_creation_fr FROM billets ORDER BY date_creation DESC LIMIT 0, 5");


      $posts = [];
      while($row = $req->fetch()){
         $post = [
            'title' => $row['titre'],
            'content' => $row['contenu'],
            'frenchCreationDate' => $row['date_creation_fr'],
         ];
      $posts[] = $post;
      }
      require('templates/homepage.php');
?>

