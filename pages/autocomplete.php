<?php  

$link = mysqli_connect("mariadb", "user", "user", "flyweb", 3306);

/*
if($link){
     echo "ok";
}else{
     echo "mannaggia gesi";
}

 echo $link->host_info . ", kek";

*/

 if(isset($_POST["query"]))  
 { 
      $output = '';  
      $query = "SELECT * FROM Tag WHERE Nome LIKE '%".$_POST["query"]."%'";  
      $result = mysqli_query($connect, $query);  
      echo $result;
      $output = '<ul class="list-unstyled">';  
      if(mysqli_num_rows($result) > 0)  
      {  
           while($row = mysqli_fetch_array($result))  
           {  
                $output .= '<li>'.$row["Nome"].'</li>';  
           }  
      }  
      else  
      {  
           $output .= '<li>nessun tag del genere</li>';  
      }  
      $output .= '</ul>';  
      echo $output;  
 }else{
      echo "fallito";
 }


 ?> 