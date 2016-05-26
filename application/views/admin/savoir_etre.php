<div class="customClearing" id="savoirEtreHeader">
  <h1 class="ui left floated header">
    Gestion des savoir-être
  </h1>
  <button class="ui right floated button blue listeSavoirEtre">
    <i class="icon plus"></i>
    Créer un savoir-être
  </button>
  <button class="ui right floated button blue creationSavoirEtre">
    <i class="icon left arrow"></i>
    Liste des savoir-être
  </button>
</div>
<div class="ui error message hidden">
  <i class="close icon"></i>
  <ul class="list">
  </ul>
</div>
<div class="ui grid stackable two column divided listeSavoirEtre">
  <?php
    foreach($savoir_etre  as $name => $value){
  ?>
    <div class="column">
      <h2 class="ui header"><?php echo $name ?></h2>
      <table class="ui very basic table">
        <?php
          foreach ($value as $item) {
        ?>
          <tr>
            <td class="twelve wide"><?php echo $item->nom ?></td>
            <td class="two wide">
              <button class="ui button mini icon tooltip deleteSavoirEtre"
                      data-content="Le savoir-être restera présent dans la base de données mais ne pourra plus être réactivé."
                      data-title="Supprimer le savoir être." data-position="left center"
                      data-value="<?php echo $item->id ?>"
              >
                <i class="icon delete"></i>
              </button>
            </td>
            <td class="two wide">
              <div class="ui toggle checkbox tooltip toggleSavoirEtre" data-content="Désactiver le savoir-être"
                   data-position="right center">
                <input <?php if ($item->etat == 1) {
                  echo 'checked="checked"';
                } ?> value="<?php echo $item->id ?>" class="hidden" tabindex="0" type="checkbox">
                <label></label>
              </div>
            </td>
          </tr>
        <?php
          }
        ?>
      </table>
    </div>
  <?php
    }
  ?>
</div>
<div class="creationSavoirEtre">
  <div class="ui form">
    <h3 class="ui dividing header">Créer un nouveau savoir-être</h3>
    <div class="ui inline field">
      <label for="nouveauSavoirEtre">Nom du savoir être : </label>
      <input type="text" id="nouveauSavoirEtre">
    </div>
    <div class="ui inline field">
      <label for="typeSavoirEtre">Savoir-être disponible pour le </label>
      <div class="ui radio checkbox">
        <input class="hidden" tabindex="0" name="typeSavoirEtre" checked="checked" type="radio" value="1">
        <label>Jeune</label>
      </div>
      <div class="ui radio checkbox">
        <input class="hidden" tabindex="0" name="typeSavoirEtre"  type="radio" value="2">
        <label>Référent</label>
      </div>
    </div>
    <div class="ui inline field">
      <button class="ui button blue">
        <i class="icon check"></i>
        Valider
      </button>
    </div>
  </div>
</div>
<script>
  var reqUrl = '<?php echo site_url('/admin/savoir_etre/') ?>';
</script>
<script src="<?php echo base_url().'static/js/utils.js'?>"></script>
<script src="<?php echo base_url().'static/js/savoir_etre.js'?>"></script>
