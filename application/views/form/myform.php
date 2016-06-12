<!--Connexion-->

<div class="separateur"></div>
<div class="ui container">
  <div class="ui grid stackable two column middle aligned relative very relaxed">
    <div class="column">
      <a href="<?php echo site_url('twitter/auth')?>" class="ui twitter button fluid">
        <i class="icon twitter"></i>
        Connexion avec Twitter
      </a>
    </div>
    <div class="ui vertical divider">ou</div>
    <div class="column">
      <?php echo form_open('connexion', array('class' => 'ui form column error')); ?>
        <div class="field">
          <label for="email">Email</label>
          <div class="ui left icon input">
            <input tabindex="1" type="email" id="email" name="mail" value="<?php echo set_value('mail'); ?>">
            <i class="at icon"></i>
          </div>
          <?php if (form_error('email') != "") {echo "<div class=\"ui error message\">";echo form_error('email'); echo "</div>";} ?>
        </div>

        <div class="field">
          <label for="mdp">Mot de passe</label>
          <div class="ui left icon input">
            <input tabindex="2" type="password" id="mdp" name="mdp" value="">
            <i class="lock icon"></i>
          </div>
          <?php if (form_error('mdp') != "") {echo "<div class=\"ui error message\">";echo form_error('mdp'); echo "</div>";} ?>
        </div>

        <input tabindex="3" class="ui button pink" type="submit" value="Se connecter">
        <a tabindex="4" href="<?php echo site_url('connexion/inscription');?>" class="ui button">
            <i class="signup icon"></i>
            Créer un compte
        </a>
      </form>
    </div>
  </div>
</div>
