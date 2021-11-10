<?php
    session_start();
    require_once('connect.php');

        if ((isset($_POST['identifiant'], $_POST['answer'],$_POST['password'], $_POST['password2']))
        && !empty(($_POST['identifiant']) && !empty($_POST['answer']) && ! empty($_POST['password']) && ! empty($_POST['password2']))) {

            $username = htmlspecialchars($_POST['identifiant']);
            $answer = htmlspecialchars($_POST['answer']);
            $password = password_hash($_POST['password'],PASSWORD_ARGON2ID);
        

            $sqlQuery = $bdd->prepare("SELECT * FROM users WHERE username = :username");
            $sqlQuery->bindValue('username',$_POST['username']);
            $sqlQuery->execute();
            $users = $sqlQuery->fetch();

            if(count($users) !== 0){
                    if($_POST['answer'] =  $users['answer']) {
                        $_SESSION['username'] = $username;
                        $_SESSION['id'] = $users['id'];
                        $_SESSION['nom'] = $users['nom'];
                        $_SESSION['prenom'] = $users['prenom'];
                        header ('Location: gbaf.php');
                    }else{
                        header ('Location: index.php?error=1');
                    }
            }else{
                header ('Location: index.php?error=1');
            }
        }


    if(isset($_GET['action'])){

        $userId = intval($_POST['uid']);
        $identifiant = htmlspecialchars($_POST['identifiant']);
        $password = password_hash ($_POST['password'],PASSWORD_ARGON2ID);	
        $answer = htmlspecialchars($_POST['answer']);	

        /* REQUETE DE MISE A JOUR UTILISATEUR */
        $sqlQuery = $bdd->prepare("UPDATE users SET username = :identifiant, reponse = :reponse, password = :password WHERE id = :id");
        $sqlQuery->bindValue('identifiant',$identifiant, PDO::PARAM_STR);
        $sqlQuery->bindValue('reponse',$answer, PDO::PARAM_STR);
        $sqlQuery->bindValue('password',$password, PDO::PARAM_STR);
        $sqlQuery->bindValue('id',$userId, PDO::PARAM_INT);
        $sqlQuery->execute();

        header ('Location: index.php');
    }
  
?>

<!DOCTYPE html>
<html lang="fr-FR">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="style.css">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>


    <form name="recupForm" id="recupForm"action="membre.php?action=edit" method="POST"> 
    <a href="gbaf.php"><img src="images/logo_gbaf.png" /></a>
                <h2 class="recupTitre">Récupération Compte GBAF</h2> <br /> 

        <label for="identifiant">Identifiant</label>
        <input type="text" name="identifiant"  placeholder="identifiant"  > <br /> 

        <label for="answer">Réponse à la question</label>
        <input type="text" name="answer" id="answer"> <br /> 

        <label for="password">Mot de Passe</label>
        <input type="password" name="password" placeholder="Nouveau Mot de passe" > <br /> 

        <label for="password2">Confirmez Mot De Passe</label>
        <input type="password" name="password2"placeholder="Confirmez Mot de passe" id="password2"> <br /> 

        <input type="submit" value="Mettre à jour" />

    </form>
    <?php require_once ('footer.php'); ?>
</body>
</html>