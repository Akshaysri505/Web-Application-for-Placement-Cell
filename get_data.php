

<?php

require('fpdf183/fpdf.php');
$pdf=new FPDF('L', 'mm','Legal');
$pdf->AliasNbPages();
$pdf->AddPage();      
$pdf->SetFont('Arial','B',16);
$fontsize=16;    

session_start();
if(!empty($_POST['filter1']) && !empty($_POST['filter2']) && !empty($_POST['filter3']) && !empty($_SESSION['user2'])) { 


    $filter1=$_POST['filter1'];  
    $filter2=$_POST['filter2'];  
    $filter3=$_POST['filter3'];
    $dbhost="localhost";
    $dbuser="root";
    $dbpass="";
    $db="placement";
    $conn=new mysqli($dbhost,$dbuser,$dbpass,$db);
    if($conn->connect_error)
    {
    die("connection failed: %s\n".$conn->connect_error);
    }
    

    if($filter1=='Branch')
    {
        $sql=" SELECT `Roll_no`, `Username`, `Mobile_no`, `Cgpa`, `email_id`, `Program`, `Gender` FROM `present_year_students` WHERE Branch='".$filter2."' ";
    }
    
    else if($filter1=='gender')
    {
        $sql=" SELECT `Roll_no`, `Username`,  `Mobile_no`, `Cgpa`, `email_id`, `Program`, `Branch` FROM `present_year_students` WHERE Gender='".$filter2."' ";
    }
    else if($filter1=='Program')
    {
        $sql=" SELECT `Roll_no`, `Username`,  `Mobile_no`, `Cgpa`, `email_id`,  `Branch`, `Gender` FROM `present_year_students` WHERE Program='".$filter2."' ";
    }
    else if($filter1=='Cgpa')
    {
        $sql=" SELECT `Roll_no`, `Username`, `Cgpa`,`Mobile_no`,  `email_id`, `Program`, `Branch`, `Gender` FROM `present_year_students` WHERE Cgpa >'".$filter2."' ";
    }
    $result = $conn->query($sql);
    /*echo mysqli_num_rows($result);*/
    if ($result->num_rows > 0) {

    /*while($row = $result->fetch_assoc())  
    {  
        $pdf->Cell(0,10,$row['Roll_no'],1,1,'C'); 
     $pdf->Cell(10,20, $row['Name'] ,1,1,'C');
      $pdf->Cell(20,30, $row['Gender'],1,1,'C');
       $pdf->Cell(30,40,$row['Mobile_no'],1,1,'C');
        $pdf->Cell(40,50, $row['Year'],1,1,'C');
         $pdf->Cell(50,60, $row['Company'],1,1,'C');
          $pdf->Cell(60,70, $row['Program'],1,1,'C');
           $pdf->Cell(70,80,$row['Branch'],1,1,'C');  
    }  
    $pdf->Output();*/
	$pdf->Cell(0,10,"JNTUA Students Details based on ".$filter1."-".$filter2." report ",0,0,'C');

	$pdf->ln();
	$pdf->ln();
    
    $s=$pdf->GetStringWidth('S.NO');
    $g=$pdf->GetStringWidth('Female  ');
    $r=$pdf->GetStringWidth('17001A0507 ');
    $u=$pdf->GetStringWidth('aaaaaaaaaaaaaaaaaaaaaaaaaaaaaa ');
    $m=$pdf->GetStringWidth('9999999999 ');
    $c=$pdf->GetStringWidth('10.0  ');
    $e=$pdf->GetStringWidth('aaaaaaaaaaaaaaaaaaaaaaaaaaaaaa ');
    $p=$pdf->GetStringWidth('Program ');;
    $b=$pdf->GetStringWidth('Branch ');;

     



/*foreach($result as $row) {*/
    $pdf->SetFont('Arial','B',12);   
    $pdf->Ln();


    if($filter1=='Branch')
    {
      $pdf->cell($s,10,"S.NO",1,0,'C');
    	$pdf->cell($r,10,"Student Id",1,0,'C');
    $pdf->cell($u,10,"Name",1,0,'C');
    $pdf->cell($g,10,"Gender",1,0,'C');
    $pdf->cell($m,10,"Phone no",1,0,'C');
    $pdf->cell($c,10,"Cgpa",1,0,'C');
    $pdf->cell($e,10,"email id",1,0,'C');
    $pdf->cell($p,10,"Program",1,0,'C');

    $yb=1;
    while ($row = $result->fetch_assoc()) {

    	$pdf->SetFont('Arial','B',12);   
    $pdf->Ln();

      $pdf->Cell($s,10,$yb,1,0,'C');
       $yb=$yb+1;
    	$pdf->Cell($r,10,$row['Roll_no'],1,0,'C'); 
    	$pdf->Cell($u,10,$row['Username'],1,0,'C');
        $pdf->Cell($g,10,$row['Gender'],1,0,'C');
        $pdf->Cell($m,10,$row['Mobile_no'],1,0,'C');
        $pdf->Cell($c,10,$row['Cgpa'],1,0,'C');
        $pdf->Cell($e,10,$row['email_id'],1,0,'C');
        $pdf->Cell($p,10,$row['Program'],1,0,'C');

         }
    $pdf->output();
    }
    else if($filter1=='gender')
    {
      $yg=1;
      $pdf->cell($s,10,"S.NO",1,0,'C');
    	$pdf->cell($r,10,"Student Id",1,0,'C');
    $pdf->cell($u,10,"Name",1,0,'C');
    $pdf->cell($m,10,"Phone no",1,0,'C');
    $pdf->cell($c,10,"Cgpa",1,0,'C');
    $pdf->cell($e,10,"email id",1,0,'C');
    $pdf->cell($p,10,"Program",1,0,'C');
    $pdf->cell($b,10,"Branch",1,0,'C');


    while ($row = $result->fetch_assoc()) {

    	$pdf->SetFont('Arial','B',12);   
    $pdf->Ln();

      $pdf->Cell($s,10,$yg,1,0,'C');
       $yg=$yg+1;
    	$pdf->Cell($r,10,$row['Roll_no'],1,0,'C'); 
    	$pdf->Cell($u,10,$row['Username'],1,0,'C');
        $pdf->Cell($m,10,$row['Mobile_no'],1,0,'C');
        $pdf->Cell($c,10,$row['Cgpa'],1,0,'C');
        $pdf->Cell($e,10,$row['email_id'],1,0,'C');
        $pdf->Cell($p,10,$row['Program'],1,0,'C');
        $pdf->Cell($b,10,$row['Branch'],1,0,'C');

         }
    $pdf->output();
    }
    else if($filter1=='Program')
    {
      $pdf->cell($s,10,"S.NO",1,0,'C');
    	$pdf->cell($r,10,"Student Id",1,0,'C');
    $pdf->cell($u,10,"Name",1,0,'C');
    $pdf->cell($g,10,"Gender",1,0,'C');
    $pdf->cell($m,10,"Phone no",1,0,'C');
    $pdf->cell($c,10,"Cgpa",1,0,'C');
     $pdf->cell($e,10,"email id",1,0,'C');
    $pdf->cell($b,10,"Branch",1,0,'C');

    $yp=1;
    while ($row = $result->fetch_assoc()) {

    	$pdf->SetFont('Arial','B',12);   
    $pdf->Ln();

      $pdf->Cell($s,10,$yp,1,0,'C');
       $yp=$yp+1;
    	$pdf->Cell($r,10,$row['Roll_no'],1,0,'C'); 
    	$pdf->Cell($u,10,$row['Username'],1,0,'C');
        $pdf->Cell($g,10,$row['Gender'],1,0,'C');
        $pdf->Cell($m,10,$row['Mobile_no'],1,0,'C');
        $pdf->Cell($c,10,$row['Cgpa'],1,0,'C');
        $pdf->Cell($e,10,$row['email_id'],1,0,'C');
        $pdf->Cell($b,10,$row['Branch'],1,0,'C');

         }
    $pdf->output();
    }
    else if($filter1=='Cgpa')
    {
      $pdf->cell($s,10,"S.NO",1,0,'C');
    	$pdf->cell($r,10,"Student Id",1,0,'C');
    $pdf->cell($u,10,"Name",1,0,'C');
    $pdf->cell($g,10,"Gender",1,0,'C');
    $pdf->Cell($c,10,'Cgpa',1,0,'C');
    $pdf->cell($m,10,"Phone no",1,0,'C');
    $pdf->cell($e,10,"email id",1,0,'C');
    $pdf->cell($p,10,"Program",1,0,'C');
    $pdf->cell($b,10,"Branch",1,0,'C');

    $yc=1;
    while ($row = $result->fetch_assoc()) {

    	$pdf->SetFont('Arial','B',12);   
    $pdf->Ln();

      $pdf->Cell($s,10,$yc,1,0,'C');
       $yc=$yc+1;
    	$pdf->Cell($r,10,$row['Roll_no'],1,0,'C'); 
    	$pdf->Cell($u,10,$row['Username'],1,0,'C');
        $pdf->Cell($g,10,$row['Gender'],1,0,'C');
        $pdf->Cell($c,10,$row['Cgpa'],1,0,'C');
        $pdf->Cell($m,10,$row['Mobile_no'],1,0,'C');
        $pdf->Cell($e,10,$row['email_id'],1,0,'C');
        $pdf->Cell($p,10,$row['Program'],1,0,'C');
        $pdf->Cell($b,10,$row['Branch'],1,0,'C');

         }
    $pdf->output();
    }

    
    }
    else
    {  
    echo '<script>';
    echo 'alert("students of specific filter are not registered.");';
    echo 'window.location="";';
    echo '</script>';  
    }  
}
else
{


if(!empty($_SESSION['user2']))
{
	echo"<html>";
	echo "<head> <link rel='stylesheet' href='css/bootstrap.css'> <style> #m3{ background-color:#EAC8AF;  border-radius:8px;}</style>";
	echo "<script>";
  	echo "function filters()";
  		echo "{";
    
    echo " if(document.getElementById('filter1').value=='Branch')
    {
      /*document.getelementById('filter2').InnerHTML+='<option>2018</option><option>2019</option><option>2020</option>';*/
      document.getElementById('filter2').options.length=0;
      var select = document.getElementById('filter2');
      var op=['CSE','ECE','EEE','MECH','CHE','CIVIL','MBA'];
      var values=['CSE','ECE','EEE','MECH','CHE','CIVIL','MBA'];
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
        select.options[i] = new Option(op[i],values[i],false,false);
      }
    }
    if(document.getElementById('filter1').value=='Program')
    {
      /*document.getelementById('filter2').InnerHTML+='<option>2018</option><option>2019</option><option>2020</option>';*/
      document.getElementById('filter2').options.length=0;
      var select = document.getElementById('filter2');
      var op=['Btech/UG','Mtech/PG','MBA',''];
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
       var op=['>6.0','>6.5','>7.0','>7.5','>8.0','>8.5','>9.0','>9.5','10.0'];
       var values=['6.0','6.5','7.0','7.5','8.0','8.5','9.0','9.5','10.0'];
      for(var i=0;i<op.length;i++)
      {
        select.options[i] = new Option(op[i], values[i],false,false);
      }
      
      
    }
    
  }
</script>";
	echo "</head>";
	echo "<body style='background-color: #F5F3EE;overflow-x:hidden;'>";
	 include('Header1.html');
	echo '<div class="row" > <div class="col-md-4"></div>
        <div class="col-md-4" style="box-shadow:4px 4px 3px 4px gray;padding:40px;margin:30px">
        <form class="form-sign-in" action="#" method="post" target="_blank">
          <h3 class="form-signin-heading" style="text-align:center;">Retrieve Students Details </h3></br>
          <select class="form-control" name="filter1" id="filter1" onclick="filters()" required autofocus><option value="Program">Program</option><option value="Branch">Branch</option><option value="gender">Gender</option><option value="Cgpa">CGPA</option></select>
          &nbsp &nbsp <select class="form-control" name="filter2" id="filter2" required></select></br>
          <select style="display:none;" class="form-control" name="filter3" id="filter3" > <option value="pdf">pdf</option></select><br>
          <input type="submit" class="btn btn-primary btn-block" value="Submit"><br><br>
          <p style="text-align:left;font-size:20px"><a href="logout.php" style="color:red"> Logout</a></p>
           
        </form>
        </div>
        <div class="col-md-4"></div>
    </div>';
	include('footer.html');
	echo "</body></html>";
}

else
{
	header('Location:index.php');
}

}
?>