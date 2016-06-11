<page>

  <h1 style="font-weight: normal">
    <img style="width: 75px" src="<?php echo FCPATH.'static/img/j64_logo1.jpg' ?>">
    Liste d'engagements de <?php echo $jeune->prenom . ' ' . $jeune->nom ?>
  </h1>
  <table style="width: 100%;">
    <tr>
      <td style="width:50%;">E-mail de contact : <?php echo mailto($jeune->mail) ?></td>
      <td> Date de naissance : <?php echo date("d/m/Y", strtotime($jeune->date_naissance)); ?></td>
    </tr>
  </table>
  <div style="margin-top: 20px"></div>
  <?php
    $counter = 0;
    foreach ($grp as $ref) {
      $counter++;
  ?>
    <h2 style="font-size: 70%; margin-top: 40px; font-weight: normal">Référence n°<?php echo $counter ?></h2>
    <table style="width: 100%; vertical-align: top">
      <thead>
      <tr>
        <th style="color:#e03997; width: 50%">Jeune</th>
        <th style="color:#21ba45; width: 50%">Référent</th>
      </tr>
      </thead>
      <tr>
        <td style="width: 50%;">
          <span style="text-decoration: underline;">Mes savoir-être :</span> Je suis
          <?php
          foreach ($ref['savoir_etre']['jeune'] as $savoir_etre){
            echo $savoir_etre .  ' ';
          }
          ?>
        </td>
        <td style="width: 50%;">
          <span style="text-decoration: underline;">Ses savoir-être :</span> Je confirme qu'il/elle est
          <?php
          foreach ($ref['savoir_etre']['referent'] as $savoir_etre){
            echo $savoir_etre .  ' ';
          }
          ?>
        </td>
      </tr>
      <tr>
        <td>
          <span style="text-decoration: underline;">Description : </span> <?php echo $ref['description'] ?>
        </td>
        <td>
          <span style="text-decoration: underline;">Coordonnée : </span> <?php echo $ref['prenom'] . ' ' . $ref['nom'] . ' - ' . mailto($ref['mail']); ?>
        </td>
      </tr>
      <tr>
        <td>
          <span style="text-decoration: underline;">Durée :</span> <?php echo $ref['duree'] ?>
        </td>
        <td>
          <span style="text-decoration: underline;">Commentaire :</span> <?php echo $ref['commentaire'] ?>
        </td>
      </tr>
    </table>
    <?php
  }
  ?>
</page>