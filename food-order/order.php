<?php include('partials-front/menu.php'); ?>


     <?php
      //check whether food id is or not
      if(isset($_GET['food_id']))
         {
            //get the food id and details of the food 
            $food_id = $_GET['food_id'];

             //get the details of the selected food
             $sql = "SELECT tbl_food.*, tbl_category.restaurant_id, tbl_category.id, tbl_resturant.id AS restaurant_id, tbl_resturant.resturant_name FROM tbl_food, tbl_category, tbl_resturant WHERE tbl_category.id = tbl_food.category_id AND tbl_resturant.id = tbl_category.restaurant_id AND tbl_food.id=$food_id";

             //execute the query
             $res = mysqli_query($conn, $sql);

             //count the rows
             $count = mysqli_num_rows($res);

             //check whether the data is available or not
             if($count==1)
             {
                //we have data
                //get the data from database
                $row = mysqli_fetch_assoc($res);
                 
                 $title = $row['title'];
                 $price = $row['price'];
                 $image_name = $row['image_name'];
                 $restaurant_name = $row['resturant_name'];
                 $restaurant_id = $row['restaurant_id'];

             }

             else
             {
                //food not available
                //redirect to homepage
                header('location:'.SITEURL);  

             }
          
         }

         else

         {
            //redirect to homepage
            header('location:'.SITEURL);    

            
         }

   ?>

    <!-- fOOD sEARCH Section Starts Here -->
    <script>

        function change_quantity(quantity_var){
            document.getElementById('yenepay_form').setAttribute('action',"?food_id=<?php echo $_GET['food_id']; ?>&quantity="+quantity_var);
        }
    </script>
    <section class="food-search">
        <div class="container">
            
            
            <?php 
                if(isset($_GET['payment_status']) && $_GET['payment_status'] == "paid"){
                   echo '<h3 class="text-center success">You successfully paid</h3>';
                }
            ?>
            <?php 
                if(isset($_GET['payment_status']) && $_GET['payment_status'] == "canceled"){
                   echo '<h3 class="text-center error">Error: Payment has canceled</h3>';
                }
            ?>

            <h3 id='on_to_yenepay' class="text-center success"></h3>
            
            <h2 class="text-center text-white">Fill this form to confirm your order.</h2>
            <form action="https://test.yenepay.com" method="POST" >
                <input type="hidden" name="process" value="Express">
                <input type="hidden" name="successUrl" value="http://localhost/food-order/order.php?food_id=<?php echo $_GET['food_id']; ?>&payment_status=paid">
                <input type="hidden" name="ipnUrl" value="http://localhost/food-order/ipn.php">
                <input type="hidden" name="cancelUrl" value="http://localhost/food-order/order.php?food_id=<?php echo $_GET['food_id']; ?>&payment_status=canceled">
                <input type="hidden" name="merchantId" value="SB1938">
                <input type="hidden" name="merchantOrderId" value="xy2">
                <input type="hidden" name="expiresAfter" value="60">
                <input type="hidden" name="itemId" value="<?php echo $title; ?>">
                <input type="hidden" name="itemName" value="<?php echo $title; ?>">
                <input type="hidden" name="unitPrice" value="<?php echo $price; ?>">
                <input type="hidden" id='quantity' name="quantity" value="<?php if(isset($_GET['quantity'])) echo $_GET['quantity'];  else echo '1'; ?>">
                <input type="hidden" name="discount" value="0">
                <input type="hidden" name="handlingFee" value="0">
                <input type="hidden" name="deliveryFee" value="0">
                <input type="hidden" name="tax1" value="0">
                <input type="hidden" name="tax2" value="0">
                <input type="submit" id="submit_yenepay" value="Submit to YenePay" style="display: none;" />
            </form>
            <form id='yenepay_form' action="?food_id=<?php echo $_GET['food_id']; ?>&quantity=<?php if(isset($_GET['quantity'])) echo $_GET['quantity']; else echo '1'; ?>" method="POST" class="order">
                <fieldset>
                    <legend>Selected Food</legend>

                    <div class="food-menu-img">

                              <?php
                              
                              //check whether image is available or not
                              if($image_name=="")
                              {
                                //image not available
                                echo "<div class='error'>Image not available</div>";
                              }

                              else
                              {
                                 //image is available
                                 ?>
                              <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                                 <?php

                              }

                              ?>


                        
                    </div>
    
                    <div class="food-menu-desc">
                        <h3><?php echo $title; ?></h3>
                        <input type="hidden" name="food" value="<?php echo $title; ?>">
                        
                        <h4><?php echo "Restaurant = ".$restaurant_name; ?></h4>

                        <p class="food-price">$<?php echo $price; ?></p>
                        <input type="hidden" name="price" value="<?php echo $price; ?>">


                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" min="1" class="input-responsive" value="1" onchange="change_quantity(this.value);" required>
                        
                    </div>
 
                </fieldset>
                
                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="E.g. kirubel endalamaw" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="conatct" placeholder="E.g. 9843xxxxxx" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="E.g. kirubelendala15@gmail.com" class="input-responsive" required>

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>

                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>

            </form>

            <?php
            //check whether the submit button is clicked or not

            if(isset($_POST['submit']))
            {
                //get the details from the form
                $food = $_POST['food'];
                $price = $_POST['price'];
                $qty = $_POST['qty'];

                $total = $price * $qty; // total = price * quantity
                $order_date = date("Y-m-d h:i:sa");// order date
                $status = "paid"; //ordered and on delivery, deliverd, cancelled 
                $customer_name = $_POST['full-name'];
                $customer_conatct = $_POST['conatct'];
                $customer_email = $_POST['email'];
                $customer_address = $_POST['address'];


                //save the order in databse
                //create sql to save the data

                $sql2 = "INSERT INTO tbl_order SET
                 restaurant_id = '$restaurant_id',
                 food = '$food',
                 price = '$price',
                 qty = '$qty',
                 total = '$total',
                 order_date = '$order_date',
                 status = '$status',
                 customer_name = '$customer_name',
                 customer_conatct = '$customer_conatct',
                 customer_email = '$customer_email',
                 customer_address = '$customer_address'
                
                
                ";

                //execute the query
                $res2 = mysqli_query($conn, $sql2);

                //check whether query executed successfully or not 
                if($res2==true)
                {
                    echo "<script>document.getElementById('on_to_yenepay').innerHTML = 'Food orderd, redirecting to YenePay...';</script>";
                    echo "<script>document.getElementById('submit_yenepay').click();</script>";
                }

                else
                {

                    //faild to save order 
                    $_SESSION['order'] = "<div class='error text-center'>Faild to order food.</div>";
                    header('location:'.SITEURL); 

                }

            


            }
            
            ?>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

    <?php include('partials-front/footer.php'); ?>