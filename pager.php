<?php 
require_once("connection.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        a{
            text-decoration:none;
        }
        a:hover{
            text-decoration:none;
        }
    </style>
</head>
<body>

   <!-- container -->
   <div class="container mt-5 py-3">

      <div class="row">
         <div class="col mb-3">
            <h4>Pager</h4>
         </div>
         <div class="col-auto ms-auto mb-3">
            <a href="repeater.php" class="btn btn-primary">GO Repeater <i class="fa fa-arrow-right"></i></a>
         </div>
      </div>

      <div class="row justify-content-center">
         <div class="col-md-4 ">
            <div class="card">
               <div class="card-header">Customers</div>
               <div class="card-body">
                  <div id="contents"></div>
                  <nav aria-label="Page navigation example" id="customerPager" class="my-4 mb-0">
                     <ul class="pagination justify-content-center mb-0">
                     </ul>
                  </nav>
               </div>
            </div>
         </div>
      </div>


   </div>
   <!-- end container -->

   <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

   <script>

      $(document).on("click","#customerPager a",function(){

         if($(this).parent().hasClass("prev") ){
            return;
         }
         
         if($(this).parent().hasClass("next") ){
            return;
         }

         console.log($(this).html());

         getCustomers($(this).html());

      });

      $(document).on("click","#customerPager .page-item.next",function(){

         var active = $("#customerPager .page-item.active a"),
            paginations = $("#customerPager ul.pagination");

         if(paginations.find(">*").length - 2 == parseInt(active.html())){
            return;
         }

         $("#customerPager .page-item.prev").removeClass("disabled");
         var pn = parseInt($("#customerPager .page-item.active a").html()) + 1;
         getCustomers(pn);
         
      });

      $(document).on("click","#customerPager .page-item.prev",function(){

         var active = $("#customerPager .page-item.active a"),
            paginations = $("#customerPager ul.pagination");

         if(parseInt(active.html()) == 1){
            return;
         }

         $("#customerPager .page-item.prev").removeClass("disabled");
         var pn = parseInt($("#customerPager .page-item.active a").html()) - 1;
         getCustomers(pn);
         
      });

      getCustomers();
      function getCustomers(pn=1){

         var content = "";
         $.getJSON("read-customers.php", { pn: pn }, function(result){

            console.log(result.start);
            console.log(result.end);

            $.each(result.rows, function(i, field){
               content += "<div class='row'>";
               content += "<div class='col-auto pe-1 my-1'>";
               content += "#";
               content += field.id;
               content += "</div>";
               content += "<div class='col my-1'>";
               content += field.name;
               content += "</div>";
               content += "<div class='col my-1'>";
               content += field.phone;
               content += "</div>";
               content += "</div>";
            });

            var paginations = "";
            for (let i = 1; i <= result.pages; i++) {
               paginations += "<li class='page-item ";
               if(pn == i){
                  paginations += "active";
               }
               paginations += "'>";
               paginations += "<a href='javascript:void(0)' class='page-link' href='#'>";
               paginations += i;
               paginations += "</a></li>";
            }
            
            var prevBtn = '<li class="page-item prev ';
            if(pn == 1){
               prevBtn += "disabled";
            }
            prevBtn += '">';

            prevBtn += '<a class="page-link" href="javascript:void(0)" tabindex="-1">Previous</a>';
            prevBtn += '</li>';

            var nextBtn = '<li class="page-item next ';
            if(pn == result.pages){
               nextBtn += "disabled";
            }
            nextBtn += '">';
            nextBtn += '<a class="page-link" href="javascript:void(0)">Next</a>';
            nextBtn += '</li>';

            $("#customerPager ul.pagination").html(prevBtn + paginations + nextBtn);
            
         }).done(function(){
            $("#contents").html(content);
         });
      }
   </script>
</body>
</html>