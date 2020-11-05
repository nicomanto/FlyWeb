<?php  

 $connect = mysqli_connect("localhost", "user", "user", "flyweb",3307);  

 if($connect){
     echo "ok";
 }else{
     echo "fallito dm";
 }

 /*
 if(isset($_POST["query"]))  
 {  
      $output = '';  
      $query = "SELECT * FROM Tag WHERE Nome LIKE '%".$_POST["query"]."%'";  
      $result = mysqli_query($connect, $query);  
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
 }
 */

 ?> 