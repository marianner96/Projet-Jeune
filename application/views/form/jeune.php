<div class="separateur"></div>
<div class="ui container">

	<?php echo form_open('connexion/inscription', array('class' => 'ui error form')); ?>


	<h3>Inscrivez-vous ! (C'est sympa ici)</h3>


	<div class="field">
		<label>Nom </label>
		<input type="text" name="nom" value="<?php echo set_value('nom'); ?>">
		
	</div>
	<?php echo form_error('nom',"<div class='ui error message'>","</div>") ?>



	<div class="field">
		<label>Prénom </label>
		<input type="text" name="prenom" value="<?php echo set_value('prenom'); ?>">
	</div>
	<?php echo form_error('prenom','<div class="ui error message">',"</div>")?>


	<div class="field">
		<label>Date de naissance </label>
		<div class="three fields">
			<div class="field">
				<label>Jour</label>
				<input type="number" name="jour" value="<?php echo set_value('jour'); ?>">
			</div>
			<div class="field">
				<label>Mois</label>
				<select name="mois" class="ui dropdown search selection">
					<option value="1" <?php echo set_select('mois', 1)?>>Janvier</option>
					<option value="2" <?php echo set_select('mois', 2)?>>Février</option>
					<option value="3" <?php echo set_select('mois', 3)?>>Mars</option>
					<option value="4" <?php echo set_select('mois', 4)?>>Avril</option>
					<option value="5" <?php echo set_select('mois', 5)?>>Mai</option>
					<option value="6" <?php echo set_select('mois', 6)?>>Juin</option>
					<option value="7" <?php echo set_select('mois', 7)?>>Juillet</option>
					<option value="8" <?php echo set_select('mois', 8)?>>Août</option>
					<option value="9" <?php echo set_select('mois', 9)?>>Septembre</option>
					<option value="10" <?php echo set_select('mois', 10)?>>Octobre</option>
					<option value="11" <?php echo set_select('mois', 11)?>>Novembre</option>
					<option value="12" <?php echo set_select('mois', 12)?>>Decembre</option>
		        </select>
			</div>
			<div class="field">
				<label>Année</label>
				<input type="number" name="annee" value="<?php echo set_value('annee'); ?>">
			</div>
		</div>
	</div>
	<?php 
          if ((form_error('jour') != "") || (form_error('mois') != "") || (form_error('annee') != "")) 
	  {
            echo "<div class='ui error message'>";
            echo form_error('jour');
            echo form_error('mois');
            echo form_error('annee') ;
            echo "</div>";
          } 
        ?>


	<div class="field">
		<label>E-mail </label>
		<input type="text" name="mail" value="<?php echo set_value('mail'); ?>">
	</div>
	<?php echo form_error('mail','<div class="ui error message">', "</div>"); ?>


	<div class="field">
		<label>Mot de passe</label>
		<input type="password" name="mdp" value="">
	</div>
	<?php echo form_error('mdp', '<div class="ui error message">',"</div>"); ?>

	
	<div class="field">
		<label>Confirmation du mot de passe</label>
		<input type="password" name="verifmdp" value="">
	</div>
	<?php echo form_error('verifmdp', '<div class="ui error message">', "</div>"); ?>


	<input class="ui button pink" type="submit" value="Valider">
	

	</form>
</div>
<script>
$('.ui.dropdown')
  .dropdown();
</script>
