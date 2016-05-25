<div class="ui error message hidden">
  <i class="close icon"></i>
  <ul class="list">
  </ul>
</div>
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
          <div class="ui toggle checkbox tooltip toggleSavoirEtre" data-content="Désactiver le savoir-être" data-position="right center">
            <input <?php if($item->etat == 1){echo 'checked="checked"';} ?> value="<?php echo $item->id ?>" class="hidden" tabindex="0" type="checkbox">
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
            <div class="ui toggle checkbox tooltip toggleSavoirEtre" data-content="Désactiver le savoir-être" data-position="right center">
              <input <?php if($item->etat == 1){echo 'checked="checked"';} ?> value="<?php echo $item->id ?>" class="hidden" tabindex="0" type="checkbox">
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
  $('.tooltip')
    .popup();
  $('.message .close')
    .on('click', function () {
      $(this)
        .closest('.message')
        .transition('fade down');
    });
  var reqUrl = '<?php echo site_url('/admin/savoir_etre/') ?>';
  var errEl = $('.ui.error.message ul');

  function displayError(rep, msg){
    var data;
    //Récupération de l'erreur
    try{
      data = JSON.parse(rep);
    } catch (e){
      data = {errors : ['Erreur : ' + msg]};
    }
    //On supprime les anciens messages d'erreur
    errEl.empty();
    //On met les nouveaux
    for(err in data.errors){
      $('<li></li>')
        .text(data.errors[err])
        .appendTo(errEl);
    }
    //Petite transition si le bloc n'est pas visible
    $('.error.message.hidden')
      .transition('fade down');
  }

  function toggleSavoirEtre(e){
    var self = this;
    $.get(reqUrl+'/toggle/'+this.value, function () {
      $(self).prop('checked', !$(self).prop('checked'))
    })
      .fail(function (xhr, status, msg) {
        displayError(xhr.responseText, msg);
      });
    return false;
  }
  $('.toggleSavoirEtre')
    .checkbox({
      beforeChecked: toggleSavoirEtre,
      beforeUnchecked : toggleSavoirEtre
    })
</script>
