<div class="separateur"></div>
<div class="ui container">
  <div class="ui grid stackable two column middle aligned relative very relaxed">
    <div class="column">
      <div class="ui grid">
        <div class="eight wide column">
          <a href="#" class="ui twitter button fluid">
            <i class="icon twitter"></i>
            Connexion avec Twitter
          </a>
        </div>
        <div class="eight wide column">
          <a href="#" class="ui google plus button fluid">
            <i class="icon google"></i>
            Connexion avec Google
          </a>
        </div>
      </div>
    </div>
    <div class="ui vertical divider">ou</div>
    <div class="column">
      <?php echo form_open('connexion', array('class' => 'ui form column')); ?>
        <div class="field">
          <label for="email">Email</label>
          <div class="ui left icon input">
            <input type="email" id="email" name="email" value="<?php echo set_value('user'); ?>">
            <i class="at icon"></i>
          </div>
          <?php if (form_error('email') != "") {echo "<div class='alert alert-warning'>";echo form_error('email'); echo "</div>";} ?>
        </div>

        <div class="field">
          <label for="pass">Mot de passe</label>
          <div class="ui left icon input">
            <input type="password" id="pass" name="pass" value="<?php echo set_value('pass'); ?>"> 
            <i class="lock icon"></i>
          </div>
          <?php if (form_error('user') != "") {echo "<div class='alert alert-warning'>";echo form_error('pass'); echo "</div>";} ?>
        </div>
        <input class="ui button pink" type="submit" value="Se connecter">
        <a href="<?php echo site_url('connexion/inscription');?>" class="ui button">
            <i class="signup icon"></i>
            Créer un compte
        </a>
      </form>
    </div>
  </div>
</div>
