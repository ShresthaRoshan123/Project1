<?php 
session_start();
$email=$_SESSION['email'];
include 'config.php';
if(isset($_POST["insert"])){  
	$file = addslashes(file_get_contents($_FILES["image"]["tmp_name"]));  
	$queries= "update vendors set Image='".$file."' WHERE Email='$email'";
	if(mysqli_query($conn, $queries)){  
		 echo '<script>alert("Image Inserted into Database")</script>';  
	}  
} 
$query = mysqli_query($conn,"select * from vendors where Email='$email'");
	$rows = mysqli_fetch_assoc($query);
	$num=mysqli_num_rows($query);
	if ($num == 1) {
		$name=$rows['Name'];
		$sname=$rows['ShopName'];
		$contact=$rows['Contact'];			
		$dist=$rows['District'];
		$state=$rows['State'];
		$country=$rows['Country'];
		$pcode=$rows['Pincode'];
		$dp=$rows['Image'];	
	}
	if (isset($_POST['login'])){
		$name=$_POST['oname'];
		$sname=$_POST['sname'];		
		$contact=$_POST['shopcontact'];		
		$dist=$_POST['dist'];
		$state=$_POST['state'];
		$country=$_POST['country'];
		$pcode=$_POST['pcode'];		
		$sql = "UPDATE vendors SET Name='".$name."',ShopName='".$sname."',Contact='".$contact."',District='".$dist."',State='".$state."',Country='".$country."',Pincode='".$pcode."' WHERE Email='$email'";   
        if (mysqli_query($conn,$sql)){
                echo "Updated";
                }
			else
			{
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
			}
	
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title></title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
<link href="assets/img/favicon.png" rel="icon">
		
		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="assets/css/bootstrap.min.css">
		
		<!-- Fontawesome CSS -->
		<link rel="stylesheet" href="assets/plugins/fontawesome/css/fontawesome.min.css">
		<link rel="stylesheet" href="assets/plugins/fontawesome/css/all.min.css">
		
		<!-- Main CSS -->
		<link rel="stylesheet" href="assets/css/style.css">
<style>
	/* Chrome, Safari, Edge, Opera */
	input::-webkit-outer-spin-button,
	input::-webkit-inner-spin-button {
	  -webkit-appearance: none;
	  margin: 0;
	}
	
	/* Firefox */
	input[type=number] {
	  -moz-appearance: textfield;
	}
	</style>

</head>
<body>
<div class="content">
				<div class="container-fluid">

					<div class="row">
    <div class="col-md-5 col-lg-4 col-xl-3 theiaStickySidebar">
        <!-- Profile sidebar -->
    <div class="profile-sidebar">
								<div class="widget-profile pro-widget-content">
									<div class="profile-info-widget">
										<a href="#" class="booking-doc-img">
											<?php echo '<img class="rounded-circle" src="data:image/jpeg;base64,'.base64_encode($dp).'"  alt='.$name.'>  ';?>
										</a>
										<div class="profile-det-info">
											<h3><?php echo $name;?></h3>
											
											<div class="patient-details">
												<h5 class="mb-0"><?php echo $sname;?></h5>
											</div>
										</div>
									</div>
								</div>
								<div class="dashboard-widget">
									<nav class="dashboard-menu">
										<ul>
											<li >
												<a href="home.php">
													<i></i>
													<span>Home</span>
												</a>
											</li>
											<li >
												<a href="updateproducts.php">
													<i class="fas fa-calendar-check"></i>
													<span>Update Products</span>
												</a>
											</li>
											<li>
												<a href="myproducts.php">
													<i class="fas fa-user-injured"></i>
													<span>My Products</span>
												</a>
											</li>
											
											<li class="active">
												<a href="shopdetails.php">
													<i class="fas fa-user-cog"></i>
													<span>Profile</span>
												</a>
											</li>
											
											<li>
												<a href="change-password.php">
													<i></i>
													<span>Change Password</span>
												</a>
											</li>
											<li>
												<a href="index.php">
													<i class="fas fa-sign-out-alt"></i>
													<span>Logout</span>
												</a>
											</li>
										</ul>
									</nav>
								</div>
                            </div>
                            <!-- //Profile Side Bar -->
    </div>
    <div class="col-md-7 col-lg-8 col-xl-9">
							<div class="appointments">
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<span class="login100-form-title p-b-26">
					Shop Details
				</span>
				<div class="profile-info-widget">
										<a href="#" class="booking-doc-img">
										
											<?php echo '<img class="rounded-circle centre" src="data:image/jpeg;base64,'.base64_encode($dp).'"  alt='.$name.'>  ';?>
									
										</a>
										</div>
<form method="POST"  enctype="multipart/form-data" >
			<div class="upload-img">
				<div class="change-photo-btn">
					<span><i ></i> Select Photo</span>
					<input type="file" class="upload" name="image" id="image">
				</div>
				<small class="form-text text-muted">Allowed JPG, GIF or PNG. Max size of 50KB</small>
			</div>
			<div class="upload-img">
				<div class="change-photo-btn">
					<span><i class="fa fa-upload"></i> Upload Photo</span>
					<input type="submit" name="insert" id="insert" value="Insert" class="upload">
				
				</div>
				
			</div>
</form>
<div><br></div>
				<form class="login100-form validate-form" method="POST" action="shopdetails.php" >
					
				
	<?php 
	if($contact!=null){
		echo '<div class="wrap-input100 validate-input" data-validate="This Field is Required">
		<input class="input100" type="text" name="oname" placeholder="Name of Shop Owner" value="'.$name.'">
		
	</div>

	<div class="wrap-input100 validate-input" data-validate="This Field is Required">
		<input class="input100" type="text" name="sname" placeholder="Shop Name" value="'.$sname.'">
		
	</div>
	<div class="wrap-input100 validate-input" data-validate="This Field is Required">
		<input class="input100" type="number" id="input" name="shopcontact" value="'.$contact.'" placeholder="Shop Contact">
		
	</div>
	<div class="wrap-input100 validate-input" data-validate="This Field is Required">
		<input class="input100" type="text" name="dist" placeholder="District" value="'.$dist.'">
		
	</div>
	<div class="wrap-input100 validate-input" data-validate="This Field is Required">
		<input class="input100" type="text" name="state" placeholder="State" value="'.$state.'">
	
	</div>
	<div class="wrap-input100 validate-input" data-validate="This Field is Required">
		<input class="input100" type="text" name="country" placeholder="Country" value="'.$country.'">
		<span class="focus-input100" data></span>
	</div>
	
	<div class="wrap-input100 validate-input" data-validate="This Field is Required">
		<input class="input100" type="number" id="input" name="pcode" placeholder="Pincode" value="'.$pcode.'">
		
	</div>';
	}else{
		echo '<div class="wrap-input100 validate-input" data-validate="This Field is Required">
		<input class="input100" type="text" name="oname" >
		<span class="focus-input100" data-placeholder="Name of Shop Owner"></span>
	</div>

	<div class="wrap-input100 validate-input" data-validate="This Field is Required">
		<input class="input100" type="text" name="sname">
		<span class="focus-input100" data-placeholder="Shop Name"></span>
	</div>
	<div class="wrap-input100 validate-input" data-validate="This Field is Required">
		<input class="input100" type="number" id="input" name="shopcontact">
		<span class="focus-input100" data-placeholder="Shop Contact"></span>
	</div>
	<div class="wrap-input100 validate-input" data-validate="This Field is Required">
		<input class="input100" type="text" name="dist">
		<span class="focus-input100" data-placeholder="District"></span>
	</div>
	<div class="wrap-input100 validate-input" data-validate="This Field is Required">
		<input class="input100" type="text" name="state">
		<span class="focus-input100" data-placeholder="State"></span>
	</div>
	<div class="wrap-input100 validate-input" data-validate="This Field is Required">
		<input class="input100" type="text" name="country">
		<span class="focus-input100" data-placeholder="Country"></span>
	</div>
	
	<div class="wrap-input100 validate-input" data-validate="This Field is Required">
		<input class="input100" type="number" id="input" name="pcode">
		<span class="focus-input100" data-placeholder="Pincode"></span>
	</div>';
	}
	?>

					
					
					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button type="submit" name="login" class="login100-form-btn">
						Submit
							</button>
						</div>
					</div>
					</form>
			</div>
		</div>
	</div>
	</div>
						</div>
					</div>

				</div>

			</div>

	<div id="dropDownSelect1"></div>
	
<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>
</html>