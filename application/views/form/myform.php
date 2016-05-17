

<?php echo form_open('connexion'); ?>


<h3>Vous avez déjà un compte jeune ? Connectez-vous !</h3>
<h3>Sinon rendez-vous sur cette <a href="<?php echo site_url('connexion/inscription') ?>">page</a>!</h3>

<div class="form-group">
	<label> Utilisateur :
	<input type="txt" name="user" value="<?php echo set_value('user'); ?>">
	</label>
	<? if (form_error('user') != "") {echo "<div class='alert alert-warning'>";echo form_error('user'); echo "</div>";} ?>
</div>

<div class="form-group">
	<label>Mot de passe :
	<input type="password" name="pass" value="<?php echo set_value('pass'); ?>"> 
	</label>
	<? if (form_error('user') != "") {echo "<div class='alert alert-warning'>";echo form_error('pass'); echo "</div>";} ?>
</div>

<div class="form-group">
	<input type="submit" name="ok" value="Connexion">
</div>

</form>