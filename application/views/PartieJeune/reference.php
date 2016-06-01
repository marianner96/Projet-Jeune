<?php
  if (count($validation)!=0){
?>
  <div class="ui success message">
    <i class="close icon"></i>
    <div class="header">Demande de référence</div>
    <p>
      Votre demande de référence a bien été créee <?php echo $tab["prenom"] . ' ' . $tab["nom"]; ?>, elle sera envoyée à <?php echo $validation[0] . ' ' . $validation[1]; ?>
    </p>
  </div>
<?php
  }
?>
<div class="ui error message hidden">
  <i class="close icon"></i>
  <ul class="list">
  </ul>
</div>
<div class="ui success message hidden grp">
  <i class="close icon"></i>
  <div class="header">Liste d'engagement</div>
  Votre liste d'engagement a bien été créée !
</div>
<!-- Header de la section -->
<div class="customClearing referencesHeader">
  <h1 class="ui left floated header">
    Gérer vos références
  </h1>
  <a class="ui right floated button pink" href="<?php echo site_url('jeune/formulaire') ?>">
    <i class="icon plus"></i>
    Demande de référence
  </a>
  <button class="ui right floated button pink selectionView" name="cancel">
    <i class="icon cancel"></i>
    Annuler
  </button>
  <button class="ui right floated button pink selectionView" name="submit">
    <i class="icon check"></i>
    Valider
  </button>
  <button class="ui right floated button pink overView" name="createGrp">
    <i class="icon plus"></i>
    Créer un groupement
  </button>
</div>
<!-- Menu onglet -->
<div class="ui top attached tabular menu">
  <a class="item active" data-tab="validee">
    Validées
    <label class="ui label green"><?php echo $nb_references[2] ?></label>
  </a>
  <a class="item" data-tab="non-validee">
    En cours de validation
    <label class="ui label orange"><?php echo $nb_references[1] ?></label>
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
        <div class="item" data-value="<?php echo $reference['id']?>">
          <div class="right floated content overView">
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
      if($nb_references[2] == 0){
        echo 'Pas encore de références ici.';
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

<script>var reqUrl = '<?php echo site_url('/jeune/'); ?>' </script>
