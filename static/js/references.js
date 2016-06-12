/**
 * Created by zorg on 01/06/16.
 */
$('.menu .item')
  .tab();

var selectGroup = false;

/* Passe de la vue "selection" à la vue "overview" et inversement */

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
/* Créer un groupement de référence */
function creerGrp (){
  var tab = [];
  $('div[data-tab=validee] .list.selection .item.active')
    .each(function(i){
      tab[i] = $(this).data('value');
    });
  $.post(reqUrl+'/creer-groupement', {grp : tab}, function(data){
    $('.message.grp.hidden')
      .transition('fade down')
      .find('a')
      .attr('href', function () {
        console.log(data);
        return $(this).data('base-url')+'#'+data.lien;
      });
    toggleView();
  })
    .fail(function(xhr, status, msg){
      displayError(xhr.responseText, msg);
    });
}

/* Amène l'utilisateur à la référence indiquer dans le hash */
function goToRef(){
  var hash = window.location.hash;
  var id = hash.slice(1);
  if(!id)
    return;
  $('.item[data-value='+id+'] .long')
    .click();
  var tab = $('.item[data-value='+id+']')
    .addClass('flash')
    .parents('.tab')
    .data('tab');
  console.log(tab);
  $('.menu .item[data-tab='+tab+']').click();
  setTimeout(function(){
    $('.item[data-value='+id+']')
      .removeClass('flash');
  }, 1000);
}

function archiver(){
  var self = this;
  $('.ui.basic.modal')
    .modal({
      onApprove : archiverAction.bind(self)
    })
    .modal('show')
  ;
}

function archiverAction () {
  var ref = $(this).parents('.item');
  var refId = ref.data('value');
  $.post(reqUrl+'/archiver-reference', {id : refId}, function () {
    $('.message.archive')
      .find('span')
      .text(refId);
    $('.message.archive.hidden')
      .transition('fade down');
    var tab = ref.parents('.tab').data('tab');
    $('.item[data-tab='+tab+'] label span').get(0).textContent--;
    $('.item[data-tab="archivee"] label span').get(0).textContent++;
    if(!$('.tab[data-tab="archivee"] .list .item').length){
      $('.tab[data-tab="archivee"] .list').empty();
    }
    ref.appendTo('.tab[data-tab="archivee"] .list');
    ref.find('.right.floated.content').remove();
  })
    .fail(function(xhr, status, msg){
      displayError(xhr.responseText, msg);
    });
}

/* Gestion du clique sur une référence */
$('.list.selection .item')
  .click(function (e) {
    // Si on a cliqué sur le bouton d'archive ou le lien de contact on s'arrete
    if(selectGroup ||
      e.target.classList.contains('button') ||
      e.target.parentElement.classList.contains('button') ||
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

/* Gestion du clique sur les référence validée pour les mettre mode
 * "selectionné" quand on est en vue "selection"
 */

$('div[data-tab=validee] .list.selection .item')
  .click(function(){
    if(!selectGroup)
      return;
    $(this).toggleClass('active');
  });

$('.list.selection .item .button')
  .click(archiver);

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
  if(selectGroup)
    toggleView();
})

window.onhashchange = goToRef;
goToRef();
