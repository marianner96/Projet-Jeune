/**
 * Created by zorg on 05/06/16.
 */

//Initialisation de la gestion des tooltip
$('.tooltip')
  .popup();

var detail = false;
/* Change de vue entre la vue en détail d'une liste et l'overview des listes de
 * reférences
 */
function toggleView(){
  $('.liste-engagement').toggleClass('hidden');
  $('.list').toggle();
}
/* Affiche une liste de référence en detail en récupérant la vue partielle en
 * ajax
 */

function showList(){
  var key = window.location.hash.slice(1);
  if(key) {
    if(!detail) {
      toggleView();
    }
    $.get(reqUrl + '/get-liste/' + key, function (data) {
        $('.liste-engagement.content').html(data);
      })
      .fail(function () {
        $('.liste-engagement.content')
          .html('<div class="ui message error">Une erreur est survenue, êtes-vous sur que cette liste d\'engagements existe?</div>')
      });
    
    $('a.pdf')
      .attr('href', consUrl + '/' + key + '.pdf');

    detail = true;
    return;
  }
  $('.liste-engagement.content')
    .html('Chargement...');
  detail=false;
  toggleView();
}

 /*Envoie la requête pour envoyer l'email au consultant
  */
function sendEmail(e){
  e.preventDefault();
  var cle = window.location.hash.slice(1);
  var email = $('form.send input[type=email]').val();
  if(!email.length){
    return
  }
  $.post(reqUrl+'/send-list/'+cle, {email : email}, function(){ 
    $('.message.success span').text(email);
    $('.message.success.hidden').transition('fade down');
  })
    .fail(function (xhr, status, msg) {
      displayError(xhr.responseText, msg);
    });
}
/*Initialisation des events
 */
window.onhashchange = showList;
window.location.hash && showList();
$('form.send').submit(sendEmail);
