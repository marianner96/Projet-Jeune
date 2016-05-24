<div class="ui container">
	<h1>Modifier ses informations personnelles</h1>

	<?php echo form_open('jeune/profil', array('class' => 'ui form')); ?>

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
		<div class="ui checkbox">
	      <input type="checkbox" value ="cmail" name="cmail">
	      <label>Changer l'adresse mail</label>
	    </div>
	</div>

	<div class="field">
		<label>Mot de passe</label>
		<input type="password" name="mdp" value="">
		<div class="ui checkbox">
	      <input type="checkbox" value ="cmdp" name="cmdp">
	      <label>Changer le mot de passe</label>
	    </div>
	</div>
	

	<input class="ui button pink" type="submit" value="Valider">
	</form>
</div>