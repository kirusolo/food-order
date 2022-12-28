
<?php include('partials-front/menu.php'); ?>



    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>


            <?php
                   
              //display all the category all are active
              //sql query
              $sql = "SELECT tbl_category.*, tbl_resturant.resturant_name FROM tbl_category, tbl_resturant WHERE tbl_category.restaurant_id = tbl_resturant.id AND tbl_category.active='Yes' AND tbl_category.featured='Yes' LIMIT 30";
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


    <?php include('partials-front/footer.php'); ?>