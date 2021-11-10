<?php
	session_start();
	require_once('connect.php');

	if (!isset($_SESSION['username'])) {
		header ('Location: index.php');
		exit();
	}else{}
?>
<!DOCTYPE html>
<html>
	<head>	
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="style.css">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<script src="https://kit.fontawesome.com/00341d3c98.js" crossorigin="anonymous"></script>
	</head>
	<body>

		<?php require_once('header.php'); ?>


		<section id="mentionLegales">
			<div class="container">
				<p>
					Les informations recueillies sur ce site sont enregistr&eacute;es dans un fichier informatis&eacute;<br>
					par identit&eacute; et coordonn&eacute;es du responsable de traitement pour finalit&eacute;s du traitement.<br>
					La base l&eacute;gale du traitement est [base l&eacute;gale du traitement].Les donn&eacute;es collect&eacute;es seront<br>
					communiqu&eacute;es aux seuls destinataires suivants : [destinataires des donn&eacute;es].<br>
					Les donn&eacute;es sont conserv&eacute;es pendant [dur&eacute;e de conservation des donn&eacute;es pr&eacute;vue<br>
					par le responsable du traitement ou crit&egrave;res permettant de la d&eacute;terminer].<br>
					Vous pouvez acc&eacute;der aux donn&eacute;es vous concernant, les rectifier, demander leur effacement ou exercer<br>
					votre droit &agrave; la limitation du traitement de vos donn&eacute;es. (en fonction de la base l&eacute;gale du traitement,<br>
					mentionner &eacute;galement : Vous pouvez retirer &agrave; tout moment votre consentement au traitement de vos donn&eacute;es ;<br>
					Vous pouvez &eacute;galement vous opposer au traitement de vos donn&eacute;es ; Vous pouvez &eacute;galement exercer votre <br>
					droit &agrave; la portabilit&eacute; de vos donn&eacute;es)<br>
					Consultez le site cnil.fr pour plus d&#039;informations sur vos droits.<br>
					Pour exercer ces droits ou pour toute question sur le traitement de vos donn&eacute;es dans ce dispositif,<br>
					vous pouvez contacter (le cas &eacute;ch&eacute;ant, notre d&eacute;l&eacute;gu&eacute; &agrave;<br>
					la protection des donn&eacute;es ou le service charg&eacute; de l&#039;exercice de ces droits) :adresse &eacute;lectronique,<br>
					postale, coordonn&eacute;es t&eacute;l&eacute;phoniques, etc. <br>
					Si vous estimez, apr&egrave;s nous avoir contact&eacute;s, que vos droits  &lsaquo;Informatique et Libert&eacute;s &rsaquo;<br>
					ne sont pas respect&eacute;s, vous pouvez adresser une r&eacute;clamation &agrave; la CNIL.<br>
				</p>
			</div>
		</section>

		<?php require_once('footer.php'); ?>
	</body>
</html>