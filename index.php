<htmL>
	<head>
			<link href="https://fonts.googleapis.com/css2?family=Josefin+Sans&family=Mountains+of+Christmas:wght@400;700&display=swap" rel="stylesheet">
			 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
			 <!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

		<style>
			body{
				background-color:#F5F3EE;
			}
		/*slide show styling*/
		.slideshow{
			width:100%;
			position:relative;
			margin:auto;
		}
		#slideimage{
			width:100%;
			height:100%;
			vertical-align:left;
		}
		/* about us section styling*/
		.about{
			background:url('images/College_icon.png') no-repeat left;
			background-position:left;
			background-size:33%;
			background-color:#fdfdfd;
			overflow:hidden;
			padding: 15px 0;
			width:100%;
		}
		.inner-section{
			width:55%;
			float:right;
			background-color:#fdfdfd;
			padding:100px;
			box-shadow:10px 10px 8px rgba(0,0,0,0.3);
		}
		.inner-section h1{
			margin-bottom:30px;
			font-size:30px;
			font-weight:900;
		}
		.text{
			font-size:19px;
			color:#545454;
			line-height:30px;
			text-align:justify;
			margin-bottom:40px;
			font-family: 'Roboto' sans-serif;
		}
		.skills button {
			font-size:22px;
			text-align:center;
			letter-spacing:2px;
			border:none;
			border-radius:20px;
			padding:8px;
			width:200px;
			background-color:#f7882f;
			color:white;
			cursor:pointer;
		}
		.skills button a{
			color:brown;
		}
		.skills button:hover{
			transition:1s;
			background-color:#ecf5f5;
			color:#00999c;
		}
		@media screen and (max-width:1200px){
			.inner-section{
				padding:80px 80px 80px 40px;
			}
		}
		@media screen and (max-width:1000px)
		{
			.about{
				/*margin-top:610px;*/
				background-size:100%;
				padding:100px 80px;
				background-image: none;
			}
			.inner-section{
				width:100%;
			}
			.ftr{
				width:100%;
			}
		}
		@media screen and (max-width:600px)
		{
			.about{
				padding:0;
			}
			.inner-section{
				padding:60px;
			}
			.skills button{
				font-size:19px;
				padding:5px;
				width:160px;
			}
			.developer{
				width:100;
			}
		}
		.points{
			padding:15px;
			list-style-type:disc;
		}
		#m1{
			background-color:#EAC8AF;
			border-radius:8px;
		}
    }
	</style>
</head>
	<body style="overflow-x:hidden">
		<!-- html code -->
		<?php include 'Header1.html' ?>
	<!-- slideshow section-->
	<!--slideshow-->
<div class="row" style="height:500px">
<div class="col-md-8 " style="border-style:none;padding:35px">
<div class="slideshow">
	<a href="#" style="cursor:pointer;"><img src="images/3.jpg" alt='img' id="slideimage" style="border-radius:8px;"></a>
</div>
<script>
		var images=["images/1.jpg",
		            "images/2.jpg"];
		var i=0;
		function slides()
		{
			document.getElementById("slideimage").src=images[i];
			if(i<(images.length-1))
			{
				i++;
			}
			else
			{
				i=0;
			}
		}
		setInterval(slides,2000)
</script>
</div>

<div class="col-md-4" style="padding:30px;">

	<div>
		<h3 text-align="center">Recent Drives</h3>
		<ul id="nb">
		</ul>
	</div>
	<?php
	$dir = "notice-board";

// Sort in ascending order - this is default
/*$a = scandir($dir);*/

// Sort in descending order
$b = scandir($dir,2);

   for($i=count($b)-1;$i>=2;$i--)
   {
   		$x = pathinfo($b[$i], PATHINFO_FILENAME);
   		echo "<script type=\"text/javascript\">  document.getElementById(\"nb\").innerHTML+='<li class=\"points\"><a href=\"notice-board/$b[$i]\" target=\"_blank\"> $x</a></li>';</script>";
   }
	/*foreach ( $b as $k)
	{

		echo "<script type=\"text/javascript\">  document.getElementById(\"nb\").innerHTML+='<a href=\"#\">$k</a><br>';</script>";
	}*/
	 /*$x = pathinfo($b[$i], PATHINFO_FILENAME);*/

/*print_r($b);*/

?>

<!--<div class="panel panel-primary" style="padding:35px;">
	<div class="panel-heading"><h4><strong><a href="#">Campus Drive Procedure</a></strong></h4></div>
	<div class="panel-body">
	  
		<ul>
			<li class="points"><h5>Pre – Placement Talk</h5></li>
			<li class="points"><h5>Educational Qualification</h5></li>
			<li class="points"><h5>Written Test</h5></li>
			<li class="points"><h5>Group Discussion (Optional)</h5></li>
			<li class="points"><h5>Technical Interview</h5></li>
			<li class="points"><h5>HR Interview</h5></li>
			<li class="points"><h5>Post – Placement Talk</h5></li>
		</ul>

    </div>
    </div>-->
</div>

<!--<div class="col-md-4" >
<div class="panel panel-primary" style="padding:35px;">
	<div class="panel-heading"><h4><strong><a href="#">Campus Drive Procedure</a></strong></h4></div>
	<div class="panel-body">
	  <marquee direction="up" height="500px" scrollamount="3" onmouseover="this.stop();"
                                 onmouseout="this.start();">

                            
        <h5>Payment of tuition fee for B. Tech, M. Tech &MCA</h5> <br><br>
       <h5>Quotations are invited through e-procureme</h5> <br><br>
       <h5>Awarding of Gold Medals at the Eleventh Convocation 2021</h5> <br><br>

      </marquee>
    </div>
    </div>
  </div>-->
 </div>
	<!--about us section-->
	<div class="about">
		<div class="inner-section">
			<h1>About Us</h1>
			<p class="text">Trends is a one stop shop for all your fashion and lifestyle needs. Being India's largest e-commerce store for fashion and lifestyle products, Trends aims at providing a hassle free and enjoyable shopping experience to shoppers across the country with the widest range of brands and products on its portal. The brand is making a conscious effort to bring the power of fashion to shoppers with an array of the latest and trendiest products available in the country.
			</p>
			<div class="skills">
				<button><a href="aboutus.php">Contact Us</a></button>
			</div>
		</div>
    </div>
<?php include 'footer.html' ?>
</body>
</html>
