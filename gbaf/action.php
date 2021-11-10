<?php
    session_start();
    require_once('connect.php');

        if(isset($_GET['t'],$_GET['id']) && !empty($_GET['t']) && !empty($_GET['id'])) {

            $getid = (int)$_GET['id'];
            $gett = (int)$_GET['t'];
            $uid = (int)$_SESSION['id'];

            $check = $bdd->prepare('SELECT id FROM partenaires WHERE id = ?');
            $check->execute(array($getid));

            if($check->rowCount() == 1){
                if($gett == 1){

                    $nbLike = $bdd->prepare("SELECT count(*) 
                    AS count 
                    FROM alike 
                    WHERE id_partenaires = :id
                    AND id_users = :userId");
					$nbLike->bindValue('id',$getid, PDO::PARAM_INT);
                    $nbLike->bindValue('userId',$uid, PDO::PARAM_INT);
					$nbLike->execute();    
                    $countLike = $nbLike->fetchAll(PDO::FETCH_OBJ);
					if($countLike[0]->count == 0){
                        $nbDisLike = $bdd->prepare("SELECT count(*) 
                        AS count 
                        FROM dislike 
                        WHERE id_partenaires = :id
                        AND id_users = :userId");
                        $nbDisLike->bindValue('id',$getid, PDO::PARAM_INT);
                        $nbDisLike->bindValue('userId',$uid, PDO::PARAM_INT);
                        $nbDisLike->execute();    
                        $countDisLike = $nbDisLike->fetchAll(PDO::FETCH_OBJ);
                        if($countDisLike[0]->count == 0){
                            $ins = $bdd->prepare('INSERT INTO alike (id_partenaires, id_users) VALUES (?,?)');
                            $ins->execute(array($getid, $uid));
                        }else{}
                    }else{}
                } elseif ($gett == 2) {

                    $nbDisLike = $bdd->prepare("SELECT count(*) 
                    AS count 
                    FROM dislike 
                    WHERE id_partenaires = :id
                    AND id_users = :userId");
					$nbDisLike->bindValue('id',$getid, PDO::PARAM_INT);
                    $nbDisLike->bindValue('userId',$uid, PDO::PARAM_INT);
					$nbDisLike->execute();    
                    $countDisLike = $nbDisLike->fetchAll(PDO::FETCH_OBJ);
					if($countDisLike[0]->count == 0){
                        $nbLike = $bdd->prepare("SELECT count(*) 
                        AS count 
                        FROM alike 
                        WHERE id_partenaires = :id
                        AND id_users = :userId");
                        $nbLike->bindValue('id',$getid, PDO::PARAM_INT);
                        $nbLike->bindValue('userId',$uid, PDO::PARAM_INT);
                        $nbLike->execute();    
                        $countLike = $nbLike->fetchAll(PDO::FETCH_OBJ);
                        if($countLike[0]->count == 0){
                            $ins = $bdd->prepare('INSERT INTO dislike (id_partenaires, id_users) VALUES (?, ?)');
                            $ins->execute(array($getid, $uid));
                        }else{}
                    }else{}
                }
                header('Location: /partenaire.php?id='.$getid);

            }else{
                exit('Erreur fatale. <a href="/">Retour</a>');
            }

        }
    ?>
  