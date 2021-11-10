<?php
	session_start();
	require_once('connect.php');
	
	if (!isset($_SESSION['username'])) {
		header ('Location: index.php');
		exit();
	}else{}

	$titre='';
	$image='';
	$description='';
	$id=intval($_GET['id']);
	$sql ="SELECT * FROM partenaires WHERE id = '".$id."'";
	foreach (($bdd->query($sql)->fetchAll(PDO::FETCH_OBJ)) as $value) {
		$titre=$value->titre;
		$image=$value->logo;
		$description=$value->texte;
	}
?>
<!DOCTYPE html>
<html lang="fr-FR">
	<head>
		<title><?php echo $titre; ?></title>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="style.css">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<script src="https://kit.fontawesome.com/00341d3c98.js" crossorigin="anonymous"></script>
	</head>
	<body>
	
		<?php require('header.php'); ?>

		<section id="partenaire">
			<div class="container">
				<div class="imagePartenaire"><img src="<?php echo $image; ?>" width="100%" height="auto" /></div>
				<h2><?php echo $titre; ?></h2>
				<p><?php echo $description; ?></p>
			</div>
		</section>
		<section id="commentaires">
			<div class="container">
				<?php
					/* Nombres de commentaires du partenaires */
					$countCommentaire = 0;
					try{
						$sqlCommentaire =  $bdd->query('SELECT * FROM commentaires WHERE id_partenaires = '.$id.' ORDER BY id DESC');
						$countCommentaire = $sqlCommentaire->rowCount();
					} catch (Exception $e) {
						echo 'Exception reçue : ',  $e->getMessage(), "\n";
					}
				?>
				<h2>
					<?php 
						if($countCommentaire <= 1){
							echo $countCommentaire.' commentaire';
						}else{
							echo $countCommentaire.' commentaires';
						}
					?>
				</h2>

				<div class="optionCommentaire">
					<a href='commentaire.php?id=<?php echo $id; ?>' class="linkPostComment">Poster un commentaire</a>
					
					<!-- LIKE -->
					<a href="action.php?t=1&id=<?=$id?>"> <i class="fas fa-thumbs-up"></i></a> 
					<?php
						$sqlQuery = $bdd->prepare("SELECT count(*) AS count FROM alike WHERE id_partenaires = :id");
						$sqlQuery->bindValue('id',$id, PDO::PARAM_INT);
						$sqlQuery->execute();
						$countLike = $sqlQuery->fetchAll(PDO::FETCH_OBJ);
						echo $countLike[0]->count;
					?>

					<!-- DISLIKE -->
					<a href="action.php?t=2&id=<?=$id?>"> <i class="fas fa-thumbs-down"> </i></a> 
					<?php
						$sqlQuery = $bdd->prepare("SELECT count(*) AS count FROM dislike WHERE id_partenaires = :id");
						$sqlQuery->bindValue('id',$id, PDO::PARAM_INT);
						$sqlQuery->execute();
						$countDislike = $sqlQuery->fetchAll(PDO::FETCH_OBJ);
						echo $countDislike[0]->count;
					?>

				</div>
				<div class="clear"></div>

				<!-- Commentaires -->
				<?php
					$requeteCommentaire = $bdd->prepare("SELECT *
					FROM commentaires AS c 
					INNER JOIN users AS u ON c.id_users = u.id 
					WHERE c.id_partenaires = :idPartenaire 
					ORDER BY c.id DESC");
					$requeteCommentaire->bindValue('idPartenaire',$id, PDO::PARAM_INT);
					$requeteCommentaire->execute();
					foreach(($requeteCommentaire->fetchAll(PDO::FETCH_OBJ)) as $value) {
						echo "<div class='commentSingleListing'>";
							echo "<div><strong>".$value->prenom."</strong></div>";
							echo "<div>".$value->timePost."</div>";
							echo "<p><i>".$value->commentaire."</i></p>";
						echo "</div>";
					}
				?>
			</div>
		</section>
		<?php require('footer.php'); ?>
	</body>
</html>
