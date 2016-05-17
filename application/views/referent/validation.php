<div class="centerBlock">
	<p>
	Confirmez cette expérience que vous avez pu constater au contact de ce jeune.
	</p>
</div>





<div class="rightSavoirEtre"> 
	<?php echo form_open('validationExperience'); ?>

	<div class="leftCommentaire">
		<div class="field">
    	<label>Commentaires</label>
    	<textarea></textarea>
  		</div>
	</div>


	<h3>Ses savoirs être *</h3>

	<div class="ui checkbox">
      <input class="hidden" tabindex="0" type="checkbox">
      <label>Confiance</label>
    </div><br>
    
    <div class="ui checkbox">
      <input class="hidden" tabindex="0" type="checkbox">
      <label>Bienveillance</label>
    </div><br>

	<div class="ui checkbox">
      <input class="hidden" tabindex="0" type="checkbox">
      <label>Respect</label>
    </div><br>

    <div class="ui checkbox">
      <input class="hidden" tabindex="0" type="checkbox">
      <label>Honnêteté</label>
    </div><br>

	<div class="ui checkbox">
      <input class="hidden" tabindex="0" type="checkbox">
      <label>Tolérance</label>
    </div><br>

    <div class="ui checkbox">
      <input class="hidden" tabindex="0" type="checkbox">
      <label>Juste</label>
    </div><br>

    <div class="ui checkbox">
      <input class="hidden" tabindex="0" type="checkbox">
      <label>Impartial</label>
    </div><br>

    <div class="ui checkbox">
      <input class="hidden" tabindex="0" type="checkbox">
      <label>Travail</label>
    </div><br>

    <div>
    	* Faire 4 choix maximum
    </div>

    <input class="ui submit button" type="submit" value="Valider" name="valider">

	</form>

</div>

<script> // Active checkbox
$('.ui.checkbox')
  	.checkbox()
;
</script>