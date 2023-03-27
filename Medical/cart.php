<?php
session_start();
include "config.php";
$demo   = $_SESSION["array"] == "" ? "gg" : $_SESSION["array"] ;
$str_arr = explode (",", $demo); 
$productprice=0;
$realprice=0;
$nodup=array();
$nodup=removeduplicates($str_arr,count($str_arr));
$ndpstring = join("','",$nodup );
$_SESSION['pids']=$ndpstring;
$_SESSION['pidarr']=$nodup;
$sql1="SELECT * FROM products WHERE ProductId IN ('$ndpstring')";
$result1=mysqli_query($conn, $sql1);
$num=mysqli_num_rows($result1);
$i=0;

while($row1 = mysqli_fetch_array($result1)){
    $prodName[$i]=$row1['ProductName'];
    $prodType[$i]=$row1['ProductType'];
    $brand[$i]=$row1['Brand'];
    $price[$i]=$row1['Price'];
    $prodImage[$i]=$row1['ProductImage'];
    $prodMail[$i]=$row1['Email'];
    
    $realprice+=$price[$i];
	$i++;
}
function removelements($arr,$ele){
    $key = array_search($ele, $arr);
    array_splice($arr, $key,1);
}
function removeduplicates($arr,$num){
    $newarr=[];
    $k=0;
    for($i=0;$i<$num;$i++){
        if(!in_array($arr[$i], $newarr)){
            $newarr[$k]=$arr[$i];
            $k++;
        }
    }
    return $newarr;
}
?>
<!doctype html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cart</title>
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
                        <li><a href="index.php">Shop</a></li>                            
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

<div class="uni-cart">
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
                                <h1>your cart</h1>
                            </div>
                        </div>
                        

                        
                        <ul class="breadcrumbs">
                           <?php
                           if(isset($_SESSION['email'])){
                               echo '<li><a href="logout.php">Logout</a></li>';
                           }else{
                            echo '<li><a href="login.php">Login</a></li>';
                           }
                           ?>
                            
                            <li><a >Cart</a></li>
                        </ul>
                       
                    </div>
                </div>

                <main id="main" class="site-main">
                    <div class="uni-cart-body">
                        <div id="post" class="container">
                            <div class="entry-content">
                                <div class="woocommerce">
                                    <form class="woocommerce-cart-form" method="post">
                                        <table class="woocommerce-cart-form__contents table shop_table_responsive">
                                            <thead>
                                            <tr>
                                                <th class="product-remove"></th>
                                                <th class="product-name">Product</th>
                                                <th class="product-price">Price</th>
                                                <th class="product-quantity">Quantity</th>
                                                <th class="product-subtotal">Total</th>
                                            </tr>
                                            </thead>

                                            <tbody>

   <?php 
   $quantity=array();
   $i=0; 
   while($i<$num){
      
   $qty=1;
   if(isset($_POST['qty'.$i])){
    $qty=$_POST['qty'.$i];
   }
   echo' <tr class="woocommerce-cart-form__cart-item cart_item">
         <td class="product-remove">
         <a href="#" class="remove"><i  aria-hidden="true"></i></a>
        </td>
        <td class="product-name">
            <span class="product-thumbnail">
                <a href="#">
                    <img src="data:image/jpeg;base64,'.base64_encode($prodImage[$i]).'" alt="" class="attachment-shop_thumbnail size-shop_thumbnail wp-post-image img-responsive">
                </a>
            </span>
            <a href="#">'.$prodName[$i].'</a>
        </td>
        <td class="product-price">
            <span class="woocommerce-Price-amount amount">
                <span class="woocommerce-Price-currencySymbol">Rs</span>
                '.$price[$i].'
            </span>
        </td>
        <td class="product-quantity">
            <div class="quantity">
                <input type="number" name="qty'.$i.'" class="qty" min="1"  value="'.$qty.'">
            </div>
        </td>
        <td class="product-subtotal">
            <div class="woocommerce-Price-amount amount">
                <span class="woocommerce-Price-currencySymbol">Rs</span>
               '.$qty * $price[$i].'
            </div>
        </td>
    </tr>';
    $quantity[$i]=$qty;
    $productprice+=$qty * $price[$i];
    $i++;
}
$_SESSION['qty']=$quantity;
    ?>

                                     
                                            </tbody>

                                            <tfoot>
                                            <tr>
                                                <td class="actions" colspan="5">
                                                    
                                                    <input type="submit" class="button" name="update_cart" value="Update cart">
                                                </td>
                                            </tr>
                                            </tfoot>
                                        </table>
                                    </form>

                                    <div class="cart-collaterals">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="cart_totals">
                                                    <h2>Cart totals</h2>
                <table class="shop_table shop_table_responsive">
                    <tbody><tr class="cart-subtotal">
                        <th>Subtotal (For 1 quantity)</th>
                        <td><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">Rs</span><?php echo $realprice;?></span></td>
                    </tr>
                    <tr class="order-total">
                        <th>Total</th>
                        <td><strong><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">Rs</span><?php echo $productprice;?></span></strong> </td>
                    </tr>
                    </tbody>
                </table>

                                                    <div class="wc-proceed-to-checkout">
                                                        <a href="checkout.php" name="ckt" type="submit" class="checkout-button button alt wc-forward">Proceed to checkout</a>
                                                    </div>
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


</html>