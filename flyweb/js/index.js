//#region APPROVA RECENSIONE
function approva(id){
    const data =    {  
                        id_recensione: id,
                        tipo_richiesta: "approvazione"
                    };

    fetch('/html/components/AdmApprovaReview.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(data)

    }).then(data => data.text())
    .then(
        function (data) {
            document.getElementById(id).parentElement.parentElement.parentElement.remove();
        }
    )
}

function elimina(id){
    const data =    {  
                        id_recensione: id,
                        tipo_richiesta: "eliminazione"
                    };

    fetch('/html/components/AdmApprovaReview.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(data)

    }).then(data => data.text())
    .then(
        function (data) {
            console.log(id);
            document.getElementById(id).parentElement.parentElement.parentElement.remove();
        }
    )
}

//#endregion 


//#region CHECKBOX FORM VIAGGIO

function checkboxformviaggio(){
    //invia una richiesta POST ad autocomplete.php: riceve la lista dei tag e la inserisce della datalist come <option>
    fetch('/html/components/checkboxIntegrazioniFormViaggio.php', { method: 'POST' })
    .then(data => data.text())
    .then(
        function (data) {
            //console.log(data);
            document.getElementById('checkboxIntegrazioniFormViaggio').innerHTML = data;
        }
    )

}
//#endregion


//#region CHECK BOX INTEGRAZIONE

function checkboxintegrazione(){
        console.log("check box integrazione");
        //invia una richiesta POST ad autocomplete.php: riceve la lista dei tag e la inserisce della datalist come <option>
        fetch('/html/components/checkboxIntegrazione.php', { method: 'POST' })
            .then(data => data.text())
            .then(
                function (data) {
                    //console.log(data);
                    document.getElementById('cb').innerHTML = data;
                }
            )
}
//#endregion


//#region FORM INSERIMENTO VIAGGIO

function forminserimento() {
    fetch('/html/components/autocomplete.php', { method: 'POST' })
     .then(data => data.text())
     .then(
          function (data) {
               console.log("prova");
               //console.log(data);
               document.getElementById('tagList').innerHTML = data;
          }
     )
}

function aggiungiTag() { 

    var s = document.getElementById("addTagAutocomplete").value;
    //console.log(s);
    var pos = document.getElementById("addTagAutocomplete").selectedIndex;
    //console.log(pos);
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

checkboxformviaggio();
forminserimento();
aggiungiTag();
//#endregion