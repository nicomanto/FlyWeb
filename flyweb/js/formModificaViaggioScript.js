//script che scarica i dati di un determinato viaggio per poi inserirli nel campi
//apposti del form per renderli modificabili
fetch('/pages/autocomplete.php', { method: 'POST' })
     .then(data => data.text())
     .then(
          function (data) {
               //console.log(data);
               document.getElementById('tagList').innerHTML = data;
          }
     )

