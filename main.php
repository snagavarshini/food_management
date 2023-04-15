<?php
$conn = new mysqli("localhost", "root", "","onlinefoodorder");

//start session
session_start();

//define the variable
define('SITEURL','http://localhost/demo/');
?>

<html>
  <head>
    <title> NV-Home Page</title>
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
            <li><a href="http://localhost/demo/main.php">Home</a></li>
            <li><a href="http://localhost/demo/manage_admin.php">Admin</a></li>
            <li><a href="http://localhost/demo/manage_category.php">Category</a></li>
            <li><a href="http://localhost/demo/manage_food.php">Food</a></li>
            <li><a href="http://localhost/demo/manage_order.php">order</a></li>

         </div>
      </div>  
    <!--menu section ends-->

    <!--main content section starts-->
      <div class="main-content">
         <div class="wrapper">
           <h1>DASH BOARD</h1>
           <div class="col-4 text center">
             <?php
              //sql query
              $sql = "SELECT * FROM tbl_admin";
              //execute query
              $res = mysqli_query($conn,$sql);
              //count rows
              $count = mysqli_num_rows($res);
            ?>
             <h1><?php echo $count; ?></h1>
             
               <br>
               Admins
           </div>

           <div class="col-4 text center">
             <?php
              //sql query
              $sql2 = "SELECT * FROM tbl_category";
              //execute query
              $res2 = mysqli_query($conn,$sql2);
              //count rows
              $count2 = mysqli_num_rows($res2);
            ?>
             <h1><?php echo $count2; ?></h1>
               <br>
               Categories
           </div>

           <div class="col-4 text center">
             <?php
              //sql query
              $sql3 = "SELECT * FROM tbl_food";
              //execute query
              $res3 = mysqli_query($conn,$sql3);
              //count rows
              $count3 = mysqli_num_rows($res3);
            ?>
             <h1><?php echo $count3; ?></h1>
               <br>
              Food
           </div>

            <div class="col-4 text center">
            
             <h1>5</h1>
               <br>
              Orders
           </div>

           
           <div class="clearfix"></div>

         </div>
      </div>
    <!--main content section ends-->


    <!--footer section starts-->
      <div class="footer">
         <div class="wrapper">
           <p class="text-center">2022 All rights reserved,Developed By Nv Rk Sha Sho </p>
        
         </div>
      </div>
    <!--footer section ends-->

</body>
</html>