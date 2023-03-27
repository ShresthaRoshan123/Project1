<?php
session_start();
include 'config.php';
 if(isset($_SESSION['email'])){
     $email=$_SESSION['email'];
     if(isset($_POST['Cancel'])){
		$id=$_POST['Cancel'];
		$sql = "UPDATE orders SET Status='-2' WHERE OrderId='$id'";
		$result=mysqli_query($conn,$sql);
	}
    if(isset($_POST['showall'])){
        $sql1 = "Select * from orders where customermail='$email'";
    }else{
        $sql1 = "Select * from orders where customermail='$email' AND Status IS NULL";
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
    $dist[$i]=$row1['District'];
    $state[$i]=$row1['State'];
    $country[$i]=$row1['Country'];
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
        $quantity[$i]=$row['Quantity'];
        $pimage[$i]=$row['ProductImage'];
    }

    $i++;
    }
   
 }
?>
<!doctype html>
<html lang="en">

<!-- 06_02_single_product.html  [XR&CO'2014], Tue, 22 Oct 2019 11:56:12 GMT -->
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>06_02_single_product</title>
    <link rel="shortcut icon" type="image/x-icon" href="images/favicon.png" />
    <link rel="stylesheet" href="plugin/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="plugin/bootstrap/css/bootstrap-theme.css">
 
    <link rel="stylesheet" href="plugin/fonts/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="plugin/jquery-ui/jquery-ui.min.css">
    <link rel="stylesheet" href="plugin/process-bar/tox-progress.css">
    <link rel="stylesheet" href="plugin/owl-carouse/owl.carousel.min.css">
    <link rel="stylesheet" href="plugin/owl-carouse/owl.theme.default.min.css">
    <link rel="stylesheet" href="plugin/animsition/css/animate.css">
    <link rel="stylesheet" href="plugin/jquery-ui/jquery-ui.min.css">
    <link rel="stylesheet" href="plugin/mediaelement/mediaelementplayer.css">
    <link rel="stylesheet" href="plugin/datetimepicker/bootstrap-datepicker3.css">
    <link rel="stylesheet" href="plugin/datetimepicker/bootstrap-datetimepicker.min.css">
    <link rel="stylesheet" href="plugin/lightgallery/lightgallery.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/styles.css">

</head>
<style>button {
    background-color: Transparent;
    background-repeat:no-repeat;
    border: none;
    cursor:pointer;
    overflow: hidden;
    outline:none;
		}
	</style>
<body>

<!--load page-->
<div class="load-page">
    <div class="sk-wave">
        <div class="sk-rect sk-rect1"></div>
        <div class="sk-rect sk-rect2"></div>
        <div class="sk-rect sk-rect3"></div>
        <div class="sk-rect sk-rect4"></div>
        <div class="sk-rect sk-rect5"></div>
    </div>
</div>

<!-- Mobile nav -->
<nav class="visible-sm visible-xs mobile-menu-container mobile-nav">
    <div class="menu-mobile-nav navbar-toggle">
        <span class="icon-bar"><i class="fa fa-bars" aria-hidden="true"></i></span>
    </div>
    <div id="cssmenu" class="animated">
        <div class="uni-icons-close"><i class="fa fa-times" aria-hidden="true"></i></div>
        <ul class="nav navbar-nav animated">
          
            <li class="has-sub"><a href='#'>shop</a>
                <ul>
                    <li><a href="06_01_shop.html">Shop</a></li>
                     
                    <li><a href="cart.php">Cart</a></li>
                    <li><a href=" checkout.php">Checkout</a></li>
                    <li><a href=" myorders.php">My Orders</a></li>
                </ul>
            </li>
           
        </ul>
        <div class="clearfix"></div>
    </div>
</nav>
<!-- End mobile menu -->

<div class="uni-single-product">
    <div id="wrapper-container" class="site-wrapper-container">
        <header>
            <div class="uni-medicare-header sticky-menu">
                <div class="container">
                    <div class="uni-medicare-header-main">
                        <div class="row">
                            <div class="col-md-2">
                                <!--LOGO-->
                                <div class="wrapper-logo">
                                    <a class="logo-default" href="#"><img src="images/logo.png" alt="" class="img-responsive"></a>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                            <div class="col-md-10">
                                <!--MENU TEXT-->
                                <div class="uni-main-menu">
                                    <nav class="main-navigation uni-menu-text">
                                        <div class="cssmenu">
                                            <ul>
                                              
                                                <li class="has-sub"><a href='#'>shop</a>
                                                    <ul>
                                                        <li><a href="index.php">Shop</a></li>                                                         
                                                        <li><a href="cart.php">Cart</a></li>
                                                        <li><a href=" checkout.php">Checkout</a></li>
                                                        <li><a href=" myorders.php">My Orders</a></li>
                                                    </ul>
                                                </li>
                                                
                        <!--FORM SEARCH-->
                        <div class="uni-form-search-header">
                            <div class="box-search-header collapse in" id="box-search-header">
                                <div class="uni-input-group">
                                    <input type="text" name="key" placeholder="Search" class="form-control">
                                    <button class="uni-btn btn-search">
                                        <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <div id="main-content" class="site-main-content">
            <div class="site-content-area">

                <div class="uni-banner-default uni-background-1">
                    <div class="container">
                        <!-- Page title -->
                        <div class="page-title">
                            <div class="page-title-inner">
                                <h1>My Orders</h1>
                            </div>
                        </div>
                        <!-- End page title -->

                        <!-- Breadcrumbs -->
                        <ul class="breadcrumbs">
                        <?php
                           if(isset($_SESSION['email'])){
                               echo '<li><a href="logout.php">Logout</a></li>';
                           }else{
                            echo '<li><a href="login.php">Login</a></li>';
                           }
                           ?>
                            
                            <li><a >shop</a></li>
                        </ul>
                        <!-- End breadcrumbs -->
                    </div>
                </div>
              
                <main id="main" class="site-main">
                    <div class="uni-single-product-body">
                        <div class="container">
                            <div id="content">
                                <div class="row">
                                <div class="content">
                                <div class="col-md-7 col-lg-12 col-xl-12">
							<div class="appointments">
<form method="POST">

        <?php	
         if(!isset($_SESSION['email'])){
             echo '<p>Please <a href="login.php"> Login</a> to View your Cart</p>';
         }else{
            $i=0;
   
            while($i<$num){
            echo '<div class="appointment-list">
                    <div class="profile-info-widget">
                        <a href="patient-profile.php" class="booking-doc-img">
                        <img class="img-fluid" src="data:image/jpeg;base64,'.base64_encode($pimage[$i]).'"   alt="'.$pname[$i].'"/>
                        </a>
                        <div class="profile-det-info">
                            <h3><a href="patient-profile.php">'.$pname[$i].'</a></h3>
                            <div><br></div>
                            <a>'.$ptype[$i].'
                            <div class="patient-details">
                            <br>
                                <h5><i class="far fa-clock"></i><b>Quantity*Price: &nbsp;</b>'.$qty[$i].'*'.$price[$i].'</h5>
                                <h2><b>Cost: </b>'.$qty[$i]*$price[$i].'</h2>
                                
                            </div>
                        </div>
                    </div>';
        if($status[$i]==1){
            echo '<div class="appointment-action">				
                        <a href="javascript:void(0);" class="btn btn-sm bg-success-light" >					
                            <i  style="color:green;"> Delivered</i>
                        </a>
                        
                    </div>
                </div>';
        }else if($status[$i]==-1){
            echo '<div class="appointment-action">				
                        
                        <a href="javascript:void(0);" class="btn btn-sm bg-danger-light">
                        <i  style="color:red;"> Cancelled By Vendor</i>					
                        </a>
                    </div>
                </div>';
        }else if($status[$i]==-2){
            echo '<div class="appointment-action">				
                        
                        <a href="javascript:void(0);" class="btn btn-sm bg-danger-light">
                        <i  style="color:red;"> Cancelled By You</i>					
                        </a>
                    </div>
                </div>';
        }else{
                    echo '<div class="appointment-action">	
                               
                       
                        <a href="javascript:void(0);" class="btn btn-sm bg-danger-light">
                        <button style="color:red;" name="Cancel" value="'.$orderid[$i].'"> Cancel</button>					
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
            
         }

       
            ?>
			
			</form>
          </div>
        </div>
        </div>  
						</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>

            </div>
        </div>

        <footer class="site-footer footer-default">
            <div class="footer-main-content">
                <div class="container">
                    <div class="row">
                       
            </div>
        </footer>
    </div>
</div>
<script src="plugin/jquery/jquery-2.0.2.min.js"></script>
<script src="plugin/jquery-ui/jquery-ui.min.js"></script>
<script src="plugin/bootstrap/js/bootstrap.js"></script>
<script src="plugin/process-bar/tox-progress.js"></script>
<script src="plugin/waypoint/jquery.waypoints.min.js"></script>
<script src="plugin/counterup/jquery.counterup.min.js"></script>
<script src="plugin/owl-carouse/owl.carousel.min.js"></script>
<script src="plugin/jquery-ui/jquery-ui.min.js"></script>
<script src="plugin/mediaelement/mediaelement-and-player.js"></script>
<script src="plugin/masonry/masonry.pkgd.min.js"></script>
<script src="plugin/datetimepicker/moment.min.js"></script>
<script src="plugin/datetimepicker/bootstrap-datepicker.min.js"></script>
<script src="plugin/datetimepicker/bootstrap-datepicker.tr.min.js"></script>
<script src="plugin/datetimepicker/bootstrap-datetimepicker.js"></script>
<script src="plugin/datetimepicker/bootstrap-datetimepicker.fr.js"></script>

<script src="plugin/lightgallery/picturefill.min.js"></script>
<script src="plugin/lightgallery/lightgallery.js"></script>
<script src="plugin/lightgallery/lg-pager.js"></script>
<script src="plugin/lightgallery/lg-autoplay.js"></script>
<script src="plugin/lightgallery/lg-fullscreen.js"></script>
<script src="plugin/lightgallery/lg-zoom.js"></script>
<script src="plugin/lightgallery/lg-hash.js"></script>
<script src="plugin/lightgallery/lg-share.js"></script>
<script src="plugin/sticky/jquery.sticky.js"></script>

<script src="js/main.js"></script>
</body>

<!-- 06_02_single_product.html  [XR&CO'2014], Tue, 22 Oct 2019 11:56:16 GMT -->
</html>