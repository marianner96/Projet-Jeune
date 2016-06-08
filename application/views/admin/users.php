<div class="ui error message hidden">
  <i class="close icon"></i>
  <ul class="list">
  </ul>
</div>
<h1 class="ui left floated header">
  Gestion des membres
</h1>
<table class="ui very basic table users">
  <thead>
    <tr>
      <th class="eight wide">Nom et prénom</th>
      <th class="four wide">E-mail</th>
      <th class="two wide center aligned">Rang</th>
      <th class="two wide center aligned">Supprimer</th>
    </tr>
  </thead>
<?php
  foreach ($users as $user){
    ?>
      <tr data-user-id="<?php echo $user['id'] ?>">
        <td><?php echo $user['prenom'] . ' ' . $user['nom']?></td>
        <td><?php echo mailto($user['mail']) ?></td>
        <td class="center aligned"><i class="<?php echo $user['rang'] > 99 ? '' : 'empty' ?> star large icon"></i></td>
        <td class="center aligned"><i class="remove user large icon"></i></td>
      </tr>
    <?php
  }
?>
</table>
<?php
  echo $this->pagination->create_links();
?>
<script>
  var reqUrl = '<?php echo site_url('/admin/') ?>';
</script>
