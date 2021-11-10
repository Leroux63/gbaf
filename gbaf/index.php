<?php
   session_start();
   require_once('connect.php');

    if ((isset($_POST['username'], $_POST['password']))
    && !empty($_POST['username']) && !empty($_POST['password'])) {

        $username = htmlspecialchars($_POST['username']);
        $password = password_hash($_POST['password'],PASSWORD_ARGON2ID);
        $sqlQuery = $bdd->prepare("SELECT * FROM users WHERE username = :username");
        $sqlQuery->bindValue('username', $_POST['username']);
        $sqlQuery->execute();
        $users = $sqlQuery->fetch();

        //var_dump($users['id'], $users['nom'], $users['prenom']);

        if(count($users) !== 0){
            if(password_verify($_POST['password'], $users['password'])) {
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
    }else{}
?>
<!DOCTYPE html>
<html>
<head>
    <title>GBAF</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
    <div class="conteneur">
        
        <form method="POST" name="loginForm" id="loginForm">

            <img src="images/logo_gbaf.png" />
            <h2 class="connexionTitre">Connexion GBAF</h2>

            <?php if(isset($_GET['error'])){ ?>
            <div class="errorMessage">
                <?php echo "Identifiant et/ou mot de passe invalide"; ?>
            </div>
            <?php }else{} ?>

            <input type="text" name="username" placeholder="Identifiant" value="<?php if (isset($_POST['username'])) echo htmlspecialchars(trim($_POST['username'])); ?>" ><br />
            <input type="password" name="password" placeholder="Mot de passe" value="<?php if (isset($_POST['password'])) echo htmlspecialchars(trim($_POST['password'])); ?>"><br />
            <button type="submit" class="btn btn-primary">Se Connecter</button>

            <div class="linkConnexion">
                <a href="inscription.php">S'inscrire</a> | 
                <a href="recuperation.php">Mot de Passe oublié</a>
            </div>     
        </form>
    </div>

    <?php if (isset($erreur)) echo '<br /><br />',$erreur; ?>
    <?php require_once('footer.php'); ?>
</body>
</html>