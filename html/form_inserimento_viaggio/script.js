
var daInviare = "";
//invia una richiesta POST ad autocomplete.php: riceve la lista dei tag e la inserisce della datalist
fetch('../../pages/autocomplete.php', { method: 'POST' })
     .then(data => data.text())
     .then(
          function (data) {
               //console.log(data);
               document.getElementById('tagList').innerHTML = data;
          }
     )


//funzione attivata al click del bottone 'aggiungi tag': aggiunge il tag e rimuove la option dalle disponibili del datalist
function aggiungiTag() { 

     var s = document.getElementById("addTagAutocomplete").value;
     var pos = document.getElementById("addTagAutocomplete").selectedIndex;

     document.getElementById(s).remove();

     document.getElementById('tagInseriti').textContent+="#"+s+" ";
     //console.log(document.getElementById('some').value);
     document.getElementById('daInviare').value+=s+";";
     //console.log(document.getElementById('daInviare').value);
     document.getElementById('addTagAutocomplete').value="";

     //console.log(s);
}


//funzione per inviare la stringa dei tag
function inviaTag() {
     console.log("!");
}

//console.log servivano per debug