<?php
    session_start();
    //connxion à la base de données
    $connexion=require('connect.php');
    if(!$connexion)
    {
        echo "erreur connexion bd\n";
        exit();
    }
    $test=true;
    if(!isset($_SESSION['email']) || !isset($_SESSION['nom']) || !isset($_SESSION['prenom']))
    {
        $test=false;         
    }
    else
    {
         $mail=$_SESSION['email'];
         $msql = "SELECT utilisateur_id FROM UTILISATEUR WHERE utilisateur_mail='%s'";
        $sql = sprintf ($msql, $mail);
        $sth = $pdo->query($sql);
        $data = $sth->fetchAll(PDO::FETCH_ASSOC);
        $utilisateur_id=$data[0]['utilisateur_id'];
        //recherche dans la base de donnee l'utilisateur pour les préférences
            $msql = "SELECT couleur FROM UTILISATEUR WHERE utilisateur_mail='%s'";
            $sql = sprintf ($msql, $mail);
            $sth = $pdo->query($sql);
            $data = $sth->fetchAll(PDO::FETCH_ASSOC);
            $couleur=$data[0]['couleur'];
    }
   
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <!-- entête de la page-->
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">


         <!-- CSS -->
        <link rel="stylesheet" href="style2.css"/>

        <!-- js pour certaine modification -->
        <script src="Preference.js" async ></script> 
        <script src="etoile.js" async ></script> 
        <script src="forum.js" async ></script> 
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


        <!-- lien et style pour l'autocomplétion de la barre de recherche -->
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
        <script src="//code.jquery.com/jquery-1.12.4.js"></script>
        <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

        
        <!-- php pour récupere tout les informations du film-->
        <?php
            
            if(!isset($_SESSION['id']) && !isset($_SESSION['titre']) && !isset($_SESSION['minutes']) && !isset($_SESSION['iso']) && !isset($_SESSION['annee']) && !isset($_SESSION['photo']) && !isset($_SESSION['realisateur']) )
            {
                $url="Acceuil.php";
                header("Location:" . $url);
                echo "erreur! </br>";
                exit();
            }
            
            

            /* ***************************************************************** */ 

            //on cherche le realisateur
            $msql='SELECT realisateur_nom FROM REALISATEUR r JOIN FILM f on f.film_realisateur=r.realisateur_id WHERE r.realisateur_id= "%s" ';
            $sql=sprintf ($msql, $_SESSION['realisateur']);
            $sth = $pdo->query($sql);
            $data = $sth->fetchAll(PDO::FETCH_ASSOC);
            //echo $data;
            $realisateur= $data[0]['realisateur_nom'];

            //on cherche les catégories du film
            $msql='SELECT DISTINCT categorie_nom FROM CATEGORIE JOIN (EST e JOIN FILM f ON f.film_id=e.est_film)  ON est_categorie=categorie_id WHERE film_id="%s"';
            $sql=sprintf ($msql, $_SESSION['id']);
            $sth = $pdo->query($sql);
            $data2 = $sth->fetchAll(PDO::FETCH_COLUMN,0);

            //on cherche tous les acteurs qui ont participer au film
            $msql='SELECT DISTINCT acteur_nom FROM ACTEUR JOIN (TRAVAILLE t JOIN FILM f ON f.film_id=t.travaille_film )  ON travaille_acteur=acteur_id WHERE film_id="%s"';
            $sql=sprintf ($msql, $_SESSION['id']);
            $sth = $pdo->query($sql);
            $data3 = $sth->fetchAll(PDO::FETCH_COLUMN,0);

            //On cherche la bonne affiche
            $photo=$_SESSION['photo']+1;

            //on cherche la bonne bande annonce
            $film=$_SESSION['photo']/10;
            
            /* ***************************************************************** */ 

            // récupérer ton les nom des film et indivu de la base de données pour l'autocomplétion de la barre de recherche
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
        <title><?php echo $_SESSION['titre']; ?></title> 
    </head>
    <body>
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <div id="header">
                    <input type="hidden" id='infoForum' value='<?php echo  $_SESSION['titre']; ?>'>
                    <input type="hidden" id='couleur' value='<?php echo  $couleur; ?>';>
                    <div class="row align-items-center g-0" style="height:90%">
                            <div class="col-sm-12 col-md-4 col-lg-4"> <!-- lien page d'accueil -->
                                <div class="myAllocine">
                                    <a href="Acceuil.php" title="retour accueil" _parent > 
                                        <h1>myAllocine</h1> 
                                    </a> 
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-4 col-lg-4 align-self-end d-flex justify-content-center"> <!-- Barre de recherche -->
                                <form method="post" action="recherche.php" id="barreRecherche">
                                    <input type=" search" name="quoi" id="recherche" autocomplete="on" placeholder="Rechercher un film ou un individu"  onkeydown=if (event.keyCode == 13) document.getElementById('bouton').click()/>    

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
                <div class="col">
                    <div id="content">
                        <div class="row">
                            <div class="col align-items-center justify-content-center">
                                <div id="titreBoxFilm">
                                    <?php 
                                        echo '<h2 id="titreFilm">';
                                        echo $_SESSION['titre'];
                                        echo '</h2>'
                                    ?>
                                </div>
                            </div>
                        </div>

                        <div class="row justify-content-center">
                            <div class="col-md-4 col-lg-4 col-sm-10 col-xl-2"> <!-- l'image du film-->
                                <div class="d-flex justify-content-center justify-content-lg-end justify-content-md-end">
                                    <img src="image/<?php echo $photo; ?>.png" alt="affiche du film" id="afficheFilm"/>  
                                </div>
                            </div>
                            <div class="col-md-4 col-lg-4 col-sm-10 col-xl-5"> <!-- information du film-->
                               <div class="row">
                                    <p>
                                        Année: <?php echo $_SESSION['annee']; ?> <br>
                                        Réalisateur: <?php echo $realisateur; ?> <br>
                                        Acteurs: <?php echo implode(", ", $data3) ;?><br>
                                        Durée: <?php echo $_SESSION['minutes']; ?> minutes <br>
                                        Nationalité: <?php echo $_SESSION['iso']; ?> <br>
                                        Catégorie(s): <?php echo implode(", ", $data2) ;?> <br>
                                        <p id="etoilem">Note: <?php echo  $_SESSION['etoile']; ?> </p>
                                    </p>
                                </div>
                                <div class="row">
                                    <div id="resumeFilm">
                                        <h3 style="margin-bottom: -10px;"> Synopsis </h3> <br> 
                                        <?php echo  $_SESSION['synopsis']; ?> 
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-4 col-lg-4 col-sm-10 col-xl-3 align-items-center"> <!-- noter le film-->
                                <div class="d-flex justify-content-center"><!-- centrer au milieu de la colonne-->

                                    <div class="classementEtoile" id="Avisfilm">
                                    <div class="headClassement"> <h4>Donner votre avis</h4> </div>
                                        <div>
                                            <div class="EtoileBox">
                                                <input id="e5" type="image" class="etoile" name="etoile" alt="etoile5" src="image/star.png" value="5;<?php echo $_SESSION['titre']; ?>" onclick="avis(this.value)">
                                                <input id="e4" type="image" class="etoile" name="etoile" alt="etoile4" src="image/star.png" value="4;<?php echo $_SESSION['titre']; ?>" onclick="avis(this.value)">
                                                <input id="e3" type="image" class="etoile" name="etoile" alt="etoile3" src="image/star.png" value="3;<?php echo $_SESSION['titre']; ?>" onclick="avis(this.value)">
                                                <input id="e2" type="image" class="etoile" name="etoile" alt="etoile2" src="image/star.png" value="2;<?php echo $_SESSION['titre']; ?>" onclick="avis(this.value)">
                                                <input id="e1" type="image" class="etoile" name="etoile" alt="etoile1" src="image/star.png" value="1;<?php echo $_SESSION['titre']; ?>" onclick="avis(this.value)">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-between justify-content-xl-around">
                            <div class="col-md-5 col-lg-5 col-sm-10 col-xl-5 offset-xl-1"> <!-- video -->
                                <video src="video/v<?php echo $film; ?>.mp4.mp4" controls poster ="image/<?php echo $photo-1; ?>.png" width ="100%" > 
                                    Veuillez mettre à jour votre navigateur ! (message de secours)
                                </video >
                            </div>
                            <div class="col-md-4 col-lg-4 col-sm-10 col-xl-3 d-flex justify-content-center justify-content-xl-start">  <!-- noter forum-->
                            <div class="classement" id="forum">
                                    <div class="headClassement"> <h4>Forum</h4> </div>
                                    <div class="mess1" id="messages">
                                        <?php 
                                            //on affiche les 10 derniers messages du forums
                                             
                                            $requete = $pdo->query('SELECT message_id, utilisateur_nom, utilisateur_prenom, message_valeur, utilisateur_id
                                            FROM((MESSAGE JOIN UTILISATEUR ON utilisateur_id=message_utilisateur ) LEFT OUTER JOIN FILM ON film_id=`message_film`)  
                                            WHERE film_titre = "'.$_SESSION['titre'].'" ORDER BY message_id DESC');
               
                                           if($requete->rowCount()>0)
                                            {
                                                while($donnees = $requete->fetch()){
                                                    //on affiche le message
                                                    echo "<p id=\"" . $donnees['utilisateur_id'] . "\">" . $donnees['utilisateur_prenom']." ".$donnees['utilisateur_nom']." dit : " . $donnees['message_valeur'] . "</p>";
                                                }
                                            }
                                            else
                                            {                                              
                                                echo "<p> Personne n'a encore parlé sur ce forum ^^.</p>";
                                            }
                                            $requete->closeCursor();
                                        ?>
                                        
                                    </div>
                                    <div> 
                                    <?php
                                        if($test)
                                        {
                                             echo '
                                            <input type="hidden" name="utilisateur" value="'.$utilisateur_id.'" id="utilisateur" />
                                            <input type="hidden" name="film" value="'.$_SESSION['id'].'"id="filmu"/>
                                            <input type="text" name="message" id="InputAvis" placeholder="Envoyez votre message !" />
                                            <input type="submit" name="submit" class="mess" value="Envoyez votre message !" id="envoi2" />';
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
                <div class="col">
                    <div id="footer">
                    </div>
                </div>
            </div>

        </div>
    </body>

</html>