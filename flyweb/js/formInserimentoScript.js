//alert("funziono!");
var daInviare = "";
//invia una richiesta POST ad autocomplete.php: riceve la lista dei tag e la inserisce della datalist come <option>
fetch('/pages/autocomplete.php', { method: 'POST' })
     .then(data => data.text())
     .then(
          function (data) {
               //console.log(data);
               document.getElementById('tagList').innerHTML = data;
          }
     )


//funzione attivata al click del bottone 'aggiungi tag': 
//   aggiunge il tag e rimuove la option dalle disponibili del datalist
//   inoltre aggiunge ad un <input type="hidden"> il tag (cosìcche possa inviaro a php tramite una post)
function aggiungiTag() { 

     var s = document.getElementById("addTagAutocomplete").value;
     var pos = document.getElementById("addTagAutocomplete").selectedIndex;

     document.getElementById(s).remove();

     document.getElementById('tagInseriti').textContent+="#"+s+" ";
     document.getElementById('tagDaInviare').value+=s+";";
     console.log(document.getElementById('daInviare').value);
     document.getElementById('addTagAutocomplete').value="";

     //console.log(s);
}

function conferma(){
     $popup_conferma = confirm("vuoi confermare il form?");
     return ($popup_conferma)?true:false;
}
