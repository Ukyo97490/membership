<?php
require ('pdo.php');

$title='Inscription';
$errors = [];

if(!empty($_POST))
{
  $post = filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);
  extract($post);

  if(empty($name)|| strlen($name)<3){
    array_push($errors,'Le nom est trop petit et doit contenir au moins 3 caractères.');
  }
  if(empty($email)|| !filter_var($email,FILTER_VALIDATE_EMAIL)){
    array_push($errors, 'L\'email n\'est pas valide.');
  }
  if(empty($password)|| strlen($password)<6){
    array_push($errors, 'Le password doit contenir au moins 6 caractères.');
  }
  
  // Vérifiez s'il n'y a pas d'erreurs et insérez les données dans la base de données
  if (empty($errors)) {
    // Requête pour vérifier si le nom d'utilisateur est déjà enregistré
    $req = $db->prepare('SELECT * FROM users WHERE name=:name');
    $req->bindValue(':name', $name, PDO::PARAM_STR);
    $req->execute();

    if ($req->rowCount() > 0) {
      array_push($errors,'Un utilisateur est déjà enregistré avec ce nom.');
    }
    
    // Requête pour vérifier si l'email est déjà enregistré
    $req = $db->prepare('SELECT * FROM users WHERE email=:email');
    $req->bindValue(':email', $email, PDO::PARAM_STR);
    $req->execute();

    if ($req->rowCount() > 0) {
      array_push($errors,'Un utilisateur est déjà enregistré avec cet email.');
    }
  


        // Insérez les données dans la base de données si aucune erreur n'est survenue

    if(empty($errors))
    {
      // Insérez les données dans
      $req=$db->prepare('INSERT INTO users (name,email,password,created_at) VALUES (:name,:email,:password, NOW())');
      $req->bindValue(':name',$name,PDO::PARAM_STR);
      $req->bindValue(':email',$email,PDO::PARAM_STR);
      $req->bindValue(':password',password_hash($password,PASSWORD_ARGON2ID),PDO::PARAM_STR);
      $req->execute();

      unset($name, $email, $password);
      $success='Votre inscription est terminée avec réussite, vous pouvez vous <a href="login.php">Vous connecter.</a>';
    }
  }

}
?>
<?php 
include ('header.php')
?>

<h2><?=$title?></h2>
<!-- Message d'alerte de réussite ou erreur  -->
<?php include ('messages.php')?>
<!-- FIN Message d'alerte de réussite ou erreur  -->
    <form action="index.php" method="post">
      <div class="form-group">
        <label for="name">Nom d'utilisateur</label>
        <input type="text" name="name" class="form-control" placeholder="Nom d'utilisateur" value="<?= $name ?? '';?>">
      </div>
      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" name="email" class="form-control" placeholder="Email" value="<?= $email ?? '';?>">
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" name="password" class="form-control" placeholder="Mot de passe">
      </div>
      <button type="submit" class="btn btn-primary">Envoyer</button>
    </form>

  </div>
</main>
<?php
include ('footer.php')
?>

