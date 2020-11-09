<?php  

$link = mysqli_connect("mariadb", "user", "user", "flyweb", 3306);

/*
if($link){
     echo "ok";
}else{
     echo "mannaggia gesi";
}*/



      $output = '';  
      $query = "SELECT * FROM Tag ";  
      $result = mysqli_query($link, $query);  
      if(mysqli_num_rows($result) > 0)  
      {  
           while($row = mysqli_fetch_array($result))  
           {  
                $output .= ' <option value='.$row["Nome"].'>'.$row["Nome"].'</option> ';  
           }  
      }  
      else  
      {  
           $output .= ' nessun tag del genere ';  
      }  
      $output .= '';
      echo $output;  
 ?> 