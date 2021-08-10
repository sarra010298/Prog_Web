<?php

    //connexion à la base de données
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
    else
    {
        $mail=$_SESSION['email'];
                        //recherche dans la base de donnee l'utilisateur pour les préférences
            $msql = "SELECT couleur FROM UTILISATEUR WHERE utilisateur_mail='%s'";
            $sql = sprintf ($msql, $mail);
            $sth = $pdo->query($sql);
            $data = $sth->fetchAll(PDO::FETCH_ASSOC);
            $couleur=$data[0]['couleur'];
           $msql = "SELECT utilisateur_id FROM UTILISATEUR WHERE utilisateur_mail='%s'";
            $sql = sprintf ($msql, $mail);
            $sth = $pdo->query($sql);
            $data = $sth->fetchAll(PDO::FETCH_ASSOC);
            $utilisateur_id=$data[0]['utilisateur_id'];
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


        <!-- lien et style pour l'autocomplétion de la barre de recherche -->
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
        <script src="//code.jquery.com/jquery-1.12.4.js"></script>
        <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

         <!-- js pour certaine modification -->
         <script src="Preference.js" async ></script> 
         <script src="forum.js" async ></script> 
        <?php
           
     
            if(!isset($_SESSION['id']) && !isset($_SESSION['unom']) && !isset($_SESSION['iso']) && !isset($_SESSION['photo']) )
            {
                $url="Acceuil2.php";
                header("Location:" . $url);
                echo "erreur! </br>";
                exit();
            }

 
            

            /* ***************************************************************** */ 

            // récupérer ton les nom des film et indivu de la base de données pour l'autocomplétion de la barre de recherche
            $sqlF="SELECT film_titre FROM FILM";
            $sqlR="SELECT realisateur_nom FROM REALISATEUR";
            $sqlA="SELECT acteur_nom FROM ACTEUR";

            $sthF=$pdo->query($sqlF);
            $sthR=$pdo->query($sqlR);
            $sthA=$pdo->query($sqlA);
          
            $dataF= $sthF->fetchAll(PDO::FETCH_COLUMN,0);
            $dataR= $sthR->fetchAll(PDO::FETCH_COLUMN,0);
            $dataA= $sthA->fetchAll(PDO::FETCH_COLUMN,0);

            $dataC=array_merge($dataF, $dataR);
            $dataConcat=array_merge($dataC, $dataA);
           
            /* ***************************************************************** */ 
            //on cherche les films auquel l'individu a participer
           
            $msql='SELECT * FROM REALISATEUR WHERE realisateur_nom="%s"';
            $sql=sprintf ($msql, $_SESSION['unom']);
            $sth = $pdo->query($sql);
            $data = $sth->fetchAll(PDO::FETCH_COLUMN,0);

            if(count($data)>0)
            {
                $msql='SELECT film_photo FROM FILM JOIN REALISATEUR ON film_realisateur=realisateur_id WHERE realisateur_id="%s" ORDER BY film_annee';
                $sql=sprintf ($msql, $_SESSION['id']);
                $sth = $pdo->query($sql);
                $data = $sth->fetchAll(PDO::FETCH_COLUMN,0);
                
            }
            else 
            {
                $msql='SELECT film_photo FROM ACTEUR JOIN (FILM JOIN TRAVAILLE ON film_id=travaille_film) ON acteur_id=travaille_acteur WHERE acteur_id="%s" ORDER BY film_annee';
                $sql=sprintf ($msql, $_SESSION['id']);
                $sth = $pdo->query($sql);
                $data = $sth->fetchAll(PDO::FETCH_COLUMN,0);
                
            }
           
        ?>
        <title><?php echo $_SESSION['unom']; ?></title> 
    </head>
    <body>
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <div id="header">
                    <input type="hidden" id='couleur' value='<?php echo  $couleur; ?>'>
                    <input type="hidden" id='infoForum' value='<?php echo  $_SESSION['unom']; ?>'>
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
                                    <input type=" search" name="quoi" id="recherche" autocomplete="on" placeholder="Rechercher un film ou un individu"  />    <!--onkeydown=if (event.keyCode == 13) document.getElementById('bouton').click()-->

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
                           <div class="col-6 col-lg-4 col-md-4 d-flex justify-content-start justify-content-md-end">
                                <img src="image/<?php echo $_SESSION['photo'];?>.png" alt="affiche de l'individu" id="afficheFilm"/> 
                           </div>
                           <div class="col-4 col-lg-4 col-md-4 offset-1 offset-sm-0">
                                <p id="informationsFilm">
                                    Nom: <?php echo $_SESSION['unom']; ?><br>
                                    Nationalité: <?php echo $_SESSION['iso']; ?>   
                                </p>
                            </div>
                            <div class="col-sm-12 col-lg-4 col-md-4 col-xl-3 d-flex justify-content-center align-items-center">
                                <div class="classement" id="forum">
                                    <div class="headClassement"> <h4>Forum</h4> </div>
                                    <div class="mess1" id="messages">
                                        <?php 
                                            //on affiche les derniers messages du forums
                                            $requete = $pdo->query("SELECT message_id, utilisateur_nom, utilisateur_prenom, message_valeur, utilisateur_id
                                            FROM(((MESSAGE JOIN UTILISATEUR ON utilisateur_id=message_utilisateur ) LEFT OUTER JOIN FILM ON film_id=`message_film`)  LEFT OUTER JOIN ACTEUR ON acteur_id=`message_acteur` )  LEFT OUTER JOIN REALISATEUR ON realisateur_id=`message_realisateur` 
                                            WHERE acteur_nom LIKE '%".$_SESSION['unom']."%' OR REALISATEUR_nom LIKE '%".$_SESSION['unom']."%' 
                                                             
                                            ORDER BY message_id DESC");

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
                                                <input type="text" name="message" id="InputAvis" placeholder="Envoyez votre message !" />
                                                <input type="hidden" name="utilisateur" value="'.$utilisateur_id.'" id="utilisateur" />
                                                <input type="hidden" name="individu" value="'.$_SESSION['unom'].'"id="individu"/>
                                                <input type="hidden" name="id" value="'.$_SESSION['id'].'"id="idu"/>
                                                <input type="submit" name="submit" class="mess" value="Envoyez votre message !" id="envoi"/>
                                                ';
                                                
                                            }
                                        ?> 
                                       
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row text-center">
                            <p id="titreFilmogrparagraphie">
                                <h3>Filmographie</h3>
                            </p>
                        </div>

                        <div class="row justify-content-around">
                           
                                <?php 
                                    for($i=0; $i<count($data); $i+=1)
                                    {
                                        echo "

                                        <div class='col-6 col-md-2 d-flex align-items-center'>
                                            <div class='filmographie'>
                                                <img src='image/".($data[$i]+1).".png' alt='affiche du film' id='imageFilmogragraphie'/>
                                            </div>
                                        </div>
                                        
                                        
                                        ";
                                    }      
                                ?>
                     
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