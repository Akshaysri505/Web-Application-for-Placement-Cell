<?php
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\SMTP;
	use PHPMailer\PHPMailer\Exception;
session_start();
	if(!empty($_POST['email']) && !empty($_SESSION['h']) && $_POST['hide'] == $_SESSION['h'])
	{
		$_SESSION['h']=45;
		$dbhost="localhost";
    $dbuser="root";
    $dbpass="";
    $db="placement";
    $conn=new mysqli($dbhost,$dbuser,$dbpass,$db);
    if($conn->connect_error)
    {
    die("connection failed: %s\n".$conn->connect_error);
    }
    $sql = "SELECT * FROM present_year_students where Username='".$_POST['email']."' ";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {

    while($row = $result->fetch_assoc())  
    {  
    $dbusername=$row['Username'];  
    $email=$row['email_id'];
     
    }  
  
    if($_POST['email'] == $dbusername )  
    {  
      
    /*<?php
    print_r($_COOKIE);
    ?>session_start();  
    $_SESSION['user']=$_POST['user'];*/
    require_once "C:/xampp/vendor/autoload.php";


	$mail = new PHPMailer(true);

//Enable SMTP debugging.
	$mail->SMTPDebug = 0;                               
//Set PHPMailer to use SMTP.
	$mail->isSMTP();            
//Set SMTP host name                          
	$mail->Host = "smtp.gmail.com";
//Set this to true if SMTP host requires authentication to send email
	$mail->SMTPAuth = true;                          
//Provide username and password     
	$mail->Username = "munvarhussain337@gmail.com";                 
	$mail->Password = "Munvar@15";                           
//If SMTP requires TLS encryption then set it
	$mail->SMTPSecure = "tls";                           
//Set TCP port to connect to
	$mail->Port = 587;                                   

	$mail->From = "munvarhussain337@gmail.com";
	$mail->FromName = "Munvar Hussain";

	$mail->addAddress($email);

	$mail->isHTML(true);

	$new=md5(rand());

	$mail->Subject = "New password for the student  account";
	$mail->Body = $_POST['email']."password is :".$new;

	$mail->send();


    	 $sql = " UPDATE present_year_students set Password='".$new."' where email_id ='".$email."' ";
    if($conn->query($sql) === TRUE)
    {
    	echo '<script type ="text/JavaScript">';
    	echo 'alert("Password sent succesfully to user email address ");';
        echo 'window.location="student_login.php";';
    	echo '</script>';
    	/*header('Location:student_login.php'); */ 
    }
    else
    {
    	echo '<script type ="text/JavaScript">';
    	echo 'alert("error in updating the password ")';
    	echo '</script>';
    }
    /*echo $_POST['hide'];*/
    } 
    }
     else {  
        echo '<script type ="text/JavaScript">';
    	echo 'alert("Invalid username ")';
    	echo '</script>';  
                
    }  
}


?>
<html>
<head>
	<link rel="stylesheet" href="css/bootstrap.css">
	<style>
		#m2{
      background-color:#EAC8AF;
      border-radius:8px;
    }
	</style>
</head>
<body style="background-color: #F5F3EE;overflow-x:hidden;">
	<?php include('Header1.html') ?>
	<div class="row" style="margin-bottom:160px;">
		<div class="col-md-4">
		</div>
		<div class="col-md-4">
			<br>
			<form action="#" method="post" class="form-sign-in">
				<h3 calss="form-signin-heading" style="text-align:center;"> Reset Password</h3><br>
				<input class="form-control" type="text" name="email" required placeholder="enter username"><br>
				<input type="hidden" name="hide" id="hide" value="<?php  $_SESSION['h']=rand(1,100); echo $_SESSION['h']; ?>" ></br>
				<input type="Submit" value="Reset password"  name="submit" class="btn btn-block btn-secondary"><br>&nbsp
				<p> (On successfull submission new password will be sent to  registered email) </p>
			</form>
		</div>
		<div class="col-md-4 " >
		</div>
	</div>
	<?php include('footer.html') ?>
</body>
</html>