<?php

    echo $_POST['couleur'].'<br>';
    echo $_POST['email'];
   //on verifie que l'on a bien tout le donnees
    if((isset($_POST['email']) && !empty($_POST['email'])) && (isset($_POST['couleur']) && !empty($_POST['couleur'])))
    {
        //Connexion a la base de donnees myAllocine
        $connexion=require('connect.php');
        if(!$connexion)
        {
            echo "erreur connexion bd\n";
            exit();
        } 
        //recherche dans la base de donnee l'utilisateur
        $mail=strval($_POST['email']);
        $msql = "SELECT * FROM UTILISATEUR WHERE utilisateur_mail='%s'";
        $sql = sprintf ($msql, $mail);
        $sth = $pdo->query($sql);
        $data = $sth->fetchAll(PDO::FETCH_ASSOC);
        $id=$data[0]['utilisateur_id'];
        
        //on modifie la base de donne 
        if(count($data) == 1)
        {
           

            echo $id;
            //on modifie les valeurs

            $msql = "UPDATE `UTILISATEUR` SET `couleur` = '%s' WHERE `UTILISATEUR`.`utilisateur_id` = '%s';";
            $sql = sprintf ($msql, $_POST['couleur'],$id);
            $sth = $pdo->exec($sql);
        }
    }
    else
    {
        echo 'error';
    }
   
?>