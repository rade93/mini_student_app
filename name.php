<?php  
 $connect = mysqli_connect("localhost", "root", "", "mini_app");  
 $direction1 = count($_POST["direction"]);  
 if($direction1 > 1)  
 {  
      for($i=0; $i<$direction1; $i++)  
      {  
           if(trim($_POST["direction"][$i] != ''))  
           {  
                $sql = "INSERT INTO direction(dname) VALUES('".mysqli_real_escape_string($connect, $_POST["direction"][$i])."')";  
                mysqli_query($connect, $sql);  
           }  
      }  
      echo "Data Inserted";  
 }  
 else  
 {  
      echo "Please Enter Name";  
 }  
 ?> 