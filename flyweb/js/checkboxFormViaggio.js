//invia una richiesta POST ad autocomplete.php: riceve la lista dei tag e la inserisce della datalist come <option>
fetch('/html/components/checkboxIntegrazioniFormViaggio.php', { method: 'POST' })
     .then(data => data.text())
     .then(
          function (data) {
               //console.log(data);
               document.getElementById('checkboxIntegrazioniFormViaggio').innerHTML = data;
          }
     )


//funzione attivata al click del bottone 'aggiungi tag': 
//   aggiunge il tag e rimuove la option dalle disponibili del datalist