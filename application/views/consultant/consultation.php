   <a class="ui button" href="<?php echo site_url('consultant/presentation') ?>">
    En savoir plus
  </a>
  <div class="ui equal width grid">
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
  if (fmod($i,2)==0) {
    echo "<div class=row>";
  }
  echo "<div class=column>";
  /*echo "<div class=\"ui segment\">";*/
  /*echo "<div class=\"ui middle aligned divided list selection reference\">";
  //Début de l'affichage  des références validées
  echo "<div class=content>";
  echo "<div class=description>";*/
  
  /*echo "<div class=\"ui grid stackable\">";
  echo "<div class=\"four wide column header\">";
  echo "<h3 class=\"ui header tiny\">Description :</h3>";
  echo "</div>";
  echo "<div class=\"twelve wide column\">";
  echo $ref[$i]->description;
  echo "</div>";
  //Détail de la référence
  //duree
  echo "<div class=\"four wide column header\">";
echo "<h3 class=\"ui header tiny\">Durée :</h3>";
  echo "</div>";
  echo "<div class=\"twelve wide column\">";
  echo $ref[$i]->duree;
  echo "</div>";
  //savoir etre
  echo "<div class=\"four wide column header\">";
echo "<h3 class=\"ui header tiny\">Savoir-être :</h3>";
  echo "</div>";
  echo "<div class=\"twelve wide column\">";
  foreach ($savoirEtreNum[$i] as $value) {
    echo "<label class=\"ui label\">";
      echo $value->nom;
      echo "</label>";
  }
  echo "</div>";
  //Coordonnées référent
  echo "<div class=\"four wide column header\">";
echo "<h3 class=\"ui header tiny\">Référent :</h3>";
  echo "</div>";
  echo "<div class=\"twelve wide column\">";
  echo $ref[$i]->nom . " " . $ref[$i]->prenom . " -" . mailto($ref[$i]->mail);
  echo "</div>";
  //Commentaire du référent
   echo "<div class=\"four wide column header\">";
  echo "<h3 class=\"ui header tiny\">Commentaire:</h3>";
  echo "</div>";
  echo "<div class=\"twelve wide column\">";
  echo $ref[$i]->commentaire;
  echo "</div>";
  echo "</div>";
  echo "</div>";
  echo "</div>";
  echo "</div>";*/
  ?>

    <div class="ui segment">
      <?php 
      $j=$i+1;
  echo "<h3> <center>  Référence " . $j . "</center> </h3>";
  ?>
      <div class="ui grid">
      <div class="eight wide column">
    <h2 class="ui header small engagement pink"><hr><div>Jeune</div></h2>
    <div class="ui grid stackable">
        <div class="seven wide column">
        <h3 class="ui header tiny">Mes savoir-être</h3>
      </div>
      <div class="nine wide column">
        <ul>
        <?php 
foreach ($savoirEtreNum[$i] as $value) {
      echo "<li>". $value->nom ."</li>";
  }
        ?>
      </ul>
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
    <div class="ui grid stackable">
      <div class="seven wide column">
        <h3 class="ui header tiny">Ses savoir-être</h3>
      </div>
      <div class="nine wide column">
        <ul>
        <?php 
foreach ($savoirEtreNum[$i] as $value) {
      /*if ($savoirEtreNum[$i]->id){*/
      echo "<li>". $value->nom ."</li>";
    /*}*/
  }
        ?>
      </ul>
      </div>
      <div class="seven wide column">
        <h3 class="ui header tiny">Coordonnées</h3>
      </div>
      <div class="nine wide column">
        <?php echo $ref[$i]->nom . " " . $ref[$i]->prenom . " -" . mailto($ref[$i]->mail);?>
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

  <?php
  /*echo "</div>";*/
  echo "</div>";
  if (fmod($i,2)==1) {
    echo "</div>";
  }
  }
?>
</div> 