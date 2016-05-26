<html>
<head>
<title>My Form</title>
</head>
<body>s
  <div class="ui success message">
    <div class="header">Demande de référence</div>
    <p><?php 
    echo "Votre demande de référence a bien été crée " . $tab["prenom"] . " " . $tab["nom"] . "," " elle sera envoyé à " . set_value('nom') . " " . set_value('prenom');
?></p>
  </div>


</body>
</html>