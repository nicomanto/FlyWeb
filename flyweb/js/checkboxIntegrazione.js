//alert("funziono!");
var daInviare = "";
//invia una richiesta POST ad autocomplete.php: riceve la lista dei tag e la inserisce della datalist come <option>
fetch('/html/components/autocompleteIntegrazione.php', { method: 'POST' })
     .then(data => data.text())
     .then(
          function (data) {
               //console.log(data);
               document.getElementById('integrazioniList').innerHTML = data;
          }
     )


//funzione attivata al click del bottone 'aggiungi tag': 
//   aggiunge il tag e rimuove la option dalle disponibili del datalist
//   inoltre aggiunge ad un <input type="hidden"> il tag (cosìcche possa inviaro a php tramite una post)
function aggiungiIntegrazione(){ 

     var s = document.getElementById("addIntegrazioniAutocomplete").value;
     var pos = document.getElementById("addIntegrazioniAutocomplete").selectedIndex;

     document.getElementById(s).remove();

     document.getElementById('integrazioniInserite').textContent+="#"+s+" ";
     document.getElementById('integrazioniDaInviare').value+=s+";";
     console.log(document.getElementById('daInviare').value);
     document.getElementById('addIntegrazioniAutocomplete').value="";

     //console.log(s);
}