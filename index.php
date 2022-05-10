<?php 
    include "function.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Finder</title>
    <!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <a href="" class="navbar-brand">Course Finder</a>
    </div>
</nav>


<div class="container">
    <div class="row">
        <div class="col-3">
            <div class="card">
                <div class="card-body">
                    <h6>Insert Course</h6>
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="">Title</label>
                            <input type="text" name="title" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="">price</label>
                            <input type="text" name="price" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="">discount_price</label>
                            <input type="text" name="discount_price" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="">instructor</label>
                            <input type="text" name="instructor" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="">duration</label>
                            <input type="text" name="duration" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="">cover</label>
                            <input type="file" name="cover" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="">description</label>
                            <input type="text" name="description" class="form-control">
                        </div>
                        <div class="mb-3">
                            <input type="submit" name="send" class="btn btn-success w-100">
                        </div>

                    </form>

                    <?php 
                    if(isset($_POST['send'])){

                        $filename = $_FILES['cover']['name'];
                        $tmp = $_FILES['cover']['tmp_name'];
                        move_uploaded_file($tmp,"images/$filename");

                        $data = [
                            'title' => $_POST['title'],
                            'price' => $_POST['price'],
                            'discount_price' => $_POST['discount_price'],
                            'description' => $_POST['description'],
                            'duration' => $_POST['duration'],
                            'cover' => $filename,
                            'instructor' => $_POST['instructor'],
                        ];
                        insert("courses",$data);
                    }
                    ?>
                </div>
            </div>
        </div>
        <div class="col-9">
            <h6>Manage Course</h6>
            <div class="row">
               <?php 
               $callingCourse = calling("courses");
               foreach ($callingCourse as $value) {
                ?>

            <div class="col-3">
                <div class="card">
                    <img src="images/<?= $value['cover'];?>" style="object-fit:cover;height:180px" alt="" class="w-100">
                    <div class="card-body">
                        <h6><?= $value['title'];?></h6>
                        <h4>Rs. <?= $value['discount_price'];?>/- <del><?= $value['price'];?>/-</del></h4>
                        <form action="paytmKit/pgRedirect.php" method="post">
                            <input type="text" name="ORDER_ID">
                            <input type="text" name="CUST_ID">
                            <input type="text" name="TXN_AMOUNT">
                            <input type="submit" value="Pay Now" class="btn btn-danger">
                        </form>
                    </div>
                </div>
            </div>

                <?php  } ?>
             </div>
        </div>
    </div>
</div>
    
</body>
</html>