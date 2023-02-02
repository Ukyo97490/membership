<!-- MESSAGES EST EN FAIT LE FICHIER QUI AFFICHE LES MESSAGES ERREUR ET REUSSITE  -->
<?php if(!empty($success)) ?>
<div class="alert alert-success">
<p><?=$success;?></p>
</div>
<?php if(!empty($errors)): ?>
  <div class="alert alert-danger">
  <?php foreach($errors as $error):?>
    <p><?=$error;?></p>
    <?php endforeach; ?>
  </div>
<?php endif; ?>