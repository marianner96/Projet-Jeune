
Décrivez votre expérience et mettez en avant ce que vous en avez retiré :

Mes savoirsetre :
<?php echo validation_errors(); ?>

<?php echo form_open('jeune/accueil'); ?>
<div class="ui small form">
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
<!--<div class="ui form">-->
  <!-- <div class="inline field">
    <div class="ui checkbox">
      <input type="checkbox" tabindex="0" class="hidden">
      <label>Autonome</label>
      <label>Capable d’analyse et de synthèse</label>
      <label>A l’écoute</label>
      <label>Organisé</label>
      <label>Passionné</label>
      <label>Fiable</label>
      <label>Patient</label>
      <label>Réfléchi</label>
      <label>Responsable</label>
      <label>Sociable</label>
      <label>Optimiste</label>
    </div>
  </div> -->
 <!--  <div class="inline field">
    <div class="ui checkbox">
      <input type="checkbox" tabindex="0" class="hidden" name="savoiretre[]" value="1">
      <label>Capable d’analyse et de synthèse</label>
    </div>
  </div>
  <div class="inline field">
    <div class="ui checkbox">
      <input type="checkbox" tabindex="1" class="hidden" name="savoiretre[]" value="2">
      <label>A l’écoute</label>
    </div>
  </div>
  <div class="inline field">
    <div class="ui checkbox">
      <input type="checkbox" tabindex="2" class="hidden" name="savoiretre[]" value="3">
      <label>Organisé</label>
    </div>
  </div>
  <div class="inline field">
    <div class="ui checkbox"> 
      <input type="checkbox" tabindex="3" class="hidden" name="savoiretre[]" value="4">
      <label>Passionné</label>
    </div>
  </div>
  <div class="inline field">
    <div class="ui checkbox">
      <input type="checkbox" tabindex="4" class="hidden" name="savoiretre[]" value="5">
      <label>Fiable</label>
    </div>
  </div> -->
  <!-- <div class="inline field">
    <div class="ui checkbox">
      <input type="checkbox" tabindex="5" class="hidden" name="savoiretre[]" value="6">
      <label>Patient</label>
    </div>
  </div>
  <div class="inline field">
    <div class="ui checkbox">
      <input type="checkbox" tabindex="6" class="hidden" name="savoiretre[]" value="7">
      <label>Réfléchi</label>
    </div>
  </div>
  <div class="inline field">
    <div class="ui checkbox">
      <input type="checkbox" tabindex="7" class="hidden" name="savoiretre[]" value="8">
      <label>Responsable</label>
    </div>
  </div>
  <div class="inline field">
    <div class="ui checkbox">
      <input type="checkbox" tabindex="8" class="hidden" name="savoiretre[]" value="9">
      <label>Sociable</label>
    </div>
  </div>
  <div class="inline field">
    <div class="ui checkbox">
      <input type="checkbox" tabindex="9" class="hidden" name="savoiretre[]" value="10">
      <label>Optimiste</label>
    </div>
  </div>
  <div><input type="submit" value="Submit" /></div>
</div> -->