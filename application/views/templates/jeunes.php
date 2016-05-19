<div class="ui container">
  <div class="ui grid stackable">
    <div class="four wide column">
      <div class="ui vertical menu fluid">
        <a class="item <?php echo !empty($content) && $content == 'profil' ? 'active' : '' ?>" href="<?php echo site_url('jeune') ?>">
          Mon profil
        </a>
        <a class="item <?php echo !empty($content) && $content == 'fomulaire' ? 'active' : '' ?>" href="<?php echo site_url('jeune/formulaire') ?>">
          Demande de référence
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

