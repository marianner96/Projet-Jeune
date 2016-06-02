<div class="ui container">
	<h1>Mes informations personnelles</h1>

	<div class="ui message error hidden">
		<i class="icon close"></i>
		<ul class="list"></ul>
	</div>

	<div class="ui message success hidden">
		<i class="icon close"></i>
		<p></p>
	</div>

	<div class="ui segments">
		<h5 class="ui top attached header">
		  Nom
		</h5>
		<div class="ui attached segment">
		  <p><?php echo($tab['nom']);?></p>
		</div>
	</div>

	<div class="ui segments">
		<h5 class="ui attached header">
		  Prénom
		</h5>
		<div class="ui attached segment">
		  <p><?php echo($tab['prenom']); ?></p>
		</div>
	</div>

	<div class="ui segments">
		<h5 class="ui attached header">
		  Date de naissance
		</h5>
		<div class="ui attached segment">
		  <p><?php echo($tab['date_naissance']); ?></p>
		</div>
	</div>

	<div class='ui form'>
		<div class="field">
			<label>E-mail </label>
			<input type="text" name="mail" value="<?php echo($tab['mail']); ?>">
		</div>
		<input class="ui button pink" type="submit" value="Changer l'e-mail" name="chmail">

		<div class="field">
			<label>Mot de passe</label>
			<input type="password" name="mdp" value="">
		</div>

		<div class="field">
			<label>Nouveau mot de passe</label>
			<input type="password" name="nvmdp" value="">
		</div>
		
		<div class="field">
			<label>Confirmer ce mot de passe</label>
			<input type="password" name="comdp" value="">
		</div>
		<input class="ui button pink" type="submit" value="Changer le mot de passe" name="chmdp">

	</div>
</div>

<script src="<?php echo base_url()?>static/js/utils.js"></script>

<script>
  $("input[name='chmail']").click(function () { //on clique sur le bouton de modification de mail
  	$.post(<?php echo "'".site_url("jeune/profil/chmail")."'"; ?>, { //on appelle le contrôleur de modifiaction de mail
  		mail : $("input[name='mail']").val()
  	}, function() {
  		$('.message.success p').text("Vos changements ont bien été modifiés !"); //message mis si les changements ont été effectué
  		$('.message.success').transition('fade down');
  	}).fail(function(xhr, status, messagehttp){
  		displayError(xhr.responseText, messagehttp); // si il y a eu un problème ça s'affiche
  	})
  });

  $("input[name='chmdp']").click(function() {
  	$.post(<?php echo "'".site_url("jeune/profil/chmdp")."'";?>, {
  		mdp : $("input[name='mdp']").val(),
  		nvmdp : $("input[name='nvmdp']").val(),
  		comdp : $("input[name='comdp']").val()
  	}, function() {
  		$('.message.success p').text("Vos changements ont bien été modifiés !");
  		$('.message.success').transition('fade down');
  	}).fail(function(xhr, status, messagehttp){
  		displayError(xhr.responseText, messagehttp);
  	})
  });

</script>