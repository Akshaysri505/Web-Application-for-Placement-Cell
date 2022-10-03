
<?php
 session_start();
if( !empty($_POST['user']) && !empty($_POST['pass']) && !empty($_SESSION['h']) && $_POST['hide'] == $_SESSION['h'] ){ 
    $_SESSION['h']=145; 
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
    $sql = "SELECT Username, Password FROM present_year_students where Username='".$user."' and Password='".$pass."' ";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {

    while($row = $result->fetch_assoc())  
    {  
    $dbusername=$row['Username'];  
    $dbpassword=$row['Password'];  
    }  
  
    if($user == $dbusername && $pass == $dbpassword)  
    {  
    $_SESSION['user']=$_POST['user'];
    setcookie("munvar","data",time()+60,'/');
    /*<?php
    print_r($_COOKIE);
    ?>session_start();  
    $_SESSION['user']=$_POST['user'];*/
    echo '<script type="text/javascript">';
    echo 'alert("Login is successfull");';
    echo 'window.location="student_details.php";';
    echo '</script>' ; 
    /*header('Location:student_details.php');  */
    } 
    }
     else {  
      echo '<script type="text/javascript">';
    echo 'alert("Invalid username or password!")';
    echo '</script>' ;  
    }  
}  
?>
<html>
<head>
		<link rel="stylesheet" href="css/bootstrap.css" >
    <style>
      #m2{
      background-color:#EAC8AF;
      border-radius:8px;
    }
    </style>
</head>
<body style="background-color: #F5F3EE;overflow-x:hidden;">
	<?php include 'Header1.html'; ?>

     <div class="row" style="margin-bottom:80px;margin-top:10px;">
       <div class="col-md-4">
       </div>
       <div class="col-md-4">
       	<form class="form-sign-in" action="#" method="post"><br>
       		<h3 class="form-signin-heading" style="text-align:center;">Student Login</h3></br>
       		<input type="text" class="form-control" name="user" placeholder="Username" required autofocus></br>
       		<input type="password" class="form-control" name="pass" placeholder="passsord" required></br>
          <input type="hidden" name="hide" id="hide" value="<?php  $_SESSION['h']=rand(1,100); echo $_SESSION['h']; ?>" ></br>
       		<div class="row"> <div class="col-md-10" ><a href="forget_password.php" style="text-align:left;">Forget Password?</a></div> <div class="col-md-2" ><a href="student_signup.php" style="text-align:center;">Sign Up</a></div></div>&nbsp<br>
       		<input type="Submit" class="btn btn-primary btn-block" value="log in"></br>
          &nbsp
       	</form>
       </div>
       <div class="col-md-4">
       </div>
    </div>

	<?php include 'footer.html'; ?>
</body>
</html>