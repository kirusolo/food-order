
<?php include('partials/menu.php');

?>


<!---main-content start here--->

    <div class="main-content">
    
    <div class="wrapper">
       <h1>Dashboard</h1>
          
       <br><br> 
       <?php
     if(isset($_SESSION['login']))
       {
              echo $_SESSION['login'];
              unset($_SESSION['login']);
       }

       if(isset($_SESSION['restaurant_id']))
       {
              $restaurant_id = $_SESSION['restaurant_id'];
       }
       ?>
       <br><br>


    <div class="col-4 text-center">

    <?php
    //sql query

    $sql = "SELECT * FROM tbl_category WHERE restaurant_id = $restaurant_id";

    //execute the query
    $res = mysqli_query($conn, $sql);
    //count rows

    $count = mysqli_num_rows($res);



    ?>
    

    <h1><?php echo $count; ?></h1>
    <br />
     Categorys
     </div>


     <div class="col-4 text-center">
            
           
    <?php
    //sql query

    $sql2 = "SELECT tbl_food.id, tbl_food.category_id, tbl_category.restaurant_id, tbl_category.id, tbl_resturant.id FROM tbl_food, tbl_category, tbl_resturant WHERE tbl_category.id = tbl_food.category_id && tbl_resturant.id = tbl_category.restaurant_id && tbl_resturant.id = $restaurant_id";

    //execute the query
    $res2 = mysqli_query($conn, $sql2);
    //count rows

    $count2 = mysqli_num_rows($res2);



    ?>


    <h1><?php echo $count2; ?></h1>
    <br />
       Foods
     </div>


     <div class="col-4 text-center">
                  
    <?php
    //sql query

    $sql3 = "SELECT * FROM tbl_order WHERE restaurant_id = $restaurant_id";

    //execute the query
    $res3 = mysqli_query($conn, $sql3);
    //count rows

    $count3 = mysqli_num_rows($res3);



    ?>

    <h1><?php echo $count3; ?></h1>
    <br />
     Total Orders
     </div>


     <div class="col-4 text-center">

         <?php
         //create sql query to get total generated revenue
         //aggergate function in sql
         $sql4 = "SELECT SUM(total) AS Total FROM tbl_order WHERE status='delivered' && restaurant_id = $restaurant_id";

         //execute the query
         $res4 = mysqli_query($conn, $sql4);

         //get the value
         $row4 = mysqli_fetch_assoc($res4);
          
         //get the total revenue 
         $total_revenue = $row4['Total'];
        
         
         
         
         ?>

    <h1>$<?php echo $total_revenue; ?></h1>
    <br />
     Revenue Generiated
     </div>


     <div class="clearfix"></div>

    </div>
     
    
    </div>
<!---main-content end here--->

<?php include('partials/footer.php'); ?>