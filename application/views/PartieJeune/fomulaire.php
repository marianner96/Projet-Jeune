<style>
 #for { 
border-style: solid;
  }
</style>
<div class="ui three column divided grid">
  <div class="stretched row">
    <div class="column">
      <div class="ui segment">
        <div class="ui inverted vertical menu">
    <a class="item <?php echo !empty($menu) && $menu == 'accueil' ? 'active' : '' ?>" href="<?php echo site_url('jeune') ?>">
    Mon profil
  </a>
  <a class="active item <?php echo !empty($menu) && $menu == 'accueil' ? 'active' : '' ?>" href="<?php echo site_url('jeune/formulaire') ?>">
    Demande de référence
  </a>
  <a class="item <?php echo !empty($menu) && $menu == 'accueil' ? 'active' : '' ?>" href="<?php echo site_url('jeune/consultant') ?>">
    Consultant
  </a>
</div>
      </div>
    </div>
    <div class="column">
      <div class="ui segment">
<form class="ui small form" >
   <h4 class="ui dividing header">Savoir-être</h4>
   <div class="field">
    <select multiple="" class="ui dropdown" name="savoirEtre">
      <option value="">Selectionner vos savoir être</option>
      <option value="AU">Autonome</option>
      <option value="AN">Capable d’analyse et de synthèse</option>
      <option value="AL">A l’écoute</option>
      <option value="OR">Organisé</option>
      <option value="PAS">Passionné</option>
      <option value="FI">Fiable</option>
      <option value="PAT">Patient</option>
      <option value="REF">Réfléchi</option>
      <option value="RES">Responsable</option>
      <option value="SO">Sociable</option>
      <option value="OP">Optimiste</option>
    </select>
  </div>
  <h4 class="ui dividing header">Engagement</h4>
  <div class="two fields">
    <div class="field">
      <label>Description de l'engagement</label>
      <textarea rows="2"></textarea>
    </div>
    <div class="field">
      <label>Durée de l'engagement</label>
      <input type="text">
    </div>
  </div>
  <h4 class="ui dividing header">Référent</h4>
    <div class=" field">
      <label>Identité</label>
        <div class="two fields">
          <div class="field">
            <input type="text" name="shipping[first-name]" placeholder="Prénom">
          </div>
          <div class="field">
            <input type="text" name="shipping[last-name]" placeholder="Nom">
          </div>
        </div>
    </div>
  <div class="field">
    <label>Adresse</label>
      <div class="fields">
        <input type="text" name="shipping[address]" placeholder="Nom de la rue">
      </div>
  </div>
  <div class="two fields">
    <div class="field">
      <input type="text" name="shipping[address]" placeholder="Ville">
    </div>
    <div class="field">
      <input type="text" name="shipping[address]" placeholder="Pays">
    </div>
  </div>
  <div class="field">
    <label>Adresse email</label>
      <input type="email" name="shipping[address]">
  </div>
   <div class="ui submit button">Submit</div>
  <div class="ui error message"></div>
</form>
      </div>
  </div>
</div>


<script>
$('select.dropdown')
  .dropdown()
;
$('.ui.form')
  .form({
    fields: {
      savoiretre :{
        identifier :'savoirEtre',
        rules: [
          {
            type   : 'maxCount[4]',
            type   : 'minCount[1]',
            prompt : 'Veuillez selectionner au maximum 4 savoir-être'
          }
        ]
      }
    }
  })
</script>