/**
 * Created by zorg on 06/06/16.
 */

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

$('.icon.star').click(updateRank);

$('.icon.remove.user').click(deleteUser);