<!-- Header de la section -->
<div class="customClearing referencesHeader">
  <h1 class="ui left floated header">
    Gérer vos références
  </h1>
  <a class="ui right floated button pink" href="<?php echo site_url('jeune/formulaire') ?>">
    <i class="icon plus"></i>
    Demande de référence
  </a>
  <button class="ui right floated button pink">
    <i class="icon plus"></i>
    Créer un groupement
  </button>
</div>
<!-- Menu onglet -->
<div class="ui top attached tabular menu">
  <a class="item active" data-tab="validee">
    Validées
    <label class="ui label green"><?php echo $nb_references[1] ?></label>
  </a>
  <a class="item" data-tab="non-validee">
    En cours de validation
    <label class="ui label orange"><?php echo $nb_references[2] ?></label>
  </a>
  <a class="item" data-tab="archivee">
    Archivées
    <label class="ui label blue"><?php echo $nb_references[3] ?></label>
  </a>
</div>
<!-- Liste des références validées -->
<div class="ui bottom attached tab segment active" data-tab="validee">
  <div class="ui middle aligned divided list selection reference">
    <!-- Début de l'affichage  des références validées -->
    <?php
      foreach ($references as $reference) {
      if($reference['etat'] == 2) {
        ?>
        <div class="item">
          <div class="right floated content">
            <div class="ui button">
              <i class="icon archive"></i>
              Archiver
            </div>
          </div>
          <i class="icon caret right icon large"></i>
          <div class="content">
            <div class="description">
              <?php echo $reference['description'] ?>

              <!-- Détail de la référence -->
              <div class="long">
                <div class="ui grid stackable">
                  <!-- Durée -->
                  <div class="four wide column header">
                    Durée
                  </div>
                  <div class="twelve wide column">
                    <?php echo $reference['duree'] ?>
                  </div>
                  <!-- Savoir être-->
                  <div class="four wide column header">
                    Savoir-être
                  </div>
                  <div class="twelve wide column">
                    <?php
                    foreach ($reference['savoir_etre'] as $savoir_etre) {
                      ?>
                      <label class="ui label"><?php echo $savoir_etre['nom'] ?></label>
                      <?php
                    }
                    ?>
                  </div>
                  <!-- Coordonnées référent-->
                  <div class="four wide column header">
                    Référent
                  </div>
                  <div class="twelve wide column">
                    <?php echo $reference['prenom'] . ' ' . $reference['nom'] . ' - ' . mailto($reference['mail']) ?>
                  </div>
                  <!-- Commentaire du référent-->
                  <div class="four wide column header">
                    Commentaire
                  </div>
                  <div class="twelve wide column">
                    <?php echo $reference['commentaire'] ?>
                  </div>
                </div>
              </div>
              <!-- Fin détail de la référence -->

            </div>
          </div>
        </div>
        <?php
        }
      }
    ?>
    <!-- Fin de l'affichage  des références validées-->
  </div>
</div>
<div class="ui bottom attached tab segment" data-tab="non-validee">
  Second
</div>
<div class="ui bottom attached tab segment" data-tab="archivee">
  Third
</div>

<script>
  $('.menu .item')
    .tab();
  $('.ui.checkbox')
    .checkbox();
  var selectGroup = false;
  $('div[data-tab=validee] .list.selection .item')
    .click(function (e) {
      if(selectGroup || e.target.classList.contains('button'))
        return;
      $(this)
        .find('.long')
        .toggle();
      $(this)
        .find('.icon.caret')
        .toggleClass('right')
        .toggleClass('down');
    });
</script>
