<?php
   include_once("connection.php");

   $sql = "DELETE FROM `repeater_pager`.`customers` WHERE `id`='$id';";
   if($cxl->query($sql)){
      $result["delete"][] = [
         "status" => "success"
      ];
   }else {
      $result["delete"][] = [
         "status" => "error",
         "sql" => $sql,
         "message" => $cxl->error,
      ];
   }

   header("Location: repeater.php");
   exit;