function approva(){

    $id =document.getElementById('par_id_approva').value();

    fetch('/html/components/AdmApprovaReview.php', {
        method: 'post',
        body: $id
      });


    document.getElementById('p_approvata').textContent+= "RECENSIONE APPROVATA";
    document.getElementById('btn_approva').disabled = true;

}