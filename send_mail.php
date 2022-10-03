<?php
session_start();
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\SMTP;
	use PHPMailer\PHPMailer\Exception;

if(!empty($_POST['filter1']) && !empty($_POST['filter2'])  && !empty($_POST['subject']) && !empty($_POST['body']) && !empty($_SESSION['user1'])) { 

    $filter1=$_POST['filter1'];  
    $filter2=$_POST['filter2']; 
    $subject=$_POST['subject'];
    $body=$_POST['body']; 
    $dbhost="localhost";
    $dbuser="root";
    $dbpass="";
    $db="placement";
    $conn=new mysqli($dbhost,$dbuser,$dbpass,$db);
    if($conn->connect_error)
    {
    die("connection failed: %s\n".$conn->connect_error);
    }

     if($filter1=='Department')
     {
     	$sql="select email_id from present_year_students where Branch='".$filter2."' ";
     }
     else if($filter1=='gender')
     {
     	$sql=" select email_id from present_year_students where Gender='".$filter2."'";
     }
     else if($filter1=='Program')
     {
     	$sql="select email_id from present_year_students where Program='".$filter2."' ";
     }
     else if($filter1=='Cgpa')
     {
     	$sql="select email_id from present_year_students where Cgpa='".$filter2."' ";
     }
     $result = $conn->query($sql);
    if ($result->num_rows > 0) {


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
 
 		while($row = $result->fetch_assoc())
 		{
 			$mail->addAddress($row['email_id']);
 			$mail->addReplyTo("munvarhussain600@gmail.com");
 		}
	/*$mail->addAddress("munvarhussain600@gmail.com", "Recepient Name");*/

	foreach ($_FILES["uploaded_files"]["name"] as $k => $v) {
   
           $my_path="drive_files/$v";
   /* $mail->AddAttachment( $_FILES["uploaded_files"]["tmp_name"][$k], $_FILES["attachment"]["name"][$k] );*/
              $mail->addAttachment($my_path);

		}


	/*$mail->addAttachment(" 'drive_files/'.$FILES['uploaded_files']['name'] ");*/	

	$mail->isHTML(true);

	$mail->Subject = $subject;
	$mail->Body = $body;
/*$mail->AltBody = "This is the plain text version of the email content";*/

try {
    $mail->send();
      echo '<script type ="text/JavaScript">';
    	echo 'alert("Email is sent successfully ");';
      echo 'window.location="";';
    	echo '</script>'; 
    /*header('Location:#');*/
} catch (Exception $e) {
    echo "Mailer Error: " . $mail->ErrorInfo;
}
    
    }
     else {  
        echo '<script type ="text/JavaScript">';
    	echo 'alert("No data is found ")';
    	echo '</script>';  
                
    }  

}
else
{

if(!empty($_SESSION['user1']))
{

echo '<html>
<head>
	<link rel="stylesheet" href="css/bootstrap.css">
  <style>
     #m4{
      background-color:#EAC8AF;
      border-radius:8px;
    }
  </style>';
	echo "<script>
		 function filters()
  {
    if(document.getElementById('filter1').value=='Department')
    {
      /*document.getelementById('filter2').InnerHTML+='<option>2018</option><option>2019</option><option>2020</option>';*/
      document.getElementById('filter2').options.length=0;
      var select = document.getElementById('filter2');
      var op=['CSE','ECE','EEE','MECH','CHE','CIVIL'];
      var values=['CSE','ECE','EEE','MECH','CHE','CIVIL'];
      for(var i=0;i<op.length;i++)
      {
        select.options[i] = new Option(op[i], values[i],false,false);
      }
    }
    if(document.getElementById('filter1').value=='gender')
    {
      /*document.getelementById('filter2').InnerHTML+='<option>2018</option><option>2019</option><option>2020</option>';*/
      document.getElementById('filter2').options.length=0;
      var select = document.getElementById('filter2');
      var op=['Male','Female'];
      var values=['Male','Female'];
      for(var i=0;i<op.length;i++)
      {
        select.options[i] = new Option(op[i], values[i],false,false);
      }
    }
    if(document.getElementById('filter1').value=='Program')
    {
      /*document.getelementById('filter2').InnerHTML+='<option>2018</option><option>2019</option><option>2020</option>';*/
      document.getElementById('filter2').options.length=0;
      var select = document.getElementById('filter2');
      var op=['Btech/UG','Mtech/PG','MBA','Mca'];
      var values=['BTech','MTech','MBA','MCA'];
      for(var i=0;i<op.length;i++)
      {
        select.options[i] = new Option(op[i], values[i],false,false);
      }
    }
    if(document.getElementById('filter1').value=='Cgpa')
    {
      /*document.getelementById('filter2').InnerHTML+='<option>2018</option><option>2019</option><option>2020</option>';*/
      document.getElementById('filter2').options.length=0;
       var select= document.getElementById('filter2');
       var values=['6.0','6.5','7.0','7.5','8.0','8.5','9.0','9.5','10.0'];
       var op=['>6.0','>6.5','>7.0','>7.5','>8.0','>8.5','>9.0','>9.5','10.0'];
      for(var i=0;i<op.length;i++)
      {
        select.options[i] = new Option(op[i], values[i],false,false);
      }
      
      
    }
  }
</script>";
echo '</head>
<body style="background-color: #F5F3EE;overflow-x:hidden;">';
	 include 'header1.html' ;

  echo '<div class="row">
       <div class="col-md-4">
       </div>
       <div class="col-md-4" style="padding:40px;">
        <form class="form-sign-in" action="#" method="post" enctype="multipart/form-data">
          <h3 class="form-signin-heading" style="text-align:center;color:gray">Email Notification</h3></br>
          <select class="form-control" name="filter1" id="filter1" onclick="filters()"><option value="Department">Department</option><option value="gender">Gender</option><option value="Program">Program</option><option value="Cgpa">CGPA</option></select>
          &nbsp &nbsp <select class="form-control" name="filter2" id="filter2"></select></br>
          <input type="text" placeholder="email subject" name="subject" class="form-control" required><br>
          <input type="text" placeholder="email body details" name="body" class="form-control" required><br>
          <input type="file" name="uploaded_files[]"  multiple="multiple">file should be in pdf format of maximum size 5MB<br><br>
          <input type="submit" class="btn btn-primary btn-block" value="Send Email"><br>
          <div class="row">
            <div class="col-md-4">
            <p style="text-align:left;font-size:20px"><a href="logout.php" style="color:red"> Logout </a></p></div>
            <div class="col-md-4"></div>
            <div class="col-md-4"><form class="container">
        <a href="generate_pdf.php"><input type="button" style="border:none;color:red;font-size:20px" value="Go back!"></a>
      </form></div>
          </div>
        </form>
       </div>
       <div class="col-md-4">
       </div>
  </div>';
   include 'footer.html';
echo '</body>
</html>';
}

else
{
  header('Location:index.php');
}
}
?>