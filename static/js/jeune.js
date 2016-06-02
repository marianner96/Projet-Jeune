/**
 * Created by zorg on 01/06/16.
 */
$('.menu .item')
  .tab();

var selectGroup = false;

function toggleView(){
  $('.selectionView').toggle();
  $('.overView').toggle();
  selectGroup = !selectGroup;
  if(!$('div[data-tab=validee] .reference .item').length)
    return;
  $('div[data-tab=validee] .reference .item')
    .toggleClass('active', false)
    .toggleClass('state-selection', selectGroup);
}

function creerGrp (){
  var tab = [];
  $('div[data-tab=validee] .list.selection .item.active')
    .each(function(i){
      tab[i] = $(this).data('value');
    });
  $.post(reqUrl+'/creer-groupement', {grp : tab}, function(data){
    $('.message.grp').toggle();
    toggleView();
  })
    .fail(function(xhr, status, msg){
      displayError(xhr.responseText, msg);
    });
}

$('.list.selection .item')
  .click(function (e) {
    // Si on a cliqué sur le bouton d'archive ou le lien de contact on s'arrete
    if(selectGroup ||
      e.target.classList.contains('button') ||
      e.target.classList.contains('archive') ||
      e.target.tagName == 'A'
    )
      return;
    //Sinon on affiche les détails de la référence
    $(this)
      .find('.long')
      .toggle();
    $(this)
      .find('.icon.caret')
      .toggleClass('right')
      .toggleClass('down');
  });

$('div[data-tab=validee] .list.selection .item')
  .click(function(){
    if(!selectGroup)
      return;
    $(this).toggleClass('active');
  });

/*
 * On rentre dans la séléction quand on clique sur "Créer un groupement"
 * On en sort en cliquant sur annuler
 * Quand on entre dans la vue de séléction l'onglet des références validées
 * est automatiquement séléctionné
 */
$('button[name=createGrp], button[name=cancel]')
  .click(function(){
    if(!selectGroup){
      $('.top.menu .item:first-child')
        .click();
    }
    toggleView();
  });

$('button[name=submit]')
  .click(creerGrp);
//On sort de la séléction quand on change d'onglet
$('.top.menu .item[data-tab!=validee]').click(function(){
  console.log('lol');
  if(selectGroup)
    toggleView();
})

function goToRef(){
  var hash = window.location.hash;
  var id = hash.slice(1);
  if(!id)
    return;
  $('.item[data-value='+id+']')
    .find('.long')
    .click();
  var tab = $('.item[data-value='+id+']')
    .parents('.tab')
    .data('tab');
  console.log(tab);
  $('.menu .item[data-tab='+tab+']').click();
}
window.onhashchange = goToRef;
goToRef();
