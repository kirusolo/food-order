<?php include('partials/menu.php'); ?>



<?php
             
             //check whether the id is set or not
             if(isset($_GET['id']))
             {
                //get the id and all other details
                  // echo "geting the value";
                   $id = $_GET['id'];

                //sql query to get the selected food

                $sql2 = "SELECT * FROM tbl_food WHERE id=$id";

                //execute the query
                $res2 = mysqli_query($conn, $sql2);

                //get the value based on query executed

                $row2 = mysqli_fetch_assoc($res2); 
        
                    //get the individual values of selected food
                   
                    $title = $row2['title'];

                    $description = $row2['description'];

                    $price = $row2['price'];
                    $current_image = $row2['image_name'];
                    $current_category = $row2['id'];
                    $featured = $row2['featured'];
                    $active = $row2['active'];

                

               
                    
             }

             else
             {
              
                //redirect to manage category
                header('location:'.SITEURL.'admin/manage-category.php');
             }
      
       ?>






<div class="main-content">
  <div class="wrapper">
    <h1>
       Update Food
    </h1>

    <form action="" method="POST" enctype="multipart/form-data">

<table class="tbl-30">
<tr>
  
<td>Title: </td>
<td>
<input type="text" name="title" value="<?php echo $title; ?>">
</td>

</tr>

<tr>
  
  <td>Description: </td>
  <td>
    
  <textarea name="description" cols="30" rows="5"><?php echo $description; ?></textarea>
</td>

  </tr>   

  <tr>
  
  <td>Price: </td>
  <td>
   <input type="number" name="price"  value="<?php echo $price ?>">
</td>

  </tr>


  <tr>  
  <td>Current Image: </td>
  <td>
       
    <?php
           
           if($current_image == "")
           {

             //image not avilable
             echo "<div class='error'>Image not avilable</div>";

           }

           else
           {
              //image avilable
              ?>
              <img src="<?php echo SITEURL; ?>images/food/<?php echo $current_image; ?>" width="150px">
              <?php

           }
    ?>

</td>

  </tr>

  <tr>
        <td>New Image: </td>
        <td>
            <input type="file" name="image">
        </td>
     
  </tr>


  <tr>
  <td>Category: </td>
  <td>
    <select name="category">

             
    <?php


//
if(isset($_SESSION['restaurant_id']))
{
  $restaurant_id = $_SESSION['restaurant_id'];
}
$sql = "SELECT * FROM tbl_category WHERE active='Yes' && restaurant_id = $restaurant_id";
  
//execute the query
$res = mysqli_query($conn, $sql);

//count rows to check whether we have categories or not
$count = mysqli_num_rows($res);
    
//if count have greater than zero, we have category else we don't have category
if($count>0)
{
  // category avilable
   while($row=mysqli_fetch_assoc($res))
   {
    // category not avilable
    $category_title = $row['title'];
    $category_id = $row['id'];

      ?>
       <option <?php if($current_category==$category_id){echo "selected";} ?> value="<?php echo $category_id; ?>"><?php echo $category_title; ?></option>

      <?php

   }
  
   

}
else
{

   //we dont have category

 echo  "<option value='0'>No category found</option>";

   
}


//display on dropdown


?> 



    </select>
</td>
    </tr>

    
<tr>

<td>Featured: </td>
<td>
  <input <?php if($featured=="Yes"){echo "checked";} ?> type="radio" name="featured" value="Yes"> Yes
  <input <?php if($featured=="No"){echo "checked";} ?> type="radio" name="featured" value="No"> No

</td>
</tr> 

<tr>

<td>Active: </td>
<td>
  <input <?php if($active=="Yes"){echo "checked";} ?> type="radio" name="active" value="Yes"> Yes
  <input <?php if($active=="No"){echo "checked";} ?> type="radio" name="active" value="No"> No

</td>
</tr> 









  

<tr>
    <td> 
    

<input type="hidden" name="id" value="<?php echo $id; ?>">
<input type="hidden" name="current_image" value="<?php echo $current_image; ?>">

<input type="submit" name="submit" value="Update-Food" class="btn-secondary">

</td>
</tr> 
      

</table>

</form>




<?php
   
   if(isset($_POST['submit']))
   {
      //echo "submit";
      //1 get all the values from our form

       $id = $_POST['id'];
       $title = $_POST['title'];
       $description = $_POST['description'];
       $price = $_POST['price'];
       $current_image = $_POST['current_image'];
       $category = $_POST['category'];
       $featured = $_POST['featured'];
       $active = $_POST['active'];

       //2 updating new image if selected
       //check whether the image is selected or not
       if(isset($_FILES['image']['name']))

       {
         //get the image details
          $image_name = $_FILES['image']['name'];

          //check whether the image is available or not
          if($image_name != "")
          {
             //image avilable
             //A. upload the new image

        
              //auto rename our image
    //get the extension of our image(jpg,gif,png, etc) eg. foo1.jpg
    $ext = (end(explode('.', $image_name)));

    //rename the image
    $image_name = "Food_Name_".rand(000, 999).'.'.$ext; // eg Food_name_555.jpg


    $src_path = $_FILES['image']['tmp_name'];

    $dst_path = "../images/food/".$image_name;    

    //finaly upload the image
    $upload = move_uploaded_file($src_path, $dst_path);

    //check whether the image is uploaded or not 
    //and if the image is not uploaded then we will stop the process and redirect with error messeage
    if($upload==false)
    {
     //set messeage 
     $_SESSION['upload'] = "<div class='error'>failed to upload image.</div>";
     //redirect to add category page
     header('location:'.SITEURL.'admin/manage-food.php');
      //stop the process
      die();

    }
   

             //B. remove the new image
                  if($current_image!="")
                  {
                     
                     $remove_path = "../images/food/".$current_image;

                     $remove = unlink($remove_path);

             //check to remove the image
             if($remove==false)
             {
                 //faile to remove image
                 $_SESSION['failed-remove'] = "<div class='error'>failed to remove current image</div>";
                 header('location:'.SITEURL.'admin/manage-food.php');
                 die();//stop
             }

                  }

             
          }
            else
            {
              $image_name = $current_image;//defualt image when image is not selected
            }

        }
          else
          {
             $image_name = $current_image;//default image when button is not clicked

          }

      
       
       
       //3 update the database
       $sql3 = "UPDATE tbl_food SET
           title = '$title',
           description = '$description',
           price = '$price',
           image_name = '$image_name',
           category_id = '$category',
           featured = '$featured',
           active = '$active'
           WHERE id=$id
        
       ";

       //execute the query
       $res3 = mysqli_query($conn, $sql3);

       //4 redirect to manage category with message
       //check whether executed or not

     if($res3==true)
     {
         //category updated 
         $_SESSION['update'] = "<div class='success'>Food updated successfully.</div>";
         header('location:'.SITEURL.'admin/manage-food.php');
     }

     
     else
     {
         // fail to updaate category
         $_SESSION['update'] = "<div class='error'>failed to update Food.</div>";
         header('location:'.SITEURL.'admin/manage-food.php');
     }

 }

 ?>


           
  </div>

</div>



<?php include('partials/footer.php'); ?>