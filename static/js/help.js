/**
 * Created by zorg on 10/06/16.
 */

$('.help.title')
  .click(function(){
    $(this)
      .next('.help.message')
      .transition('fade down');
  });