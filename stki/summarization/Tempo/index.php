 <!DOCTYPE html>
<html lang="en" class=" js no-touch">
<head>
  <title>STKI | Peringkasan Teks Otomatis</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
  <link href='https://fonts.googleapis.com/css?family=Open+Sans:300,600|Raleway:600,300|Josefin+Slab:400,700,600italic,600,400italic' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" type="text/css" href="css/slick-team-slider.css"/>
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <!-- =======================================================
        Theme Name: Tempo
        Theme URL: https://bootstrapmade.com/tempo-free-onepage-bootstrap-theme/
        Author: BootstrapMade.com
        Author URL: https://bootstrapmade.com
    ======================================================= -->
</head>
<body>
	<?php
		error_reporting(E_ERROR | E_PARSE);
		include "./summarize.php";
		
		// scan nama file korpus
		$dir_corpus = "./corpus";
		$files 		= scandir($dir_corpus);
		$files		= array_slice($files, 2);
		
		// hasil
		if(isset($_POST["filename"])) {
			$filename	 = $_POST["filename"];
			$output 	 = summarize($filename);
			$title 		 = substr($filename, 0, -4);
		}

	?>

	<!--HEADER START-->
	<div class="main-navigation navbar-fixed-top">
		<nav class="navbar navbar-default">
			<div class="container">
			<div class="navbar-header">
			  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
			    <span class="icon-bar"></span>
			    <span class="icon-bar"></span>
			    <span class="icon-bar"></span>
			  </button>
			  <a class="navbar-brand" href="index.php">STKI</a>
			</div>
			<div class="collapse navbar-collapse" id="myNavbar">
			  <ul class="nav navbar-nav navbar-right">
			    <li class="active"><a href="#banner">Home</a></li>
			    <li><a href="#service">Try Now</a></li>
			    <li><a href="#about">Our Team</a></li>
			  </ul>
			</div>
		  </div>
		</nav>
	</div>
	<!--HEADER END-->

	<!--BANNER START-->
	<div id="banner" class="section-padding">
		<div class="container">
			<div class="row">
				<div class="jumbotron">
				  <h1 class="small"><span class="bold">Peringkasan Teks Otomatis</span></h1>
				  <p class="big">Pada Buku Biografi Dengan Metode TF.IDF</p>
				</div>
			</div>
		</div>
	</div>
	<!--BANNER END-->

	<!--CTA1 START-->
	<div class="cta-1">
		<div class="container">
			<div class="row text-center white">
				<h1 class="cta-title">Final Project</h1>
				<p class="cta-sub-title">Sistem Temu Kembali Informasi - D</p>
			</div>
		</div>
	</div>
	<!--CTA1 END-->

	<!--SERVICE START-->
	<div id="service" class="section-padding">
		<div class="container">
			<div class="row">
				<div class="page-title text-center">
					<h1>Try Now!</h1>
					<hr class="pg-titl-bdr-btm"></hr>
				</div>
			</div>

				<div class="form-sec">
                	<form action="index.php#service" method="post" role="form" class="contactForm">
                        <!-- <div class="col-md-12 form-group">
                        	<p class="cta-sub-title text-center">Input Text</p>
                            <textarea style="line-height:18px;" class="form-control text-field-box" name="input-text" rows="5" data-rule="required"></textarea>
                        </div> -->
                        <div class="col-md-12 form-group">
                        	<!-- <p class="cta-sub-title text-center">OR</p> -->
                        	<p class="cta-sub-title text-center">Select File</p>
								<select class="form-control text-field-box" name="filename" style="width:100%;">
									<option>Choose one</option>
									<?php
									foreach ($files as $key => $value) {
										$title = str_replace("_", " ", substr($value, 0, -4));
										if($filename == $value) {
											echo "<option value='$value' SELECTED>$title</option>";
										}
										else {
											echo "<option value='$value'>$title</option>";
										}
									}
									?>
								</select>
                        </div>
                        <div class="col-md-12 form-group">
                            <input class="button-medium" id="contact-submit" type="submit" value="Summarize" name="contact">
                        </div>
                    </form>
                    	<div class="col-md-6 form-group">
                    		<h3 class="text-center">Original Text</h3>
                            <textarea style="line-height:18px;" class="form-control text-field-box" name="message" rows="10" data-rule="required" 
                            data-msg="Please write something for us"><?php echo !empty($output['asli'])? $output['asli'] : "";?></textarea>
                        </div>
                    	<div class="col-md-6 form-group">
                    		<h3 class="text-center">Summary</h3>
                            <textarea style="line-height:18px;" class="form-control text-field-box" name="message" rows="10" data-rule="required" 
                            data-msg="Please write something for us"><?php echo !empty($output['ringkasan'])? $output['ringkasan'] : "";?></textarea>
                        </div>
                </div>

		</div>
	</div>
	<!--SERVICE END-->

	<!--TEAM START-->
	<div id="about" class="section-padding">
		<div class="container">
			<div class="row">
				<div class="page-title text-center">
					<h1>Meet Our Team</h1>
					<hr class="pg-titl-bdr-btm"></hr>
				</div>
					<div class="col-md-3">
						<div class="team-info">
							<div class="fig-caption">
								<h3>Muhammad M. Munir</h3>
								<p class="marb-20">Project Manager</p>
							</div>
						</div>
					</div>
					<div class="col-md-3">
						<div class="team-info">
							<div class="fig-caption">
								<h3>M. Kevin Pahlevi</h3>
								<p class="marb-20">UI/UX Designer</p>
							</div>
						</div>
					</div>
					<div class="col-md-3">
						<div class="team-info">
							<div class="fig-caption">
								<h3>Yulfa H. Wicaksono</h3>
								<p class="marb-20">System Analyst</p>
							</div>
						</div>
					</div>
					<div class="col-md-3">
						<div class="team-info">
							<div class="fig-caption">
								<h3>Muhammad Nadzir</h3>
								<p class="marb-20">Technical Writer</p>
							</div>
						</div>
					</div>
			</div>
		</div>
	</div>
	<!--TEAM END-->
    
	<!--CTA2 START-->
	<div class="cta2">
		<div class="container">
			<div class="row white text-center">
				<h3 class="wd75 fnt-24">"Educating the mind without educating the heart is no education at all." - Aristotle</h3>
				<p class="cta-sub-title"></p>
			</div>
		</div>
	</div>
	<!--CTA2 END-->

	<!--FOOTER START-->
	<footer class="footer section-padding">
		<div class="container">
			<div class="row">
				<div style="visibility: visible; animation-name: zoomIn;" class="col-sm-12 text-center wow zoomIn">
					<h3>Follow us on</h3>
					<div class="footer_social">
						<ul>
							<li><a class="f_facebook" href="#"><i class="fa fa-facebook"></i></a></li>
							<li><a class="f_twitter" href="#"><i class="fa fa-twitter"></i></a></li>
							<li><a class="f_google" href="#"><i class="fa fa-google-plus"></i></a></li>
							<li><a class="f_linkedin" href="#"><i class="fa fa-linkedin"></i></a></li>
						</ul>
					</div>																
				</div><!--- END COL -->
			</div><!--- END ROW -->
		</div><!--- END CONTAINER -->
	</footer>
	<!--FOOTER END-->
	<div class="footer-bottom">
		<div class="container">
			<div style="visibility: visible; animation-name: zoomIn;" class="col-md-12 text-center wow zoomIn">
				<div class="footer_copyright">
					<p> © Copyright, All Rights Reserved.</p>					
					<div class="credits">
                        <!-- 
                            All the links in the footer should remain intact. 
                            You can delete the links only if you purchased the pro version.
                            Licensing information: https://bootstrapmade.com/license/
                            Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/buy/?theme=Tempo
                        -->
                        Designed by <a href="https://bootstrapmade.com/">Bootstrap Themes and edited by our team</a>
                    </div>
				</div>
			</div>
		</div>
	</div>
  	<script src="js/jquery.min.js"></script>
  	<script src="js/jquery.easing.min.js"></script>
  	<script src="js/bootstrap.min.js"></script>
  	<script src="js/jquery.mixitup.js" type="text/javascript"></script>
	<script type="text/javascript" src="js/slick.min.js"></script>
	<script type="text/javascript" src="js/custom.js"></script>
    <script src="contactform/contactform.js"></script>
    
</body>
</html>