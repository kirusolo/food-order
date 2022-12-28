<?php include('partials/menu.php');  ?>

<div class="main-content">

<div class="wrapper">
    <h1>Add Category</h1>

        <br><br>

        <?php
            if(isset($_SESSION['add']))
            {
     
     
                   echo $_SESSION['add'];
                   unset($_SESSION['add']);
            }
            
            if(isset($_SESSION['upload']))
            {
     
     
                   echo $_SESSION['upload'];
                   unset($_SESSION['upload']);
            }

        ?>
        <br><br>
    <!--Add category form starts here-->
    <form action="" method="POST" enctype="multipart/form-data">
    <table class="tbl-30">
     <tr>
          
       <td>Title: </td>
       <td>
        <input type="text" name="title" placeholder="category title">
    </td>

       </tr>

       <tr>
          
       <td>SelectImage: </td>
       <td>
        <input type="file" name="image">
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
          <input type="submit" name="submit" value="Add category" class="btn-secondary">

          </td>
          </tr> 


</table>


    </form>
    <!--Add category form ends here-->


 <?php

//check whether the submit button is clicked or not

if(isset($_POST['submit']))
{
  
    //1 get the value from category form
    $title = $_POST['title'];

    // for radio input we need to check whether the button is selected or not
    if(isset($_POST['featured']))
    {
        // get the value from form
        $featured = $_POST['featured'];
    }

    else
    {
        // set the defualt value
        $featured = "No";
    }

    if(isset($_POST['active']))
    {
        // get the value from form
        $active = $_POST['active'];
    }

    else
    {
        // set the defualt value
        $active = "No";
    }

    //check whether the image is selected or not and set the value for image name accordingly
    //print_r($_FILES['image']);
    //die();//break the code

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
       $image_name = "Food_Category_".rand(000, 999).'.'.$ext; // eg Food_category_555.jpg


       $source_path = $_FILES['image']['tmp_name'];

       $destination_path = "../images/category/".$image_name;    

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

    //2 create sql query to insert category into database
    $restaurant_id = $_SESSION['restaurant_id'];
    $sql = "INSERT INTO tbl_category SET
    title='$title',
    restaurant_id =$restaurant_id,
    image_name='$image_name',
    featured='$featured',
    active='$active'
    
    ";

    // execute the query and save it to database
    $res = mysqli_query($conn, $sql);

    //check whether the query excuted or not and data added or not

    if($res==true)
    {
        //query excuted and category add
        $_SESSION['add'] = "<div class='success'>category add sucssfully.</div>";
           //redirect to manage-category page
        header('location:'.SITEURL.'admin/manage-category.php');

    }
    else
    {
     //failed to add category
     $_SESSION['add'] = "<div class='error'>failed to add category.</div>";
           //redirect to manage-category page
        header('location:'.SITEURL.'admin/add-category.php');

    }
}

?>

</div>

</div>

<?php include('partials/footer.php'); ?>