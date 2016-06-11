<div class="ui error message hidden">
  <i class="close icon"></i>
  <ul class="list">
  </ul>
</div>

<div class="ui success message hidden grp">
  <i class="close icon"></i>
  Un email a bien été envoyé à <span></span>
</div>

<div class="jeuneHeader">
  <h1 class="ui left floated header">
    Listes de mes engagements
  </h1>
  <div>
    <form class="send ui action input liste-engagement hidden">
      <input type="email" placeholder="Email du consultant...">
      <button class="ui icon button" title="Envoyer">
        <i class="send icon"></i>
      </button>
    </form>
    <a class="ui icon button red liste-engagement hidden pdf" title="Voir la version PDF" target="_blank">
      <i class="file pdf outline icon"></i>
    </a>
    <a class="ui button pink liste-engagement hidden" href="#" title="Retourner à la liste des références">
      <i class="icon arrow left"></i>
      Retour
    </a>
  </div>
</div>
<div class="help title" title="Afficher l'aide"><i class="icon idea"></i> Listes d'engagements : Comment ça marche ?</div>
<div class="ui message info help hidden">
  <i class="icon close"></i>
  <p>
    Une liste d'engagements représente un groupement de références que vous pouvez envoyer par email à un consultant ou imprimer.
  </p>
  <ul>
    <li>Pour envoyer une <strong>liste de références</strong> par email, cliquez sur le numéro de la liste que vous voulez envoyer pour l'afficher en détail. Ensuite entrez l'email du <strong>consulant</strong> dans le champ prévu à cet effet puis cliquez sur le bouton <i class="icon send"> </i><i>Envoyer</i> (à droite du champ de l'email).</li>
    <li>Pour imprimer une <strong>liste de références</strong>, cliquez sur le numéro de la liste pour la voir en détail. Vous pourrez ensuite accéder à la verison PDF en cliquant sur le bouton <i class="file pdf outline icon"></i> <i>Voir la version PDF</i> ou vous pourrez cliquer sur le lien de consultation puis sur "Voir en PDF". Servez-vous ensuite de la boîte de dialogue d'impression de votre navigateur pour l'imprimer (généralement accessible avec <em>CTRL-P</em>)</li>
  </ul>
</div>
<div class="ui middle aligned divided list">
  <!-- Début de l'affichage  des listes d'engagement -->
  <?php
    foreach ($grp as $key=>$list){
      ?>
      <div class="item">
        <div class="content">
          <a class="header tooltip" href="#<?php echo $list['lien_consultation'] ?>" data-content="Voir votre liste en détail, l'imprimer ou l'envoyer à un consultant">
            Liste n°<?php printf('%03d',$key+1) ?>
          </a>
          <div class="description">
            <?php echo $list['nb_ref'] . ' référence' . ($list['nb_ref'] > 1 ? 's' : '') ?><br>
            Lien de consultation : <?php echo anchor('/consultant/'.$list['lien_consultation'], $list['lien_consultation'], ['target'=>'_blank', 'data-content'=>"Cliquer ici pour avoir un aperçu de ce que verra le consultant.", 'class'=>'tooltip']) ?>
          </div>
        </div>
      </div>
      <?php
    }if(empty($grp)){
      echo 'Aucune liste d\'engagements. Vous pouvez en créer à partir de vos ' . anchor(site_url('/jeune/reference'), 'références validées'). '.';
    }
  ?>
  <!-- Fin de l'affichage  des liste d'engagements -->
</div>
<div class="liste-engagement content hidden">
  Chargements...
</div>
<script>var reqUrl = '<?php echo site_url('/jeune/'); ?>' </script>
<script>var consUrl = '<?php echo site_url('/consultant/'); ?>' </script>
