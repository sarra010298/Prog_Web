<?php

    //connxion à la base de données
    $connexion=require('connect.php');
    if(!$connexion)
    {
        echo "erreur connexion bd\n";
        exit();
    }

    $requete = $pdo->query("SELECT message_id, utilisateur_nom, utilisateur_prenom, message_valeur, utilisateur_id
    FROM(((MESSAGE JOIN UTILISATEUR ON utilisateur_id=message_utilisateur ) LEFT OUTER JOIN FILM ON film_id=`message_film`)  LEFT OUTER JOIN ACTEUR ON acteur_id=`message_acteur` )  LEFT OUTER JOIN REALISATEUR ON realisateur_id=`message_realisateur` 
    WHERE acteur_nom LIKE '%".$_POST['unom']."%' OR REALISATEUR_nom LIKE '%".$_POST['unom']."%' OR film_titre LIKE '%".$_POST['unom']."%'
    ORDER BY message_id DESC");

?>
<html lang="fr">
    <div id='reponse'> <?php 
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
?> </div>
</html>