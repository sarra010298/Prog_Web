<?php
    session_start();
    if(!isset($_SESSION['email']) && !isset($_SESSION['nom']) && !isset($_SESSION['prenom']) && !isset($_SESSION['couleur']))
    {
        $url="Acceuil.php";
        header("Location:" . $url);
        exit();
    }
    $mail=$_SESSION['email'];
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Preferences</title>

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
         <!-- CSS -->
        <link rel="stylesheet" href="style2.css"/>
        
        <!-- lien et style pour l'autocomplétion de la barre de recherche -->
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
        <script src="//code.jquery.com/jquery-1.12.4.js"></script>
        <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    
        <!-- Php pour récupérer ton les nom des film et indivu de la base de données pour l'autocomplétion de la barre de recherche -->
        <?php
            //connection a la base de donnee
            $connexion=require('connect.php');
            if(!$connexion)
            {
                echo "erreur connexion bd\n";
                exit();
            }
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
            //recherche dans la base de donnee l'utilisateur pour les préférences
            $msql = "SELECT couleur FROM UTILISATEUR WHERE utilisateur_mail='%s'";
            $sql = sprintf ($msql, $mail);
            $sth = $pdo->query($sql);
            $data = $sth->fetchAll(PDO::FETCH_ASSOC);
            $couleur=$data[0]['couleur'];
        ?>
        <!-- js pour certaine modification -->
        <script src="Preference.js" async ></script> 
    </head>
    <body>
        <div class="container-fluid">
            <div class="row"><!--Le haut de la page-->
                <div class="col ">
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
                                            minLength: 3});
                                    </script>
                                </form>  
                            </div>
                            <div class="col-sm-12 col-md-4 col-lg-4 text-center"> <!-- lien Identification -->
                                <div class="col-6 offset-3">
                                    <a href="deconnexion.php" title="deconnection">
                                        <h4>Déconnection</h4>
                                    </a>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <div id="content">
                        <div class="row justify-content-around align-items-center" >
                            <div class="col-sm-12 col-lg-6 col-md-6 col-xl-5 offset-xl-1" style="height:50%"> <!-- Connection -->
                                
                                        
                                <div> <!-- faire un fichier traimement. php qui traite les identifications-->
                                    <p>
                                        <div class="bloc">
                                            <div class="headBloc"><h3 id="pref1">Modifier votre profil</h3>  <?php echo htmlentities(trim($_SESSION['prenom'])); echo " "; echo htmlentities(trim($_SESSION['nom'])); ?> </div>
                                            <form method="post" action="profilPreference_mail.php" >
                                                <input type="hidden" name="email" value="<?php echo $_SESSION['email'];?>"/>
                                                <input type="email" name="email2" placeholder="MODIFiCATION EMAIL"/>
                                                <input type="password" name="password" placeholder="MOT DE PASSE"/>
                                                <input type="submit" name="sauvegarder" id="button" value="Sauvegarder"/>
                                            </form>

                                            <form method="post" action="profilPreference_mdp.php" >
                                                <input type="hidden" name="email" value="<?php echo $_SESSION['email'];?>"/>
                                                <input type="password" name="password2" placeholder="MODIFICATION MOT DE PASSE"/>
                                                <input type="password" name="password" placeholder="MOT DE PASSE"/>
                                                <input type="submit" name="sauvegarder2" id="button" value="Sauvegarder"/>
                                            </form>
                                        </div>
                                    </p>
                                </div>
                                  
                                
                            </div>
                            
                            <div class="col-sm-12 col-lg-6 col-md-6 col-xl-5" style="height:50%"><!-- inscription-->
                                
                                    <p>
                                        <div class="bloc">
                                            <div class="headBloc"><h3 id="pref2">Préférences</h3></div>
                                            <div class="contentInput">
                                                <p>THÈME PAGES</p>
                                                <form method="post" action="modification.php">  
                                                    <input name='email' type='hidden' id='mail' value="<?php echo $_SESSION['email'];?>">
                                                    <nav>
                                                        <ul>
                                                            <li><button type="button" class="btncolor" data-ref="0"></button></li>
                                                            <li><button type="button" class="btncolor red" data-ref="1"> </li>
                                                            <li><button type="button" class="btncolor blue" data-ref="2"></button></li>
                                                            <li><button type="button" class="btncolor green" data-ref="3"></button></li>
                                                            <li><button type="button" class="btncolor yellow" data-ref="4"></button></li>
                                                            <li><button type="button" class="btncolor pink" data-ref="5"></button></li>
                                                            <li><button type="button" class="btncolor gray" data-ref="6"></button></li>
                                                        </ul>
                                                    </nav>
                                                <div style="height:50px"></div>
                                                <p>THÈME FORUM</p>
                                               
                                                <!-- Selection de police -->

                                                <select name="Police" id="police" onchange="myFunction(this)">
                                                    <option value="Arial">Arial</option>
                                                    <option value="Arial Black">Arial Black</option>
                                                    <option value="Bookman">Bookman</option>
                                                    <option value="cursive">cursive</option>
                                                    <option value="Courier">Courier</option>
                                                    <option value="Comic Sans MS">Comic Sans MS</option>
                                                    <option value="Courier New">Courier New</option>
                                                    <option value="Garamond">Garamond</option>
                                                    <option value="Georgia">Georgia</option>
                                                    <option value="Impact">Impact</option>
                                                    <option value="Lucida Sans">Lucida Sans</option>
                                                    <option value="Palatino">Palatino</option>
                                                    <option value="sans-serif">sans-serif</option>
                                                    <option value="Times New Roman">Times New Roman</option>
                                                    <option value="Trebuchet MS">Trebuchet MS</option>
                                                    <option value="Verdana">Verdana</option>
                                                </select>
                                                
                                                
                                            </div><!--
                                            <input type="button" id="button" value="Sauvegarder"/>-->
                                        </div>
                                    </p>
                                
                            </div>
                        </div>
                        <div class="row"><!--Pied de page -->
                            <div class="col-lg-2 offset-lg-10 col-md-2 offset-md-10 col-sm-2 offset-sm-9">
                                <p ><br/><a href="suppression.php" title="supprimer votre compte" class="liens" > Supprimer Compte </a></p>       
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row"><!--Pied de page -->
                <div class="col">
                    <div id="footer">
                    </div>
                </div>
            </div>


        </div>
    </body>
</html>