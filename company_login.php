<?php 
session_start();
error_reporting(E_ERROR | E_PARSE);
if($_SESSION['h']==$_POST['hide'] && !empty($_POST['hide']) && !empty($_POST['user']) && !empty($_POST['pass']) && !empty($_SESSION['h']) )
{
    $_SESSion['h']=12;
    $user=$_POST['user'];  
    $pass=$_POST['pass'];  
    $dbhost="localhost";
    $dbuser="root";
    $dbpass="";
    $db="placement";
    $conn=new mysqli($dbhost,$dbuser,$dbpass,$db);
    if($conn->connect_error)
    {
    die("connection failed: %s\n".$conn->connect_error);
    }
    $sql = "SELECT username, password FROM company where username='".$user."' and password='".$pass."' ";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {

    while($row = $result->fetch_assoc())  
    {  
    $dbusername=$row['username'];  
    $dbpassword=$row['password'];  
    }  
  
    if($user == $dbusername && $pass == $dbpassword)  
    {  
    $_SESSION['user2']=$_POST['user'];
    setcookie("munvar","data",time()+60,'/');
    /*<?php
    print_r($_COOKIE);
    ?>session_start();  
    $_SESSION['user']=$_POST['user'];*/
    echo '<script type ="text/JavaScript">';
      echo 'alert("Login is successfull");';
      echo 'window.location="drive_details.php";';
      echo '</script>';  
    /*header('Location:drive_details.php'); */ 
    /*echo $_POST['hide'];*/
    } 
    }
     else {  
        echo '<script type ="text/JavaScript">';
    	echo 'alert("Invalid username or password!")';
    	echo '</script>';  
                
    }  

	 
}
?><html>
<head>
  <style>
    .points{
      list-style-type:disc;
      padding-bottom:20px;
    }
    #m3{
      background-color:#EAC8AF;
      border-radius:8px;
    }
  </style>
	<link rel="stylesheet" href="css/bootstrap.css">
</head>
<body style="background-color: #F5F3EE;overflow-x:hidden;" >
	<?php include('Header1.html') ?>

    <br>
     <div class="row " style="margin-bottom:130px;">
       <div class="col-md-4">
       </div>
       <div class="col-md-4">
       	<form class="form-sign-in" action="#" method="post">
       		<h3 class="form-signin-heading" style="text-align:center;">Company Login</h3></br>
       		<input type="text" class="form-control" name="user" placeholder="Username" required autofocus></br>
       		<input type="password" class="form-control" name="pass" placeholder="passsord" required></br>
		<input type="hidden" value="<?php $_SESSION['h']=rand(1,1000); echo $_SESSION['h'];?>" name="hide">
		<div class="row"> <div class="col-md-10" ><a href="aboutus.php" style="text-align:left;">Forget Password?</a></div> <div class="col-md-2" ><a href="aboutus.php" style="text-align:center;">Sign Up</a></div></div>&nbsp<br>
		<input type="Submit" class="btn btn-primary btn-block" value="Log in">
	     &nbsp
       	</form>
       </div>
       <div class="col-md-4">

        <div class="card border-0" style="margin:auto;">
          <div class="card-body" style="background-color: #F5F3EE;">
            <h4 class="card-title text-center" style="padding-bottom:20px;color:red"><b>Guidelines</b></h4>
            <h5 class="card-text "><ul ><li class="points"> Company representatives should contact TPO of the college to get their credentails for the login.</li><li class="points"> Drive details should be uploaded in the form of pdf.</li><li class="points"> If u have issue related to password of your credentials, please contact TPO of the college.</li></ul></h5>
          </div>
        </div>

       </div>
    </div>

	<?php include('footer.html') ?>
</body>
</html>