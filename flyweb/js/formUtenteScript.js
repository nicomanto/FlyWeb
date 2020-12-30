function clicked(){
    $popup_conferma = confirm("vuoi davvero davvero eliminare il tuo profilo? :( :(");
    return ($popup_conferma)?true:false;
}
function showPwd() {
    var input = document.getElementById('password');
    if (input.type === "password") {
      input.type = "text";
    } else {
      input.type = "password";
    }
  }

