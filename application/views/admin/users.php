
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
      <tr>
        <td><?php echo $user['nom'] . ' ' . $user['prenom']?></td>
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
  $('.icon.star').click(function(){
    console.log('test');
    $(this)
      .toggleClass('empty');
    $(this)
      .transition('jiggle');
  })
</script>
