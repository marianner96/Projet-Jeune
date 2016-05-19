<div class="separateur"></div>
<div class="ui container">
  <div class="ui grid stackable two column middle aligned relative very relaxed">
    <?php echo form_open('connexion', array('class' => 'ui form column')); ?>

      <div class="ui form error">
        <div class="field">
          <label for="email">Email</label>
          <div class="ui left icon input">
            <input type="email" id="email" name="email" value="<?php echo set_value('user'); ?>">
            <i class="at icon"></i>
          </div>
          <?php if (form_error('email') != "") {echo "<div class='ui error message'>";echo form_error('email'); echo "</div>";} ?>
        </div>
      </div>

      <div class="ui form error">
        <div class="field">
          <label for="pass">Mot de passe</label>
          <div class="ui left icon input">
            <input type="password" id="pass" name="pass" value="<?php echo set_value('pass'); ?>"> 
            <i class="lock icon"></i>
          </div>
          <?php if (form_error('pass') != "") {echo "<div class='ui error message'>";echo form_error('pass'); echo "</div>";} ?>
        </div>
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
