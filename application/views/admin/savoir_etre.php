<div class="customClearing" id="savoirEtreHeader">
  <h1 class="ui left floated header">
    Gestion des savoir-être
  </h1>
  <button class="ui right floated button blue listeSavoirEtre">
    <i class="icon plus"></i>
    Créer un savoir-être
  </button>
  <button class="ui right floated button blue creationSavoirEtre">
    <i class="icon left arrow"></i>
    Liste des savoir-être
  </button>
</div>
<div class="ui error message hidden">
  <i class="close icon"></i>
  <ul class="list">
  </ul>
</div>
<div class="ui grid stackable two column divided listeSavoirEtre">
  <?php
    foreach($savoir_etre  as $name => $value){
  ?>
    <div class="column">
      <h2 class="ui header"><?php echo $name ?></h2>
      <table class="ui very basic table">
        <?php
          foreach ($value as $item) {
        ?>
          <tr>
            <td class="twelve wide"><?php echo $item->nom ?></td>
            <td class="two wide">
              <button class="ui button mini icon tooltip deleteSavoirEtre"
                      data-content="Le savoir-être restera présent dans la base de données mais ne pourra plus être réactivé."
                      data-title="Supprimer le savoir être." data-position="left center"
                      data-value="<?php echo $item->id ?>"
              >
                <i class="icon delete"></i>
              </button>
            </td>
            <td class="two wide">
              <div class="ui toggle checkbox tooltip toggleSavoirEtre" data-content="Désactiver le savoir-être"
                   data-position="right center">
                <input <?php if ($item->etat == 1) {
                  echo 'checked="checked"';
                } ?> value="<?php echo $item->id ?>" class="hidden" tabindex="0" type="checkbox">
                <label></label>
              </div>
            </td>
          </tr>
        <?php
          }
        ?>
      </table>
    </div>
  <?php
    }
  ?>
</div>
<div class="creationSavoirEtre">
  <div class="ui form">
    <h3 class="ui dividing header">Créer un nouveau savoir-être</h3>
    <div class="ui inline field">
      <label for="nouveauSavoirEtre">Nom du savoir être : </label>
      <input type="text" id="nouveauSavoirEtre">
    </div>
    <div class="ui inline field">
      <label for="typeSavoirEtre">Savoir-être disponible pour le </label>
      <div class="ui radio checkbox">
        <input class="hidden" tabindex="0" name="typeSavoirEtre" checked="checked" type="radio" value="1">
        <label>Jeune</label>
      </div>
      <div class="ui radio checkbox">
        <input class="hidden" tabindex="0" name="typeSavoirEtre"  type="radio" value="2">
        <label>Référent</label>
      </div>
    </div>
    <div class="ui inline field">
      <button class="ui button blue">
        <i class="icon check"></i>
        Valider
      </button>
    </div>
  </div>
</div>
<script>
  //Initialisation de la gestion des tooltip
  $('.tooltip')
    .popup();

  //Initialisation de la gestion de la fermeture des messages
  $('.message .close')
    .on('click', function () {
      $(this)
        .closest('.message')
        .transition('fade down');
    });

  //Initialisation des radios
  $('.radio.checkbox')
    .checkbox();

  var reqUrl = '<?php echo site_url('/admin/savoir_etre/') ?>';
  var errEl = $('.ui.error.message ul');

  function displayError(rep, msg){
    var data;
    //Récupération de l'erreur
    try{
      data = JSON.parse(rep);
    } catch (e){
      data = {errors : ['Erreur : ' + msg]};
    }
    //On supprime les anciens messages d'erreur
    errEl.empty();
    //On met les nouveaux
    console.error(data);
    for(err in data.errors){
      $('<li></li>')
        .text(data.errors[err])
        .appendTo(errEl);
    }
    //Petite transition si le bloc n'est pas visible
    $('.error.message.hidden')
      .transition('fade down');
  }

  function toggleSavoirEtre(){
    var self = this;
    $.get(reqUrl+'/toggle/'+this.value, function (data) {
      $(self).prop('checked', !$(self).prop('checked'))
    })
      .fail(function (xhr, status, msg) {
        displayError(xhr.responseText, msg);
      });
    return false;
  }
  function deleteSavoirEtre(){
    var self = this;
    $.get(reqUrl+'/delete/'+this.dataset.value, function(){
      $(self).popup('destroy');
      $(self).closest('tr').transition({
        animation : 'fade down',
        onComplete : function(){
          $(self).closest('tr').remove();
        }
      });
    })
      .fail(function(xhr, status, msg){
        displayError(xhr.responseText, msg);
      });
  }

  function createSavoirEtre(){
    if ($(this).hasClass('loading'))
      return
    $(this).toggleClass('loading');

    var type = $('input:radio[name=typeSavoirEtre]:checked').val();
    var name = $('#nouveauSavoirEtre').val();

    $.get(reqUrl+'/create/'+type+'/'+name,function (data) {
      console.log(data);
      $('.listeSavoirEtre .column:nth-child('+type+') table').append(
        '<tr>'+
        ' <td class="twelve wide">'+name+'</td>'+
        '   <td class="two wide">'+
        '   <button class="ui button mini icon tooltip deleteSavoirEtre"'+
        '           data-content="Le savoir-être restera présent dans la base de données mais ne pourra plus être réactivé."'+
        '           data-title="Supprimer le savoir être." data-position="left center"'+
        '           data-value="'+data.id+'">' +
        '    <i class="icon delete"></i>' +
        '    </button>'+
        '  </td>'+
        '  <td class="two wide">'+
        '    <div class="ui toggle checkbox tooltip toggleSavoirEtre" data-content="Désactiver le savoir-être"'+
        '  data-position="right center">'+
        '    <input checked="checked" value="'+data.id+'" class="hidden" tabindex="0" type="checkbox">'+
        '    <label></label>'+
        '    </div>'+
        '  </td>'+
        '</tr>'
      );
      
      $('#nouveauSavoirEtre').val('');
      $(this).toggleClass('loading');
      toggleDisplay();
      initEvent();
    })
      .fail(function(xhr, status, msg){
        displayError(xhr.responseText, msg);
      });
  }

  function toggleDisplay() {
    $('.creationSavoirEtre, .listeSavoirEtre').toggle();
  }
  function initEvent() {
    $('.toggleSavoirEtre')
      .checkbox({
        beforeChecked: toggleSavoirEtre,
        beforeUnchecked: toggleSavoirEtre
      });

    $('.deleteSavoirEtre').click(deleteSavoirEtre);
  }

  initEvent();

  $('#savoirEtreHeader button').click(toggleDisplay);

  $('.creationSavoirEtre button').click(createSavoirEtre);
</script>
