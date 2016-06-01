<!doctype html>
<html>
  <head>
    <title><?php echo (empty($title) ? '' : $title.' -') ?> Jeunes 6.4</title>

    <link rel="icon" type="image/x-icon" href="<?php echo base_url() ?>static/img/favicon.ico" />

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>static/semantic/dist/semantic.min.css">
    <script src="<?php echo base_url() ?>static/semantic/dist/semantic.min.js"></script>
    
    <link rel="stylesheet" href="<?php echo base_url() ?>static/css/main.css">
  </head>
  <body>
  <header>
    <nav class="ui large secondary menu">
      <div class="ui container centered">
        <div class="item">
          <img class="ui image tiny" alt="Jeunes 6.4" src="<?php echo base_url()?>static/img/j64_logo1.svg">
        </div>
        <a class="item <?php echo !empty($menu) && $menu == 'accueil' ? 'active' : '' ?>" href="<?php echo site_url('accueil') ?>">
          <i class="icon home"></i>
          <span>Accueil</span>
        </a>
        <a class="item <?php echo !empty($menu) && $menu == 'partenaires' ? 'active' : '' ?>" href="<?php echo site_url('partenaires') ?>">
          <i class="icon users"></i>
          <span>Partenaires</span>
        </a>
        <a class="item pink <?php echo !empty($menu) && $menu == 'jeune' ? 'active' : '' ?>" href="<?php echo site_url('jeune') ?>">
          <i class="user icon"></i>
          <span>Jeunes</span>
        </a>
        <?php
          if(!empty($is_admin) && $is_admin){
        ?>
          <a class="item <?php echo !empty($menu) && $menu == 'admin' ? 'active' : '' ?>"
             href="<?php echo site_url('admin') ?>">
            <i class="settings icon"></i>
            <span>Administration</span>
          </a>
        <?php
          }
        ?>
        <?php
          if(!empty($is_logged) && $is_logged){
        ?>
          <div class="right menu">
            <a class="item" href="<?php echo site_url('deconnexion') ?>">
              <i class="sign out icon"></i>
              <span>Déconnexion</span>
            </a>
          </div>
        <?php
          }
        ?>
      </div>
    </nav>
  </header>
