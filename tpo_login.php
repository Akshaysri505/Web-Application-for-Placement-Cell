<?php
session_start();
if(!empty($_POST['userid']) && !empty($_POST['pwd']) && !empty($_SESSION['h']) && $_POST['hide'] == $_SESSION['h'] ) { 
    $_SESSION['h']==23;
    $user=$_POST['userid'];  
    $pass=$_POST['pwd'];  
    $dbhost="localhost";
    $dbuser="root";
    $dbpass="";
    $db="placement";
    $conn=new mysqli($dbhost,$dbuser,$dbpass,$db);
    if($conn->connect_error)
    {
    die("connection failed: %s\n".$conn->connect_error);
    }
    $sql = "SELECT Username, Password FROM tpo where Username='".$user."' and Password='".$pass."' ";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {

    while($row = $result->fetch_assoc())  
    {  
    $dbusername=$row['Username'];  
    $dbpassword=$row['Password'];  
    }  
  
    if($user == $dbusername && $pass == $dbpassword)  
    {      	   
    $_SESSION['user1']=$_POST['userid'];
    echo '<script type="text/javascript">';
    echo 'alert("Login is scuccessfull");';
    echo 'window.location="generate_pdf.php";';
    echo '</script>' ; 
    /*header('location:generate_pdf.php'); */ 
    } 
    }
     else {  
      echo '<script>';
    echo 'alert("Invalid username or password!")';  
    echo '</script>';
    }  
}  

?>
<html>
<head>
    	<link rel="stylesheet" href="css/bootstrap.css" >
      <style>
        #m4{
      background-color:#EAC8AF;
      border-radius:8px;
    }
      </style>
</head>
<body style="background-color: #F5F3EE;overflow-x:hidden;">
		<?php include 'Header1.html' ?>
	<div class="row" style="margin-bottom:180px;margin-top:10px;" >
	<div class="col-md-4">
	</div>
	<div class="col-md-4" >
		<form class="form-sign-in" action="#" method="POST" >
       		<h3 class="form-signin-heading" style="text-align:center;">TPO Log In</h3></br>
       		<input type="text" class="form-control" name="userid" id="userid" placeholder="Username" required></br>
          <input type="password" class="form-control" name="pwd"  id="pwd" placeholder="Password" required></br>
          <input type="hidden" name="hide" id="hide" value="<?php  $_SESSION['h']=rand(1,100); echo $_SESSION['h']; ?>" ></br>
          <!--<input class="form-control"  name="email" placeholder="email" pattern="[a-zA-Z0-9]+@[a-z]+.[a-z]{2,4}"></br>-->
       	  <input type="submit"   class="btn  btn-primary btn-block" value="LOG IN"></br>
       	 <!-- <a href="#" style="text-decoration:none;">Forgot Password?</a><br>-->
    </form>
	</div>
    <div class="col-md-4">
	  </div>	
  </div>
		<?php include 'footer.html' ?>
</body>
</html>