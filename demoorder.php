<?php
$conn = new mysqli("localhost", "root", "","onlinefoodorder");

//start session
session_start();

//define the variable
define('SITEURL','http://localhost/demo/');

?>

<html>
  <head>
    <title> NV-order</title>
    <style>
        :root{
  --red:#ff3838;
}

*{
  font-family: 'Nunito', sans-serif;
  margin:0; padding:0;
  box-sizing: border-box;
  outline: none; border:none;
  text-decoration: none;
  text-transform: capitalize;
  transition:all .2s linear;
}

*::selection{
  background:var(--red);
  color:#fff;
}

html{
  font-size: 62.5%;
  overflow-x: hidden;
  scroll-behavior: smooth;
  scroll-padding-top: 6rem;
}

body{
  background:#f7f7f7;
}

section{
  padding:2rem 9%;
}

.heading{
  text-align: center;
  font-size: 3.5rem;
  padding:1rem;
  color:#666;
}

.heading span{
  color:var(--red);
}

.order .row{
  padding:2rem;
  box-shadow: 0 .5rem 1rem rgba(0,0,0,.1);
  background:#fff;
  display: flex;
  flex-wrap: wrap;
  gap:1.5rem;
  border-radius: .5rem;
}

.order .row .image{
  flex:1 1 30rem;
}

.order .row .image img{
  height: 100%;
  width:100%;
  object-fit: cover;
  border-radius: .5rem;
}

.order .row form{
  flex:1 1 50rem;
  padding:1rem;
}

.order .row form .inputBox{
  display: flex;
  justify-content: space-between;
  flex-wrap: wrap;
}

.order .row form .inputBox input, .order .row form textarea{
  padding:1rem;
  margin:1rem 0;
  font-size: 1.7rem;
  color:#333;
  text-transform: none;
  border:.1rem solid rgba(0,0,0,.3);
  border-radius: .5rem;
  width:49%;
}

.order .row form textarea{
  width:100%;
  resize: none;
  height:15rem;
}

.order .row form .btn{
  background:none;
}

.order .row form .btn:hover{
  background:var(--red);
}

.btn{
  display: inline-block;
  padding:.8rem 3rem;
  border:.2rem solid var(--red);
  color:var(--red);
  cursor: pointer;
  font-size: 1.7rem;
  border-radius: .5rem;
  position: relative;
  overflow: hidden;
  z-index: 0;
  margin-top: 1rem;
}

.btn::before{
  content: '';
  position: absolute;
  top:0; right: 0;
  width:0%;
  height:100%;
  background:var(--red);
  transition: .3s linear;
  z-index: -1;
}

.btn:hover::before{
  width:100%;
  left: 0;
}

.btn:hover{
  color:#fff;
}

header{
  position: fixed;
  top:0; left: 0; right:0;
  z-index: 1000;
  display: flex;
  align-items: center;
  justify-content: space-between;
  background:#fff;
  padding:2rem 9%;
  box-shadow: 0 .5rem 1rem rgba(0,0,0,.1);
}

header .logo{
  font-size: 2.5rem;
  font-weight: bolder;
  color:#666;
}

header .logo i{
  padding-right: .5rem;
  color:var(--red);
}

header .navbar a{
  font-size: 2rem;
  margin-left: 2rem;
  color:#666;
}

header .navbar a:hover{
  color:var(--red);
}

#menu-bar{
  font-size: 3rem;
  cursor: pointer;
  color:#666;
  border:.1rem solid #666;
  border-radius: .3rem;
  padding:.5rem 1.5rem;
  display: none;
}
</style>
</head>
<body>

<!-- header section starts  -->

<header>

    <a href="#" class="logo"><i class="fas fa-utensils"></i>food for everyone</a>

    <div id="menu-bar" class="fas fa-bars"></div>

    <nav class="navbar">
        <a href="index.php#home">home</a>
        <a href="index.php#speciality">speciality</a>
        <a href="index.php#popular">food</a>
        <a href="index.php#gallery">gallery</a>
        <a href="index.php#review">review</a>
        <a href="demoorder.php">order</a>
    </nav>

</header>

<!-- header section ends -->

<!-- order section starts  -->


<section class="order" id="order">


<h1 class="heading"> <span>order</span> now </h1>

<div class="row">
        
        <div class="image">
            <img src="images/bri2.jpg" alt="">
        </div>


<?php
           if(isset($_SESSION['add'])) //checking whether the session is set or not
            {
              echo $_SESSION['add']; //displaying the session message if set
              unset($_SESSION['add']); //remove session message
            }
           ?> 

    

    

        <form action="" method="POST">

            <div class="inputBox">
                <input type="text" name="name" placeholder="name">
                <input type="email" name="email" placeholder="email">
            </div>

            <div class="inputBox">
                
                <input type="text" name="hotel_name" placeholder="Hotel name">
                 <input type="text" name="food_name" placeholder="Food name">
                <input type="date" name="order_date" placeholder="Date">
            </div>
   <textarea placeholder="address" name="address" id="" cols="30" rows="10"></textarea>

            <input type="submit" name="submit" value="order now" class="btn">

        

    </div>

</section>

<!-- order section ends -->
<?php

if(isset($_POST['submit']))
{

//Get the Data from form

 $name = $_POST['name'];
 $email = $_POST['email'];
 $hotel_name = $_POST['hotel_name'];
 $food_name = $_POST['food_name'];
 $order_date = $_POST['order_date'];
 $address = $_POST['address'];
 


//SQL Query to save the data into dataBase

 $sql = "INSERT INTO tbl_order SET
   name='$name',
   email='$email',
   hotel_name='$hotel_name',
   food_name='$food_name',
   order_date='$order_date',
   address='$address'
   
 ";

//Executing Query and saving Data into db
 $res = mysqli_query($conn, $sql) or die(mysqli_error());

//check whether the (query is inserted)data is inserted or not and display appropriate message
if($res==TRUE)
{
//data inserted
//echo "Data inserted"; 
//create a session variable to display message
$_SESSION['add'] = "ordered Successfully";
//redirect page to manage admin
//header("location:".SITEURL.'index.php');
echo '<script>window.location= "index.php"</script>';
}

else
{
//failed to insert data
//echo "Fail to insert data";
//create a session variable to display message
$_SESSION['add'] = "Failed to add Admin";
//redirect page to add admin
header("location:" .SITEURL. 'demoorder.php');

}

}


   

?>

</body>
</html>