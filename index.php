<!-- require_once 'partials/Database.php';

$dbobj = new Database();
var_dump($dbobj); -->


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- font awesomem CDN link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <link rel="stylesheet" href="css/style.css">
    <title>PHP Advance CRUD</title>
</head>
<body>
    
<h1 class="bg-dark text-light text-center py-2">PHP Advance CRUD</h1>
<div class="displaymessage text-center text-light bg-dark"></div>
<div class="container">

<!-- form modal  -->
<?php include 'form.php' ?>
<?php include 'profile.php' ?>




<!-- inut search and button section  -->

    <div class="row">
        <div class="col-10">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text bg-dark">
                    <i class="fa fa-search text-light" aria-hidden="true"></i>
                    </span>
                </div>
                <input type="text" name="searchBar" id="searchForm" class="form-control" placeholder="Search user">
            </div>
        </div>

        <div class="col-2">
            <button class="btn btn-dark" type="button" data-toggle="modal" data-target="#usermodal" id="adduserbtn">Add new user</button>
        </div>
    </div>

<!-- table to display data from database  -->
<?php include 'tableData.php'; ?>


<!-- Pagination -->

<nav aria-label="Page navigation example" id="pagination">
  <!-- <ul class="pagination justify-content-center">
    <li class="page-item disabled"><a class="page-link" href="#">Previous</a></li>
    <li class="page-item active"><a class="page-link" href="#">1</a></li>
    <li class="page-item"><a class="page-link" href="#">2</a></li>
    <li class="page-item"><a class="page-link" href="#">3</a></li>
    <li class="page-item"><a class="page-link" href="#">Next</a></li>
  </ul> -->
</nav>
<input type="hidden" value="1" name="currentpage" id="currentpage">
</div>



<!-- jquery CDN -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

<!-- Bootstrap popper and JS links -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<!-- our js file  -->
<script src="js/script.js"></script>

</body>
</html>