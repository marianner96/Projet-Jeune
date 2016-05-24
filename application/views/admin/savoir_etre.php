<div class="ui grid stackable two column divided">
  <div class="column">
    <h2 class="ui header">Jeune</h2>
    <table class="ui very basic table">
      <?php
        foreach ($jeune_savoir_etre as $item) {
      ?>
      <tr>
        <td class="twelve wide"><?php echo $item->nom ?></td>
        <td class="two wide">
          <button class="ui button mini icon tooltip" data-content="Le savoir-être restera présent dans la base de données mais ne pourra plus être réactivé." data-title="Supprimer le savoir être." data-position="left center">
            <i class="icon delete" ></i>
          </button>
        </td>
        <td class="two wide">
          <div class="ui toggle checkbox tooltip" data-content="Désactiver le savoir-être" data-position="right center">
            <input <?php if($item->etat == 1){echo 'checked="checked"';} ?> class="hidden" tabindex="0" type="checkbox">
            <label></label>
          </div>
        </td>
      </tr>
      <?php
        }
      ?>
    </table>
  </div>
  <div class="column">
    <h2 class="ui header">Référent</h2>
    <table class="ui very basic table">
      <?php
      foreach ($referent_savoir_etre as $item) {
        ?>
        <tr>
          <td class="twelve wide"><?php echo $item->nom ?></td>
          <td class="two wide">
            <button class="ui button mini icon tooltip" data-content="Le savoir-être restera présent dans la base de données mais ne pourra plus être réactivé." data-title="Supprimer le savoir être." data-position="left center">
              <i class="icon delete" ></i>
            </button>
          </td>
          <td class="two wide">
            <div class="ui toggle checkbox tooltip" data-content="Désactiver le savoir-être" data-position="right center">
              <input <?php if($item->etat == 1){echo 'checked="checked"';} ?> class="hidden" tabindex="0" type="checkbox">
              <label></label>
            </div>
          </td>
        </tr>
        <?php
      }
      ?>
    </table>
  </div>
</div>
<script>
  $('.ui.checkbox')
    .checkbox();
  $('.tooltip')
    .popup();
</script>
