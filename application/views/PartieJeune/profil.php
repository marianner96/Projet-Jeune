<div class="ui container">
	<h1>Modifier ses informations personnelles</h1>

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
		<input type="password" name="mdp" value="">
	</div>
	
	<div class="field">
		<label>Confirmer ce mot de passe</label>
		<input type="password" name="mdp" value="">
	</div>

	<input class="ui button pink" type="submit" value="Changer mot de passe" name="chmdp">
</div>
</div>

<script>
  $("input[name='chmail']").click(function () {
  	$.post(<?php echo "'".site_url("jeune/profil/chmail")."'"; ?>, {
  		mail : 'roger@gmail.com'
  	})
  });

</script>