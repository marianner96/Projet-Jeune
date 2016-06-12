/**
 * Created by zorg on 06/06/16.
 */

//Change le rang de l'utilisateur et le met à jour sur la vue du client
function updateRank (){
  var id = $(this)
    .parents('tr')
    .data('user-id');
  var self = this;
  $.post(reqUrl+'/toggle-admin',{ id_user : id}, function(){
    $(self)
      .toggleClass('empty')
      .transition({
        animation : 'jiggle',
        duration : '0.5s'
      });
  })
    .fail(function(xhr, status, msg){
      displayError(xhr.responseText, msg);
    });
}
//Supprime un utilisateur du site et l'enlève de la vue du client
function deleteUser() {
  var id = $(this)
    .parents('tr')
    .data('user-id');
  var row = $(this)
    .parents('tr');
  $.post(reqUrl+'/delete-user',{ id_user : id}, function() {
    row.remove();
  })
    .fail(function(xhr, status, msg){
      displayError(xhr.responseText, msg);
    });
}
//Initialisation des events
$('.icon.star').click(updateRank);

$('.icon.remove.user').click(deleteUser);