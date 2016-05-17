<div class="separateur"></div>
<div class="ui container">
  <div class="ui grid stackable two column middle aligned relative very relaxed">
    <?php echo form_open('connexion', array('class' => 'ui form column')); ?>


      <div class="field">
        <label for="user"> Utilisateur</label>
        <div class="ui left icon input">
          <input type="text" id="user" name="user" value="<?php echo set_value('user'); ?>">
          <i class="users icon"></i>
        </div>
        <? if (form_error('user') != "") {echo "<div class='alert alert-warning'>";echo form_error('user'); echo "</div>";} ?>
      </div>

      <div class="field">
        <label for="pass">Mot de passe</label>
        <div class="ui left icon input">
          <input type="password" id="pass" name="pass" value="<?php echo set_value('pass'); ?>"> 
          <i class="lock icon"></i>
        </div>
        <? if (form_error('user') != "") {echo "<div class='alert alert-warning'>";echo form_error('pass'); echo "</div>";} ?>
      </div>

      <input class="ui button" type="submit" value="Connexion">

    </form>
    <div class="ui vertical divider">ou</div>
    <div class="center aligned column">
      <a href="<?php echo site_url('connexion/inscription');?>" class="ui button large pink ">
        <i class="signup icon"></i>
        Créer un compte
      </a>
    </div>
  </div>
</div>
