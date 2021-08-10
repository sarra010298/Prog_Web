<?php
    //evenement qui permet déclancher les avis
    if( isset($_POST['etoile']) && !empty($_POST['etoile']))
    {
        //connxion à la base de données
        $connexion=require('connect.php');
        if(!$connexion)
        {
            echo "erreur connexion bd\n";
            exit();
        }
        printf("connection ok");
        echo "<br/>";
        echo $_POST['etoile'];
        echo "<br/>";

        $tab=explode(";",$_POST['etoile']);

        print_r($tab);
        echo "<br/>";

        $etoile=$tab[0];
        $recherche= $tab[1];

        echo $recherche;
        echo "<br/>";

        //on fait la recherche dans la base de données
        $Fsql='SELECT * FROM FILM WHERE film_titre Like  "%s%s%s" ';
        $mFsql=sprintf ($Fsql, '%',$recherche, '%');
        $sthF = $pdo->query($mFsql);
        $dataF = $sthF->fetchAll(PDO::FETCH_ASSOC);
        $film=$dataF[0]['film_id'];

        session_start();
        $_SESSION['id']=$dataF[0]['film_id'];
        $_SESSION['titre']=$dataF[0]['film_titre'];
        $_SESSION['iso']=$dataF[0]['film_iso'];
        $_SESSION['minutes']=$dataF[0]['film_minutes'];
        $_SESSION['annee']=$dataF[0]['film_annee'];
        $_SESSION['photo']=$dataF[0]['film_photo'];
        $_SESSION['realisateur']=$dataF[0]['film_realisateur'];

        echo "film id";
        echo $dataF[0]['film_id'];
        echo '<br>';

        //si on trouve on rajoute un avis
        if(count($dataF) > 0 )
        {
            //on trouvre un id pour le prochaine avis
            $Fsql='SELECT * FROM ETOILE';
            $sthF = $pdo->query($Fsql);
            $dataF = $sthF->fetchAll(PDO::FETCH_ASSOC);
            $nb=count($dataF)+1;
           
            
            //on insert la nouvelle etoile
            $Fsql='INSERT INTO `ETOILE` (`etoile_id`, `etoile_nombre`, `etoile_commentaire`, `etoile_film`, `etoile_utilisateur`) VALUES ("%s", "%s", NULL, "%s", NULL)';
            $mFsql=sprintf ($Fsql,$nb,$etoile,$film);
            echo $mFsql;
            $sthF = $pdo->exec($mFsql);

            //on fait la moyenne des avis
            $Fsql="SELECT avg(etoile_nombre) as moyenne FROM `ETOILE` WHERE etoile_film='%s' ";
            $mFsql=sprintf ($Fsql,$film);
            echo $mFsql;
            $sthF = $pdo->query($mFsql);
            $dataF = $sthF->fetchAll(PDO::FETCH_ASSOC);
            print_r($dataF);
            $reponse1='Note: '.$dataF[0]['moyenne'].' étoiles';  
            
     
            $Fsql="SELECT count(*) FROM `ETOILE` WHERE etoile_film='%s' ";
            $mFsql=sprintf ($Fsql,$film);
            echo $mFsql;
            $sthF = $pdo->query($mFsql);
            $data = $sthF->fetchAll(PDO::FETCH_ASSOC);
            $reponse= $reponse1." avec ".$data[0]['count(*)']." votes";
        }
    }
    else
      {  echo "error";}
?>
<!DOCTYPE html>
<html lang="fr">
    <div id='reponse'> <?php echo $reponse; ?> </div>
</html>