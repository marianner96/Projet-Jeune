<div class="ui container">
  <div class="ui grid stackable">
    <div class="four wide column">
      <div class="ui vertical pointing menu">
        <a class="item <?php echo $content == 'index' ? 'active' : ''?>" href="<?php echo site_url('admin') ?>">Vue d'ensemble</a>
        <a class="item <?php echo $content == 'savoir_etre' ? 'active' : ''?>" href="<?php echo site_url('admin/savoir-etre') ?>">Savoir-être</a>
        <a class="item <?php echo $content == 'users' ? 'active' : ''?>" href="<?php echo site_url('admin/utilisateurs') ?>">Membres</a>
      </div>
    </div>
    <div class="twelve wide column">
      <?php $this->load->view('admin/'.$content); ?>
    </div>
  </div>
</div>
