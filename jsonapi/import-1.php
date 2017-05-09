<?php   

  
 $handle = fopen("new-list.csv", "r");      
   
 if(!$handle){
        die ('Cannot open file for reading');
  }      
 while (($data = fgetcsv($handle,      10000, ",")) !== FALSE)
 {
          $query = "INSERT INTO wp_xpksy4skky_users        (user_login, user_email, user_nicename , user_registered)
             values ('$data[3]', '$data[3]', '$data[0]', 'NOW()') ";


             print($query);
               //mysql_query($query) 
              // or die(mysql_error()) ;



                   /* $query1 = "INSERT INTO tablename        (col1_csv, col2_csv)
                values ('$data[0]', '$data[1]') ";
               mysql_query($query1) 
             or die(mysql_error());*/
 }
 fclose($handle);
  ?>

 ?>