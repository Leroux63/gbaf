<?php session_start(); ?>
<!DOCTYPE html>
<html lang="fr-FR">
<head>
	<meta charset="utf-8">
	<title>Inscription</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="./style.css">
</head>
	<body>
		<section id="membre">
			<div class="conteneur">
				<?php 
					require_once('connect.php'); 
					if ((isset($_POST['nom'], $_POST['prenom'], $_POST['username'], $_POST['password'], $_POST['password2'], $_POST['reponse'])) && ! empty($_POST['nom']) && ! empty($_POST['prenom']) && ! empty($_POST['username']) && ! empty($_POST['password']) && ! empty($_POST['password2']) && ! empty($_POST['reponse'])) {

						$nom = htmlspecialchars ($_POST['nom']);
						$prenom = htmlspecialchars ($_POST['prenom']);
						$username = htmlspecialchars ($_POST['username']);
						$password = password_hash ($_POST['password'],PASSWORD_ARGON2ID);
						$reponse = htmlspecialchars ($_POST['reponse']);

						try{
							$exec = $bdd->prepare("INSERT INTO users (nom,prenom,username,password,reponse)  VALUES (:nom, :prenom, :username, :password, :reponse)");
							$exec->execute(array(":nom" => $nom,":prenom" => $prenom,":username" => $username,":password" => $password,":reponse" => $reponse,));	
						} catch (Exception $e) {
							echo 'Exception reçue : ',  $e->getMessage(), "\n";
						}
					}
				?>

				<form action="inscription.php" method="post"name="inscForm" id="inscForm">
					<div>
						<a href="gbaf.php"><img src="./images/logo_gbaf.png" /></a> 
						<br />
			
						<label for="nom">Nom</label>
						<input type="text" name="nom" placeholder="Nom" id="nom"> 
						
						<div class="separateur"></div>

						<label for="prenom">Prénom</label>
						<input type="text" name="prenom" placeholder="Prénom" id="prenom"> <br /> 

						<div class="separateur"></div>

						<label for="username">Identifiant</label>
						<input type="text" name="username" placeholder="identifiant" id="username"> <br /> 

						<div class="separateur"></div>

						<label for="password">Mot de passe</label>
						<input type="password" name="password" placeholder="Mot de passe" id="password"> <br /> 

						<div class="separateur"></div>

						<label for="password2">Confirmez Mot de passe</label>
						<input type="password" name="password2" placeholder="Confirmez Mot de passe" id="password2"> <br /> 

						<div class="separateur"></div>
					
						<label for="reponse">Quel est le nom de votre premier ami d'enfance?</label>
						<input type="text" name="reponse" placeholder="Réponse" id="reponse">

						<div class="separateur"></div>

						<input type="submit" name="M'inscrire" value="m'inscrire" />

					</div>
				</form>
			</div>
		</section>
		<?php require_once('footer.php'); ?>
	</body>
</html>