<style>
 #for { 
border-style: solid;
  }
</style>
<div class="ui inverted vertical menu">
  <a class="item <?php echo !empty($menu) && $menu == 'accueil' ? 'active' : '' ?>" href="<?php echo site_url('jeune') ?>">
    Présentation
  </a>
  <a class="active item <?php echo !empty($menu) && $menu == 'accueil' ? 'active' : '' ?>" href="<?php echo site_url('jeune/formulaire') ?>">
    Demande de référence
  </a>
  <a class="item">
    Mon profil
  </a>
  <a class="item">
    Consultant
  </a>
</div>
Décrivez votre expérience et mettez en avant ce que vous en avez retiré :  
<form class="ui small form" id="for">
  <h4 class="ui dividing header">Engagement</h4>
    <div class="field">
      <label>Description de l'engagement</label>
      <textarea rows="2"></textarea>
    </div>
    <div class="field">
      <label>Durée de l'engagement</label>
      <textarea rows="2"></textarea>
    </div>
    <div class="field">
      <label>Milieu de l'angement</label>
      <textarea rows="2"></textarea>
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
  <h4 class="ui dividing header">Savoir-être</h4>
   <div class="field">
    <label>Savoir être</label>
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
   <div class="ui submit button">Submit</div>
  <div class="ui error message"></div>
</form>

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