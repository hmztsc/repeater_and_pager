<?php
   include_once("connection.php");

   foreach($updateNames as $key => $value){
      $id = $ids[$key];
      $name = $value;
      $phone = $updatePhones[$key];

      $sql = "UPDATE `repeater_pager`.`customers` SET `name`='$name',`phone`='$phone' WHERE `id`='$id';";
      if($cxl->query($sql)){
            $result["update"][] = [
               "status" => "success"
            ];
      }else {
            $result["update"][] = [
               "status" => "error",
               "sql" => $sql,
               "message" => $cxl->error,
            ];
      }
   }

   foreach($names as $key => $value){

      if(empty($value))
      continue;

      $name = $value;
      $phone = $phones[$key];

      $sql = "INSERT INTO `repeater_pager`.`customers` (`name`,`phone`) VALUES('$name','$phone');";
      if($cxl->query($sql)){
         $result["create"][] = [
            "status" => "success"
         ];
      }else {
         $result["create"][] = [
            "status" => "error",
            "sql" => $sql,
            "message" => $cxl->error,
         ];
      }
   }

   header("Location: repeater.php");
   exit;