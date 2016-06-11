 
  <h1>Création d'une référence</h1>
  <div class="help title" title="Afficher l'aide"><i class="icon idea"></i>Demande de référence : Comment ça marche ?</div>
  <div class="ui message info help hidden">
    <i class="icon close"></i>
    <p>
      Renseignez un engagement, une expérience que vous avez effectuez.</br>
      Cette référence sera envoyé par mail à votre référent qui pourra valider votre demande et également selectionner les savoir-être vous correspondant selon lui.
      Décrivez votre expérience et mettez en avant ce que vous en avez retiré.
    </p>
  </div>
<div class="creation_reference">
 <?php
  $classError = validation_errors()=="" ? "":"error";
      echo form_open('jeune/nouvelleDemande', array('class' => 'ui small form ' . $classError)); ?>
   <h4 class="ui dividing header">Savoir-être</h4>
   <div class="field">
    <select multiple="" class="ui dropdown" name="savoirEtre[]" data-validate="savoirEtre">
      <option value="">Selectionner vos savoir être</option>
      <?php
foreach ($query as $value) {
    echo "<option value=\"$value->id\" " . set_select('savoirEtre', $value->id, in_array($value->id, $favori)) . ">" . $value->nom . "</option>";
}
?>
    </select>
  </div>
  <h4 class="ui dividing header">Engagement</h4>
  <div class="two fields">
    <div class="field">
      <label>Description de l'engagement</label>
      <textarea rows="2" name="description"><?php echo set_value('description'); ?></textarea>
    </div>
    <div class="field">
      <label>Durée de l'engagement</label>
      <div class="ui action input">
        <input type="text" name="duree" value="<?php echo set_value('duree'); ?>">
        <select name="duree_type" class="ui compact selection dropdown">
          <option value="day">Jours</option>
          <option selected="selected" value="week">Semaines </option>
          <option value="month">Mois</option>
          <option value="year">Ans</option>
        </select>
      </div>
    </div>
  </div>
  <h4 class="ui dividing header">Référent</h4>
    <div class=" field">
      <label>Identité</label>
        <div class="two fields">
          <div class="field">
            <input type="text" name="prenom" placeholder="Prénom" value="<?php echo set_value('prenom'); ?>">
          </div>
          <div class="field">
            <input type="text" name="nom" placeholder="Nom" value="<?php echo set_value('nom'); ?>">
          </div>
        </div>
    </div>
  <div class="field">
    <label>Adresse email</label>
      <input placeholder="E-mail" type="email" name="mail" value="<?php echo set_value('mail'); ?>">
  </div>
   <input class="ui submit button" value="Envoyer" type="submit">
  <div class="ui error message">
    <ul clas="list">
      <?php echo validation_errors('<li>', '</li>'); ?>
    </ul>
  </div>
</form>
</div>
<script src="<?php echo base_url()?>static/js/utils.js"></script>
<script src="<?php echo base_url()?>static/js/help.js"></script>

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
             prompt : 'Veuillez selectionner au maximum 4 savoir-être'
           },
           {
             type   : 'minCount[1]',
             prompt : 'Veuillez selectionner au moins un savoir-être'
           }
         ]
       },
     description:{
       identifier :'description',
         rules: [
           {
             type   : 'empty',
             prompt : 'Veuillez mettre une description'
           }
         ]
     },
     duree:{
       identifier :'duree',
         rules: [
           {
             type   : 'empty',
             prompt : 'Veuillez préciser la durée de votre engagement'
           }
         ]
     },
     prenom:{
       identifier :'prenom',
         rules: [
           {
             type   : 'empty',
             prompt : 'Veuillez préciser le prenom du référent'
           }
         ]
     },
       nom:{
       identifier :'nom',
         rules: [
           {
             type   : 'empty',
             prompt : 'Veuillez préciser le nom du référent'
           }
         ]
     },
   mail:{
       identifier :'mail',
         rules: [
           {
             type   : 'empty',
             prompt : 'Veuillez préciser le mail du référent'
           }
         ]
     }
   }
 })
</script>
