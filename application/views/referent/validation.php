<div class="ui container">
   <div class="ui stackable two column grid">
    <div class="column">
      <div class="ui pink segment">
            Confirmez cette expérience et ce que vous avez pu constater au contact de ce jeune. <br>
            
            <h2><?php echo($infoJeune['nom'].' '.$infoJeune{'prenom'});?></h2>
            <h4 class="ui dividing header">Description</h4>

            <?php echo($ref['description']) ?>
            <h4 class="ui dividing header">Durée de l'engagement</h4> <?php echo($ref['duree']) ?>
            
            <h4 class="ui dividing header">Savoirs-être dévoloppés</h4>
            <?php foreach ($savoirEtreJeune as $ligne){
              echo"<div class=\"ui label\">";
              echo($ligne);  //Haha ..
              echo "</div>";
            }?>
            
            <div class="ui right aligned grid">
              <div class="sixteen wide column">
                <i class="mail icon"></i><a href=<?php echo ("mailto:".$infoJeune['mail']);?> >Contacter</a>  
              </div>
            </div>
            
        </div>
        <a class="ui boutton" target="_blank" href="<?php echo site_url('accueil')?>">En savoir plus sur la démarche</a> 

    </div>

    <div class="column">
      <div class="ui green segment">
        <?php echo form_open('referent/validation/'.$cle, array('class' => 'ui small form ' . (validation_errors() == '' ? '' : 'error' ))); ?>
        <div class="ui error message">
          <ul class="list">
            <?php echo validation_errors('<li>', '</li>'); ?>
          </ul>
        </div>
          <h4 class="ui dividing header">Savoir-être</h4>
      		<div class="field">
            <select multiple="" class="ui dropdown" name="savoirEtre[]">
              <option value="">Selectionner ses savoir être</option>
              <?php foreach ($savoirEtreRef as $savoir) {
                echo('<option value="'.$savoir->id.'"' . set_select('savoirEtre', $savoir->id) . '>'.$savoir->nom.'</option>');
              } ?>
            </select>
          </div>

          <h4 class="ui dividing header">Identité</h4>
          <div class=" field">
              <label>Nom et Prénom</label>
                <div class="two fields">
                  <div class="field">
                    <input type="text" name="prenom" value=<?php echo(set_value('prenom', $ref['nom'])) ?>>
                  </div>
                  <div class="field">
                    <input type="text" name="nom" value=<?php echo( set_value('nom', $ref['prenom'])) ?>>
                  </div>
                </div>
          </div>
          <div class="field">
            <label>Date de naissance</label>
            <div class="fields">
              <div class="five wide field">
                <input type="text" name="jourNaissance" placeholder="Exemple : 17" value="<?php echo set_value('jourNaissance')?>">
              </div>
              <div class="six wide field">
                <select name="moisNaissance" class="ui fluid search selection dropdown ">
                  <option value="1" <?php echo set_select('moisNaissance', 1)?>>Janvier</option>
                  <option value="2" <?php echo set_select('moisNaissance', 2)?>>Février</option>
                  <option value="3" <?php echo set_select('moisNaissance', 3)?>>Mars</option>
                  <option value="4" <?php echo set_select('moisNaissance', 4)?>>Avril</option>
                  <option value="5" <?php echo set_select('moisNaissance', 5)?>>Mai</option>
                  <option value="6" <?php echo set_select('moisNaissance', 6)?>>Juin</option>
                  <option value="7" <?php echo set_select('moisNaissance', 7)?>>Juillet</option>
                  <option value="8" <?php echo set_select('moisNaissance', 8)?>>Août</option>
                  <option value="9" <?php echo set_select('moisNaissance', 9)?>>Septembre</option>
                  <option value="10" <?php echo set_select('moisNaissance', 10)?>>Octobre</option>
                  <option value="11" <?php echo set_select('moisNaissance', 11)?>>Novembre</option>
                  <option value="12" <?php echo set_select('moisNaissance', 12)?>>Decembre</option>
                </select>
              </div>
              <div class="five wide field">
                <input type="text" name="anneeNaissance" placeholder="Exemple : 1977" value="<?php echo set_value('anneeNaissance')?>">
              </div>
            </div>
          </div>

          <h4 class="ui dividing header">Ajouter un commentaire</h4>
          <div class="field">
            <textarea name="commentary"><?php echo set_value('commentary')?></textarea>
          </div>

          <div class="ui error message"></div>

          <input class="ui submit green button" type="submit" value="Confirmer l'expérience" name="valider">
        </form>
      </div>
    </div>
  </div>
</div>

<script> // Active dropdown
  $('select.dropdown')
    .dropdown()
  ;

  /*Ca marche pas

  $('.ui.form') // Regles formulaire
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
              prompt : 'Veuillez selectionner au minimum 1 savoir-être'
            }
          ]
        }
      }
    })
*/

</script>