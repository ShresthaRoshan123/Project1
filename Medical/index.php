<?php
session_start();



include "config.php";

	if(isset($_POST['filterbtn'])){
	if(isset($_POST['place'])){
            $ftr=$_POST['place'];
            $ccc=count($ftr);            
            switch($ccc){
                case 1:$sql1 = "Select * from products where ProductType='$ftr[0]'";  break;
                case 2:$sql1 = "Select * from products where ProductType='$ftr[0]' OR  ProductType='$ftr[1]'"; break;
                case 3:$sql1 = "Select * from products where ProductType='$ftr[0]' OR  ProductType='$ftr[1]' OR ProductType='$ftr[2]'";break;
                case 4:$sql1 = "Select * from products where ProductType='$ftr[0]' OR  ProductType='$ftr[1]' OR ProductType='$ftr[2]' OR ProductType='$ftr[3]'";break;
                case 5:$sql1 = "Select * from products where ProductType='$ftr[0]' OR  ProductType='$ftr[1]' OR ProductType='$ftr[2]' OR ProductType='$ftr[3]' OR ProductType='$ftr[4]'";break;
                default:$sql1 = "Select * from products"; break;
            }			
		}else{
            $sql1 = "Select * from products"; 
        }
	}else{
		$sql1 = "Select * from products";
    }
    if(isset($_POST['searchbtn'])){
        $pattern=$_POST['search'];
        $sql1 = "Select * from products where ProductName like '%".$pattern."%'";
    }
    $result1=mysqli_query($conn, $sql1);
    $num=mysqli_num_rows($result1);
    $i=0;
    while($row1 = mysqli_fetch_array($result1)){
        $prodid[$i]=$row1['ProductId'];
        $prodName[$i]=$row1['ProductName'];
        $prodType[$i]=$row1['ProductType'];
        $brand[$i]=$row1['Brand'];
        $price[$i]=$row1['Price'];
        $prodImage[$i]=$row1['ProductImage'];
        $prodMail[$i]=$row1['Email'];

        $sql = "Select * from vendors where Email='$prodMail[$i]'";
        $result=mysqli_query($conn, $sql);
        while($row = mysqli_fetch_array($result)){
            $sname[$i]=$row['ShopName'];
           
            
        }
        $i++;
    }
    if(isset($_POST['acart'])){
        stringform();
    }

    function stringform(){
        if (isset($_POST["acart"])) {
            if ($_SESSION["array"] != "") {
                $_SESSION["array"] .= "," ;
            }
    
            $_SESSION["array"]  .= $_POST["acart"] ;
        }
        else {
            $_SESSION["array"] = "" ;
        }
        
       
    }
    if(isset($_SESSION["array"])){
        $demo   = $_SESSION["array"] == "" ? "gg" : $_SESSION["array"] ;
    }else{
        $_SESSION["array"]="";
    }
    

?>
<!doctype html>
<html lang="en">

<!-- 06_01_shop.html  [XR&CO'2014], Tue, 22 Oct 2019 11:56:01 GMT -->
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>06_01_shop</title>
    <link rel="shortcut icon" type="image/x-icon" href="images/favicon.png" />
    <link rel="stylesheet" href="plugin/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="plugin/bootstrap/css/bootstrap-theme.css">
    <link rel="stylesheet" href="fonts/poppins/poppins.css">
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
</head>
<style>
.cartbutton {
  background-color: #008CBA; /* Green */
  border: none;
  color: white;
  padding: 15px 12px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  cursor: pointer;
}
.cartpage {
  background-color: #A9A9A9; /* Green */
  border: none;
  color: white;
  padding: 15px 12px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  cursor: pointer;
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
            
            <li><a href="02_04_contact.html">Contact</a></li>
        </ul>
        <div class="clearfix"></div>
    </div>
</nav>
<!-- End mobile menu -->

<div class="uni-shop">
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
                                                <!-- <li class="has-sub hover-element"><a href='#'>Shortcode</a></li> -->
                                            </ul>
                                        </div>
                                    </nav>
                                </div>

                                <!--SEARCH AND APPOINTMENT-->
                               
                        <!--END SHORTCODE-->

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
                                <h1>shop</h1>
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
                    <div class="uni-shop-body">
                        <div class="container">
                            <div id="content">

                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="uni-single-product-left">
                                            <div class="uni-siderbar-left">
                                <form  method="post" accept-charset="utf-8">
                                    <div class="vk-newlist-banner-test-search">
                                        <input type="text" name="search" placeholder="Search...">
                                        <button type="submit" name="searchbtn"><i class="fa fa-search" aria-hidden="true"></i></button>
                                    </div>
                                </form>

                                                

                                             

<form method="POST">
                                                <div class="uni-best-seller">
                                                    <h3>Filter</h3>
                            <div class="uni-divider"></div>
                            <div class="vk-newlist-details">
                                <div class="vk-newlist-details-newlist1 vk-book-details">
                                    <div>
                                        <label class="custom_check">
                                            <input type="checkbox" name="place[]" value="tablet">
                                            <span class="checkmark"></span>Tablets
                                        </label>
                                    </div>
                                </div>

                                <div class="vk-newlist-details-newlist1  vk-book-details">
                                    <div>
                                        <label class="custom_check">
                                            <input type="checkbox" name="place[]" value="capsule">
                                            <span class="checkmark"></span>Capsule
                                        </label>
                                    </div>
                                </div>

                                <div class="vk-newlist-details-newlist1  vk-book-details">
                                    <div>
                                        <label class="custom_check">
                                            <input type="checkbox" name="place[]" value="tonic">
                                            <span class="checkmark"></span>Tonic
                                        </label>
                                    </div>
                                </div>

                                <div class="vk-newlist-details-newlist1  vk-book-details">
                                    <div>
                                        <label class="custom_check">
                                            <input type="checkbox" name="place[]"  value="ointment">
                                            <span class="checkmark"></span>Ointment
                                        </label>
                                    </div>
                                </div>
                                <div class="vk-newlist-details-newlist1  vk-book-details">
                                    <div>
                                        <label class="custom_check">
                                            <input type="checkbox" name="place[]"  value="powder">
                                            <span class="checkmark"></span>Powder
                                        </label>
                                    </div>
                                </div>
                                <div class="vk-newlist-details-newlist1  vk-book-details">
                                   
                                    <div class="clearfix"></div> 
                                        <button type="submit" name="filterbtn" class="button"><i class="fa fa-search" aria-hidden="true"></i></button>
                                    
                                </div>
                                <div class="box-add">
                                    <center><a href="cart.php" class="cartpage">Proceed to cart</a></center>
                                </div>
                            </div>
                        </div>
                        </form>
                    </div>
                                        </div>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="uni-shop-siderbar-right">
                                            <div class="product-filter">
                                                <p class="woocommerce-result-count">Showing 
                                                <?php if($num<2) echo $num.' result';
                                                        else echo $num.' results';
                                                ?></p>

                                                
                                                <div class="clearfix"></div>
                                                <!-- .woocommerce-ordering -->
                                            </div>

<form method="POST">                                            <!-- .product item -->
<?php 
if($num==0) echo '<a class="product_name">Sorry! No Products Available..</a>';
$i=0;
while($i<$num){
echo'<div class="category-product uni-product-wapper">
<div class="row">
    <div class="col-md-4 col-sm-6">
        <div class="product-item">
            <ul class="category-product">
                <li>
                    <div class="wrapper">
                        <div class="feature-image">
                            <a><img class="wp-post-image img-responsive" src="data:image/jpeg;base64,'.base64_encode($prodImage[$i]).'" alt=""></a>
                        </div>
                        <!-- .feature-image -->

                        <div class="stats">
                            <div class="box-title">
                                <h2 class="title-product">
                                    <a class="product_name">'.$prodName[$i].'</a>
                                    <a class="product_name">'.$prodType[$i].'</a>
                                </h2>
                                <!-- .title-product -->
                            </div>
                            <!-- .box-title -->
                            <div class="price-add-cart">
                                <a>Shop Name: '.$sname[$i].'</a>
                                <div class="box-price">
                                    <span class="price">
                                        <span class="woocommerce-Price-amount amount">
                                            <span class="woocommerce-Price-currencySymbol">Rs</span>
                                            '.$price[$i].'
                                        </span>
                                    </span>
                                </div>

                                <div class="box-add">
                                    <button type="submit" class="cartbutton" name="acart" value='.$prodid[$i].'>Add to cart</button>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <!-- .box-price -->
                        </div>
                        <!-- .stats -->
                    </div>
                </li>
            </ul>
        </div>
    </div>';
    $i++;
}
    ?>
                                                                            
       </form>                                             
                                    

                </div>
                                            </div>


                                            
                                            <div class="clearfix"></div>
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

<!-- 06_01_shop.html  [XR&CO'2014], Tue, 22 Oct 2019 11:56:12 GMT -->
</html>