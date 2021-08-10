<?php
    //evenement appuyer bouton se connecter
    if(isset($_POST['sauvegarder']) && ($_POST['sauvegarder']=='Sauvegarder'))
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
            $mail2=strval($_POST['email2']);
            $mdp=strval($_POST['password']);
          
            $msql = "UPDATE `UTILISATEUR` SET `utilisateur_mail` = '%s' WHERE utilisateur_mail='%s' AND utilisateur_mdp='%s' ";
            $sql = sprintf ($msql, $mail2, $mail, $mdp);
            
            $sth = $pdo->exec($sql);
           
            //si la modification c'est bien effectuer
            if($sth==1)
            {
                //on ouvre une session avec le nom et le prenom de l'utilisateur
                
                $erreur='Après avoir modifier votre mail vous devez vous identifier à nouveau. ^^';
                session_start();
                $_SESSION['ok']=$erreur;
                $url="Identification.php";
                header("Location:" . $url);

                exit();
            }
            //si mauvais email ou mdp 
            else
            {
                
                $erreur='Email ou mot de passe incorrect vous devez vous identifier à nouveau.';
                session_start();
                $_SESSION['erreur']=$erreur;
                
                $url="Identification.php";
                header("Location:" . $url);
                exit();
            }
            
        }
        else
        {

            $erreur='Erreur de saisie! Veuillez remplir tout les champs. Vous devez vous identifier à nouveau.';
    
            session_start();
            $_SESSION['erreur']=$erreur;
            
            $url="Identification.php";
            header("Location:" . $url);
            exit();
        }
    }

?>