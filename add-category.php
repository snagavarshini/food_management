<?php
$conn = new mysqli("localhost", "root", "","onlinefoodorder");

//start session
session_start();

//define the variable
define('SITEURL','http://localhost/demo/');

?>
<html>
  <head>
    <title> NV-Add Category</title>
    <style>
*{
margin: 0;
padding: 0;
font-family:arial,Helvelica,sans-serif; 
}

.wrapper{
padding: 1%;
width: 80%;
margin: 0 auto;
}  

.text-center{
text-align: center;
}

.clearfix{
float: none;
clear: both;
}


.btn-primary{
background-color: #ED4C67 ;
padding: 1%;
color: white;
text-decoration: none;
font-width: bold;
}

.btn-primary:hover{
background-color: #833471 ;
}

.tbl-30{
width: 30%;
}



/* css for Menu */
.menu{
border-bottom: 1px solid grey;
}

.menu ul{
list-style-type:none;
}

.menu ul li{
display: inline;
padding: 1%;
}

.menu ul li a{
text-decoration: none;
font-weight: bold;
color: #ED4C67;
}

.menu ul li a:hover{
color: #be2edd;
}

/* css for main content*/
.main-content{
background-color: #95afc0;
padding: 3% 0;
}

.col-4{
width: 18%;
background-color: white;
margin: 1%;
padding: 2%;
float: left;
}

/* css for footer */
.footer{
background-color: #ED4C67;
color: white;
}
    </style>
  </head>
 <body>
    <!--menu section starts-->
      <div class="menu text-center">
        <div class="wrapper">
          <ul>
            <li><a href="main.php">Home</a></li>
            <li><a href="manage_admin.php">Admin</a></li>
            <li><a href="manage_category.php">Category</a></li>
            <li><a href="manage_food.php">Food</a></li>
            <li><a href="manage_order.php">order</a></li>

         </div>
      </div>  
    <!--menu section ends-->



<!--main content section starts-->
      <div class="main-content">
         <div class="wrapper">
           <h1>ADD CATEGORY</h1>
           </br></br>
           <?php
           if(isset($_SESSION['add'])) //checking whether the session is set or not
            {
              echo $_SESSION['add']; //displaying the session message if set
              unset($_SESSION['add']); //remove session message
            }
           ?>
           <form action= "" method="POST">
             <table class="tbl-30">
               <tr>
                 <td>Hotel Name: </td>
                 <td><input type="text" name="hotel_name" placeholder="Enter Hotel Name"></td>
               </tr>

               <tr>
                    <td>Select Image: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                 <tr>
                 <td>Food: </td>
                 <td><input type="text" name="food" placeholder="Enter food Name"></td>
               </tr>

               <tr>
                 <td>Hotel Address</td>
                 <td><input type="text" name="hotel_address" placeholder="Hotel Address">
                 </td>
               </tr>

              
               <tr>
                 <td colspan="2">
                 <input type="submit" name="submit" value="Add Category" class="btn-primary"></td>
               </tr>
             </table>
</form>
         </div>
      </div>





<!--footer section starts-->

      <div class="footer">
         <div class="wrapper">
           <p class="text-center">2022 All rights reserved,Developed By Nagavarshini </p>
        
         </div>
      </div>
    <!--footer section ends-->


<?php

if(isset($_POST['submit']))
{

//Get the Data from form

 $hotel_name = $_POST['hotel_name'];
 $hotel_address = $_POST['hotel_address'];
$food = $_POST['food'];
$image_name = $_POST['image_name'];

if(isset($_FILES['image']['name']))
                {
                    //Upload the Image
                    //To upload image we need image name, source path and destination path
                    $image_name = $_FILES['image']['name'];
                    
                    // Upload the Image only if image is selected
                    if($image_name != "")
                    {

                        //Auto Rename our Image
                        //Get the Extension of our image (jpg, png, gif, etc) e.g. "specialfood1.jpg"
                        $ext = end(explode('.', $image_name));

                        //Rename the Image
                        $image_name = "Food_Category_".rand(000, 999).'.'.$ext; // e.g. Food_Category_834.jpg
                        

                        $source_path = $_FILES['image']['tmp_name'];

                        $destination_path = "/images/category/".$image_name;

                        //Finally Upload the Image
                        $upload = move_uploaded_file($source_path, $destination_path);

                        //Check whether the image is uploaded or not
                        //And if the image is not uploaded then we will stop the process and redirect with error message
                        if($upload==false)
                        {
                            //SEt message
                            $_SESSION['upload'] = "<div class='error'>Failed to Upload Image. </div>";
                            //Redirect to Add CAtegory Page
                            header('location:'.SITEURL.'add-category.php');
                            //STop the Process
                            die();
                        }

                    }
                }
                else
                {
                    //Don't Upload Image and set the image_name value as blank
                    $image_name="";
                }

//SQL Query to save the data into dataBase

 $sql = "INSERT INTO tbl_category SET
   hotel_name='$hotel_name',
   image_name='$image_name',
   food='$food',
   hotel_address='$hotel_address'
 ";

//Executing Query and saving Data into db
 $res = mysqli_query($conn, $sql) or die(mysqli_error());

//check whether the (query is inserted)data is inserted or not and display appropriate message
if($res==TRUE)
{
//data inserted
//echo "Data inserted"; 
//create a session variable to display message
$_SESSION['add'] = "Category Added Successfully";
//redirect page to manage category
header("location:".SITEURL.'manage_category.php');
}

else
{
//failed to insert data
//echo "Fail to insert data";
//create a session variable to display message
$_SESSION['add'] = "Failed to add Admin";
//redirect page to add admin
header("location:".SITEURL.'add-category.php');

}

}


   

?>

</body>
</html>