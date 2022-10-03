<?php
session_start();
if(!empty($_POST['name'])&&!empty($_POST['gender'])&&!empty($_POST['year'])&&!empty($_POST['company']) && !empty($_SESSION['user1'])) {

	$program=$_POST['program'];
	$branch=$_POST['branch'];
	if($program=='Null')
	{
		$program='';
	}
	if($branch=='Null')
	{
		$branch='';
	}
	$roll=$_POST['roll'];
	$phone=$_POST['phone'];
	$name=$_POST['name'];
	$gender=$_POST['gender'];
	$year=$_POST['year'];
	$company=$_POST['company'];
	$dbhost="localhost";
     $dbuser="root";
     $dbpass="";
     $db="placement";
    $conn=new mysqli($dbhost,$dbuser,$dbpass,$db);
   if($conn->connect_error)
   {
    die("connection failed: %s\n".$conn->connect_error);
   }
   $sql = "SELECT Roll_no FROM student where Roll_no='".$roll."' AND Company='".$company."' ";
    $result = $conn->query($sql);
    if ($result->num_rows == 0) {
    	if(empty($roll)&&empty($branch)&&empty($program)&&empty($phone)) {
          
          $sql= "INSERT INTO student ( Name, Gender, Year, Company) VALUES('$name','$gender','$year','$company')";
        } elseif(empty($branch)&&empty($phone)&&empty($roll)) {
             
           $sql= "INSERT INTO  student ( Name, Gender,  Year, Company, Program) VALUES('$name','$gender','$year','$company','$program')";
        } elseif(empty($program)&&empty($phone)&&empty($branch)) {

            $sql= "INSERT INTO  student (Roll_no, Name, Gender, Year, Company) VALUES('$roll','$name','$gender','$year','$company')";
        } elseif(empty($roll)&&empty($program)&&empty($branch)) {

        	$sql= "INSERT INTO student  ( Name, Gender, Mobile_no, Year, Company) VALUES('$name','$gender','$phone','$year','$company')";
        } elseif(empty($roll)&&empty($program)&&empty($phone)) {

        	$sql= "INSERT INTO student  ( Name, Gender, Year, Company, Branch) VALUES('$name','$gender','$year','$company', '$branch')";
        } elseif(empty($branch)&&empty($program)) {

        	$sql= "INSERT INTO student  ( Roll_no, Name, Gender, Mobile_no, Year, Company) VALUES('$roll','$name','$gender','$phone','$year','$company')";
        } elseif(empty($phone)&&empty($branch)) {

        	$sql= "INSERT INTO student  ( Roll_no, Name, Gender,  Year, Company, Program) VALUES('$roll','$name','$gender','$year','$company','$program')";
        } elseif(empty($program)&&empty($phone)) {

        	$sql= "INSERT INTO student  (Roll_no, Name, Gender, Year, Company, Branch) VALUES('$roll','$name','$gender','$year','$company','$branch')";
        } elseif(empty($roll)&&empty($branch)) {

        	$sql= "INSERT INTO student  ( Name, Gender, Mobile_no, Year, Company, Program) VALUES('$name','$gender','$phone','$year','$company','$program')";
        } elseif(empty($roll)&&empty($program)) {

        	$sql= "INSERT INTO student  ( Name, Gender, Mobile_no, Year, Company, Branch) VALUES('$name','$gender','$phone','$year','$company','$branch')";
        } elseif(empty($roll)&&empty($phone)) {

        	$sql= "INSERT INTO student  ( Name, Gender,  Year, Company, Program, Branch) VALUES('$name','$gender','$year','$company','$program','$branch')";
        } elseif(empty($roll)) {

        	$sql= "INSERT INTO student  ( Name, Gender, Mobile_no, Year, Company, Program, Branch) VALUES('$name','$gender','$phone','$year','$company', '$program', '$branch')";
        } elseif(empty($program)) {

        	$sql= "INSERT INTO student  ( Roll_no, Name, Gender, Mobile_no, Year, Company, Branch) VALUES('$roll','$name','$gender','$phone','$year','$company','$branch')";
        } elseif(empty($phone)) {

        	$sql= "INSERT INTO student  ( Roll_no, Name, Gender,  Year, Company, Program, Branch) VALUES('$roll','$name','$gender','$year','$company','$program','$branch')";
        } elseif(empty($branch)){

        	$sql= "INSERT INTO student  ( Name, Gender, Mobile_no, Year, Company, Program) VALUES('$name','$gender','$phone','$year','$company','$program')";
        } else {

          $sql="INSERT INTO student  ( Roll_no, Name, Gender, Mobile_no, Year, Company, Program, Branch) VALUES('$roll','$name','$gender','$phone','$year','$company','$program','$branch')";
        }
   }
   $t=$conn->query($sql);
   if($t==true) {

    echo '<script type="text/javascript">';
    echo 'alert("Details entered successfully");';
    echo 'window.location="";';
    echo '</script>' ; 
    /* header("Location:#");*/
    } else {
    
    echo '<script type="text/javascript">';
    echo 'alert("error in saving detials");';
    echo 'window.location="";';
    echo '</script>' ;  
    /*header("Location:failure1.php") ;*/
    }  
  
} 


else
{

if(!empty($_SESSION['user1']))
{
echo '<html>
    <head>
    	<link rel="stylesheet" href="css/bootstrap.css" >
    	<style>
    		.topbar{
	background:#fffcfc;
	color:rgb(12, 12, 12);
	font-size:14px;
       		}
           #m4{
      background-color:#EAC8AF;
      border-radius:8px;
    }
    	</style>
	</head>
	<body style="background-color: #F5F3EE;overflow-x:hidden;">';
     include('Header1.html');
			/*<div class="topbar">
                <div class="container row">

                   <div class="pull-left col-md-4" align="right"><a href="index.php" style="text-align:left;"><img src="images/jntuaceatp.png" height="100" width="100"></a></div></br>
                  
                   <div class="col-md-8"><h2 align="left" style="padding:35px"><b>JNTUA PLACEMENT CELL</b></h2></div>
                   
                </div>
      </div>*/
    echo '<br>
  <div class="row">
	<div class="col-md-4">
	</div>
	<div class="col-md-4">
		<form class="form-sign-in" action="#" method="post">
       		<h3 class="form-signin-heading" style="text-align:center;">Upload Placement Data</h3></br>
       		<input type="text" class="form-control" name="roll" placeholder="Rollno" maxlength="10"></br>
       		<input type="text" class="form-control" name="name" placeholder="Name"></br>
          <select class="form-control" name="gender"><option>Male</option><option>Female</option></select></br>
          <input type="text" class="form-control" name="phone" placeholder="Mobile number" maxlength="10" pattern="[0-9]{10}"></br>
          <select class="form-control" name="year"><option value="" disabled selected hidden>Passed_Out_Year</option><option>2021</option><option>2022</option></select></br>
          <select class="form-control" name="company"><option>TCS_Digital</option><option>TCS_Ninja</option><option>CTS</option><option>Accenture</option><option>CGI</option><option>Genpact</option><option>Socrotonics</option><option>ALTP</option><option>INDO-MIM</option><option><option>AurobindoPharma</option><option>Medha Servo</option><option>TATA Projects</option><option>Arcserve</option><option>Tranncuron</option><option>Cerium Systems</option><option>Wipro</option><option>Broadcom</option><option>DIVIs Laboratories</option><option>Infosys</option><option>Delta X</option><option>PSA AVTEC</option><option>Math Works</option><option>Hyundai Motors</option><option>Amara Raja Group</option><option>Vertex Customer Management India Pvt Ltd</option><option>FACE</option><option>DAIKIN INDIA Pvt Ltd</option><option>Hyundai dym</option><option>Catchpoint systems</option><option>Berger paints</option><option>Black pepper</option><option>Hetro Drugs</option><option>Cap Gemini</option><option>EPAM</option><option>Tata Chemical</option><option>KCC paint</option><option>KIA Motors</option><option>BE Analytic solution</option><option>Ingersoll Rand</option><option>ZapCom Solutions</option><option>Robet Bosch</option><option>AMD</option><option>Nalsoft Pvt Ltd</option><option>Capital Via Global Pvt Ltd</option><option>Bibox Pvt Ltd</option><option>Spic Company</option><option>Aarvee associates</option><option>All online tele services</option></select></br>

          <select class="form-control" name="program"><option>BTech</option><option>MTech</option><option>BPharm</option><option>MPharm</option><option>MSIT</option><option>MCA</option><option>MBA</option><option>Null</option></select></br>
          <select class="form-control" name="branch"><option>Computer Science & Engineering</option><option>Electrical & Electronics Engineering</option><option>Electronics & Communication Engineering</option><option>Mechanical Engineering</option><option>Civil Engineering</option><option>Chemical Engineering</option><option>Pharmaceutical Analysis</option><option>Digital systems</option><option>Control systems</option><option>Internal combustion engine</option><option>Advanced Manufacturing Systems</option><option>Information technology</option><option>Artificial intelligence</option><option>Computer aided design</option><option>Computer science in media</option><option>Energy and Management</option><option>Energy systems</option><option>Nanoscience & technology</option><option>Power electronics & drives</option><option>Power systems</option><option>Product design</option><option>Refrigerationn & air conditioning</option><option>Reliability engineering</option><option>DECS</option><option>PID</option><option>Civil Structural engineering</option><option>VLSI</option><option>Software engineering</option><option>DSCE</option><option>Null</option></select></br>
          <!--<input class="form-control"  name="email" placeholder="email" pattern="[a-zA-Z0-9]+@[a-z]+.[a-z]{2,4}"></br>-->
       	  <input type="submit" style="align-content: center"  class="btn  btn-primary btn-block" value="Submit"></br>
       	</form>
        <div class="row">
            <div class="col-md-4">
            <p style="text-align:left;font-size:20px"><a href="logout.php" style="color:red"> Logout </a></p></div>
            <div class="col-md-4"></div>
            <div class="col-md-4"><form class="container">
        <a href="generate_pdf.php"><input type="button" style="border:none;color:red;font-size:20px" value="Go back!" ></a>
      </form></div>
          </div>
	</div>
    <div class="col-md-4">
	</div>	
    </div>';
  include('footer.html');
	echo '</body>
</html>';
}

else
{
  header('Location:index.php');
}

}

?>