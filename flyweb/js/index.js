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

//SEZIONE PROFILO
function checkCartaCredito(){
    var numero_carta  = document.getElementById("codiceCarta").value;
    var error_id_message=document.getElementById("input_error_carta_codice");

    if(numero_carta){
        if(numero_carta.length <13 || numero_carta.length >16){
            error_id_message.style.visibility = 'visible';
            document.getElementById("codiceCarta").style.border = "2px solid red";
            error_id_message.innerHTML = "La carta di credito è formata da 13 a 16 numeri";
            return false;
        }else{
            error_id_message.style.visibility = 'hidden';
            document.getElementById("codiceCarta").style.border = "2px solid #0a3150";
        }
    }
    else{
        error_id_message.style.visibility = 'hidden';
        document.getElementById("codiceCarta").style.border = "2px solid #0a3150";
    }

    return true;
}

function checkMonthCarta(){
    var mese_carta  = document.getElementById("scadenza_mese").value;
    var error_id_message=document.getElementById("input_error_carta_mese");

    if(mese_carta){
        if(mese_carta > 12 || mese_carta < 1){
            error_id_message.style.visibility = 'visible';
            document.getElementById("scadenza_mese").style.border = "2px solid red";
            error_id_message.innerHTML = "Il numero deve essere compreso fra 1 e 12";
            return false;
        }
        if(mese_carta.length>2){
            error_id_message.style.visibility = 'visible';
            document.getElementById("scadenza_mese").style.border = "2px solid red";
            error_id_message.innerHTML = "Il numero deve avere al massimo due cifre (es. 01 o 1 per Gennaio)";
            return false;
        }
        else{
            error_id_message.style.visibility = 'hidden';
            document.getElementById("scadenza_mese").style.border = "2px solid #0a3150";
        }
    }
    else{
        error_id_message.style.visibility = 'hidden';
        document.getElementById("scadenza_mese").style.border = "2px solid #0a3150";
    }

    return true;
}

function checkYearCarta(){
    var anno_carta  = document.getElementById("scadenza_anno").value;
    var error_id_message=document.getElementById("input_error_carta_anno");

    if(anno_carta){
        if(anno_carta < 0){
            error_id_message.style.visibility = 'visible';
            document.getElementById("scadenza_anno").style.border = "2px solid red";
            error_id_message.innerHTML = "Il numero deve essere positivo";
            return false;
        }
        if(anno_carta.length>2){
            error_id_message.style.visibility = 'visible';
            document.getElementById("scadenza_anno").style.border = "2px solid red";
            error_id_message.innerHTML = "Il numero deve avere al massimo due cifre (es. 21 per 2021)";
            return false;
        }
        else{
            error_id_message.style.visibility = 'hidden';
            document.getElementById("scadenza_anno").style.border = "2px solid #0a3150";
        }
    }
    else{
        error_id_message.style.visibility = 'hidden';
        document.getElementById("scadenza_anno").style.border = "2px solid #0a3150";
    }

    return true;
}

function checkCVV(){
    var cvv  = document.getElementById("cvv").value;
    var error_id_message=document.getElementById("input_error_carta_cvv");

    if(cvv){
        if(cvv.length>3){
            error_id_message.style.visibility = 'visible';
            document.getElementById("cvv").style.border = "2px solid red";
            error_id_message.innerHTML = "Il codice deve avere al massimo 3 cifre";
            return false;
        }
        else{
            error_id_message.style.visibility = 'hidden';
            document.getElementById("cvv").style.border = "2px solid #0a3150";
        }
    }
    else{
        error_id_message.style.visibility = 'hidden';
        document.getElementById("cvv").style.border = "2px solid #0a3150";
    }

    return true;
}

function checkIndirizzi(id,Element){
    var element  = document.getElementById(Element).value;
    var error_id_message=document.getElementById(id);
    var reg_expr= /^[\w\s\.]*$/;
    var no_only_special=/^(\.|_|\s)*$/;

    if(element){
        if( element.search(reg_expr) !=0){
            error_id_message.style.visibility = 'visible';
            document.getElementById(Element).style.border = "2px solid red";
            error_id_message.innerHTML = "Permessi i caratteri da A-Z, a-z, 0-9, _ e il carattere spazio";
            return false;
        }
        else if(no_only_special.test(element)){
            error_id_message.style.visibility = 'visible';
            document.getElementById(Element).style.border = "2px solid red";
            error_id_message.innerHTML = "Deve contenere almeno delle lettere o numeri";
            return false;
        }
        else{
            error_id_message.style.visibility = 'hidden';
            document.getElementById(Element).style.border = "2px solid #0a3150";
        }
    }
    else{
        error_id_message.style.visibility = 'hidden';
        document.getElementById(Element).style.border = "2px solid #0a3150";
    }

    return true;
}

function checkCAP(){
    var cap = document.getElementById("cap").value;
    var error_id_message=document.getElementById("input_error_cap");
    var reg_expr= /^[\d]{5}$/;

    if(cap){
        if( cap.search(reg_expr) !=0){
            error_id_message.style.visibility = 'visible';
            document.getElementById("cap").style.border = "2px solid red";
            error_id_message.innerHTML = "Si devono inserire 5 numeri";
            return false;
        }
        else{
            error_id_message.style.visibility = 'hidden';
            document.getElementById("cap").style.border = "2px solid #0a3150";
        }
    }
    else{
        error_id_message.style.visibility = 'hidden';
        document.getElementById("cap").style.border = "2px solid #0a3150";
    }

    return true;
}


function eliminazioneProfilo(){
    $popup_conferma = confirm("vuoi davvero davvero eliminare il tuo profilo? :( :(")
    if ($popup_conferma === true) {
        location.href = 'eliminazione_profilo.php'; }
}


//#endregion






//Form registrazione
function validationTipoNome(id,Element){
    var element  = document.getElementById(Element).value;
    var error_id_message=document.getElementById(id);
    var reg_expr= /^[A-Za-zÀ-ú\s]{2,30}$/;
    var no_only_special=/^(\s)*$/;

    if(element){
        if( element.search(reg_expr) !=0){
            error_id_message.style.visibility = 'visible';
            document.getElementById(Element).style.border = "2px solid red";
            error_id_message.innerHTML = "Permessi da 2 a 30 caratteri totali fra A-Z, a-z, lettere accentate e il carattere spazio";
            return false;
        }
        else if(no_only_special.test(element)){
            error_id_message.style.visibility = 'visible';
            document.getElementById(Element).style.border = "2px solid red";
            error_id_message.innerHTML = "Deve contenere almeno delle lettere";
            return false;
        }
        else{
            error_id_message.style.visibility = 'hidden';
            document.getElementById(Element).style.border = "2px solid #0a3150";
        }
    }
    else{
        error_id_message.style.visibility = 'hidden';
        document.getElementById(Element).style.border = "2px solid #0a3150";
    }

    return true;
}

function validationUsername(){
    var username  = document.getElementById("username").value;
    var error_id_message=document.getElementById("input_error_username");
    var reg_expr= /^[\w@#-]{4,15}$/;
    var no_only_special=/^([0-9]|_|@|#|-)*$/;

    if(username){
        if( username.search(reg_expr) !=0){
            error_id_message.style.visibility = 'visible';
            document.getElementById("username").style.border = "2px solid red";
            error_id_message.innerHTML = "Permessi da 4 a 15 caratteri totali con # - _ @";
            return false;
        }
        else if(no_only_special.test(username)){
           error_id_message.style.visibility = 'visible';
           document.getElementById("username").style.border = "2px solid red";
           error_id_message.innerHTML = "Deve contenere almeno delle lettere";
           return false;
        }
        else{
           error_id_message.style.visibility = 'hidden';
           document.getElementById("username").style.border = "2px solid #0a3150";
        }
    }
    else{
       error_id_message.style.visibility = 'hidden';
       document.getElementById("username").style.border = "2px solid #0a3150";
    }

    return true;


}

function validationEmail(){
    var email  = document.getElementById("email").value;
    var error_id_message=document.getElementById("input_error_email");
    var reg_expr= /^(([\w.-]{4,20})+)@(([A-Za-z.]{4,20})+)\.([A-Za-z]{2,3})$/;

    if(email){
        if( email.search(reg_expr) !=0){
            error_id_message.style.visibility = 'visible';
            document.getElementById("email").style.border = "2px solid red";
            error_id_message.innerHTML = "Non è in un formato standard come esempio@esempio.com";
            return false;
        }
        else{
            error_id_message.style.visibility = 'hidden';
            document.getElementById("email").style.border = "2px solid #0a3150";
        }
    }
    else{
        error_id_message.style.visibility = 'hidden';
        document.getElementById("email").style.border = "2px solid #0a3150";
    }

    return true;


}

function validationPassword(){
    var password  = document.getElementById("password").value;
    var error_id_message=document.getElementById("input_error_password");
    var reg_expr= /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/;

    if(password){
        if( password.search(reg_expr) !=0){
            error_id_message.style.visibility = 'visible';
            document.getElementById("password").style.border = "2px solid red";
            error_id_message.innerHTML = "La <span xml:lang='en'>password</span> deve essere lunga almeno 8, contenere almeno un carattere maiuscolo, uno minuscolo ed un numero";
            return false;
        }
        else{
            error_id_message.style.visibility = 'hidden';
            document.getElementById("password").style.border = "2px solid #0a3150";
        }
    }
    else{
        error_id_message.style.visibility = 'hidden';
        document.getElementById("password").style.border = "2px solid #0a3150";
    }

    return true;

}


function validationPasswordRepeat(){
    var password_ripetuta  = document.getElementById("password_ripetuta").value;
    var password  = document.getElementById("password").value;
    var error_id_message=document.getElementById("input_error_password_repeated");

    if(password_ripetuta){
        if( password_ripetuta!=password){
            error_id_message.style.visibility = 'visible';
            document.getElementById("password_ripetuta").style.border = "2px solid red";
            error_id_message.innerHTML = "Le <span xml:lang='en'>password</span> non corrispondono";
            return false;
        }
        else{
            error_id_message.style.visibility = 'hidden';
            document.getElementById("password_ripetuta").style.border = "2px solid #0a3150";
        }
    }
    else{
        error_id_message.style.visibility = 'hidden';
        document.getElementById("password_ripetuta").style.border = "2px solid #0a3150";
    }

    return true;


}



function validationDataNascita(){
    var dataNascita  = document.getElementById("data_nascita").value;
    var error_id_message=document.getElementById("input_error_data_nascita");

    if(dataNascita){
        if(getAge(dataNascita)<14){
            error_id_message.style.visibility = 'visible';
            document.getElementById("data_nascita").style.border = "2px solid red";
            error_id_message.innerHTML = "Devi avere almeno 14 anni per registrarti";
            return false;
        }
        else{
            error_id_message.style.visibility = 'hidden';
            document.getElementById("data_nascita").style.border = "2px solid #0a3150";
        }
    }
    else{
        error_id_message.style.visibility = 'hidden';
        document.getElementById("data_nascita").style.border = "2px solid #0a3150";
    }

    return true;


}


/*function convertDate(date){
    var day = ("0" + date.getDate()).slice(-2);
    var month = ("0" + (date.getMonth() + 1)).slice(-2);
    var year = date.getFullYear();

    return year+'-'+month+'-'+day;
}*/


function getAge(data_nascita){
    now = new Date();
    split=data_nascita.split('-');
    var diff = now.getTime() - new Date(split[0],split[1]-1,split[2]).getTime();
    return Math.floor(diff / (1000 * 60 * 60 * 24 * 365));
}



//Recensioni
function titoloEDescrizioneRecensione(id,Element){
    var element  = document.getElementById(Element).value;
    var error_id_message=document.getElementById(id);
    var reg_expr= /^[\w\s\.]*$/;
    var no_only_special=/^(\.|_|\s)*$/;

    if(element){
        if( element.search(reg_expr) !=0){
            error_id_message.style.visibility = 'visible';
            document.getElementById(Element).style.border = "2px solid red";
            error_id_message.innerHTML = "Permessi i caratteri da A-Z, a-z, 0-9, _ e il carattere spazio";
            return false;
        }
        else if(no_only_special.test(element)){
            error_id_message.style.visibility = 'visible';
            document.getElementById(Element).style.border = "2px solid red";
            error_id_message.innerHTML = "Deve contenere almeno delle lettere o numeri";
            return false;
        }
        else{
            error_id_message.style.visibility = 'hidden';
            document.getElementById(Element).style.border = "2px solid #0a3150";
        }
    }
    else{
        error_id_message.style.visibility = 'hidden';
        document.getElementById(Element).style.border = "2px solid #0a3150";
    }

    return true;
}

function valutazioneRecensione(){
    var valutazione  = document.getElementById("valutazione").value;
    var error_id_message=document.getElementById("input_error_valutazione");

    if(valutazione){
        if(valutazione<0 || valutazione>5){
            error_id_message.style.visibility = 'visible';
            document.getElementById("valutazione").style.border = "2px solid red";
            error_id_message.innerHTML = "La valutazione deve essere compresa fra 0 e 5";
            return false;
        }
        else{
            error_id_message.style.visibility = 'hidden';
            document.getElementById("valutazione").style.border = "2px solid #0a3150";
        }
    }
    else{
        error_id_message.style.visibility = 'hidden';
        document.getElementById("valutazione").style.border = "2px solid #0a3150";
    }

    return true;
}



checkboxintegrazione();
checkboxformviaggio();
forminserimento();
aggiungiTag();
