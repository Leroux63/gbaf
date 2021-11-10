<?php
	session_start();
	require_once('connect.php');

	if (!isset($_SESSION['username'])) {
		header ('Location: index.php');
		exit();
	}else{}
?>

<html>
	<head>
		<title>Espace membre GBAF</title>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="style.css">
		<meta name="viewport" content="width=device-width, initial-scale=1">
 		<script src="https://kit.fontawesome.com/00341d3c98.js" crossorigin="anonymous"></script>
	</head>
	<body>
		<?php require_once('header.php'); ?>

		<section id="membre">
			<div class="conteneur">
				<h1>Mon espace membre</h1>
				<?php
					if(isset($_GET['action'])){

						$userId = intval($_POST['uid']);
						$identifiant = htmlspecialchars($_POST['identifiant']);
						$nom = htmlspecialchars($_POST['nom']);	
						$prenom = htmlspecialchars($_POST['prenom']);	
						$answer = htmlspecialchars($_POST['answer']);	

						/* REQUETE DE MISE A JOUR UTILISATEUR */
						$sqlQuery = $bdd->prepare("UPDATE users SET username = :identifiant, nom = :nom, prenom = :prenom, reponse = :reponse WHERE id = :id");
						$sqlQuery->bindValue('identifiant',$identifiant, PDO::PARAM_STR);
						$sqlQuery->bindValue('nom',$nom, PDO::PARAM_STR);
						$sqlQuery->bindValue('prenom',$prenom, PDO::PARAM_STR);
						$sqlQuery->bindValue('reponse',$answer, PDO::PARAM_STR);
						$sqlQuery->bindValue('id',$userId, PDO::PARAM_INT);
						$sqlQuery->execute();

						header ('Location: membre.php');

					}else{
						$sqlQuery = $bdd->prepare("SELECT * FROM users WHERE username = :username");
						$sqlQuery->bindValue('username',$_SESSION['username']);
						$sqlQuery->execute();
						foreach (($sqlQuery->fetchAll(PDO::FETCH_OBJ)) as $value) {
				?>
							<form name="editUser" id="editUser" action="membre.php?action=edit" method="POST">
								<label for="identifiant">Identifiant</label>
								<input type="text" name="identifiant" id="identifiant" value="<?php echo $value->username; ?>" />

								<label for="nom">Nom</label>
								<input type="text" name="nom" id="nom" value="<?php echo $value->nom; ?>" />

								<label for="prenom">Prénom</label>
								<input type="text" name="prenom" id="prenom" value="<?php echo $value->prenom; ?>" />

								<label for="answer">Réponse à la question</label>
								<input type="text" name="answer" id="answer" value="<?php echo $value->reponse; ?>" />

								<input type="hidden" name="uid" id="uid" value="<?php echo $value->id; ?>" />
								<input type="submit" value="Mettre à jour" />
					
							</form>
				<?php 
						} 
					}
				?>
			</div>
		</section>
		<?php require_once('footer.php'); ?>
	</body>
</html>