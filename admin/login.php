<?php include('../config/constants.php'); ?>  

<html>
  <head>
    <title>login - football website login</title>
    <link rel="stylesheet" href="../css/admin.css">
  </head>
  <body>
    <div class="login">
      <body>
        <div class="login">
          <h1 class="text-center">Login</h1>
          <br>
          <br>
          
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

?> <br><br>
          <!-- Login Form Starts Here -->
          <form action="" method="POST" class="text-center"> Username: <br>
            <input type="text" name="username" placeholder="Enter Username"><br><br>
             Password: <br>
            <input type="password" name="password" placeholder="Enter Password"><br><br>
            <input type="submit" name="submit" value="Login" class="btn-primary"> <br><br>
          </form>
          <!-- Login Form Ends Here -->
          <p class="text-center">Created By <a href="www.ankitapanwar.com">Mohit singh</a>
          </p>
        </div>
      </body>
</html> 
<?php

//Check whether the Submit Button is Clicked or NOT

if(isset($_POST['submit']))
{

//Process for Login

//1. Get the Data from Login form

$username = $_POST['username'];
$password = md5($_POST['password']);

//2. SQL to check whether the user with username and password exists or not
$sql = "SELECT * FROM tbl_admin WHERE username='$username' AND password = '$password'";
//3. Execute the Query

$res = mysqli_query($conn, $sql);
//4 count rows to check wheather the user exist or not
$count = mysqli_num_rows($res);
if($count==1)
{
    //user available and login success
    $_SESSION['login']= "<div class-'success'>login successful.</div>";
     $_SESSION['user'] = $username; //to check wheather the user is logged in or not and logout will unset it

 //redirect to home page/dashboard
    header('location:' .SITEURL. 'admin/');
}
else{

    // user not available and login failed
    $_SESSION['login'] = "<div class='error text-center'>Username or password did not match.</div>";
    // redirect to login page
    header('location:' . SITEURL . 'admin/login.php');
}

}
?>