<!-- Titre de la section -->
<div class="customClearing referencesHeader">
  <h1 class="ui left floated header">
    Gérer vos références
  </h1>
  <a class="ui right floated button pink" href="<?php echo site_url('jeune/formulaire') ?>">
    <i class="icon plus"></i>
    Demande de référence
  </a>
  <button class="ui right floated button pink">
    <i class="icon plus"></i>
    Créer un groupement
  </button>
</div>
<!-- Menu onglet-->
<div class="ui top attached tabular menu">
  <a class="item active" data-tab="validee">
    Validées
    <label class="ui label green">2</label>
  </a>
  <a class="item" data-tab="non-validee">
    En cours de validation
    <label class="ui label orange">4</label>
  </a>
  <a class="item" data-tab="archivee">
    Archivées
    <label class="ui label blue">12</label>
  </a>
</div>
<!-- Liste des références validées -->
<div class="ui bottom attached tab segment active" data-tab="validee">
  <div class="ui middle aligned divided list selection">
    <div class="item">
      <div class="right floated content">
        <div class="ui button">
          <i class="icon archive"></i>
          Archiver
        </div>
      </div>
      <i class="icon caret right icon large"></i>
      <div class="content">
        <div class="header">Quelque chose</div>
        <div class="description">
          Description
          <div class="long">
            Une description détaillée
          </div>
        </div>
      </div>
    </div>
    <div class="item">
      <div class="right floated content">
        <div class="ui button">
          <i class="icon archive"></i>
          Archiver
        </div>
      </div>
      <i class="icon caret right icon large"></i>
      <div class="content">
        <div class="header">Autre chose</div>
        <div class="description">
          Description
          <div class="long">
            Une description détaillée
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="ui bottom attached tab segment" data-tab="non-validee">
  Second
</div>
<div class="ui bottom attached tab segment" data-tab="archivee">
  Third
</div>

<script>
  $('.menu .item')
    .tab();
  $('.ui.checkbox')
    .checkbox()
  var selectGroup = false;
  $('div[data-tab=validee] .list.selection .item')
    .click(function (e) {
      if(selectGroup || e.target.classList.contains('button'))
        return;
      $(this)
        .find('.long')
        .toggle();
      $(this)
        .find('.icon.caret')
        .toggleClass('right')
        .toggleClass('down');
    });
</script>
