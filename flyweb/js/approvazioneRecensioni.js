function approva(){

    alert("debug");
    var id =document.getElementById('par_id_approva').value;

    fetch('/html/components/AdmApprovaReview.php', {
        method: 'post',
        body: id
    }).then(data => console.log("LOG -> "+data));


    document.getElementById("p_approvata"+id).textContent+= "RECENSIONE APPROVATA";
    document.getElementById('btn_approva'+id).disabled = true;

}