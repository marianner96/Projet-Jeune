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
      <button class="ui icon button">
        <i class="send icon"></i>
      </button>
    </form>
    <a class="ui button pink liste-engagement hidden" href="#">
      <i class="icon arrow left"></i>
      Retour
    </a>
  </div>
</div>
<div class="help title" title="Afficher l'aide"><i class="icon idea"></i> Comment ça marche ?</div>
<div class="ui message info help hidden">
  <i class="icon close"></i>
  <p>
    Une liste d'engagement représente un groupement de références que vous pouvez envoyer par email à un consultant ou imprimer.
  </p>
  <ul>
    <li>Pour envoyer une <strong>liste de références</strong> par email, cliquez sur la liste que vous voulez envoyer pour l'afficher en détail. Ensuite entrez l'email du <strong>consulant</strong> dans le champs prévu à cet effet puis cliquez sur le bouton <i class="icon send"> </i><i>Envoyer</i> (à droite du champs de l'email).</li>
  </ul>
</div>
<div class="ui middle aligned divided list selection">
  <!-- Début de l'affichage  des listes d'engagement -->
  <?php
    foreach ($grp as $key=>$list){
      ?>
      <div class="item">
        <div class="content">
          <a class="header" href="#<?php echo $list['lien_consultation'] ?>">
            Liste n°<?php printf('%03d',$key+1) ?>
          </a>
          <div class="description">
            <?php echo $list['nb_ref'] . ' référence' . ($list['nb_ref'] > 1 ? 's' : '') ?><br>
            Lien de consultation : <?php echo anchor('/consultant/'.$list['lien_consultation'], $list['lien_consultation'], ['target'=>'_blank']) ?>
          </div>
        </div>
      </div>
      <?php
    }if(empty($grp)){
      echo 'Aucune liste d\'engagements.';
    }
  ?>
  <!-- Fin de l'affichage  des liste d'engagements -->
</div>
<div class="liste-engagement content hidden">
  Chargements...
</div>
<script>var reqUrl = '<?php echo site_url('/jeune/'); ?>' </script>
