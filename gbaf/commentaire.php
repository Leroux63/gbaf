<?php
    session_start();
    require_once('connect.php');

    if (!isset($_SESSION['username'])) {
        header ('Location: index.php');
        exit();
    }else{}

    $getid = intval($_GET['id']);

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Commentaire</title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="style.css">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://kit.fontawesome.com/00341d3c98.js" crossorigin="anonymous"></script>
    </head>
    <body>
        <section id="commentaires">
			<div class="container">
                <?php 
                    require_once('header.php'); 

                    if(isset($_POST['commentaire']) && (!empty($_POST['commentaire']))) {

                        $id_users = $_POST['id_users'];
                        $commentaire = $_POST['commentaire'];
                        $id_partenaires = $_POST['id_partenaires'];
                        $timePost = $_POST['datetime'];

                        $query = $bdd->prepare("SELECT * FROM commentaires 
                        WHERE id_users = :id_users 
                        AND id_partenaires = :id_partenaires");
                        $query->bindValue('id_users',$id_users, PDO::PARAM_INT);
                        $query->bindValue('id_partenaires',$id_partenaires, PDO::PARAM_INT);
						$query->execute();
                        $countCommentaire = $query->rowCount();

                        if($countCommentaire >= 1){
                            echo '<div>Vous avez déjà commenté ce partenaire !</div>';
                            echo '<div><a href="/partenaire.php?id='.$getid.'">Retour à la page partenaire</a></div>';
                        }else{

                            $sql="INSERT INTO commentaires (id_users, commentaire, id_partenaires, timePost) 
                            VALUES ( :id_users, :commentaire, :id_partenaires, :datetime)";
                            $exec=$bdd->prepare($sql);
                            $exec->execute(array(
                                'id_users' => $_SESSION['id'],
                                'commentaire' => $commentaire,
                                'id_partenaires' => $id_partenaires,
                                'datetime' => $timePost,
                            ));

                            header('Location: /partenaire.php?id='.$getid);
                            
                        }

                    }else{

                        echo "<h2>Poster un commentaire</h2>";
                        echo "<form method='POST' name='commentaire' action='/commentaire.php?id=$getid'>";
                            echo "<label for='commentaire'>Commentaire</label>";
                            echo "<textarea name='commentaire' id='commentaire'></textarea>";
                            
                            echo "<div class='clear'></div>";
                            echo "<input type='hidden' name='datetime' value='".date('d-m-y H:i:s')."' />";
                            echo "<input type='hidden' name='id_partenaires' value='".$getid."' />";
                            echo "<input type='hidden' name='id_users' value='".$_SESSION['id']."' />";
                            echo "<input type='submit' class='button-red left' value='Poster mon commentaire' name='submit_commentaire' />";
                        echo "</form>";

                    }
                ?>
            </div>
        </section>


<?php require_once('footer.php'); ?>
	</body>
</html>




