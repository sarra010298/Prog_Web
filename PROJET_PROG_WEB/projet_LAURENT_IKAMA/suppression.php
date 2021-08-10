<?php

    session_start();
    if(!isset($_SESSION['email']) && !isset($_SESSION['nom']) && !isset($_SESSION['prenom']))
    {
        $url="Acceuil.php";
        $_SESSION['erreur']="erreur suppression compte";
        header("Location:" . $url);
        /*echo "erreur";*/
        exit();
    }
    //on se connect a la bd
    $connexion=require('connect.php');
    if(!$connexion)
    {
        echo "erreur connexion bd\n";
        exit();
    }

  
    //supprimer le l'utilisateur de la base de donné
    
    $mail=$_SESSION['email'];
  
    $id=$pdo->query("SELECT utilisateur_id FROM `MESSAGE` JOIN UTILISATEUR ON utilisateur_id=`message_utilisateur` WHERE  utilisateur_mail='$mail'");
    $id2=$id->fetchAll(PDO::FETCH_ASSOC);
    $id3=$id2[0]['utilisateur_id'];

    $pdo->exec("DELETE FROM MESSAGE WHERE message_utilisateur=$id3");
    $pdo->exec("SET FOREIGN_KEY_CHECKS = OFF"); 
    $msql=" DELETE FROM UTILISATEUR WHERE utilisateur_mail='%s' ";
    $sql = sprintf ($msql, $mail);

    $count=$pdo->exec($sql); 
     $pdo->exec("SET FOREIGN_KEY_CHECKS = ON"); 
    if($count==1) //si la comande a ete execute on va a la page d'accueil avec une deconnexion
    {
        session_unset();
        session_destroy();

        $url="Acceuil.php";
        header("Location:" . $url);
        
        exit();
    }
    else
    {
        echo "erreur suppression\n";
    }
?>