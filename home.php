<?php 
session_start();
$email=$_SESSION['email'];
include 'config.php';
$query = mysqli_query($conn,"select * from vendors where Email='$email'");
	$rows = mysqli_fetch_assoc($query);
	$numb=mysqli_num_rows($query);
	if ($numb == 1) {
		$name=$rows['Name'];
		$sname=$rows['ShopName'];
			
		$dist=$rows['District'];
		$state=$rows['State'];
		$country=$rows['Country'];
		$pcode=$rows['Pincode'];
		$dp=$rows['Image'];	
		$oldpwd=$rows['Password'];
	}
	if(isset($_POST['Delivered'])){
		$id=$_POST['Delivered'];
		$sql = "UPDATE orders SET Status='1' WHERE OrderId='$id'";
		$result=mysqli_query($conn,$sql);
	
	}else if(isset($_POST['Cancel'])){
		$id=$_POST['Cancel'];
		$sql = "UPDATE orders SET Status='-1' WHERE OrderId='$id'";
		$result=mysqli_query($conn,$sql);
	}
	if(isset($_POST['showall'])){
		$sql1 = "Select * from orders where vendormail='$email'";
	}else{
		$sql1 = "Select * from orders where vendormail='$email' AND Status IS NULL";
	}
	
$result1=mysqli_query($conn, $sql1);
$num=mysqli_num_rows($result1);
$i=0;
while($row1 = mysqli_fetch_array($result1)){
	
	$orderid[$i]=$row1['OrderId'];
	$prodid[$i]=$row1['ProductId'];
	$cname[$i]=$row1['CustomerName'];
	$qty[$i]=$row1['Quantity'];
	$cmail[$i]=$row1['customermail'];
	$address[$i]=$row1['Address'];
	$contact[$i]=$row1['Contact'];
	$proddist[$i]=$row1['District'];
	$prodstate[$i]=$row1['State'];
	$prodcountry[$i]=$row1['Country'];
	$pincode[$i]=$row1['Pincode'];
	$status[$i]=$row1['Status'];	
	$sql = "Select * from products where ProductId='$prodid[$i]'";
	$result=mysqli_query($conn, $sql);
	while($row = mysqli_fetch_array($result)){
		$pid[$i]=$row['ProductId'];
		$pname[$i]=$row['ProductName'];
		$ptype[$i]=$row['ProductType'];
		$brand[$i]=$row['Brand'];
		$price[$i]=$row['Price'];
		$stock[$i]=$row['Stock'];
		$cqty[$i]=$row['Quantity'];
		$pimage[$i]=$row['ProductImage'];
	}

	$i++;
}

?>


<!DOCTYPE html> 
<html lang="en">

<head>
		<meta charset="utf-8">
		<title>Orders</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
		
		<!-- Favicons -->
		<link href="assets/img/favicon.png" rel="icon">
		
		
		<link rel="stylesheet" href="assets/css/bootstrap.min.css">
		
		
		<link rel="stylesheet" href="assets/plugins/fontawesome/css/fontawesome.min.css">
		<link rel="stylesheet" href="assets/plugins/fontawesome/css/all.min.css">
		
		
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
											<li class="active">
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
                            <!-- //Profile Side Bar -->
    </div>
    <div class="col-md-7 col-lg-8 col-xl-9">
							<div class="appointments">
<form method="POST">

        <?php	
        

        $i=0;
   
        while($i<$num){
        echo '<div class="appointment-list">
                <div class="profile-info-widget">
                    <a href="patient-profile.php" class="booking-doc-img">
                    <img class="img-fluid"" src="data:image/jpeg;base64,'.base64_encode($pimage[$i]).'"   alt="'.$pname[$i].'"/>
                    </a>
                    <div class="profile-det-info">
                        <h3><a href="patient-profile.php">'.$pname[$i].'</a></h3>
                        <a>'.$ptype[$i].'
                        <div class="patient-details">
                            <h5><i class="far fa-clock"></i>Quantity: '.$qty[$i].'</h5>
                            <h5><i class="fas fa-map-marker-alt"></i>Price: '.$price[$i].'</h5>
							<h5><i class="fas fa-envelope"></i>Address: '.$address[$i].',<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$proddist[$i].','.$prodstate[$i].'</h5>
							<h5>Pincode: '.$pincode[$i].'
                            <h5 class="mb-0"><i class="fas fa-phone"></i>Contact:'.$contact[$i].'</h5>
                        </div>
                    </div>
                </div>';
    if($status[$i]==1){
        echo '<div class="appointment-action">				
                    <a href="javascript:void(0);" class="btn btn-sm bg-success-light" >					
                        <i class="fas fa-check" style="color:green;"> Delivered</i>
                    </a>
                    
                </div>
            </div>';
    }else if($status[$i]==-1){
        echo '<div class="appointment-action">				
                    
                    <a href="javascript:void(0);" class="btn btn-sm bg-danger-light">
                    <i class="fas fa-times" style="color:red;"> Cancelled by you</i>					
                    </a>
                </div>
            </div>';
	}else if($status[$i]==-2){
        echo '<div class="appointment-action">				
                    
                    <a href="javascript:void(0);" class="btn btn-sm bg-danger-light">
                    <i class="fas fa-times" style="color:red;"> Cancelled by the user</i>					
                    </a>
                </div>
            </div>';
    }
	else{
                echo '<div class="appointment-action">	
               			
                    <a href="javascript:void(0);" class="btn btn-sm bg-success-light" >	
                         				
                        <button class="fas fa-check" style="color:green;" name="Delivered" value="'.$orderid[$i].'"> Delivered</button>
                    </a>
                    <a href="javascript:void(0);" class="btn btn-sm bg-danger-light">
                    <button class="fas fa-times" style="color:red;" name="Cancel" value="'.$orderid[$i].'"> Cancel</button>					
                    </a>
                </div>
            </div>';
    }
            $i++;
		}
		if(isset($_POST['showall'])){
			echo ' <center><button type="submit" class="btn book-btn" name="showless"  >Show Less</button></center>';
		}else{
			echo ' <center><button type="submit" class="btn book-btn" name="showall"  >Show All</button></center>';
		}
            ?>
		
			</form>
          </div>
						</div>
					</div>

				</div>

			</div>
        
    </body>
 
</html>