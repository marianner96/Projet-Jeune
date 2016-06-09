<div class="ui container">
  <div class="ui grid stackable">
    <div class="four wide column">
      <div class="ui secondary vertical menu pink fluid">
         <a class="item <?php echo !empty($content) && $content == 'accueil' ? 'active' : '' ?>" href="<?php echo site_url('jeune') ?>">
          Activité
        </a>
        <a class="item <?php echo !empty($content) && ($content == 'reference' || $content == 'formulaire') ? 'active' : '' ?>" href="<?php echo site_url('jeune/reference')?>">
          Références
        </a>
        <a class="item <?php echo !empty($content) && $content == 'listes' ? 'active' : '' ?>" href="<?php echo site_url('jeune/listes-engagements') ?>">
          Listes de mes engagements
        </a>
        <a class="item <?php echo !empty($content) && $content == 'profil' ? 'active' : '' ?>" href="<?php echo site_url('jeune/profil') ?>">
          Mon profil
        </a>
      </div>
    </div>
    <div class="twelve wide streched column">
      <?php $this->load->view('PartieJeune/'.$content) ?>
    </div>
  </div>
</div>
