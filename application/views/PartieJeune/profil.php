
<div class="ui container">
	<h1>Mes informations personnelles</h1>
  <div class="help title" title="Afficher l'aide"><i class="icon idea"></i> Profil : Comment ça marche ?</div>
  <div class="ui message info help hidden">
    <i class="icon close"></i>
    <p>
      Vous trouverez ici les informations concernant votre identité ainsi que vos informations de connexion.
    </p>
  </div>
	<div class="ui message error hidden">
		<i class="icon close"></i>
		<ul class="list"></ul>
	</div>

	<div class="ui message success hidden">
		<i class="icon close"></i>
		<p></p>
	</div>
        <div class="ui grid stackable">
          <div class="eight wide column">
            <div class="ui segments">
                    <h5 class="ui top attached header">
                      Prenom Nom
                    </h5>
                    <div class="ui attached segment">
                      <p><?php echo $tab['prenom'] . ' ' .$tab['nom'] ;?></p>
                    </div>
            </div>
          </div>
          <div class="eight wide column">
            <div class="ui segments">
                    <h5 class="ui attached header">
                      Date de naissance
                    </h5>
                    <div class="ui attached segment">
                      <p><?php 
                      $endate = $tab['date_naissance'];
                      $frdate = date("d/m/Y", strtotime($endate));
                      echo($frdate); ?></p>
                    </div>
            </div>
          </div>
        </div>

	<form class='ui form' id="chmail">
		<div class="field">
			<label for="mail">E-mail </label>
			<input id="mail" type="email" name="mail" value="<?php echo($tab['mail']); ?>">
		</div>
		<input class="ui button pink" type="submit" value="Changer l'e-mail" name="chmail">
	</form>

	<form class='ui form' id="chmdp">
		<div class="field">
			<label for="mdp">Mot de passe</label>
			<input type="password" id="mdp" name="mdp" value="">
		</div>

		<div class="field">
			<label for="nvmpd">Nouveau mot de passe</label>
			<input type="password" id="nvmpd" name="nvmdp" value="">
		</div>
		
		<div class="field">
			<label for="compd">Confirmer ce mot de passe</label>
			<input type="password" id="compd" name="comdp" value="">
		</div>
		<input class="ui button pink" type="submit" value="Changer le mot de passe" name="chmdp">
	</form>
</div>

<script src="<?php echo base_url()?>static/js/utils.js"></script>
<script src="<?php echo base_url()?>static/js/help.js"></script>

<script>
	//TODO Gérer le submit avec un event de type submit plutot que click.
  $("#chmail").submit(function(event) {
  	event.preventDefault(); //on clique sur le bouton de modification de mail
  	$.post(<?php echo "'".site_url("jeune/profil/chmail")."'"; ?>, { //on appelle le contrôleur de modification de mail
  		mail : $("input[name='mail']").val()
  	}, function() {
  		$('.message.success p').text("Vos changements ont bien été modifiés !"); //message mis si les changements ont été effectué
  		$('.message.success').transition('fade down');
  	}).fail(function(xhr, status, messagehttp){
  		displayError(xhr.responseText, messagehttp); // si il y a eu un problème ça s'affiche
  	})
  });

  $("#chmdp").submit(function(event) {
  	event.preventDefault();
  	$.post(<?php echo "'".site_url("jeune/profil/chmdp")."'";?>, {
  		mdp : $("input[name='mdp']").val(),	
  		nvmdp : $("input[name='nvmdp']").val(),
  		comdp : $("input[name='comdp']").val()
  	}, function() {
  		$('.message.success p').text("Vos changements ont bien été modifiés !");
  		$('.message.error.visible').transition({duration:0});
  		$('.message.success.hidden').transition('fade down');
  	}).fail(function(xhr, status, messagehttp){
  		$('.message.success.visible').transition({duration:0});
  		displayError(xhr.responseText, messagehttp);
  	});
  	$('#chmdp input:password').val('');
  });

</script>
