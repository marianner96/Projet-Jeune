

<?php echo form_open('inscription'); ?>


<h3>Inscrivez-vous !(C'est sympa ici)</h3>

<div class="form-group">
	<label>Nom : <input type="text" name="nom" value="<?php echo set_value('nom'); ?>"></label>
	<? if (form_error('nom') != "") {echo "<div class='alert alert-warning'>";echo form_error('nom'); echo "</div>";} ?>
</div>

<div class="form-group">
	<label>Prénom : <input type="text" name="prenom" value="<?php echo set_value('prenom'); ?>"></label>
	<? if (form_error('prenom') != "") {echo "<div class='alert alert-warning'>";echo form_error('prenom'); echo "</div>";} ?>
</div>

<div class="form-group">
	<label>Date de naissance : <input type="date" max="2016-07-05" name="naissance"></label>
	<? if (form_error('naissance') != "") {echo "<div class='alert alert-warning'>";echo form_error('naissance'); echo "</div>";} ?>
</div>

<div class="form-group">
	<label>E-mail : <input type="text" name="mail" value="<?php echo set_value('username'); ?>"></label>
	<? if (form_error('mail') != "") {echo "<div class='alert alert-warning'>";echo form_error('mail'); echo "</div>";} ?>
</div>

<div class="form-group">
	<input type="submit" value="Valider" name="valider">
</div>

</form>