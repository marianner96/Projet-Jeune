<h1>Bienvenue sur le Projet Jeune</h1>
<div class="help title" title="Afficher l'aide"><i class="icon idea"></i> Comment ça marche ?</div>
<div class="ui message info help hidden">
  <i class="icon close"></i>
  <p>
    Cette page représente l'accueil de la partie <strong>Jeune</strong>, vous y trouverez les différentes activités de votre compte à savoir votre inscription, les créations de <strong>références</strong>, les créations de <strong>listes d'engagements</strong> ainsi que les validation de vos <strong>références</strong>.
  </p>
  <p>
    Pour avoir une aide détaillée de chacune des sections de la partie Jeune, veuillez vous rendre dans chacune des ces sections. Vous y trouverez une aide semblable à celle-ci.
  </p>
</div>
<div class="ui feed">
<?php
  $this->load->helper('date');
    foreach ($tableau as $value) {
?>
  <div class="event">
    <div class="content">
      <div class="ui pink segment">
        <div class="summary">
          <?php
            if ($value['type']=='1') {
              echo 'Vous vous êtes inscrit';
            } elseif ($value['type'] == '2') {
              echo 'Vous avez créé une nouvelle '. anchor('/jeune/reference#'.$value['options'], 'référence');
            } elseif($value['type'] == 3) {
              echo 'Votre '. anchor('/jeune/reference#'.$value['options'], 'référence').' a été validée';
            } elseif($value['type'] == 4) {
              echo 'Vous avez créé une ' . anchor('/jeune/listes-engagements#'.$value['options'], 'liste d\'engagement');
            }
          ?>
          <div class="date" data-position="top center" data-content="<?php 
          $endate = $value['date'];
          $frdate = date("d/m/Y H:i:s", strtotime($endate));
          echo ($frdate); ?>">
            <?php
              $datedepart = DateTime::createFromFormat('Y-m-d H:i:s', $value['date'], new DateTimeZone('Europe/Paris'));
              $diff = time()-$datedepart->getTimestamp();
              echo 'Il y a ' . timespan(1, $diff, 1);
            ?>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php
  }
  if(!count($tableau))
    echo 'Aucune activité.'
?>
</div>
<script>
  $('.date')
    .popup();
</script>
