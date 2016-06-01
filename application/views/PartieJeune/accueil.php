<?php
  function diff_date($date1, $date2)
  {
    $second = floor($date1 - $date2);
    if ($second == 0) return "0";

    return array(
      "an" => date('Y', $second) - 1970,
      "mois" => date('m', $second) - 1,
      "semaine" => floor((date('d', $second) - 1) / 7),
      "jour" => (date('d', $second) - 1) % 7
    );
  }
?>
<h1>Bienvenue sur le Projet Jeune</h1>
<div class="ui feed">
<?php
	foreach ($tableau as $value) {
?>
	<div class="event">
		<div class="content">
			<div class="ui raised segment">
				<div class="summary">
					<?php
						if ($value['type']=='1') {
							echo 'Vous vous êtes inscrit';
						} elseif ($value['type'] == '2') {
							echo 'Vous avez créer une nouvelle référence';
						} else {
							echo 'Votre référence a été validée';
						}
					?>
					<div class="date">
						<?php
							$datedepart = strtotime($value['date']);
							$dateactuelle = time(); //strtotime(time('Y-m-d'));
							$tab = diff_date($dateactuelle, $datedepart) ;
							$compteur = 0;
							foreach ($tab as $key => $value) {
								if ($value > 0) {
									echo (($compteur) ? ', ' : "Il y a ") . $value .' '. $key;
									if ($value > 1 && $key != "mois") echo  's';
									$compteur++;
								}
							}
							if ($compteur == 0) {
								echo "Aujourd'hui";
							}
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php
	}
?>
</div>