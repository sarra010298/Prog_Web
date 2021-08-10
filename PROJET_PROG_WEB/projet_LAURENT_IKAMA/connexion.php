<?php
    //evenement appuyer bouton se connecter
    if(isset($_POST['connexion']) && ($_POST['connexion']=='Se connecter'))
    {
        //on verifie que le formulaire est bien rempli
        if((isset($_POST['email']) && !empty($_POST['email'])) && (isset($_POST['password']) && !empty($_POST['password'])))
        {
            //Connexion a la base de donnees myAllocine
            
            $connexion=require('connect.php');
            if(!$connexion)
            {
                echo "erreur connexion bd\n";
                exit();
            }
    

            //recherche dans la base de donnee
            $mail=strval($_POST['email']);
            $mdp=strval($_POST['password']);
            
            $msql = "SELECT * FROM UTILISATEUR WHERE utilisateur_mail='%s' AND utilisateur_mdp='%s' ";
            $sql = sprintf ($msql, $mail, $mdp);
            
           
            $sth = $pdo->query($sql);
           
            $data = $sth->fetchAll(PDO::FETCH_ASSOC);
            //si on a un resultat =>l'utilisateur existe on ouvre une session sur page d'accueil2
            //echo count($data);
         
            if(count($data) == 1)
            {
                //on ouvre une session avec le nom et le prenom de l'utilisateur
                session_start();

                $_SESSION['email']=$mail;
                $_SESSION['nom']=$data[0]['utilisateur_nom'];
                $_SESSION['prenom']=$data[0]['utilisateur_prenom'];
               
                
                $url="Acceuil.php";
                header("Location:" . $url);

                exit();
            }
            //si mauvais email ou mdp 
            elseif (count($data) == 0 )//Trouver le moyen de simplememt afficher un message d'erreur
            {
                
                $erreur='Email ou mot de passe incorrect';
                session_start();
                $_SESSION['erreur']=$erreur;
                
                $url="Identification.php";
                header("Location:" . $url);
                exit();
            }
            //sinon probleme dans bd
            else
            {
       
                $erreur='erreur Bd Plusieurs utilisateurs ont le meme mot de passe';
                session_start();
                $_SESSION['erreur']=$erreur;
                
                $url="Identification.php";
                header("Location:" . $url);
                exit();
            }
        }
        else
        {

            $erreur='Erreur de saisie! Veuillez remplir tout les champs';
    
            session_start();
            $_SESSION['erreur']=$erreur;
            
            $url="Identification.php";
            header("Location:" . $url);
            exit();
        }
    }

?>