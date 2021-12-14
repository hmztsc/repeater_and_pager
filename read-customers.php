<?php 
   include_once("connection.php");

   if(!isset($pn) || empty($pn))
   $pn = 1;

   $offset = ($pn - 1) * 5;

   $nrQ = $cxl->query("SELECT `id` FROM `repeater_pager`.`customers`; ");
   $nr = $nrQ->num_rows;

   $sql = "SELECT * FROM `repeater_pager`.`customers` ORDER BY `id` LIMIT $offset,5 ;";
   $query = $cxl->query($sql);
   if($query){
      
      $data["rows"] = $query->fetch_all(MYSQLI_ASSOC);
      $data["pages"] = ceil($nr/5);

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
   
   echo json_encode($data);
   exit;