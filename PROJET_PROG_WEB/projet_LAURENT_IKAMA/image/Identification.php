<?php 
                if ( empty(session_id()) ) {
                     session_start();
                }
               
                if(isset($_SESSION['erreur']) && !empty($_SESSION['erreur']))
                {
                    echo '
                    <div class="alert alert-danger" role="alert">'.
                    $_SESSION['erreur']
                    .'</div>';


                }
                if(isset($_SESSION['ok']) && !empty($_SESSION['ok']))
                {
                    echo '
                    <div class="alert alert-success" role="alert">'.
                    $_SESSION['ok']
                    .'</div>';


                }
                session_destroy();
            ?>
<!DOCTYPE html>
<html>
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Identification</title>

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
         <!-- CSS -->
        <link rel="stylesheet" href="style2.css"/>
    </head>
    <body>
        <div class="container-fluid">
            <div class="row"><!--Le haut de la page-->
                <div class="col ">
                    <div id="header">
                        <div class="row align-items-center g-0" style="height:90%">
                            <div class="col-12"> <!-- lien page d'accueil -->
                                <div class="myAllocine">
                                    <a href="Acceuil.php" title="retour accueil" _parent > 
                                        <h1>myAllocine</h1> 
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

                            <div class="col-sm-12 col-lg-5 col-md-5 col-xl-5 " style="height:50%"> <!-- Connection -->
                                
                                    
                                <form method="post" action="connexion.php"> <!-- connexions-->
                                    <p>
                                        <div class="bloc">
                                            <div class="headBloc"><h3>Identifiez-vous</h3></div>
                                            <input type="email" name="email" placeholder="EMAIL" value=""/>
                                            <input type="password" name="password" placeholder="MOT DE PASSE" value=""/>
                                            <input type="submit" name="connexion" id="button" value="Se connecter">
                                        </div>
                                    </p>
                                </form>
                                  
                                
                            </div>
                            
                            <div class="col-sm-12 col-lg-5 col-md-5 col-xl-5" style="height:50%"><!-- inscription-->
                                <form method="post" action="inscription.php"> 
                                    <p>
                                        <div class="bloc">
                                            <div class="headBloc"><h3>Inscrivez-vous</h3></div>
                                            <div class="row justify-content-around">
                                                <div class=col-5>
                                                    <input type="text" name="nom" id="contentInput" placeholder="NOM" />
                                                </div>
                                                <div class=col-5>
                                                    <input type="text" name="prenom" id="contentInput" placeholder="PRENOM" />
                                                </div>
                                               
                                                
                                            </div>
                                            <input type="email" name="email" placeholder="EMAIL" />
                                            <input type="password" name="password" placeholder="MOT DE PASSE"/>
                                            <input type="password" name="confpassword" placeholder="CONFIRMATION MOT DE PASSE"/>
                                            <input type="submit"  name="inscription" id="button" value="S’inscrire">
                                        </div>
                                    </p>
                                </form>
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