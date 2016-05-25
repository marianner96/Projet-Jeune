<div class="ui container">
  <div class="ui grid stackable">
    <div class="four wide column">
      <div class="ui secondary vertical menu pink fluid">
         <a class="item <?php echo !empty($content) && $content == 'accueil' ? 'active' : '' ?>" href="<?php echo site_url('jeune') ?>">
          Accueil
        </a>
        <a class="item <?php echo !empty($content) && $content == 'profil' ? 'active' : '' ?>" href="<?php echo site_url('jeune/profil') ?>">
          Mon profil
        </a>
        <a class="item <?php echo !empty($content) && $content == 'reference' ? 'active' : '' ?>" href="<?php echo site_url('jeune/reference')?>">
          Référence
        </a>
        <a class="item <?php echo !empty($content) && $content == 'consultant' ? 'active' : '' ?>" href="<?php echo site_url('jeune/consultant') ?>">
          Consultant
        </a>
      </div>
    </div>
    <div class="twelve wide streched column">
      <?php $this->load->view('PartieJeune/'.$content) ?>
    </div>
  </div>
</div>