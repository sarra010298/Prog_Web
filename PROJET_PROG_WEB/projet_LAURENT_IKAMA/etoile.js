function avis(str)
{
    var etoilef=str;
    $("#etoilem").load("avis.php  #reponse",{ etoile: etoilef},true);
}