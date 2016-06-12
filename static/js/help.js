/**
 * Created by zorg on 10/06/16.
 */
/* Affiche l'aide quand on clique sur le titre (Comment ca marche ?) */
$('.help.title')
  .click(function(){
    $(this)
      .next('.help.message')
      .transition('fade down');
  });