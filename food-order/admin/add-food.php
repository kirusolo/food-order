<?php include('partials/menu.php'); ?>

<div class="main-content">
 <div class="wrapper">
    <h1>Add Food</h1>

        <br><br>

        <?php
            
            if(isset($_SESSION['upload']))
            {
     
     
                   echo $_SESSION['upload'];
                   unset($_SESSION['upload']);
            }
        
        ?>

        <form action="" method="POST" enctype="multipart/form-data">

        <table class="tbl-30">
     <tr>
          
       <td>Title: </td>
       <td>
        <input type="text" name="title" placeholder="Title of the food">
    </td>

       </tr>

       <tr>
          
          <td>Description: </td>
          <td>
            
          <textarea name="description" id="" cols="30" rows="6" placeholder="description"></textarea>
        </td>
   
          </tr>   

          <tr>
          
          <td>Price: </td>
          <td>
           <input type="number" name="price">
       </td>
   
          </tr>

          <tr>
          
          <td>SelectImage: </td>
          <td>
           <input type="file" name="image">
       </td>
   
          </tr>

          <tr>
          
          <td>Category: </td>
          <td>
            <select name="category">

                  <?php
                  $restaurant_id = $_SESSION['restaurant_id'];
                  //create php code to display categorys from databse
                  //1 create sql to get all active category from database
                  $sql = "SELECT * FROM tbl_category WHERE active='Yes' && restaurant_id = $restaurant_id";
                    
                  //execute the query
                  $res = mysqli_query($conn, $sql);

                  //count rows to check whether we have categories or not
                  $count = mysqli_num_rows($res);
                      
                  //if count have greater than zero, we have category else we don't have category
                  if($count>0)
                  {
                    //we have category
                     while($row=mysqli_fetch_assoc($res))
                     {
                      //get the details of category
                      $id = $row['id'];
                      $title = $row['title'];

                        ?>
                         <option  value="<?php echo $id; ?>"><?php echo $title; ?></option>

                        <?php

                     }
                    
                     

                  }
                  else
                  {

                     //we dont have category
                     ?>
                     <option value="0">No category found</option>

                     <?php
                  }


                  //display on dropdown


                  ?> 
            
                
            </select>
          
       </td>
   
          </tr>

          <tr>
          
          <td>Featured: </td>
          <td>
            <input type="radio" name="featured" value="Yes"> Yes
            <input type="radio" name="featured" value=" No"> No

        </td>
  </tr> 

  <tr>
          
          <td>Active: </td>
          <td>
            <input type="radio" name="active" value="Yes"> Yes
            <input type="radio" name="active" value=" No"> No

        </td>
  </tr> 

  <tr>
          
          <td colspan="2">

          <input type="submit" name="submit" value="Add-Food" class="btn-secondary">

          </td>
    </tr> 
                

</table>

        </form>


        <?php
               //check whether the button is clicked or not
               if(isset($_POST['submit']))
               { 
                 //add the food in databasse
                 //1 get the data from form
                 $title = $_POST['title'];
                 $description = $_POST['description'];
                 $price = $_POST['price'];
                 $category = $_POST['category'];
                 
                 

                //check whether radion button for featured and active are checked or not
                if(isset($_POST['featured']))
                {
                  $featured = $_POST['featured'];

                }
                else
                {
                  $featured = "No";//setting the default value

                }
                    if(isset($_POST['active']))
                    {
                      $active = $_POST['active'];

                    }
                    else
                    {
                      $active = "No";//seting the default value

                    }

                 //2 upload the image if selected
                 //check whether the selecetd image is clicked or not and upload the image only if the image is selected
                    
     
                 if(isset($_FILES['image']['name']))
                 {
                    //upload the image
                    //to upload image we need image name, source path, destination 
                    $image_name = $_FILES['image']['name'];
                  //upload the image if only selected
                  if($image_name != "")
                   {
             
             
                  
             
                    //auto rename our image
                    //get the extension of our image(jpg,gif,png, etc) eg. foo1.jpg
                    $ext = (end(explode('.', $image_name)));
             
                    //rename the image
                    $image_name = "Food_Name_".rand(000, 999).'.'.$ext; // eg Food__555.jpg
             
             
                    $source_path = $_FILES['image']['tmp_name'];
             
                    $destination_path = "../images/food/".$image_name;    
             
                    //finaly upload the image
                    $upload = move_uploaded_file($source_path, $destination_path);
             
                    //check whether the image is uploaded or not 
                    //and if the image is not uploaded then we will stop the process and redirect with error messeage
                    if($upload==false)
                    {
                     //set messeage 
                     $_SESSION['upload'] = "<div class='error'>failed to upload image.</div>";
                     //redirect to add category page
                     header('location:'.SITEURL.'admin/add-category.php');
                      //stop the process
                      die();
             
                    }
                 }
             
                 }
             
                 else
                 {
                     //don't upload the image and set the image name as blank
                     $image_name="";
                 }
             
                       
                 //3 insert in to database
                 //create sql query
                 $sql2 = "INSERT INTO tbl_food SET
                 
                 title = '$title',
                 description = '$description',
                 price = $price,
                 image_name = '$image_name',
                 category_id = $category,
                 featured = '$featured',
                 active = '$active'
                 

                 
                 ";

                 //execute the query
                $res2 = mysqli_query($conn, $sql2);

                //check whether the data inserted or not
                if($res2 == true)

                {

                  //data inserted successfully
                  $_SESSION['add'] = "<div class='success'>Food added successfully.</div>";
                  header('location:'.SITEURL.'admin/manage-food.php');

                }
                     else
                     {
                      $_SESSION['add'] = "<div class='error'>Faild to add food.</div>";
                      header('location:'.SITEURL.'admin/manage-food.php');
                     }
                 //4 redirect with message to manage food page


               }

        ?>

 </div>

</div>

<?php include('partials/footer.php'); ?>
