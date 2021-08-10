/* Changement de couleur dans la page preference */

"use strict";
// ref couleurs
const refcolors = ['base','red','blue','green','yellow','pink','gray']; // '' : par Défaut
// boutons
const btncolors = document.querySelectorAll('.btncolor');
btncolors.forEach( function(btncolor){
    btncolor.addEventListener( 'click', function(ev){
        ev.preventDefault();
        changecolor( refcolors[this.getAttribute('data-ref')] );
    });
});
            
function changecolor( refcolor ){
    refcolors.forEach( function(refcol)
    {
        if( refcol!='base')
        { 
            document.getElementsByTagName('body')[0].classList.remove(refcol); 
        }
    });
    if( refcolor!='base')
    { 
        document.getElementsByTagName('body')[0].classList.add(refcolor); 
    }
    //on modifie la couleur dans la base de donnees
    $(document).ready(function(){
        $("button").click(function(){  
            $.post("modification.php",
                    {
                        couleur: refcolor,
                        email: document.getElementById('mail').value
                    });
        });     
    });
} 
/* Changment de couleur pour tout les pages du site */
function changecolor2( refcolor ){
    refcolors.forEach( function(refcol)
    {
        if( refcol!='base')
        { 
            document.getElementsByTagName('body')[0].classList.remove(refcol); 
        }
        });
        if( refcolor!='base')
        { 
            document.getElementsByTagName('body')[0].classList.add(refcolor); 
        }
    } 

var couleur=document.getElementById('couleur').value

$(document).ready(function(){
    if( couleur!='')
        changecolor2(couleur);
});
   
/* Changement de police dans la page preference */

function myFunction(font) {
    var x = document.getElementById("police").value;
    document.getElementById("pref1").style.fontFamily= font.value;
    document.getElementById("police").setAttribute("style", "border: 1px solid red; outline: none");
    document.getElementById("pref2").style.fontFamily= font.value;
    document.getElementById("police").setAttribute("style", "border: 1px solid red; outline: none");
}

/******************************************************FORUM********************************************************************************************************* */

  
  