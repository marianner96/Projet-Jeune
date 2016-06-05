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
                <h3>Profil du jeune</h3>
        <div class="ui list">
       <div class="item"> Nom : <?php echo $jeune[0]->nom?></div>
       <div class="item"> Prénom : <?php echo $jeune[0]->prenom?></div>
        <div class="item">Date de naissance : <?php echo $jeune[0]->date_naissance?></div>
       <div class="item"> Mail : <?php echo $jeune[0]->mail?></div>
      </div>
      </div>
    </div>
    <div class="column">
      <div></div>
    </div>
  </div>
  <div class="row">
<?php 
for ($i=0; $i <count($ref) ; $i++) {
  $j=$i+1; 
  echo "<div class=column>";
  echo "<div class=\"ui segment\">";
  echo "<div class=\"ui middle aligned divided list selection reference\">";
  //Début de l'affichage  des références validées
  echo "<div class=content>";
  echo "<div class=description>";
  echo "<h3>  Référence " . $j . "</h3>";
  echo "<div class=\"ui grid stackable\">";
  echo "<div class=\"four wide column header\">";
  echo "Description : ";
  echo "</div>";
  echo "<div class=\"twelve wide column\">";
  echo $ref[$i]->description;
  echo "</div>";
  //Détail de la référence
  //duree
  echo "<div class=\"four wide column header\">";
  echo "Durée :";
  echo "</div>";
  echo "<div class=\"twelve wide column\">";
  echo $ref[$i]->duree;
  echo "</div>";
  //savoir etre
  echo "<div class=\"four wide column header\">";
  echo "Savoir-être :";
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
  echo "Référent :";
  echo "</div>";
  echo "<div class=\"twelve wide column\">";
  echo $ref[$i]->nom . " " . $ref[$i]->prenom . " -" . mailto($ref[$i]->mail);
  echo "</div>";
  //Commentaire du référent
   echo "<div class=\"four wide column header\">";
  echo "Commentaire :";
  echo "</div>";
  echo "<div class=\"twelve wide column\">";
  echo $ref[$i]->commentaire;
  echo "</div>";
  echo "</div>";
  echo "</div>";
  echo "</div>";
  echo "</div>";
  echo "</div>";
  echo "</div>";
}

?>
  </div>
</div> 