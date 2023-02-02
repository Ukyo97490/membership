<?php
require ('pdo.php');
$title='Connexion';

if(!empty($_POST))
{
    $post=filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    extract($post);
    $errors=[];
    if(empty($email)||!filter_var($email,FILTER_VALIDATE_EMAIL)){
        array_push($errors, 'L\'adresse email est incorrect.');
    }
    if(empty($password)){
        array_push($errors, 'Le mot de passe est incorrect.');
    }
if(empty($errors)){
    $req=$db->prepare('SELECT*FROM users WHERE email=:email');
    $req->bindValue(':email',$email, PDO::PARAM_STR).
    $req->execute();

    $user=$req->fetch();
    if($user && password_verify($password,$user->password)){
       $_SESSION['user']=$user;
       header('Location:dashboard.php');
        
    }
    array_push($errors,'Identifiants incorrect');
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
    <form action="login.php" method="post">
      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" name="email" class="form-control" placeholder="Email" value="<?= $email ?? '';?>">
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" name="password" class="form-control" placeholder="Mot de passe">
      </div>
      <button type="submit" class="btn btn-primary">Connexion</button>
    </form>

  </div>
</main>
<?php
include ('footer.php')
?>

