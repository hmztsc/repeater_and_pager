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

    <form action="add-customer.php" method="POST">

        <!-- container -->
        <div class="container mt-5 py-3">

            <div class="row">
                <div class="col mb-3">
                    <h4>Repeater</h4>
                </div>
                <div class="col-auto ms-auto mb-3">
                    <a href="pager.php" class="btn btn-primary">GO Pager <i class="fa fa-arrow-right"></i></a>
                </div>
            </div>

            <?php 
            
            $sql = "SELECT * FROM `repeater_pager`.`customers` ORDER BY `id`";
            $query = $cxl->query($sql);
            while ($row = $query->fetch_assoc()) { ?>
            
            <input type="hidden" name="ids[]" value="<?php echo $row['id'] ?>">

            <!-- row -->
            <div class="repeater">
                <div class="row my-3 repeater-item created" data-id="<?php echo $row['id'] ?>">
                    <div class="col">
                        <div class="form-floating">
                            <input type="text" name="updateNames[]" class="form-control" id="floatingInput" placeholder="Ad Soyad" value="<?php echo $row['name']; ?>">
                            <label for="floatingInput">Ad Soyad</label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-floating">
                            <input type="text" name="updatePhones[]" class="form-control" id="floatingInput2" placeholder="Telefon" value="<?php echo $row['phone']; ?>" onkeypress="return event.charCode >= 48 &amp;&amp; event.charCode <= 57" onpaste="return false" ondrop="return false">
                            <label for="floatingInput2">Telefon</label>
                        </div>
                    </div>
                    <div class="col-auto d-flex align-self-center">
                    
                        <a href="javascript:void(0)" class="d-flex me-3" style="opacity:0; visibility:hidden;"><i class="fa fa-plus text-success"></i></a>
                        <a href="delete-customer.php?id=<?php echo $row['id'] ?>" class="d-flex delete"><i class="fa fa-trash text-danger"></i></a>
                    </div>
                </div>
            </div>
            <!-- end row -->

            <?php } ?>

            <!-- row -->
            <div class="repeater">
                <div class="row my-3 repeater-item">
                    <div class="col">
                        <div class="form-floating">
                            <input type="text" name="names[]" class="form-control" id="floatingInput" placeholder="Ad Soyad">
                            <label for="floatingInput">Ad Soyad</label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-floating">
                            <input type="text" name="phones[]" class="form-control" id="floatingInput2" placeholder="Telefon" onkeypress="return event.charCode >= 48 &amp;&amp; event.charCode <= 57" onpaste="return false" ondrop="return false">
                            <label for="floatingInput2">Telefon</label>
                        </div>
                    </div>
                    <div class="col-auto d-flex align-self-center">
                    
                        <a href="javascript:void(0)" class="d-flex me-3 add"><i class="fa fa-plus text-success"></i></a>
                        <a href="javascript:void(0)" class="d-flex delete"><i class="fa fa-trash text-danger"></i></a>
                    </div>
                </div>
            </div>
            <!-- end row -->

            <div class="row">
                <div class="col">
                    <input type="submit" name="submit" class="btn btn-primary" value="Kaydet">
                </div>
            </div>
        </div>
        <!-- end container -->

    </form>



    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

    <script>
        $(document).on("click",".repeater .add",function(){
            var repeaterItem = $(this).closest(".repeater-item");
            repeaterItem.after(repeaterItem.clone());
            repeaterItem.next().find("input").val("");
        });
        $(document).on("click",".repeater .delete",function(){
            var repeaterItem = $(this).closest(".repeater-item");
            repeaterItem.remove();
        });

    </script>
    
</body>
</html>