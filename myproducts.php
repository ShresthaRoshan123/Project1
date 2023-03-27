<?php 
session_start();
$email=$_SESSION['email'];
include 'config.php';
$sql1 = "Select * from products where EMail='$email'";
	$result1=mysqli_query($conn, $sql1);
	$num=mysqli_num_rows($result1);
	$i=0;
	while($row1 = mysqli_fetch_array($result1)){
		
		$pid[$i]=$row1['ProductId'];
		$i++;
	}
if(isset($_POST['updateproduct'])){
	$id=$_POST['updateproduct'];
	$prodid=$pid[$id];
	$value=$_POST['qty'.$id];
	
	$sql = "UPDATE products set Stock='".$value."' WHERE ProductId='$prodid'";
	$result=mysqli_query($conn,$sql);
	$stock[$id]=$value;

}
if(isset($_POST['delproduct'])){
	$id=$_POST['delproduct'];
	$prodid=$pid[$id];
	$sql="DELETE FROM `products` WHERE ProductId ='$prodid'";
	$result=mysqli_query($conn,$sql);
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
	
	$sql1 = "Select * from products where EMail='$email'";
	$result1=mysqli_query($conn, $sql1);
	$num=mysqli_num_rows($result1);
	$i=0;
	while($row1 = mysqli_fetch_array($result1)){
		//echo $row1['Name'];
		$pid[$i]=$row1['ProductId'];
		$pname[$i]=$row1['ProductName'];
		$ptype[$i]=$row1['ProductType'];
		$brand[$i]=$row1['Brand'];
		$price[$i]=$row1['Price'];
		$stock[$i]=$row1['Stock'];
		$qty[$i]=$row1['Quantity'];
		$pimage[$i]=$row1['ProductImage'];
		
		$i++;
	}
	
	
	
?>
<!DOCTYPE html> 
<html lang="en">
  <head>
    <link href="assets/img/favicon.png" rel="icon">
		
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    
    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="assets/plugins/fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="assets/plugins/fontawesome/css/all.min.css">
    
    <!-- Main CSS -->
    
    <link rel="stylesheet" href="assets/css/style.css">
  </head>  
    <body>
    		
			<!-- Page Content -->
			<div class="content">
				<div class="container-fluid">

					<div class="row">
						<div class="col-md-5 col-lg-4 col-xl-3 theiaStickySidebar">
						
							<!-- Profile Sidebar -->
							<div class="profile-sidebar">
								<div class="widget-profile pro-widget-content">
									<div class="profile-info-widget">
										<a href="" class="booking-doc-img">
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
													<i class="fas fa-columns"></i>
													<span>Home</span>
												</a>
											</li>
											<li >
												<a href="updateproducts.php">
													<i class="fas fa-calendar-check"></i>
													<span>Update Products</span>
												</a>
											</li>
											<li class="active">
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
													<i class="fas fa-lock"></i>
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
							<!-- /Profile Sidebar -->
							<form method="POST" action="myproducts.php">
						</div>
						<div class="col-md-7 col-lg-8 col-xl-9">						
						<div class="row row-grid">
							
						<?php
                        $i=0;
                       
						while($i<$num){
	echo '<div class="col-md-6 col-lg-4 col-xl-3">
		<div class="card widget-profile pat-widget-profile">
			<div class="card-body">
				<div class="pro-widget-content">
					<div class="profile-info-widget">
						<a href="patient-profile.php" class="booking-doc-img">
							<img class="img-fluid"" src="data:image/jpeg;base64,'.base64_encode($pimage[$i]).'"  class="img-thumnail" alt="'.$pname[$i].'"/>
						</a>
						<div class="profile-det-info">
							<h3><a >'.$pname[$i].'</a></h3>
							
							<div class="patient-details">
								<h5><b>Brand :</b>'.$brand[$i].'</h5>
								<h5 class="mb-0"><i ></i>'.$ptype[$i].'</h5>
							</div>
						</div>
					</div>
				</div>
				<div class="patient-info">
					<ul>
						<li>Phone <span>'.$contact.'</span></li>
						<li>Product Id<span>'.$pid[$i].'</span></li>
						<li>Price <span>Rs.'.$price[$i].'</span></li>
                    </ul>
                    
				</div>
				
                <button type="button" id="sub'.$i.'" class="sub btn btn-primary submit-btn">-</button>    
                <input type="number" name="qty'.$i.'" id="'.$i.'" value="'.$stock[$i].'" min="1" max="1000" style="height: 35px;"/>    
                <button type="button" id="add'.$i.'" class="add btn btn-primary submit-btn">+</button>
                <div><br></div>
				<center><button type="submit" class="btn book-btn" name="updateproduct" value ="'.$i.'" id="button'.$i.'">Update</button></center>
				<div><br></div>
                <center><button type="submit" class="btn book-btn" name="delproduct"  value ="'.$i.'" id="del'.$i.'">Delete this Product</button></center>
            </div>
            
        </div>
        
    </div>'
    ;
							$i++;
						}
						
							?>
							
								
								
							</div>

						</div>
					</div>

				</div>

			</div>	
			</form>	
			<!-- /Page Content -->
    </body>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script>
            
            
            $('.add').click(function () {
            if ($(this).prev().val() < 1000) {
            $(this).prev().val(+$(this).prev().val() + 1);
            }
        });
        $('.sub').click(function () {
            if ($(this).next().val() > 1) {
            if ($(this).next().val() > 1) $(this).next().val(+$(this).next().val() - 1);
            }
        });
    
        </script>
</html>
