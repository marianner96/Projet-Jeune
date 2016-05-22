<div class="ui top attached tabular menu"> 
  <a class="item active" data-tab="first">En cour</a>
  <a class="item" data-tab="second">Archivé</a>
</div>
<div class="ui bottom attached tab segment active" data-tab="first">
  First
</div>
<div class="ui bottom attached tab segment" data-tab="second">
  Second
</div>
  <script>
  $('.menu .item')
  .tab()
;
  </script>
<a href="<?php echo site_url('jeune/formulaire')?>"><button class="ui button">
Demande de référence
</button>
</a>