<?php include('partials-front/menu.php'); ?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <form action="<?php echo SITEURL; ?>food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->


    <?php
    

    if(isset($_SESSION['order']))
    {


           echo $_SESSION['order'];
           unset($_SESSION['order']);
    }
    
    
    ?>

    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>


            <?php
            
            //create sql query to display categories from database
            $sql = "SELECT tbl_category.*, tbl_resturant.resturant_name FROM tbl_category, tbl_resturant WHERE tbl_category.restaurant_id = tbl_resturant.id AND tbl_category.active='Yes' AND tbl_category.featured='Yes' LIMIT 6";
            //execute the query
            $res = mysqli_query($conn, $sql);

            //count rows whether the category is avilable or not
            $count = mysqli_num_rows($res);

            if($count>0)
            {

                //category avilable
                while($row=mysqli_fetch_assoc($res))
                {
                    //get the vlaues id, title, image_name
                    $id = $row['id'];
                    $title = $row['title'];
                    $restaurant_name = $row['resturant_name'];
                    $image_name = $row['image_name'];
                    ?>

                    
            <a href="<?php echo SITEURL; ?>category-foods.php?category_id=<?php echo $id; ?>"> 
            <div class="box-3 float-container">

                <?php 

                //check whether image is avilable or not
                         if($image_name=="")
                         {
                            //display the message
                            echo "<div class='error'>image not avilable.</div>";
                            
                         }
                         else
                         {
                          //image avilable
                          ?>
                     <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" alt="Pizza" class="img-responsive img-curve">
                          <?php

                         }
                         
                         ?>

                

                <h4 style="text-shadow: 2px 1px #000000;" class="float-text text-white"><?php echo $restaurant_name."'s ".$title; ?></h4>
            </div>
            </a>
                      
                    <?php
                }

            }

            else    
            {
                //category not avilable 
                echo "<div class='error'>category not added</div>";

            }
            
            ?>


            

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->


    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

           <?php
           //geting foods from database that are active and featured
           $sql2 = "SELECT tbl_food.*, tbl_category.restaurant_id, tbl_resturant.resturant_name FROM tbl_food, tbl_category, tbl_resturant WHERE tbl_category.id = tbl_food.category_id AND tbl_resturant.id = tbl_category.restaurant_id AND tbl_food.active='Yes' AND tbl_food.featured='Yes' LIMIT 5";

             //execute the query
             $res2 = mysqli_query($conn, $sql2);

             //count rows
             $count2 = mysqli_num_rows($res2);

             //check whether food avilable or not 
             if($count2>0)
             {

                 //food avilable
                 while($row=mysqli_fetch_assoc($res2))
                 {
                     //get the vlaues id, title, image_name
                     $id = $row['id'];
                     $title = $row['title'];
                     $price = $row['price'];
                     $description = $row['description'];
                     $image_name = $row['image_name'];
                     $restaurant_name = $row['resturant_name'];

                     ?>

                     


            <div class="food-menu-box">
                <div class="food-menu-img">


                    <?php
                    //check whether image avilable or not

                    if($image_name=="")
                    {
                       //image not avilable
                       echo "<div class='error'>image not avilable.</div>";
                       
                    }
                    else
                    {
                     //image avilable
                     ?>

                 <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
              
                   <?php

                    }

                    
                    ?>


                    
                </div>

                <div class="food-menu-desc">
                    <h4><?php echo $title; ?></h4>
                    <h5>Resturant = <?php echo $restaurant_name; ?></h5>
                    <p class="food-price">$<?php echo $price; ?></p>
                    <p class="food-detail">
                       
                    <?php echo $description; ?>
                    
                    </p>
                    <br>

                    <a href="<?php echo SITEURL; ?>order.php?food_id=<?php echo $id; ?>&quantity=1" class="btn btn-primary">Order Now</a>
                </div>
            </div>


                     <?php


              


                    }
             }
             else
             {

                //food not avilable

             }


           

           
           ?>



            

            <div class="clearfix"></div>

            

        </div>

        <p class="text-center">
            <a href="#">See All Foods</a>
        </p>
    </section>
    <!-- fOOD Menu Section Ends Here -->

    <?php include('partials-front/footer.php'); ?>

    