<?php

$sql = "CREATE DATABASE `repeater_pager` /*!40100 DEFAULT CHARACTER SET utf8 */ /*!80016 DEFAULT ENCRYPTION='N' */";
$sql2 = "CREATE TABLE `repeater_pager`.`customers` ( `id` int NOT NULL AUTO_INCREMENT, `name` varchar(25) NOT NULL, `phone` varchar(25) NOT NULL, PRIMARY KEY (`id`) ) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci";

$cxl->query($sql);
$cxl->query($sql2);

if(!$cxl->query($sql) && !$cxl->query($sql2)){
   echo "Database installation was successfull. Redirecting 'Show Page' in 5 seconds";
   Header("Refresh:5 pager.php");
}
