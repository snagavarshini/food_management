<?php
$conn = new mysqli("localhost", "root", "","onlinefoodorder");

//start session
session_start();

//define the variable
define('SITEURL','http://localhost/onlinefood-order/');

?>
<html>
  <head>
    <title> Manage Category</title>
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


.tbl-full{
width: 100%;
}

table tr th{
border-bottom: 1px solid black;
padding: 1%;
text-allign: left;
}

table tr td{
padding: 1%;
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

.btn-secondary{
background-color: #ED4C67 ;
padding: 5px;
color: white;
text-decoration: none;
font-width: bold;
}

.btn-secondary:hover{
background-color: #833471 ;
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
           <h1>MANAGE CATEGORY</h1>
           <br/> <br/>

           <?php
             if(isset($_SESSION['add']))
             {
               echo $_SESSION['add']; //Displaying session message
               unset($_SESSION['add']); //Removing session message
              }
           ?>
           <br><br><br>
           <!--Button to add Admin-->
           <a href="add-category.php" class="btn-primary">Add category</a>
           </br>
           </br>
           </br>
           <table class="tbl-full">
             <tr>
               <th>S.no.</th>
               <th>Hotel name</th>
               <th>Image </th>
               <th>food</th>
               <th>Hotel Address</th>
               <th>Action</th>
             
             </tr>
            <?php
               //query to get all category
               $sql = "SELECT * from tbl_category";
               //execute the query
               $res = mysqli_query($conn,$sql);
               //check whether the query is executed or not
               if($res==TRUE)
               {
                   //count rows to check whether we have data in database or not
                   $count = mysqli_num_rows($res); //function to get all the rows in database
                   
                   $sn=1; //create a variable and assign the value


                   //check the num of rows
                   if($count>0)
                   {
                      //we have data in database
                      while($rows=mysqli_fetch_assoc($res))
                      {
                          //using while loop to get all the data from db
                          //and while loop will run as long as we have data in db


                          //get individual data
                          $id=$rows['id'];
                          $hotel_name=$rows['hotel_name'];
                          $image_name = $rows['image_name'];
                          $food=$rows['food'];
                          $hotel_address=$rows['hotel_address'];
                          //dispaly the values in our website
                          ?>
                          <tr>
                            <td><?php echo $sn++; ?> </td>
                            <td><?php echo $hotel_name; ?></td>
                            <td>
                              <?php
                               //Chcek whether image name is available or not
                                                if($image_name!="")
                                                {
                                                    //Display the Image
                                                    ?>
                                                    
                                                    <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" width="100px" >
                                                    
                                                    <?php
                                                }
                                                else
                                                {
                                                    //DIsplay the MEssage
                                                    echo "<div class='error'>Image not Added.</div>";
                                                }
                                            ?>

                                        </td>
                            <td><?php echo $hotel_name; ?></td>
                            <td><?php echo $hotel_address; ?></td>
                            <td>
                              <a href="#" class="btn-secondary">Update category</a>
                              <a href="#" class="btn-secondary">Delete category</a>
                            </td>
                          </tr>


                          <?php
                        } 
                    }
                    else
                    {
                       //we do not have data in db
                    }
              
                }
             ?>
                
           </table>
           
            <div class="clearfix"></div>

         </div>
      </div>
    <!--main content section ends-->


    <!--footer section starts-->
      <div class="footer">
         <div class="wrapper">
           <p class="text-center">2022 All rights reserved,Developed By Nagavarshini </p>
        
         </div>
      </div>
    <!--footer section ends-->

</body>
</html>