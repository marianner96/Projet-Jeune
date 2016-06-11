<div class="ui container consultant">
    <h1 class="ui header">
      Consultant
      <h2 class="ui sub header blue">
        Validez cet engagement en prenant en compte sa valeur. -
        <a class="help title" href="<?php echo site_url('/accueil')?>"> En savoir plus <i class="icon idea"></i></a>
        <a class="pdfLink" href="<?php echo current_url() . '.pdf'?>"> Voir en PDF <i class="file pdf outline icon"></i></a>
      </h2>
    </h1>
  <div class="ui equal width grid stackable">
  <div class="row">
    <div class="column">
      <div></div>
    </div>
    <div class="column">
      <div class="ui segment center aligned">
        <h3 class="ui header engagement pink">Profil du jeune</h3>
        <div class="ui list">
          <div class="item"> Nom : <?php echo $jeune[0]->nom?></div>
          <div class="item"> Prénom : <?php echo $jeune[0]->prenom?></div>
          <div class="item">Date de naissance : <?php echo $jeune[0]->date_naissance?></div>
          <div class="item"> Mail : <?php echo mailto($jeune[0]->mail)?></div>
        </div>
      </div>
    </div>
    <div class="column">
      <div></div>
    </div>
  </div>

<?php 
  for ($i=0; $i <count($ref) ; $i++) {
    ?>
    <div class=row>
      <div class=column>
        <div class="ui segment">
          <?php
            $j=$i+1;
            echo "<h3> Référence " . $j . "</h3>";
          ?>
          <div class="ui grid stackable">
            <div class="eight wide column">
              <h2 class="ui header small engagement pink"><hr><div>Jeune</div></h2>
              <div class="ui grid">
                <div class="seven wide column">
                  <h3 class="ui header tiny">Mes savoir-être</h3>
                </div>
              <div class="nine wide column">
                Je suis
                <?php
                  $savoir_etre= $savoirEtre[$tabRefGroupement[$i]->id_ref];
                  $count = 0;
                  foreach ($savoir_etre["jeune"] as $key) {
                    if($count++)
                      echo ', ';
                    echo strtolower($key);
                  }
                  echo '.';
                ?>
              </div>
              <div class="seven wide column">
                <h3 class="ui header tiny">Description</h3>
              </div>
              <div class="nine wide column">
                <?php echo $ref[$i]->description; ?>
              </div>
              <div class="seven wide column">
                <h3 class="ui header tiny">Durée</h3>
              </div>
              <div class="nine wide column">
                <?php echo $ref[$i]->duree; ?>
              </div>
            </div>
          </div>
          <div class="eight wide column">
            <h2 class="ui header small engagement green"><hr><div>Référent</div></h2>
            <div class="ui grid">
              <div class="seven wide column">
                <h3 class="ui header tiny">Ses savoir-être</h3>
              </div>
              <div class="nine wide column">
                Je confirme qu'il/elle est
                <?php
                $savoir_etre= $savoirEtre[$tabRefGroupement[$i]->id_ref];

                $count = 0;
                foreach ($savoir_etre["referent"] as $key) {
                  if($count++)
                    echo ', ';
                  echo strtolower($key);
                }
                echo '.';
                ?>
              </div>
              <div class="seven wide column">
                <h3 class="ui header tiny">Coordonnées</h3>
              </div>
              <div class="nine wide column">
                <?php echo $ref[$i]->nom . " " . $ref[$i]->prenom . " - " . mailto($ref[$i]->mail);?>
              </div>
              <div class="seven wide column">
                <h3 class="ui header tiny">Commentaire</h3>
              </div>
              <div class="nine wide column">
                <?php echo $ref[$i]->commentaire; ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php
  }
?>
</div> 
</div>
