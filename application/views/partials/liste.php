<?php
foreach ($grps as $grp) {
  ?>
  <div class="ui segment">
    <h2 class="ui header small engagement pink"><hr><div>Jeune</div></h2>
    <div class="ui grid stackable">
      <div class="four wide column">
        <h3 class="ui header tiny">Description de l'engagement</h3>
      </div>
      <div class="twelve wide column">
        <?php echo $grp['description'] ?>
      </div>
      <div class="four wide column">
        <h3 class="ui header tiny">Durée</h3>
      </div>
      <div class="twelve wide column">
        <?php echo $grp['duree'] ?>
      </div>
      <div class="four wide column">
        <h3 class="ui header tiny">Mes savoir-être</h3>
      </div>
      <div class="twelve wide column">
        Je suis
        <?php
        $count = 0;
        foreach ($grp['savoir_etre']['jeune'] as $savoir_etre) {
          if($count++)
            echo ', ';
          echo strtolower($savoir_etre);
        }
        echo '.';
        ?>
      </div>
    </div>
    <h2 class="ui header small engagement green"><hr><div>Référent</div></h2>
    <div class="ui grid stackable">
      <div class="four wide column">
        <h3 class="ui header tiny">Coordonnées</h3>
      </div>
      <div class="twelve wide column">
        <?php echo $grp['prenom'] . ' ' . $grp['nom'] . ' - ' . mailto($grp['mail'])?>
      </div>
      <div class="four wide column">
        <h3 class="ui header tiny">Ses savoir-être</h3>
      </div>
      <div class="twelve wide column">
        Je confirme qu'il/elle est
        <?php
        $count = 0;
        foreach ($grp['savoir_etre']['referent'] as $savoir_etre) {
          if($count++)
            echo ', ';
          echo strtolower($savoir_etre);
        }
        echo '.';
        ?>
      </div>
      <?php
        if(!empty($grp['commentaire'])){
          ?>
          <div class="four wide column">
            <h3 class="ui header tiny">Commentaire</h3>
          </div>
          <div class="twelve wide column">
            <?php echo $grp['commentaire'] ?>
          </div>
          <?php
        }
      ?>
    </div>
  </div>
  <?php
  }
?>