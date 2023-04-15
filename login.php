<?php
$conn = new mysqli("localhost", "root", "","onlinefoodorder");

//start session
session_start();

//define the variable
define('SITEURL','http://localhost/demo/');
?>


<html>
    <head>
        <title>Login - Food Order System</title>
          <style>
            * {
  margin: 0;
  padding: 0;
  font-family: Arial, Helvetica, sans-serif;
}

.wrapper {
  padding: 1%;
  width: 80%;
  margin: 0 auto;
}

.text-center {
  text-align: center;
}

.clearfix {
  float: none;
  clear: both;
}

.tbl-full {
  width: 100%;
}
.tbl-30 {
  width: 30%;
}

table {
  border-collapse: collapse;
  width: 100%;
}

th,
td {
  padding: 8px;
  text-align: left;
  border-bottom: 1px solid #ddd;
}

tr:hover {
  background-color: #f5f5f5;
}

table tr th {
  border-bottom: 1px solid black;
  padding: 1%;
  text-align: left;
}

table tr td {
  padding: 1%;
}

.btn-primary {
  background-color: #1e90ff;
  padding: 1%;
  color: white;
  text-decoration: none;
  font-weight: bold;
}
.btn-primary:hover {
  background-color: #3742fa;
}

.btn-secondary {
  background-color: #7bed9f;
  padding: 1%;
  color: black;
  text-decoration: none;
  font-weight: bold;
}
.btn-secondary:hover {
  background-color: #2ed573;
}

.btn-danger {
  background-color: #ff6b81;
  padding: 1%;
  color: white;
  text-decoration: none;
  font-weight: bold;
}
.btn-danger:hover {
  background-color: #5d9e5f;
}

.success {
  color: #2ed573;
}
.error {
  color: #c40e23;
}

/* CSS for Menu */
.menu {
  border-bottom: 1px solid grey;
}
.menu ul {
  list-style-type: none;
}
.menu ul li {
  display: inline;
  padding: 1%;
}
.menu ul li a {
  text-decoration: none;
  font-weight: bold;
  color: #5d9e5f;
}
.menu ul li a:hover {
  color: #5d9e5f;
}

/* CSS for main-content */
.main-content {
  background-color: #f1f2f6;
  padding: 3% 0;
}

.col-4 {
  width: 18%;
  background-color: white;
  margin: 1%;
  padding: 2%;
  float: left;
}

/* CSS for Footer */
.footer {
  background-color: #5d9e5f;
  color: white;
}

/* CSS for Login */
.login {
  border: 1px solid grey;
  width: 20%;
  margin: 10% auto;
  padding: 2%;
}

</style> 
    </head>

    <body>
        
        <div class="login">
            <h1 class="text-center">Admin Login</h1>
            <br><br>

            <?php 
                if(isset($_SESSION['login']))
                {
                    echo $_SESSION['login'];
                    unset($_SESSION['login']);
                }

                if(isset($_SESSION['no-login-message']))
                {
                    echo $_SESSION['no-login-message'];
                    unset($_SESSION['no-login-message']);
                }
            ?>
        
<br>
            <!-- Login Form Starts HEre -->
            <form action="" method="POST" class="text-center">
            Username: <br>
            <input type="text" name="username" placeholder="Enter Username"><br><br>

            Password: <br>
            <input type="password" name="password" placeholder="Enter Password"><br><br>

            <input type="submit" name="submit" value="Login" class="btn-primary">
            <br><br>
            </form>
            <!-- Login Form Ends HEre -->

            
        </div>

    </body>
</html>

<?php 

    //CHeck whether the Submit Button is Clicked or NOt
    if(isset($_POST['submit']))
    {
        //Process for Login
        //1. Get the Data from Login form
        $username = $_POST['username'];
        $password = md5($_POST['password']);

        //2. SQL to check whether the user with username and password exists or not
        $sql = "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";

        //3. Execute the Query
        $res = mysqli_query($conn, $sql);

        //4. COunt rows to check whether the user exists or not
        $count = mysqli_num_rows($res);

        if($count==1)
        {
            //User AVailable and Login Success
            $_SESSION['login'] = "<div class='success'>Login Successful.</div>";
            $_SESSION['user'] = $username; //TO check whether the user is logged in or not and logout will unset it

            //REdirect to HOme Page/Dashboard
            header("location:".SITEURL.'main.php');
        }
        else
        {
            //User not Available and Login FAil
            $_SESSION['login'] = "<div class='error text-center'>Username or Password did not match.</div>";
            //REdirect to HOme Page/Dashboard
            header("location:".SITEURL.'login.php');
        }


    }

?>