/**
 * Created by zorg on 05/06/16.
 */

function toggleView(){
  $('.liste-engagement').toggle();
  $('.list.selection').toggle();
}

function showList(){
  toggleView();
  var key = window.location.hash.slice(1);
  if(key) {
    $.get(reqUrl + '/get-liste/' + key, function (data) {
      $('.liste-engagement.content').html(data);
    });
  }else{
    $('.liste-engagement.content').html("");
  }
}

window.onhashchange = showList;
window.location.hash && showList();