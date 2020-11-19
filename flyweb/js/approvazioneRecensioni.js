function approva(id){

    alert(id);

    const data = { id_recensione: id };

    fetch('/html/components/AdmApprovaReview.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(data),

    }).then(data => data.text())
    .then(
         function (data) {
              //console.log(data);
              document.getElementById(id).disabled= true;
              data = data.replace('No results available for this query','');
              console.log(data);
              document.getElementById('p_'+id).textContent+=data;
         }
    )

}