var errEl = $('.ui.error.message ul');

//Initialisation de la gestion de la fermeture des messages
$('.message .close')
  .on('click', function () {
    $(this)
      .closest('.message')
      .transition('fade down');
  });
//Affiche une erreur en fonction du message reçu du serveur
function displayError(rep, msg){
  var data;
  //Récupération de l'erreur
  try{
    data = JSON.parse(rep);
  } catch (e){
    data = {errors : ['Erreur : ' + msg]};
  }
  //On supprime les anciens messages d'erreur
  errEl.empty();
  //On met les nouveaux
  console.error(data);
  for(err in data.errors){
    $('<li></li>')
      .text(data.errors[err])
      .appendTo(errEl);
  }
  //Petite transition si le bloc n'est pas visible
  $('.error.message.hidden')
    .transition('fade down');
}
