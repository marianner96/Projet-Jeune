<?php
  if (count($validation)!=0){
?>
  <div class="ui success message">
    <i class="close icon"></i>
    <div class="header">Demande de référence</div>
    <p>
      Votre demande de référence a bien été créée <?php echo $tab["prenom"] . ' ' . $tab["nom"]; ?>, elle sera envoyée à <?php echo $validation[0] . ' ' . $validation[1]; ?>
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
  Votre <a data-base-url="<?php echo site_url('/jeune/listes-engagements'); ?>">liste d'engagement</a> a bien été créée !
</div>
<div class="ui success message hidden archive">
  <i class="close icon"></i>
<div class="header">Référence archivée</div>
  La référence n°<span></span> a bien été archivée.
</div>
<!-- Header de la section -->
<div class="jeuneHeader">
  <h1 class="ui left floated header">
    Gérer mes références
  </h1>
  <div>
    <a class="ui button pink" href="<?php echo site_url('jeune/nouvelleDemande') ?>">
      <i class="icon plus"></i>
      Demande de référence
    </a>
    <button class="ui button pink overView" name="createGrp">
      <i class="icon plus"></i>
      Créer une liste d'engagements
    </button>
    <button class="ui button pink selectionView" name="cancel">
      <i class="icon cancel"></i>
      Annuler
    </button>
    <button class="ui button pink selectionView" name="submit">
      <i class="icon check"></i>
      Valider
    </button>
  </div>
</div>

<div class="help title" title="Afficher l'aide"><i class="icon idea"></i> Références : Comment ça marche ?</div>
<div class="ui message info help hidden">
  <i class="icon close"></i>
  <p>
    Une référence représente une expérience qui a pu vous être bénéfique et que vous souhaitez mettre en avant. Vous pouvez pour cela créer une demande de référence qui sera envoyée à votre <strong>référent</strong> qui confirmera cette expérience en faisant resortir les savoir-être qu'il a pu voir en vous.
  </p>
  <ul>
    <li>Les références <strong>validées</strong> peuvent être rassemblées pour créer une <strong>liste d'engagements</strong> que vous pourrez envoyer par mail à un consultant ou imprimer</li>
    <li>Les références <strong>en cours de validation</strong> rassemblent vos demandes de référence qui ne sont pas encore validées</li>
    <li>Les références <strong>archivées</strong> sont des références que vous ne jugez plus nécessaires d'avoir et que vous avez voulu mettre de côté. Attention une fois qu'une référence est archivée, elle ne peut plus être utlisée.</li>
  </ul>
</div>
<!-- Menu onglet -->
<div class="ui top attached tabular menu">
  <a class="item active" data-tab="validee">
    <span>Validées</span>
    <label class="ui label green">
      <i class="icon checkmark"></i>
      <span><?php echo $nb_references[2] ?></span>
    </label>
  </a>
  <a class="item" data-tab="non-validee">
    <span>En cours de validation</span>
    <label class="ui label orange">
      <i class="icon exchange"></i>
      <span><?php echo $nb_references[1] ?></span>
    </label>
  </a>
  <a class="item" data-tab="archivee">
    <span>Archivées</span>
    <label class="ui label blue">
      <i class="icon archive"></i>
      <span><?php echo $nb_references[3] ?></span>
    </label>
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
            <div class="ui icon button">
              <i class="icon archive"></i>
              <span>Archiver</span>
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
                    foreach ($reference['savoir_etre']['jeune'] as $savoir_etre) {
                      ?>
                      <label class="ui label"><?php echo $savoir_etre ?></label>
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
                  <!-- Savoir être référent-->
                  <div class="four wide column header">
                    Savoir-être référent
                  </div>
                  <div class="twelve wide column">
                    <?php
                    foreach ($reference['savoir_etre']['referent'] as $savoir_etre) {
                      ?>
                      <label class="ui label"><?php echo $savoir_etre ?></label>
                      <?php
                    }
                    ?>
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
  <div class="ui middle aligned divided list selection reference">
    <!-- Début de l'affichage  des références en cours de validation -->
    <?php
      foreach ($references as $reference) {
      if($reference['etat'] == 1) {
        ?>
        <div class="item" data-value="<?php echo $reference['id']?>">
          <div class="right floated content overView">
            <div class="ui icon button">
              <i class="icon archive"></i>
              <span>Archiver</span>
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
                    foreach ($reference['savoir_etre']['jeune'] as $savoir_etre) {
                      ?>
                      <label class="ui label"><?php echo $savoir_etre ?></label>
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
                </div>
              </div>
              <!-- Fin détail de la référence -->

            </div>
          </div>
        </div>
        <?php
        }
      }
      if($nb_references[1] == 0){
        echo 'Pas encore de références ici.';
      }
    ?>
    <!-- Fin de l'affichage  des références en cours de validation-->
  </div>
</div>
<div class="ui bottom attached tab segment" data-tab="archivee">
  <div class="ui middle aligned divided list selection reference">
    <!-- Début de l'affichage  des références archivée -->
    <?php
      foreach ($references as $reference) {
      if($reference['etat'] == 3) {
        ?>
        <div class="item" data-value="<?php echo $reference['id']?>">
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
                    foreach ($reference['savoir_etre']['jeune'] as $savoir_etre) {
                      ?>
                      <label class="ui label"><?php echo $savoir_etre ?></label>
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
                  <?php
                    if(!empty($reference['commentaire'])) {
                      ?>
                      <div class="four wide column header">
                        Commentaire
                      </div>
                      <div class="twelve wide column">
                        <?php echo $reference['commentaire'] ?>
                      </div>
                      <?php
                    }
                  ?>
                </div>
              </div>
              <!-- Fin détail de la référence -->

            </div>
          </div>
        </div>
        <?php
        }
      }
      if($nb_references[3] == 0){
        echo 'Pas encore de références ici.';
      }
    ?>
    <!-- Fin de l'affichage  des références archivée-->
  </div>
</div>

<script>var reqUrl = '<?php echo site_url('/jeune/'); ?>' </script>
