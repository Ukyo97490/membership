<?php
require 'db.php';

if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $desc = $_POST['desc'];
  
    // Récupération des images
    $img = $_FILES['img']['name'];
    $img_tmp = $_FILES['img']['tmp_name'];
    $icon = $_FILES['icon']['name'];
    $icon_tmp = $_FILES['icon']['tmp_name'];
  
    // Définition des chemins de stockage
    $img_path = "images/".$img;
    $icon_path = "images/".$icon;
  
    // Déplacement des images à partir du répertoire temporaire vers le répertoire "images"
    move_uploaded_file($img_tmp, $img_path);
    move_uploaded_file($icon_tmp, $icon_path);
  
    // Préparation de la requête SQL pour insérer les données dans la table "Games"
    $query = $db->prepare("INSERT INTO Games (name, `desc`, img, icon) VALUES (?,?,?,?)");
    $query->execute([$name, $desc, $img_path, $icon_path]);
  
    // Redirection vers la page d'accueil
    header("Location: admin.php");
  }
  ?>


<h1>Ajouter un jeu</h1>

<!-- Formulaire pour ajouter une entrée -->
<form action="game_add.php" method="post" enctype="multipart/form-data">
  <div class="form-group">
    <label for="name">Name</label>
    <input type="text" class="form-control" id="name" name="name" required>
  </div>
  <div class="form-group">
    <label for="desc">Description</label>
    <textarea class="form-control" id="desc" name="desc" required></textarea>
  </div>
  <div class="form-group">
    <label for="img">Image</label>
    <input type="file" class="form-control-file" id="img" name="img" required>
  </div>
  <div class="form-group">
    <label for="icon">Icône</label>
    <input type="file" class="form-control-file" id="icon" name="icon" required>
  </div>
  <button type="submit" class="btn btn-primary" name="submit">Ajouter</button>
</form>
