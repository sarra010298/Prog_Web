<?php

    //evenement appuyer bouton s'inscrire
    if(isset($_POST['inscription']) && ($_POST['inscription'] == 'S’inscrire'))
    {
        //on verifie que le formulaire est bien rempli
        if((isset($_POST['email']) && !empty($_POST['email'])) && (isset($_POST['password']) && !empty($_POST['password'])) && (isset($_POST['confpassword']) && !empty($_POST['confpassword'])) && ((isset($_POST['nom']) && !empty($_POST['nom'])) && (isset($_POST['prenom']) && !empty($_POST['prenom']))) )
        {
            //on verifie que les mots de passe sont identique
            if($_POST['password']==$_POST['confpassword'])
            {
                
                $connexion=require('connect.php');
                if(!$connexion)
                {
                    echo "erreur connexion bd\n";
                    exit();
                }
            

                // de l'existance possible ou non du nouvelle utilisateur
                $mail=strval($_POST['email']);
                $mdp=strval($_POST['password']);
                
                $msql = "SELECT * FROM UTILISATEUR WHERE utilisateur_mail='%s' ";
                $sql = sprintf ($msql, $mail);
                $sth = $pdo->query($sql);
                $data = $sth->fetchAll(PDO::FETCH_ASSOC);

                //si l'utilsateur extiste deja on ne cree pas de nouveau compte
                if(count($data) > 0)
                {
                    $erreur="l'email est déja utilisé extiste deja ";
                    session_start();
                    $_SESSION['erreur']=$erreur;
                    
                    $url="Identification.php";
                    header("Location:" . $url);

                    exit();
                }
                else
                {
                    
                    
                    $csql="SELECT Max(`utilisateur_id`) as id FROM `UTILISATEUR` ";
                    $sth1 = $pdo->query($csql);
                    $data1 = $sth1->fetchAll(PDO::FETCH_ASSOC);
                    $number=$data1[0]['id']+1;
                    
                    $nom=strval($_POST['nom']);
                    $premon=strval($_POST['prenom']);
                    
                    $msql2 = "INSERT INTO UTILISATEUR VALUES ('%s','%s','%s','%s','%s','','')";
                    $sql2 = sprintf ($msql2,$number,$nom,$premon,$mail,$mdp);
               
                   

                    //on verifie la que le nouvelle utilisateur a bien etait ajouter puis on va a la page d'accueil pour utilisateur
                     $bool=$pdo->exec($sql2); 

                     if($bool==false)
                     { 
                        $erreur="probleme insertion base de donnee";
                        session_start();
                        $_SESSION['erreur']=$erreur;
                    
                        $url="Identification.php";
                        header("Location:" . $url);
                         exit();
                     }
                    
                        
                    //on ouvre une session avec le nom et le prenom de l'utilisateur
                    session_start();

                    $_SESSION['email']=$mail;
                    $_SESSION['nom']=$nom;
                    $_SESSION['prenom']=$premon;
                    
                    $url="Acceuil.php";
                    header("Location:" . $url);

                    exit();
                    
                    
                }
            }
            else
            {
                $erreur='Vos mot de passe doit etre identique';
                session_start();
                $_SESSION['erreur']=$erreur;
                    
                $url="Identification.php";
                header("Location:" . $url);
                exit();
            }
        
        }
        else 
        {
            $erreur='Erreur de saisie! Veuillez remplir tout les champs.';
            session_start();
            $_SESSION['erreur']=$erreur;
            
            $url="Identification.php";
            header("Location:" . $url);
            exit();
        }
        
    }
?>