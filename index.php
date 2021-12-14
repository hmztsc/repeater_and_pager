<?php 
include("connection.php");

$query = $cxl->query("show databases;");
while($tempArray = $query->fetch_assoc()){
   $databases[$tempArray['Database']] = "";
}

if(array_key_exists('repeater_pager', $databases)){

   // echo "Database is exist";
   
   $query = $cxl->query("show tables from repeater_pager;");
   while($tempArray = $query->fetch_assoc()){
      $tables[$tempArray['Tables_in_repeater_pager']] = "";
   }

   if(array_key_exists('customers', $tables)){
      // echo "a b c tables exist";
      Header("Location: pager.php");
      exit;
   } else {
      echo "Database installation was not successfull. Please drop the database and try again.";
   }

} else {
   include("db/create.php");
}