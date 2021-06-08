

<?php
 $dbhost="localhost";
 $dbuser="root";
 $dbpass="";
 $dbname="facture";
 

 try{
     $dsn="mysql:host=".$dbhost.";dbname=".$dbname;
     $con=new PDO($dsn,$dbuser,$dbpass);
    
    
 }catch(PDOException $e){
     echo "failed";
 }


?>