<!DOCTYPE html>
<html lang="en">
<?php
include("connection/connect.php"); 
error_reporting(0);
session_start();
include_once 'product-action.php'; 
?>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="images/icon.png">
    <title>UrbanKicks</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/animsition.min.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <header id="header" class="header-scroll top-header headrom">
        <nav class="navbar navbar-dark">
            <div class="container">
                <button class="navbar-toggler hidden-lg-up" type="button" data-toggle="collapse"
                    data-target="#mainNavbarCollapse">&#9776;</button>
                <a class="navbar-brand" href="index.php"> <img class="img-rounded" src="images/logo.png"
                        style="width: 150px" alt=""> </a>
                <div class="collapse navbar-toggleable-md  float-lg-right" id="mainNavbarCollapse">
                    <ul class="nav navbar-nav">
                        <li class="nav-item"> <a class="nav-link active" href="index.php">Home <span
                                    class="sr-only">(current)</span></a> </li>
                        <li class="nav-item"> <a class="nav-link active" href="category.php">Category<span
                                    class="sr-only"></span></a> </li>
                        <?php
if(empty($_SESSION["user_id"])) // if user is not logged in
{
    echo '<li class="nav-item"><a href="login.php" class="nav-link active">Login</a> </li>';
    echo '<li class="nav-item"><a href="registration.php" class="nav-link active">Register</a> </li>';
}
else
{
    echo '<li class="nav-item"><a href="your_orders.php" class="nav-link active">My Orders</a> </li>';
    echo '<li class="nav-item"><a href="logout.php" class="nav-link active">Logout</a> </li>';
     // Fetch the username from the database based on the user's ID
    $user_id = $_SESSION["user_id"];
    $query = "SELECT username FROM users WHERE u_id = $user_id";
    $result = mysqli_query($db, $query);
    if($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $username = $row['username'];
        echo '<li class="nav-item fw-bold text-primary"><a href="#" class="nav-link active">Welcome '.$username.'</a> </li>';
   
    } else {
        // Handle the case where the user is logged in but their information cannot be fetched
        }
}
?>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <div class="page-wrapper">
        <div class="top-links">
            <div class="container">
                <ul class="row links">
                    <li class="col-xs-12 col-sm-4 link-item"><span>1</span><a href="category.php">Choose Category</a>
                    </li>
                    <li class="col-xs-12 col-sm-4 link-item active"><span>2</span><a
                            href="products.php?res_id=<?php echo $_GET['res_id']; ?>">Pick Your favorite Shoes</a></li>
                    <li class="col-xs-12 col-sm-4 link-item"><span>3</span><a href="#">Order and Pay</a></li>
                </ul>
            </div>
        </div>
        <?php $ress= mysqli_query($db,"select * from category where rs_id='$_GET[res_id]'");
									     $rows=mysqli_fetch_array($ress);										  ?>
        <section class="inner-page-hero bg-image" data-image-src="images/img/restrrr.jpg">
            <div class="profile">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12  col-md-4 col-lg-4 profile-img">
                            <div class="image-wrap">
                                <figure>
                                    <?php echo '<img src="admin/Res_img/'.$rows['image'].'" alt="product logo">'; ?>
                                </figure>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 profile-desc">
                            <div class="pull-left right-text white-txt">
                                <h6><a href="#"><?php echo $rows['title']; ?></a></h6>
                                <p><?php echo $rows['address']; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <div class="breadcrumb">
            <div class="container"></div>
        </div>
        <div class="container m-t-30">
            <div class="row">
                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-3">
                    <div class="widget widget-cart">
                        <div class="widget-heading">
                            <h3 class="widget-title text-dark">Your Cart</h3>
                            <div class="clearfix"></div>
                        </div>
                        <div class="order-row bg-white">
                            <div class="widget-body">
                                <?php
                $item_total = 0;
                foreach ($_SESSION["cart_item"] as $item)  
                {
                ?>
                                <div class="title-row">
                                    <?php echo $item["title"]; ?> <a
                                        href="products.php?res_id=<?php echo $_GET['res_id']; ?>&action=remove&id=<?php echo $item["p_id"]; ?>">
                                        <i class="fa fa-trash pull-right"></i></a>
                                </div>
                                <div>
                                    Size : <?php echo $item["size"]; ?> <div class="form-group row no-gutter">
                                    </div>
                                    <div class="col-xs-8">
                                        <input type="text" class="form-control b-r-0"
                                            value=<?php echo "₹".$item["price"]; ?> readonly id="exampleSelect1">
                                    </div>
                                    <div class="col-xs-4">
                                        <input class="form-control" type="text" readonly
                                            value='<?php echo $item["quantity"]; ?>' id="example-number-input">
                                    </div>
                                </div>
                                <?php
                $item_total += ($item["price"]*$item["quantity"]); 
                }
                ?>
                            </div>
                        </div>
                        <div class="widget-body">
                            <div class="price-wrap text-xs-center">
                                <p>TOTAL</p>
                                <h3 class="value"><strong><?php echo "₹".$item_total; ?></strong></h3>
                                <p>Free Delivery!</p>
                                <?php
                        if($item_total==0){
                        ?>
                                <a href="checkout.php?res_id=<?php echo $_GET['res_id'];?>&action=check"
                                    class="btn btn-danger btn-lg disabled">Checkout</a>
                                <?php
                        }
                        else{   
                        ?>
                                <a href="checkout.php?res_id=<?php echo $_GET['res_id'];?>&action=check"
                                    class="btn btn-success btn-lg active">Checkout</a>
                                <?php   
                        }
                        ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="menu-widget" id="2">
                        <div class="widget-heading">
                            <h3 class="widget-title text-dark">
                                Products
                            </h3>
                            <div class="clearfix"></div>
                        </div>
                        <div class="collapse in" id="popular2">
                            <?php  
									$stmt = $db->prepare("select * from Product where rs_id='$_GET[res_id]'");
									$stmt->execute();
									$products = $stmt->get_result();
									if (!empty($products)) 
									{
									foreach($products as $product)
										{	 
													 ?>
                            <div class="food-item">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-lg-8">
                                        <form method="post"
                                            action='products.php?res_id=<?php echo $_GET['res_id'];?>&action=add&id=<?php echo $product['p_id']; ?>'>
                                            <div class="rest-logo pull-left">
                                                <a class="restaurant-logo pull-left" href="#">
                                                    <?php echo '<img src="admin/Res_img/dishes/'.$product['img'].'" alt="Food logo">'; ?>
                                                </a>
                                            </div>
                                            <div class="rest-descr">
                                                <h6><a href="#"><?php echo $product['title']; ?></a></h6>
                                                <p><?php echo $product['slogan']; ?></p>
                                                <label for="size">Select Size:</label>
                                                <select name="size" id="size">
                                                    <?php
                                                // Query to fetch shoe sizes from the database
                                                $shoeSizesQuery = "SELECT * FROM shoe_size";
                                                $shoeSizesResult = mysqli_query($db, $shoeSizesQuery);
                                                if ($shoeSizesResult && mysqli_num_rows($shoeSizesResult) > 0) {
                                                    while ($row = mysqli_fetch_assoc($shoeSizesResult)) {
                                                        echo '<option value="' . $row['size'] . '">' . $row['size'] . '</option>';
                                                    }
                                                }
                                                ?>
                                                </select>

                                            </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-lg-3 pull-right item-cart-info">
                                        <span class="price pull-left">₹<?php echo $product['price']; ?></span>
                                        <input class="b-r-0" type="text" name="quantity" style="margin-left:30px;"
                                            value="1" size="2" />
                                        <input type="submit" class="btn  btn-primary" style="margin-left:40px;"
                                            value="Add To Cart" />
                                    </div>
                                    </form>
                                </div>
                            </div>
                            <?php
									  }
									}
									
								?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<footer class="footer">
        <div class="container">
            <div class="bottom-footer">
                <div class="row">
                    <div class="col-xs-12 col-sm-3 payment-options color-gray">
                        <h5>Payment Options</h5>
                        <ul>
                            <li>
                                <a href="#"> <img src="images/razorpay.jpg" alt="Paypal"> </a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-xs-12 col-sm-4 address color-gray">
                        <h5>Address</h5>
                        <p>S. V. Institurte of Computer Studies, Gandhinagar, Gujarat</p>
                        <h5>Phone : +91 851 1060 234</h5>
                    </div>
                    <div class="col-xs-12 col-sm-5 additional-info color-gray">
                        <h5>Addition informations</h5>
                        <p>Join thousands of other shoe enthusiasts who benefit from partnering with us for your
                            footwear needs.</p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <script src="js/jquery.min.js"></script>
    <script src="js/tether.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/animsition.min.js"></script>
    <script src="js/bootstrap-slider.min.js"></script>
    <script src="js/jquery.isotope.min.js"></script>
    <script src="js/headroom.js"></script>
    <script src="js/foodpicky.min.js"></script>
</body>

</html>