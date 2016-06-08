/**
 * Created by zorg on 05/06/16.
 */
var detail = false;
function toggleView(){
  $('.liste-engagement').toggleClass('hidden');
  $('.list.selection').toggle();
}

function showList(){
  var key = window.location.hash.slice(1);
  if(key) {
    if(!detail)
      toggleView();
    $
      .get(reqUrl + '/get-liste/' + key, function (data) {
        $('.liste-engagement.content').html(data);
      })
      .fail(function () {
        $('.liste-engagement.content')
          .html('<div class="ui message error">Une erreur est survenue, êtes-vous sur que cette liste d\'engagements existe?</div>')
      });

    detail = true;
    return;
  }
  $('.liste-engagement.content')
    .html('Chargement...');
  detail=false;
  toggleView();
}

function sendEmail(e){
  e.preventDefault();
  var cle = window.location.hash.slice(1);
  var email = $('form.send input[type=email]').val();
  if(!email.length){
 //   return
  }
  $.post(reqUrl+'/send-list/'+cle, {email : email}, function(){ 
    $('.message.success span').text(email);
    $('.message.success.hidden').transition('fade down');
  })
    .fail(function (xhr, status, msg) {
      displayError(xhr.responseText, msg);
    });
}

window.onhashchange = showList;
window.location.hash && showList();
$('form.send').submit(sendEmail);
