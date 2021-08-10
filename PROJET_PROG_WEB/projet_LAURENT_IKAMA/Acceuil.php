<?php
            //connection a la base de donnee
            $connexion=require('connect.php');
            if(!$connexion)
            {
                echo "erreur connexion bd\n";
                exit();
            }
            session_start();
            $test=true;
            if(!isset($_SESSION['email']) || !isset($_SESSION['nom']) || !isset($_SESSION['prenom']))
            {
              $test=false;         
            }
            else {
                
            $mail=$_SESSION['email'];
                        //recherche dans la base de donnee l'utilisateur pour les préférences
            $msql = "SELECT couleur FROM UTILISATEUR WHERE utilisateur_mail='%s'";
            $sql = sprintf ($msql, $mail);
            $sth = $pdo->query($sql);
            $data = $sth->fetchAll(PDO::FETCH_ASSOC);
            $couleur=$data[0]['couleur'];
            }
           
?>
<!doctype html>
<html lang="fr">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Acceuil</title>

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
       
       
         <!-- ********************************************** CSS ********************************************** -->
         <!-- CSS pour le style de la page -->
        <link rel="stylesheet" href="style2.css"/>
        
         <!-- ********************************************** lien et style pour l'autocomplétion de la barre de recherche ********************************************** -->
         <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
         <script src="//code.jquery.com/jquery-1.12.4.js"></script>
         <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

        
        
        <!-- ********************************************** PHP ********************************************** -->
        <!-- Php pour récupérer les nom des film et indivu de la base de données pour l'autocomplétion de la barre de recherche -->

        <?php
            
            //printf("connection ok");
            //echo "<br/>";

            $sqlF="SELECT film_titre FROM FILM";
            $sqlR="SELECT realisateur_nom FROM REALISATEUR";
            $sqlA="SELECT acteur_nom FROM ACTEUR";

            $sthF=$pdo->query($sqlF);
            $sthR=$pdo->query($sqlR);
            $sthA=$pdo->query($sqlA);
          
            $dataF= $sthF->fetchAll(PDO::FETCH_COLUMN,0);
            //print_r($dataF);
            //echo "<br/>";
            $dataR= $sthR->fetchAll(PDO::FETCH_COLUMN,0);
            $dataA= $sthA->fetchAll(PDO::FETCH_COLUMN,0);

            $dataC=array_merge($dataF, $dataR);
            $dataConcat=array_merge($dataC, $dataA);
            //print_r($dataConcat);
            //echo "<br/> <br/>";
        ?>
        
        <!-- PhP pour récupérer les 3 différents carousel de cette page -->
        <?php

            //On regarde combien de film il y a dans la base de donnee
            $sql = "SELECT * FROM FILM";
            
            //echo $sql;
            //echo "<br/>";
            $sth = $pdo->query($sql);
            $data = $sth->fetchAll(PDO::FETCH_ASSOC);
            $n=count($data);
            //echo $n;

            //on selectionne les trois derniers film
            $premier=$n-2;
            $deuxieme=$n-1;
            $troisieme=$n;

            $msql = "SELECT * FROM FILM WHERE film_id='$premier' ";
            $nsql = "SELECT * FROM FILM WHERE film_id='$deuxieme' ";
            $ksql = "SELECT * FROM FILM WHERE film_id='$troisieme' ";

            $sth1 = $pdo->query($msql);
            $sth2 = $pdo->query($nsql);
            $sth3 = $pdo->query($ksql);

            $film1 = $sth1->fetchAll(PDO::FETCH_ASSOC);
            $film2 = $sth2->fetchAll(PDO::FETCH_ASSOC);
            $film3 = $sth3->fetchAll(PDO::FETCH_ASSOC);

            //echo "ici";
            //echo "</br>";
            $nom_film1 = $film1[0]['film_titre'];
            $nom_film2 = $film2[0]['film_titre'];
            $nom_film3 = $film3[0]['film_titre'];

            $id_film1 = $film1[0]['film_photo'];
            $id_film2 = $film2[0]['film_photo'];
            $id_film3 = $film3[0]['film_photo'];
          


            // on selection trois acteurs au hasard
            $sql ="SELECT count(*) FROM `ACTEUR`";
            $sth = $pdo->query($sql);
            $data = $sth->fetchAll(PDO::FETCH_ASSOC);
            $count=$data[0]['count(*)'];
            $i=0;
            while($i<3)
            {
                $acteur[$i]['id']=rand(1,$count);
                if($i==1 && $acteur[$i]['id']==$acteur[$i-1]['id'])
                {
                    while($acteur[$i]['id']==$acteur[$i-1]['id'])
                    {
                        $acteur[$i]['id']=rand(1,$count);
                    }
                }
                else if($i==2 && ( $acteur[$i]['id']==$acteur[$i-1]['id'] || $acteur[$i]['id']==$acteur[$i-2]['id'] ))
                {
                    while( $acteur[$i]['id']==$acteur[$i-1]['id'] || $acteur[$i]['id']==$acteur[$i-2]['id'])
                    {
                        $acteur[$i]['id']=rand(1,$count);
                    }
                }
                $sth = $pdo->query("SELECT `acteur_nom` FROM `ACTEUR` WHERE`acteur_id`='".$acteur[$i]['id']."'");
                $data = $sth->fetchAll(PDO::FETCH_ASSOC);
                $acteur[$i]['nom']=$data[0]['acteur_nom'];
                //echo $data[0]['acteur_nom']." ".$acteur[$i]['id']."<br>";
                $i=$i+1;
            }

             // on selection trois realisateur au hasard
            $sql ="SELECT count(*) FROM `REALISATEUR`";
            $sth = $pdo->query($sql);
            $data = $sth->fetchAll(PDO::FETCH_ASSOC);
            $count=$data[0]['count(*)'];
            $i=0;
            while($i<3)
            {
                $realisateur[$i]['id']=rand(1,$count);
                if($i==1 && $realisateur[$i]['id']==$realisateur[$i-1]['id'])
                {
                    while($realisateur[$i]['id']==$realisateur[$i-1]['id'])
                    {
                        $realisateur[$i]['id']=rand(1,$count);
                    }
                }
                else if($i==2 && ( $realisateur[$i]['id']==$realisateur[$i-1]['id'] || $realisateur[$i]['id']==$realisateur[$i-2]['id'] ))
                {
                    while( $realisateur[$i]['id']==$realisateur[$i-1]['id'] || $realisateur[$i]['id']==$realisateur[$i-2]['id'])
                    {
                        $realisateur[$i]['id']=rand(1,$count);
                    }
                }
                $sth = $pdo->query("SELECT `realisateur_nom` FROM `REALISATEUR` WHERE`realisateur_id`='".$realisateur[$i]['id']."'");
                $data = $sth->fetchAll(PDO::FETCH_ASSOC);
                $realisateur[$i]['nom']=$data[0]['realisateur_nom'];
               //echo $data[0]['realisateur_nom']." ".$realisateur[$i]['id'];
                $i=$i+1;
            }
            
            //on veut afficher les 10 meilleurs films du site

            $meilleur = $pdo->query("SELECT SUM(etoile_nombre)as maxi ,etoile_film FROM ETOILE GROUP BY etoile_film ORDER BY maxi DESC");
            $dix= $meilleur->fetchAll(PDO::FETCH_ASSOC);

        ?> 
         <!-- ********************************************** script js ********************************************** -->

         <!-- script qui permet de modifier le script en fonction des choix de l'utilisateur connecté à son compte -->
        <script src="Preference.js" async ></script> 

        <!-- script qui permet de modifier les images et les noms/titres des carousels des 3 derniers de la base de donnees films et individus  aleatoires -->
        <script> 
            /*gestion du grand carousel pour les films*/
            var titre = new Array("<?php echo $nom_film1; ?>", "<?php echo $nom_film2; ?>", "<?php echo $nom_film3; ?>");
            var image = new Array("<?php echo "image/$id_film1.png"; ?>", "<?php echo "image/$id_film2.png"; ?>", "<?php echo "image/$id_film3.png"; ?>");
            
            var tabnum = 0;
            function Imagesens(sens) {
                tabnum = tabnum + sens;
                if (tabnum < 0)
                    tabnum = image.length - 1;
                if (tabnum > image.length - 1)
                    tabnum = 0;
                document.getElementById("Image").src = image[tabnum];
                document.getElementById("button").value = titre[tabnum];
                document.getElementById("2").value = titre[tabnum];
                
            }
            var time= setInterval("Imagesens(1)", 5000);

            function Imagesens2(sens) {
                clearInterval(time);
                clearInterval(time);
                
                tabnum = tabnum + sens;
                if (tabnum < 0)
                    tabnum = image.length - 1;
                if (tabnum > image.length - 1)
                    tabnum = 0;
                document.getElementById("Image").src = image[tabnum];
                document.getElementById("button").value = titre[tabnum];
                document.getElementById("2").value = titre[tabnum];
            }
            
            /*gestion du petit carousel pour les acteur et réalisateur*/
            var nom = new Array("<?php echo $acteur[0]['nom']; ?>","<?php echo $realisateur[0]['nom']; ?>", "<?php echo $acteur[1]['nom']; ?>","<?php echo $realisateur[1]['nom']; ?>", "<?php echo $acteur[2]['nom']; ?>","<?php echo $realisateur[2]['nom']; ?>");
            var imageIndividu = new Array("<?php echo "image/A".$acteur[0]['id'].".png"; ?>", "<?php echo "image/R".$realisateur[0]['id'].".png"; ?>","<?php echo "image/A".$acteur[1]['id'].".png"; ?>", "<?php echo "image/R".$realisateur[1]['id'].".png"; ?>","<?php echo "image/A".$acteur[2]['id'].".png"; ?>","<?php echo "image/R".$realisateur[2]['id'].".png"; ?>");

            var tabnum2 = 0;
            function ImageIndividu(sens) 
            {
                tabnum2 = tabnum2 + sens;
                if (tabnum2 < 0)
                    tabnum2 = imageIndividu.length - 1;
                if (tabnum2 > imageIndividu.length - 1)
                    tabnum2 = 0;
                document.getElementById("individu").src = imageIndividu[tabnum2];
                document.getElementById("button2").value = nom[tabnum2];
                document.getElementById("3").value = nom[tabnum2];
                
            }
            var time2= setInterval("ImageIndividu(1)", 5000);

            function ImageIndividu2(sens) 
            {
                clearInterval(time2);
                
                tabnum2 = tabnum2 + sens;
                if (tabnum2 < 0)
                    tabnum2 = imageIndividu.length - 1;
                if (tabnum2 > imageIndividu.length - 1)
                    tabnum2 = 0;
                document.getElementById("individu").src = imageIndividu[tabnum2];
                document.getElementById("button2").value = nom[tabnum2];
                document.getElementById("3").value = nom[tabnum2];
            }
        </script>    
    </head>
    <body>
        <?php 
     
            if(isset($_SESSION['erreur']) && !empty($_SESSION['erreur']))
            {
                echo '
                <div class="alert alert-danger" role="alert">'.
                $_SESSION['erreur']
                .'</div>';
                $_SESSION['erreur']=NULL;

            }
            //session_destroy();
        ?>
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <div id="header">
                        <input type="hidden" id='couleur' value='<?php echo  $couleur; ?>'>
                        <div class="row align-items-center g-0" style="height:90%">
                            <div class="col-sm-12 col-md-4 col-lg-4"> <!-- lien page d'accueil -->
                                <div class="myAllocine">
                                    <a href="Acceuil.php" title="retour accueil" _parent> 
                                        <h1>myAllocine</h1> 
                                    </a> 
                                </div>
                               
                            </div>
                            <div class="col-sm-12 col-md-4 col-lg-4 align-self-end"> <!-- Barre de recherche -->
                                <form method="post" action="recherche.php" id="barreRecherche">
                                    <input type=" search" name="quoi" id="recherche" autocomplete="on" placeholder="Rechercher un film ou un individu"  onkeydown="if (event.keyCode == 13) document.getElementById('bouton').click()"/>    

                                    <!-- autocomplétion -->
                                    <script>
                                        
                                    <?php  
                                            echo "var tab =";
                                            echo ' "'.implode("<>", array_values($dataConcat) ).'" ';
                                            echo ".split('<>');";
                                    ?>
                                        $( "#recherche" ).autocomplete({
                                            source: tab,
                                            minLength: 3
                                        });
                                    </script>
                                </form>  
                            </div>
                            <div class="col-sm-12 col-md-4 col-lg-4 text-center"> <!-- lien Identification -->
                                <div class="col-6 offset-3">
                                    <div id="ID">
                                        <?php 
                                            if($test)
                                            {
                                                echo '
                                                <a href="profilPreference.php" title="Identification" id="liens">
                                                    <p> <h1 style="margin-bottom:-40px;margin-top:-15px">Profil</h1> <br>'.htmlentities(trim($_SESSION['prenom']))." ".htmlentities(trim($_SESSION['nom'])).'</a>';
                                            }
                                            else
                                            {
                                                echo '
                                                <a href="Identification.php" title="Identification">
                                                    <h3>Identification</h3>
                                                </a>';
                                            }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>

            <div class="row">
                <div class="col ">
                    <div id="content">
                        <div class="row justify-content-around align-items-center" ><!-- ligne pour le corousel -->
                            <div class="col-md-10 col-lg-10 col-sm-12 col-xl-5" style="height:500px; width:95%">
                                <div class="carousel">

                                    <div class="item">
                                        
                                        <div class="item_image">
                                            <img src="<?php echo "image/$id_film1.png"; ?>" alt="imgage film" id="Image" />
                                            <img src="image/flecheGauche.png" alt="fleche gauche" id="gauche" onclick="Imagesens2(-1)"/>
                                            <img src="image/flecheDroite.png" alt="fleche doite" id="droite" onclick="Imagesens2(1)"/>
                                        </div>
                                        <div class="item_body">
                                            
                                            <form method="post" action="recherche.php">
                                                <input id="2" name="quoi" type="hidden" value="<?php echo $nom_film1; ?>">
                                                <input type="submit" class="item_titre" name="connexion" id="button" value="<?php echo $nom_film1; ?>">
                                            </form>
                                              
                                        </div>
                                        
                                        
                                    </div>
                                
                                </div>  
                            </div>
                        </div>
                        <div class="row justify-content-center align-items-start" style="height:30%;"><!-- ligne pour les deux petits carousel -->
                            
                            <div class="col-sm-12 col-md-5 col-lg-5 col-xl-4"> <!-- carousel test css des dix meilleurs films du site -->
                                <div class="classement">
                                    <div class="headClassement">
                                        <h4>Les 10 meilleures films </h4>
                                    </div>
                                    
                                    <div class="classement-item">
                                        <input type="radio" name="slider" id="item-1" checked>
                                        <input type="radio" name="slider" id="item-2">
                                        <input type="radio" name="slider" id="item-3">
                                        <input type="radio" name="slider" id="item-4">
                                        <input type="radio" name="slider" id="item-5">
                                        <input type="radio" name="slider" id="item-6">
                                        <input type="radio" name="slider" id="item-7">
                                        <input type="radio" name="slider" id="item-8">
                                        <input type="radio" name="slider" id="item-9">
                                        <input type="radio" name="slider" id="item-10">
                                        <div class="cards">
                                             <label class="card" for="item-1" id="film-1">
                                                <img src="image/<?php echo $dix[0]['etoile_film']*10+1;?>.png" alt="film 1">
                                            </label>
                                            <label class="card" for="item-2" id="film-2">
                                                <img src="image/<?php echo $dix[1]['etoile_film']*10+1;?>.png" alt="film 2">
                                            </label>
                                            <label class="card" for="item-3" id="film-3">
                                                <img src="image/<?php echo $dix[2]['etoile_film']*10+1;?>.png" alt="film 3">
                                            </label>
                                            <label class="card" for="item-4" id="film-4">
                                                <img src="image/<?php echo $dix[3]['etoile_film']*10+1;?>.png" alt="film 4">
                                            </label>
                                            <label class="card" for="item-5" id="film-5">
                                                <img src="image/<?php echo $dix[4]['etoile_film']*10+1;?>.png" alt="film 5">
                                            </label>
                                            <label class="card" for="item-6" id="film-6">
                                                <img src="image/<?php echo $dix[5]['etoile_film']*10+1;?>.png" alt="film 6">
                                            </label>
                                            <label class="card" for="item-7" id="film-7">
                                                <img src="image/<?php echo $dix[6]['etoile_film']*10+1;?>.png" alt="film 7">
                                            </label>
                                            <label class="card" for="item-8" id="film-8">
                                                <img src="image/<?php echo $dix[7]['etoile_film']*10+1;?>.png" alt="film 8">
                                            </label>
                                            <label class="card" for="item-9" id="film-9">
                                                <img src="image/<?php echo $dix[8]['etoile_film']*10+1;?>.png" alt="film 9">
                                            </label>
                                            <label class="card" for="item-10" id="film-10">
                                                <img src="image/<?php echo $dix[9]['etoile_film']*10+1;?>.png" alt="film 10">
                                            </label>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            
                            <div class="col-md-5 col-lg-5 col-sm-12 col-xl-4" ><!-- carousel individu -->
                            
                                <div class="classement">
                                    <div class="headClassement">
                                        <h4>Acteurs et Réalisateurs</h4>
                                    </div>
                                    <div class="classement-item">
                                       
                                        <div class='row'>
                                            <div class="col-1">
                                            <p id="gauche" onclick="ImageIndividu2(-1)"><</p>
                                            </div>
                                            <div class="col-5">
                                            <img src="<?php echo "image/A".$acteur[0]['id'].".png"; ?>" alt='photo de' id="individu"/>

                                            </div>
                                            <div class="col-5 justify-content-center align-self-center">
                                            <form method="post" action="recherche.php">
                                                    <input id="3" name="quoi" type="hidden" value="<?php echo $acteur[0]['nom']; ?>">
                                                    <input type="submit" name="connexion" id="button2" value="<?php echo $acteur[0]['nom']; ?>" >
                                            </form>

                                            </div>
                                            <div class="col-1">
                                            <p id="droite" onclick="ImageIndividu2(1)">></p>
                                            </div>
                                        </div>

                                    </div>    
                                </div>
                                <script>
                                    
                                </script>
                            </div>
                            
                        </div>
                    </div>
                </div>
                
            </div>
            <div class="row">
                <div class="col">
                    <div id="footer">
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>