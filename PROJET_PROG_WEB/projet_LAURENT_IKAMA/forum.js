/*var element=document.getElementById("messages");
element.scrollTop=element.scrollHeight;*/

function charger()
  {
    /*element.scrollTop=element.scrollHeight;*/
    $(".mess1").load("charger.php  #reponse", {
            unom: document.getElementById('infoForum').value});
  
  }
  

$('#envoi').click(function(){
  
   $.post("forum.php",{ 
                        message: document.getElementById('InputAvis').value,
                        utilisateur: document.getElementById('utilisateur').value,
                        individu: document.getElementById('individu').value,
                        id: document.getElementById('idu').value
                        });
   
    document.getElementById('InputAvis').value="";
    charger();
    charger();
  });

$('#envoi2').click(function(){
    $.post("forum.php",{ 
                        message: document.getElementById('InputAvis').value,
                        utilisateur: document.getElementById('utilisateur').value,
                        film: document.getElementById('filmu').value,
                        });
    document.getElementById('InputAvis').value="";
    charger();
    charger();
});
   
  setInterval("charger()", 2000); 