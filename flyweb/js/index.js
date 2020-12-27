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






//Form registrazione
function validationTipoNome(id,Element){
    var element  = document.getElementById(Element).value;
    var error_id_message=document.getElementById(id);
    var reg_expr= /^[A-Za-zÀ-ú\s]{4,30}$/;
    var no_only_special=/^(\s)*$/;

    if(element){
        if( element.search(reg_expr) !=0){
            error_id_message.style.visibility = 'visible';
            error_id_message.innerHTML = "Permessi da 4 a 30 caratteri totali fra A-Z, a-z, lettere accentate e il carattere spazio";
            return false;
        }
        else if(no_only_special.test(element)){
            error_id_message.style.visibility = 'visible';
            error_id_message.innerHTML = "Deve contenere almeno delle lettere";
            return false;
        }
        else{
            error_id_message.style.visibility = 'hidden';
        }
    }
    else{
        error_id_message.style.visibility = 'hidden';
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
            error_id_message.innerHTML = "Permessi da 4 a 15 caratteri totali con # - _ @";
            return false;
        }
        else if(no_only_special.test(username)){
           error_id_message.style.visibility = 'visible';
           error_id_message.innerHTML = "Deve contenere almeno delle lettere";
           return false;
        }
        else{
           error_id_message.style.visibility = 'hidden';
        }
    }
    else{
       error_id_message.style.visibility = 'hidden';
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
            error_id_message.innerHTML = "Non è in un formato standard come esempio@esempio.com";
            return false;
        }
        else{
            error_id_message.style.visibility = 'hidden';
        }
    }
    else{
        error_id_message.style.visibility = 'hidden';
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
            error_id_message.innerHTML = "La <span xml:lang='en'>password</span> deve essere lunga almeno 8, contenere almeno un carattere maiuscolo, uno minuscolo ed un numero";
            return false;
        }
        else{
            error_id_message.style.visibility = 'hidden';
        }
    }
    else{
        error_id_message.style.visibility = 'hidden';
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
            error_id_message.innerHTML = "Le <span xml:lang='en'>password</span> non corrispondono";
            return false;
        }
        else{
            error_id_message.style.visibility = 'hidden';
        }
    }
    else{
        error_id_message.style.visibility = 'hidden';
    }

    return true;


}



function validationDataNascita(){
    var dataNascita  = document.getElementById("data_nascita").value;
    var error_id_message=document.getElementById("input_error_birt_date");
    var today = convertDate(new Date());

    if(dataNascita){
        if(dataNascita>today){
            error_id_message.style.visibility = 'visible';
            error_id_message.innerHTML = "Hey, ma devi ancora nascere...";
            return false;
        }
        else{
            error_id_message.style.visibility = 'hidden';
        }
    }
    else{
        error_id_message.style.visibility = 'hidden';
    }

    return true;


}


function convertDate(date){
    var day = ("0" + date.getDate()).slice(-2);
    var month = ("0" + (date.getMonth() + 1)).slice(-2);
    var year = date.getFullYear();

    return year+'-'+month+'-'+day;
}

checkboxintegrazione();
checkboxformviaggio();
forminserimento();
aggiungiTag();
