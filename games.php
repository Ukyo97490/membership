

<h1>Games</h1>


<table class="table">
  <thead class="thead-light">
    <tr>
      <th scope="col">Name</th>
      <th scope="col">Description</th>
      <th scope="col">Image</th>
      <th scope="col">Icône</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $query = $db->prepare("SELECT * FROM games");
    $query->execute();
    $games = $query->fetchAll();
    foreach ($games as $game) {
      ?>
      <tr>
        <td><?= $game->name ?></td>
        <td><?= $game->desc ?></td>
        <td><img src="<?= $game->img ?>" width="100" height="100"></td>
        <td><img src="<?= $game->icon ?>" width="100" height="100"></td>
        <td>
          <button class="btn btn-primary" data-toggle="modal" data-target="#updateModal" onclick="fillUpdateForm(<?= $game->id ?>)">Edit</button>
          <button class="btn btn-danger" data-toggle="modal" data-target="#deleteModal" onclick="setIdToDelete(<?= $game->id ?>)">Delete</button>
        </td>
      </tr>
    <?php } ?>
  </tbody>
</table>
