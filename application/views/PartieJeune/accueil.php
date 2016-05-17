<div class="ui inverted vertical menu">
  <a class="active item">
  	Présentation
  </a>
  <a class="item <?php echo !empty($menu) && $menu == 'accueil' ? 'active' : '' ?>" href="<?php echo site_url('jeune/formulaire') ?>">
  	Demande de référence
  </a>
  <a class="item">
    Mon profil
  </a>
  <a class="item">
    Consultant
  </a>
</div>
