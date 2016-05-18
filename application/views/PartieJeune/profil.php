profil
          <div class="ui inverted vertical menu">
    <a class="active item <?php echo !empty($menu) && $menu == 'accueil' ? 'active' : '' ?>" href="<?php echo site_url('jeune') ?>">
    Mon profil
  </a>
  <a class="item <?php echo !empty($menu) && $menu == 'accueil' ? 'active' : '' ?>" href="<?php echo site_url('jeune/formulaire') ?>">
    Demande de référence
  </a>
  <a class="item <?php echo !empty($menu) && $menu == 'accueil' ? 'active' : '' ?>" href="<?php echo site_url('jeune/consultant') ?>">
    Consultant
  </a>
</div>