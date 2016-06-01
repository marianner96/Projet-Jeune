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

	<div class='ui form'>
		<div class="disabled field">
			<label>Nom</label>
			<input type="text" name="nom" value="<?php echo($tab['nom']); ?>">
		</div>

		<div class="disabled field">
			<label>Prénom </label>
			<input type="text" name="prenom" value="<?php echo($tab['prenom']); ?>">
		</div>

		<div class="disabled field">
			<label>Date de naissance</label>
			<input type="text" name="date_naissance" value="<?php echo($tab['date_naissance']); ?>">
		</div>

		<div class="field">
			<label>E-mail </label>
			<input type="text" name="mail" value="<?php echo($tab['mail']); ?>">
		</div>
		<input class="ui button pink" type="submit" value="Changer email" name="chmail">

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
		<input class="ui button pink" type="submit" value="Changer mot de passe" name="chmdp">

	</div>
</div>

<script src="<?php echo base_url()?>static/js/utils.js"></script>

<script>
  $("input[name='chmail']").click(function () {
  	$.post(<?php echo "'".site_url("jeune/profil/chmail")."'"; ?>, {
  		mail : $("input[name='mail']").val()
  	}, function() {
  		$('.message.success p').text("Vos changements ont bien été modifiés !");
  		$('.message.success').transition('fade down');
  	}).fail(function(xhr, status, messagehttp){
  		displayError(xhr.responseText, messagehttp);
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