<h1>Bienvenue sur le Projet Jeune</h1>
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
            } elseif($value['type'] == 2) {
              echo 'Votre référence a été validée';
            } elseif($value['type'] == 4) {
              echo 'Vous avez créé un ' . anchor('/jeune/listes-references/'.$value['options'], 'groupement');
            }
          ?>
          <div class="date" data-position="top center" data-content="<?php echo $value['date']; ?>">
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
?>
</div>
<script>
  $('.date')
    .popup();
</script>
