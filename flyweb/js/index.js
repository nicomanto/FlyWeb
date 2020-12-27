//#region SCRIPT MODERAZIONE RECENSIONI
/*function approva(id){
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

            var list_review=document.getElementsByClassName("board-contenuto")[0].getElementsByTagName("LI");

            if(list_review.length==0){
                document.getElementsByClassName("pageSelector")[0].remove();
                document.getElementsByClassName("board-contenuto")[0].getElementsByTagName("UL").remove();

                var no_review = document.createElement('h2');
                no_review.innerText = "Nessun recensione da moderare...per ora.";
                document.getElementsByClassName("board-contenuto")[0].appendChild(no_review);
            }
        }
    )
}*/

function ConfermaEliminazione(){

    console.log("55");

    return confirm("Vuoi confermare l'eliminazione?");

    /*if(popup_conferma){
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

            var list_review=document.getElementsByClassName("board-contenuto")[0].getElementsByTagName("LI");
            
            if(list_review.length==0){
                document.getElementsByClassName("pageSelector")[0].remove();
                document.getElementsByClassName("board-contenuto")[0].getElementsByTagName("UL").remove();

                var no_review = document.createElement('h2');
                no_review.innerText = "Nessun recensione da moderare...per ora.";
                document.getElementsByClassName("board-contenuto")[0].appendChild(no_review);
            }
        }
        )
    }*/
}

//#endregion 


//#region SCRIPT CHECKBOX FORM VIAGGIO

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


//#region SCRIPT CHECK BOX INTEGRAZIONE

function checkboxintegrazione(){
        console.log("check box integrazione");
        //invia una richiesta POST ad autocomplete.php:
        fetch('/html/components/checkboxIntegrazione.php', { method: 'POST' , id:'49'})
            .then(data => data.text())
            .then(
                function (data) {
                    console.log(data);
                    document.getElementById('cb').innerHTML = data;
                }
            )
}
//#endregion


//#region SCRIPT TAG FORM INSERIMENTO VIAGGIO

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

    var tag = document.getElementById("addTagAutocomplete").value;

    document.getElementById("addTagAutocomplete").value="";
    //console.log(s);

    if(document.getElementById(tag))
        document.getElementById(tag).remove();


    if(!document.getElementById("element"+tag) && tag!=""){


        //creo bottone eliminizaione tag inserito
        var button = document.createElement("button");
        button.innerHTML = "X";
        button.type="button";

        button.onclick = function(){
            rimuoviTag("element"+tag);
        };

        //creo tag inserito
        var message = document.createElement("P");
        message.innerText = "#"+tag; 

        var tagInseriti = document.getElementById('listTagInseriti');

        var li = document.createElement("li");
        li.id="element"+tag;
        li.appendChild(button);
        li.appendChild(message);
        tagInseriti.appendChild(li);

        document.getElementById('tagDaInviare').value+=tag+";";
        console.log(document.getElementById('daInviare').value);
    }
    //console.log(s);
}

function rimuoviTag(id_element) {

    var tag=id_element.replace("element","");
    
    var lista = document.getElementById("tagList");
    var newOptionElement = document.createElement("option");
    newOptionElement.innerHTML = tag;
    newOptionElement.id=tag;

    lista.appendChild(newOptionElement);

    document.getElementById("element"+tag).remove();


    document.getElementById('tagDaInviare').value=document.getElementById('tagDaInviare').value.replace(tag+";","");
}

function conferma(){
    return confirm("Vuoi confermare il form?");
}

function admlogout(){
    console.log("ciao");
    document.cookie = "flw_user= ; expires = Thu, 01 Jan 1970 00:00:00 GMT"
}



//#region       - - -  VALIDAZIONE FORM  - - -

function validationDataInizio(){
    document.getElementById("p").textContent += " this has just been added";
}

function validationData(){
    
    var dataInizio  = document.getElementById("datainizio").value;
    var dataFine    = document.getElementById("datafine").value;

    if(dataInizio && dataFine){
        if(dataInizio > dataFine){
            //document.getElementById("input_error_datafine").textContent = "";
            document.getElementById("datainizio").style.border = "2px solid red";
            document.getElementById("datafine").style.border = "2px solid red";

            document.getElementById("input_error_datafine").style.color = 'red';
            document.getElementById("input_error_datafine").style.visibility = 'visible';
            document.getElementById("input_error_datafine").innerHTML = "errore: data di inizio dev'essere antecedente alla data di fine";
            return false;
        }else{
            document.getElementById("datainizio").style.border = "2px solid #0a3150";
            document.getElementById("datafine").style.border = "2px solid #0a3150";
            document.getElementById("input_error_datafine").style.visibility = 'hidden';
            return true;
        }
    }
}


function validationPrz(){
    var prz  = document.getElementById("prezzo").value;

    console.log("pez");

    if(prz!=null && prz < 0){
        document.getElementById("prezzo").style.border = "2px solid red";

        document.getElementById("input_error_prezzo").style.color = 'red';
            document.getElementById("input_error_prezzo").style.visibility = 'visible';
            document.getElementById("input_error_prezzo").innerHTML = "errore: prezzo dev'essere maggiore o ugale a zero";
            return false;
        }else{
            document.getElementById("prezzo").style.border = "2px solid #0a3150";
            document.getElementById("input_error_prezzo").style.visibility = 'hidden';
            return true;
        }
}


function validationDurata(){
    var d  = document.getElementById("durata_integrazione").value;


    if(d!=null && d < 0){
        document.getElementById("durata_integrazione").style.border = "2px solid red";

    
        document.getElementById("input_error_durata").style.color = 'red';
            document.getElementById("input_error_durata").style.visibility = 'visible';
            document.getElementById("input_error_durata").innerHTML = "errore: durata dev'essere maggiore o uguale a zero";
            return false;
        }else{
            document.getElementById("durata_integrazione").style.border = "2px solid #0a3150";
            document.getElementById("input_error_durata").style.visibility = 'hidden';
            return true;
        }
}

//#endregion


//#region       - - -  POPUP  - - - 


function checkCartaCredito(){
    var creditNumber  = document.forms["form_carta_credito"]["codiceCarta"];
    
    if(creditNumber.value.length <13 || creditNumber.value.length>16){

        var erroreMessage = document.createElement('P');
        erroreMessage.innerText = "Carta di credito non valida";  
        erroreMessage.setAttribute("id", "errorMessage");

        if(!document.getElementById("errorMessage"))
            document.getElementById("containerCarta").appendChild(erroreMessage);

        return false;
    }
}


//#endregion

checkboxintegrazione();
checkboxformviaggio();
forminserimento();
aggiungiTag();
