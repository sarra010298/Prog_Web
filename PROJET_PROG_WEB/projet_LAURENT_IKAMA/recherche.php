<?php
    //evenement qui permet déclancher une recherche
    if( isset($_POST['quoi']) && !empty($_POST['quoi']))
   { 
        //connxion à la base de données
        $connexion=require('connect.php');
        if(!$connexion)
        {
            echo "erreur connexion bd\n";
            exit();
        }
        

        //on fait la recherche dans la base de données
        $recherche=strval($_POST['quoi']);
       

        $Fsql='SELECT * FROM FILM WHERE film_titre Like  "%s%s" ';
        $Asql='SELECT * FROM ACTEUR WHERE acteur_nom Like  "%s%s%s" ';  
        $Rsql='SELECT * FROM REALISATEUR WHERE realisateur_nom Like  "%s%s%s" '; 

        $mFsql=sprintf ($Fsql, '%',$recherche);
        $mAsql=sprintf ($Asql,  '%',$recherche, '%');
        $mRsql=sprintf ($Rsql, '%',$recherche, '%');

        $sthF = $pdo->query($mFsql);
        $sthA = $pdo->query($mAsql);
        $sthR = $pdo->query($mRsql);
       
        $dataF = $sthF->fetchAll(PDO::FETCH_ASSOC);
        $dataA = $sthA->fetchAll(PDO::FETCH_ASSOC);
        $dataR = $sthR->fetchAll(PDO::FETCH_ASSOC);


        //si on trouvre on revoie à la page correspondant 
        if(count($dataF) > 0 || count($dataA)>0|| count($dataR) > 0)
        { 
            if(count($dataF) > 0)
            {
                $film=$dataF[0]['film_id'];
                $Fsql="SELECT avg(etoile_nombre) as moyenne FROM `ETOILE` WHERE etoile_film='%s' ";
                $mFsql=sprintf ($Fsql,$film);
              
                $sthF = $pdo->query($mFsql);
                $data = $sthF->fetchAll(PDO::FETCH_ASSOC);
      
                session_start();
                if(empty($data[0]['moyenne']))
                {
                    $_SESSION['etoile']="Personne n'a noté ce film pour le moment.";
                }
                else
                {
                    $moyenne=$data[0]['moyenne'].' étoiles';
                    $Fsql="SELECT count(*) FROM `ETOILE` WHERE etoile_film='%s' ";
                    $mFsql=sprintf ($Fsql,$film);
                    
                    $sthF = $pdo->query($mFsql);
                    $data = $sthF->fetchAll(PDO::FETCH_ASSOC);
                    $_SESSION['etoile']= $moyenne." avec ".$data[0]['count(*)']." votes";
                }
                $_SESSION['id']=$dataF[0]['film_id'];
                $_SESSION['titre']=$dataF[0]['film_titre'];
                $_SESSION['iso']=$dataF[0]['film_iso'];
                $_SESSION['minutes']=$dataF[0]['film_minutes'];
                $_SESSION['annee']=$dataF[0]['film_annee'];
                $_SESSION['photo']=$dataF[0]['film_photo'];
                $_SESSION['realisateur']=$dataF[0]['film_realisateur'];
                $_SESSION['synopsis']=$dataF[0]['film_synopsis'];
       
          
                $url="pageFilm2.php";
                header("Location:".$url);
                exit();
            }
            else
            {
                session_start();
                if(count($dataA)>0)
                {
                    $_SESSION['id']=$dataA[0]['acteur_id'];
                    $_SESSION['unom']=$dataA[0]['acteur_nom'];
                    $_SESSION['iso']=$dataA[0]['acteur_iso'];
                    $_SESSION['photo']=$dataA[0]['acteur_photo'];
                }
                else 
                {
                    $_SESSION['id']=$dataR[0]['realisateur_id'];
                    $_SESSION['unom']=$dataR[0]['realisateur_nom'];
                    $_SESSION['iso']=$dataR[0]['realisateur_iso'];
                    $_SESSION['photo']=$dataR[0]['realisateur_photo'];
                }
                $url="individu2.php";
                header("Location:" . $url);
                exit();
            }
        }
        //sinon on affiche un message d'erreur
        else
        {  
            $erreur="Erreur de saisie! Votre recherche n'est pas sur notre site";
            session_start();
            $_SESSION['erreur']= $erreur;
            $url="Acceuil.php";//mettre les pages php
            header("Location:" . $url);
            exit();
        }
    }
    $url="Acceuil.php";//mettre les pages php
    header("Location:" . $url);
    exit();?>