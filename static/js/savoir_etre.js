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

var errEl = $('.ui.error.message ul');


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
  var self = this;

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
    $(self).toggleClass('loading');
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
