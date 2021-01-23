function ConfermaEliminazione(){

    return confirm("Vuoi confermare l'eliminazione?");
}


function conferma(){
    return confirm("Vuoi confermare il form?");
}


//#region       - - -  VALIDAZIONE FORM  - - -


function validationData(){
    
    var dataInizio  = document.getElementById("datainizio").value;
    var dataFine    = document.getElementById("datafine").value;

    dataInizio=dataInizio.replace(/\//g,"-");
    dataFine=dataFine.replace(/\//g,"-");

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

//#endregion


//#region       - - -  POPUP  - - - 

//SEZIONE PROFILO
function checkCartaCredito(){
    var numero_carta  = document.getElementById("codiceCarta").value;
    var error_id_message=document.getElementById("input_error_carta_codice");
    var reg_expr= /^[\d]{13,16}$/;

    if(numero_carta){
        if(numero_carta.search(reg_expr) !=0){
            error_id_message.style.visibility = 'visible';
            document.getElementById("codiceCarta").style.border = "2px solid red";
            error_id_message.innerHTML = "La carta di credito è formata da 13 a 16 cifre";
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

function checkScadenzaCarta(){
    var scadenza_carta  = document.getElementById("scadenza_carta").value;
    var error_id_message=document.getElementById("input_error_scadenza_carta");
    var today= new Date().toISOString().slice(0,7);

    if(scadenza_carta){
        if(today > scadenza_carta){
            error_id_message.style.visibility = 'visible';
            document.getElementById("scadenza_carta").style.border = "2px solid red";
            error_id_message.innerHTML = "La tua carta è scaduta";
            return false;
        }
        else{
            error_id_message.style.visibility = 'hidden';
            document.getElementById("scadenza_carta").style.border = "2px solid #0a3150";
        }
    }
    else{
        error_id_message.style.visibility = 'hidden';
        document.getElementById("scadenza_carta").style.border = "2px solid #0a3150";
    }

    return true;
}

function checkCVV(){
    var cvv  = document.getElementById("cvv").value;
    var error_id_message=document.getElementById("input_error_carta_cvv");
    var reg_expr= /^[\d]{3}$/;

    if(cvv){ 
        if(cvv.search(reg_expr) !=0){
            error_id_message.style.visibility = 'visible';
            document.getElementById("cvv").style.border = "2px solid red";
            error_id_message.innerHTML = "Il codice deve avere 3 cifre";
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
            error_id_message.innerHTML = "Permessi da 4 a 15 caratteri totali, permessi i caratteri # - _ @";
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
            error_id_message.innerHTML = "La <span lang='en'>password</span> deve essere lunga almeno 8, contenere almeno un carattere maiuscolo, uno minuscolo ed un numero";
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
            error_id_message.innerHTML = "Le <span lang='en'>password</span> non corrispondono";
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


function getAge(data_nascita){
    var now = new Date();
    var needReverse=false;
    //alert(data_nascita);
    if(data_nascita.includes('/')){
        data_nascita=data_nascita.replace(/\//g,"-");
        needReverse=true;
    }
    
    var split=data_nascita.split('-');

    if(needReverse){
        split.reverse();
    }
    
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


/* hamburger menu */
function hamb() {
    var menu = document.getElementById("menu");
    var navmenu = document.getElementById("navmenu");
    var hmb = document.getElementById("hambuger");
    if (menu.classList.contains("hide-menumobile")) {   //se è chiuso si apre
        menu.classList.add("show-menumobile");
        hmb.setAttribute("aria-label", "Chiudi il menù");
        hmb.setAttribute("aria-expanded", "true");
        menu.classList.remove("hide-menumobile");

        document.getElementById("menu").focus();
    } else {                                            //altrimenti si chiude
        menu.classList.remove("show-menumobile");
        menu.classList.add("hide-menumobile");
        hmb.setAttribute("aria-label", "Apri il menù");
        hmb.setAttribute("aria-expanded", "false");
        navmenu.classList.remove("fixheight");
        document.body.focus();
    }
}

/* filtri searchbox */
function filters(){
    var filtri = document.getElementById("filtri");
    var btn = document.getElementById("btn-filtri");
    if (filtri.classList.contains("filtri-no")){
        filtri.classList.remove("filtri-no");
        filtri.classList.add ("filtri-si");
        btn.setAttribute("aria-label", "Chiudi la sezione di filtri di ricerca");
        btn.setAttribute("aria-expanded", "true");
        btn.setAttribute("value", "NASCONDI FILTRI DI RICERCA AGGIUNTIVI");
        document.filtri.focus();
    } else {
        filtri.classList.remove("filtri-si");
        filtri.classList.add ("filtri-no");
        btn.setAttribute("aria-label", "Apri la sezione di filtri di ricerca");
        btn.setAttribute("aria-expanded", "false");
        btn.setAttribute("value", "VISUALIZZA FILTRI DI RICERCA AGGIUNTIVI");
        document.btn-filtri.focus();
    }
}

/*Button torna su */
function scrollFunction() {
    var btn = document.getElementById("UpArrow"); 

    
    if(document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
        btn.classList.remove("hide");
    } 
    else {
        if( !btn.classList.contains("hide")){
            btn.classList.add("hide");
        }
           
    }
}


/*Validazione data*/

function validationSearchDate(){
    var start_date  = document.getElementById("search_start_date");
    alert("ciao");

    
    var today= new Date().toISOString().slice(0,7);


    if(today>start_date.value){
        start_date.value="Data già passata";
    }
    
}

window.onscroll = function() {scrollFunction()};
