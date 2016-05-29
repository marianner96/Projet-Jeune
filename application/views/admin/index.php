<h1 class="ui header">
  Partie administration
</h1>
<div class="ui three statistics">
  <div class="statistic">
    <div class="value">
      <?php echo $users_count; ?>
    </div>
    <div class="label">
      Jeunes
    </div>
  </div>
  <div class="statistic">
    <div class="value">
      <?php echo array_sum($refs_count) ; ?>
    </div>
    <div class="label">
      Références <br> crées
    </div>
  </div>
  <div class="statistic">
    <div class="value">
      <?php echo $refs_count[2]; ?>
    </div>
    <div class="label">
      Références <br> validées
    </div>
  </div>
</div>
