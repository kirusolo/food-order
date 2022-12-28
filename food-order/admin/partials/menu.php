
<?php
 include('../config/constants.php'); 
 include('login-check.php'); 

 ?>



<html>
    <head>
        
    <title>food-order website Home page</title>
    <link rel="stylesheet" href="../css/admin.css?v=<?php echo time(); ?>">
    </head>
    <body>
      <!---menu content start here--->
   
    <div class="menu">
        
    <div class="wrapper">
        <ul>
            <li> <a href="index.php">Home</a></li>
            <li> <a href="manage-category.php">Category</a></li>
            <li> <a href="manage-food.php">Food</a></li>
            <li> <a href="manage-order.php">Order</a></li>
            <li> <a href="logout.php">Logout</a></li>
            
        </ul>
    </div>
     
    </div>

    <!---menu content end here--->