<?php
        if( isset($_POST['message']) && !empty($_POST['message'])) // si les variables ne sont pas vides
        { 
            // on se connecte à notre base de données
            $connexion=require('connect.php');
            if(!$connexion)
            {
                echo "erreur connexion bd\n";
                exit();
            }
         
            // on cherche le nombre  de message dans la base de donnne
            $msql='SELECT count(*) FROM `MESSAGE`';
            $sth = $pdo->query($msql);
            $data = $sth->fetchAll(PDO::FETCH_ASSOC);
            $count=$data[0]['count(*)']+1;


  
            //on ajout le message a la bd en fonction de l'acteur ou du film ou du réalisateur 
            if (isset($_POST['individu']) && !empty($_POST['individu']))
            {
                //on verifie si l'individue est un réalisateur ou un acteur
                $Asql='SELECT count(*) FROM ACTEUR WHERE acteur_nom="%s" ';  
                $mAsql=sprintf ($Asql,$_POST['individu']);

                $sthA = $pdo->query($mAsql);
                $dataA = $sthA->fetchAll(PDO::FETCH_ASSOC);


                if($dataA[0]['count(*)']>0) //c'est un acteur
                { 
                    $msql="INSERT INTO `MESSAGE` (`message_id`, `message_utilisateur`, `message_acteur`, `message_valeur`) VALUES ('%s','%s','%s','%s')";
                    $sql=sprintf($msql, $count, $_POST['utilisateur'], $_POST['id'],$_POST['message']);


                }
                else //c'est un realisateur
                {
                    $msql="INSERT INTO `MESSAGE` (`message_id`, `message_utilisateur`, `message_realisateur`, `message_valeur`) VALUES ('%s','%s','%s','%s')";
                    $sql=sprintf($msql, $count, $_POST['utilisateur'], $_POST['id'],$_POST['message']);
                } 
            }
            else if (isset($_POST['film']) && !empty($_POST['film']))
            {
                $msql="INSERT INTO `MESSAGE` (`message_id`, `message_utilisateur`, `message_film`, `message_valeur`) VALUES ('%s','%s','%s','%s')";
                $sql=sprintf($msql, $count, $_POST['utilisateur'], $_POST['film'],utf8_encode ($_POST["message"]));
                
            }
            else
            {
                echo "erreur forum.php ligne 38";
                exit();
            }
        
            $pdo->exec($sql);

            //on verifie que la commande a bien fonctionner
            $msql='SELECT count(*) FROM `MESSAGE`';
            $sth = $pdo->query($msql);
            $data = $sth->fetchAll(PDO::FETCH_ASSOC);
            $count2=$data[0]['count(*)'];

            if($count2!=$count)
            {
                echo "erreur forum.php ligne 51";
                exit();
            } 
        }
        else
        {
            echo "erreur formulaire";
            exit();
        }

        $requete = $pdo->query("SELECT message_valeur, message_id FROM MESSAGE WHERE message_id=
        (SELECT Max(message_id) FROM(((MESSAGE JOIN UTILISATEUR ON utilisateur_id=message_utilisateur ) LEFT OUTER JOIN FILM ON film_id=`message_film`) LEFT OUTER JOIN ACTEUR ON acteur_id=`message_acteur` ) LEFT OUTER JOIN REALISATEUR ON realisateur_id=`message_realisateur` 
        where utilisateur_id=".$_POST['utilisateur'].")");

        $data =$requete->fetchAll(PDO::FETCH_ASSOC);
        $reponse="<p id=".$data[0]['message_id'].">Vous venez de dire: ".$data[0]['message_valeur'].'<br>';
    
?>
<!DOCTYPE html>
<html lang="fr">
    <div id='reponse'> <?php echo $reponse; ?> </div>
</html>