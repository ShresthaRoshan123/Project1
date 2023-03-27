<?php 
session_start();
$email=$_SESSION['email'];
include 'config.php';
$pid=getAppointmentId();

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
	if (isset($_POST['insert'])){
		$pname=$_POST['pname'];
		$ptype=$_POST['ptype'];		
		$brand=$_POST['Brand'];		
		$price=$_POST['price'];
		$stock=$_POST['stock'];
		$qty=$_POST['Quantity'];
		//$file=null;
		$file = addslashes(file_get_contents($_FILES["image"]["tmp_name"]));  
		
		$sql = "INSERT INTO products (ProductId,ProductName,ProductType,Brand,Price,Stock,Quantity,ProductImage,Email) 
		VALUES ('$pid','$pname','$ptype','$brand','$price','$stock','$qty','$file','$email') ";	
		   
        if (mysqli_query($conn,$sql)){
                echo "Updated";
                }
			else
			{
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
			}
	
	}
	function getAppointmentId(){
		$unique=uniqid();
		$file = substr($unique, strlen($unique) - 6, strlen($unique));
		$aid="ID".$file;
		return $aid;
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login V2</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
	
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
		<style>button {
    background-color: Transparent;
    background-repeat:no-repeat;
    border: none;
    cursor:pointer;
    overflow: hidden;
    outline:none;
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
											<li class="active">
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
											
											<li>
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
					Product
				</span>
				<form method="POST"  enctype="multipart/form-data" class="login100-form validate-form">
				<div class="wrap-input100 validate-input" data-validate="This Field is Required">
				<div class="upload-img">
					
						<div class="change-photo-btn">
							<span><i class="fa fa-upload"></i>&nbsp;&nbsp;&nbsp;Photo of the Product</span>
							<input type="file" class="upload " name="image" id="image">
							<!-- <input type="file" class="upload input100" name="image" id="image"> -->
						</div>
						
						<small class="form-text text-muted">Allowed JPG, GIF or PNG. Max size of 50kb</small>
					</div>
	</div>
					<!-- <div class="upload-img">
				<div class="change-photo-btn">
					<span><i class="fa fa-upload"></i> Upload Photo</span>
					<input type="submit" name="insert" id="insert" value="Insert" class="upload">
				
				</div> -->

					

					<div class="wrap-input100 validate-input" data-validate="This Field is Required">
						<input class="input100" type="text" name="pname">
						<span class="focus-input100" data-placeholder="Product Name"></span>
                    </div>
                    <div class="form-group">
                        <label>Product Type</label>
                        <select class="form-control select"  name="ptype" required>
                            <option>Select</option>
                            <option>Tablet</option>
                            <option>Capsule</option>
                            <option>Tonic</option>
                            <option>Ointment</option>
                            <option>Powder</option>
                            <option>Others</option>
                        </select>
                    </div>

					<div class="wrap-input100 validate-input" data-validate="This Field is Required">
						<input class="input100" type="text" name="Brand">
						<span class="focus-input100" data-placeholder="Company name"></span>
					</div>
					<div class="wrap-input100 validate-input" data-validate="This Field is Required">
						<input class="input100" type="number" id="input" name="price">
						<span class="focus-input100" data-placeholder="Price/Quantity"></span>
					</div>
                    <div class="wrap-input100 validate-input" data-validate="This Field is Required">
						<input class="input100" type="text" name="stock">
						<span class="focus-input100" data-placeholder="Available Stock"></span>
                    </div>
                    <div class="wrap-input100 validate-input" data-validate="This Field is Required">
						<input class="input100" type="text" name="Quantity">
						<span class="focus-input100" data-placeholder="Quantity/Product(Eg:500ml,10 tabs)"></span>
					</div>
                    <div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button type="submit" name="insert" id="insert" class="login100-form-btn">
						Submit
							</button>
						</div>
					</div>
			<div><br></div>
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