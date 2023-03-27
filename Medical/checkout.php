<?php
session_start();
include 'config.php';
$num=0;
$totalprice=0;
if(isset($_SESSION['email']))
$email=$_SESSION['email'];
if(isset($_SESSION['qty'])){
$qty=$_SESSION["qty"];
    $num=count($qty);
}

if(isset($_SESSION['pids'])){
$pids=$_SESSION["pids"];
    $sql1="SELECT * FROM products WHERE ProductId IN ('$pids')";
$result1=mysqli_query($conn, $sql1);
$num=mysqli_num_rows($result1);
$i=0;
$realprice=0;
$totalprice=0;
while($row1 = mysqli_fetch_array($result1)){
    $prodName[$i]=$row1['ProductName'];
    $prodType[$i]=$row1['ProductType'];
    $brand[$i]=$row1['Brand'];
    $price[$i]=$row1['Price'];
    $prodImage[$i]=$row1['ProductImage'];
    $prodMail[$i]=$row1['Email'];
    $prodprice[$i]=$qty[$i]*$price[$i];
    $realprice+=$price[$i];
    $totalprice+=$prodprice[$i];
	$i++;
}
}
if(isset($_SESSION['pidarr']))
$pidarr = $_SESSION['pidarr'];
$pids=null;
$i=0;
while($i<$num){
    
    $oid[$i]=getToken(7);
  
    $i++;
}

if(isset($_SESSION['email'])){
       $sql = "Select * from users where Email='$email'";
    $row1=mysqli_query($conn, $sql);
    
    //$num=mysqli_num_rows($query);
    if ($rows = mysqli_fetch_array($row1)) {
    	$contact=$rows['Contact'];	
    	$name=$rows['Name'];
        $country=$rows['Country'];
        $state=$rows['State'];
        $dist=$rows['District'];
        $pincode=$rows['Pincode'];
        $address=$rows['Address']; 
    		
    }  
}else{
    	$contact=null;	
    	$name=null;
        $country=null;
        $state=null;
        $dist=null;
        $pincode=null;
        $email=null;
        $address=null;
}



function getToken($length){
    $token = "";
    $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $codeAlphabet.= "abcdefghijklmnopqrstuvwxyz";
    $codeAlphabet.= "0123456789";
    $max = strlen($codeAlphabet);

    for ($i=0; $i < $length; $i++) {
        $token .= $codeAlphabet[random_int(0, $max-1)];
    }

    return $token;
}
if(isset($_POST['placeorder']))
{
    $contact=$_POST['billing_phone'];	
    $name=$_POST['billing_first_name'];
    $country=$_POST['billing_country'];
    $state=$_POST['billing_state'];
    $dist=$_POST['billing_town_city'];
    $pincode=$_POST['billing_postcode'];
    $email=$_POST['billing_email'];
    $address=$_POST['billing_address'];

    $i=0;
    while($i<$num){  
        $sql2 = "INSERT INTO orders (OrderId,ProductId,CustomerName,Quantity,vendormail,customermail,Address,Contact,District,State, Country,Pincode) 
        VALUES ('$oid[$i]' , '$pidarr[$i]' ,'$name', '$qty[$i]' , '$prodMail[$i]' ,'$email','$address','$contact','$dist','$state','$country','$pincode') ";

        

	if (mysqli_query($conn, $sql2)) 
	{
        unset($_SESSION['pidarr']);
        unset($_SESSION['pids']);
        unset($_SESSION['qty']);
        unset($_SESSION['array']);
	
		header( "Refresh:3; url=index.php");

	} 
	else
	{
    echo "Error: " . $sql2 . "<br>" . mysqli_error($conn);
	}   
        $i++;
    }     
}
?>
<!doctype html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>06_04_checkout</title>
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

<div class="uni-checkout">
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
                                <h1>check out</h1>
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
                            
                            <li><a >Checkout</a></li>
                        </ul>
                        <!-- End breadcrumbs -->
                    </div>
                </div>

                <main id="main" class="clearfix right_sidebar">
                    <div class="uni-checkout-body">
                        <div class="container">
                            <div class="tg-container">
                                <div id="primary">

                                    <div class="entry-thumbnail">

                                        <div class="entry-content-text-wrapper clearfix">
                                            <div class="entry-content-wrapper">
                                                <div class="entry-content">
                                                    <div class="woocommerce">
    <?php 
    
    if(!isset($_SESSION['email'])){
        echo ' <div class="woocommerce-info">
    <i class="fa fa-info-circle" aria-hidden="true"></i> Need to track ur Order? 
    <a href="login.php" >Click here to login </a>
    </div>
   
    ';}
?>


                                                    
<a>Orders will be delivered to the below information. Please update it if any changes..</a>
            <div class="row">
                <div class="vk-checkout-billing-left">
              
                    <div class="col-md-6">
                        <div class="woocommerce-billing-fields">
                        <form method="POST">
                            <h3>Billing details</h3>
                            <div class="woocommerce-billing-fields__field-wrapper">
                                <div class="row">
                                    <div class="col-md-12">
                                        <p class="form-row form-row-first validate-required woocommerce-invalid woocommerce-invalid-required-field" id="billing_first_name_field" data-priority="10">
                                            <label for="billing_first_name" class="">Name <abbr class="required" title="required">*</abbr></label>
                                            <input type="text" class="input-text " name="billing_first_name" id="billing_first_name"  value="<?php echo $name;?>" autocomplete="given-name">
                                        </p>
                                    </div>
                                   
                                    <div class="col-md-6">
                                        <p class="form-row form-row-last validate-required" id="billing_phone_field" data-priority="20">
                                            <label for="billing_phone" class="">Phone <abbr class="required" title="required">*</abbr></label>
                                            <input type="tel" class="input-text " name="billing_phone" id="billing_phone" placeholder="" value="<?php echo $contact;?>">
                                        </p>
                                    </div>
                                    <div class="col-md-6">
                                        <p class="form-row form-row-last validate-required" id="billing_email_field" data-priority="20">
                                            <label for="billing_phone" class="">Email <abbr class="required" title="required">*</abbr></label>
                                            <input type="email" class="input-text " name="billing_email" id="billing_email" placeholder="" value="<?php echo $email;?>">
                                        </p>
                                    </div>
                                </div>
       
                              
                                <p class="form-row form-row-last validate-required" id="billing_address_field" data-priority="20">
                                    <label for="billing_address" class="">Address<abbr class="required" title="required">*</abbr></label>
                                    <input type="text" class="input-text " name="billing_address" id="billing_address" placeholder="" value="<?php echo $address;?>">
                                </p>

                                <p class="form-row form-row-last validate-required" id="billing_town_city_field" data-priority="20">
                                    <label for="billing_town_city" class="">District<abbr class="required" title="required">*</abbr></label>
                                    <input type="text" class="input-text " name="billing_town_city" id="billing_town_city" placeholder="" value="<?php echo $dist;?>">
                                </p>
                                <p class="form-row form-row-last validate-required" id="billing_town_city_field" data-priority="20">
                                    <label for="billing_town_city" class="">State<abbr class="required" title="required">*</abbr></label>
                                    <input type="text" class="input-text " name="billing_state" id="billing_state" placeholder="" value="<?php echo $state;?>">
                                </p>
                                <p class="form-row form-row-last validate-required" id="billing_town_city_field" data-priority="20">
                                    <label for="billing_town_city" class="">Country<abbr class="required" title="required">*</abbr></label>
                                    <input type="text" class="input-text " name="billing_country" id="billing_country" placeholder="" value="<?php echo $country;?>">
                                </p>
                                <p class="form-row form-row-last validate-required" id="billing_postcode_field" data-priority="20">
                                    <label for="billing_postcode" class="">Pincode</label>
                                    <input type="text" class="input-text " name="billing_postcode" id="billing_postcode" placeholder="" value="<?php echo $pincode;?>" >
                                </p>
                                
                            </div>
                        </div>

                    </div>

                    <div class="col-md-6">
                        <div class="vk-checkout-order-paypal">
                            <div id="order_review" class="woocommerce-checkout-review-order">
                                <div class="vk-checkout-order-left">
                                    <h3>Your order</h3>
                                    <table class="shop_table woocommerce-checkout-review-order-table">
                                        <thead>
                                        <tr>
                                            <th class="product-name">Product</th>
                                            <th class="product-name">Quantity</th>
                                            <th class="product-total">Price</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                    <?php
                    $i=0;
                    while($i<$num){
                        echo '<tr class="cart_item">
                        <td class="product-name">
                           '.$prodName[$i].'
                        </td>
                        <td class="product-name">
                        '.$qty[$i].'
                     </td>
                        <td class="product-total">
                            <span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">Rs.  </span>'.$prodprice[$i].'</span>						</td>
                    </tr>';
                    $i++;
                    }
                    ?>
                                        
                                      
                                        </tbody>
                                        <tfoot>

                                        
                                        <tr class="order-total">
                                            <th>Total</th>
                                            <th>&nbsp;</th>
                                            <th><strong><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">Rs.  </span><?php echo $totalprice;?></span></strong> </th>
                                        </tr>

                                        </tfoot>
                                    </table>
                                </div>

                            <div id="payment" class="woocommerce-checkout-payment">
                                
                                <div class="form-row place-order">
                                    <noscript>
                                        Since your browser does not support JavaScript, or it is disabled, please ensure you click the &lt;em&gt;Update Totals&lt;/em&gt; button before placing your order. You may be charged more than the amount stated above if you fail to do so.			&lt;br/&gt;&lt;input type="submit" class="button alt" name="woocommerce_checkout_update_totals" value="Update totals" /&gt;
                                    </noscript>

                                    <input type="submit" class="button alt" name="placeorder" id="place_order" value="PLACE ORDER" data-value="Place order">
</form>
                                    <input type="hidden" id="wpnonce" name="_wpnonce" value="341d89a24a"><input type="hidden" name="_wp_http_referer" value="/structure-contruction/checkout/?wc-ajax=update_order_review">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div><!-- .entry-content -->
</div>
</div>
</div>


                                </div> <!-- Primary end -->
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