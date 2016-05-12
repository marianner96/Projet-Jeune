<?php echo validation_errors(); ?>

<?php echo form_open('form'); ?>


<h3>Vous avez déjà un compte jeune ? Connectez-vous !</h3>
<h3>Sinon rendez-vous sur cette <a href="inscription">page</a>!</h3>

<div class="form-group">
	<label> Utilisateur :
	<input type="txt" name="user" value="">
	</label>
</div>

<div class="form-group">
	<label>Mot de passe :
	<input type="password" name="pass" value="">
	</label>
</div>

</form>