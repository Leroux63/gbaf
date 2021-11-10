<?php
	session_start();
	require_once('connect.php');

	if (!isset($_SESSION['username'])) {
		header ('Location: index.php');
		exit();
	}else{}

?>
<!DOCTYPE html>
<html lang="fr-FR">
	<head>
		<title>GBAF</title>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="style.css">
		<meta name="viewport" content="width=device-width, initial-scale=1">
 		<script src="https://kit.fontawesome.com/00341d3c98.js" crossorigin="anonymous"></script>
	</head>
	<body>
		<?php require_once('header.php'); ?>

		<section id="presentationAccueil">
			<h1>GBAF</h1>
			<div>
				GBAF Le Groupement Banque Assurance Français (GBAF) est une fédération <br /> 
				représentant les 6 grands groupes français : <br /> 
				<br /> 
				<ul>
					<li>BNP Paribas</li>
					<li>BPCE</li>
					<li>Crédit Agricole</li>
					<li>Crédit Mutuel-CIC</li>
					<li>Société Générale</li>
					<li>La Banque Postale</li>
				</ul>
				<br /> 
				Même s’il existe une forte concurrence entre ces entités, elles vont toutes 
				<br />  
				travailler de la même façon pour gérer près de 80 millions de comptes sur le territoire national.
				<br /> 
				Le GBAF est le représentant de la profession bancaire et des assureurs sur tous les axes de la réglementation financière française.
				<br /> 
				Sa mission est de promouvoir l'activité bancaire à l’échelle nationale.
				<br />
				C’est aussi un interlocuteur privilégié despouvoirs publics.
			</div>
	 	</section>
	   	<section id="partenaires">
	   		<?php
	   			$sql='SELECT * FROM partenaires ORDER BY id ASC';
	   			foreach (($bdd->query($sql)->fetchAll(PDO::FETCH_OBJ)) as $value) {
	   				echo "<div class='partenaireDetails'>";
	   					echo "<div><img src='".$value->logo."' alt='".$value->titre."' title='".$value->titre."'/></div>";
	   					echo "<div><h2>".$value->titre."</h2></div>";
	   					echo "<div><p>".substr($value->texte, 0,100)."...</p></div>";
	   					echo"<div><a href='partenaire.php?id=".$value->id."'>Cliquez ici</a></div>";
	   				echo "</div>";
	   			}
	   		?>
	   	</section>
		<?php require_once('footer.php'); ?>
	</body>
</html>