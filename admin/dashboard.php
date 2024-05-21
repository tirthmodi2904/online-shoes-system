<!DOCTYPE html>
<html lang="en">
<?php
include("../connection/connect.php");
error_reporting(0);
session_start();
if(empty($_SESSION["adm_id"]))
{
	header('location:index.php');
}
else
{
?>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../images/icon.png">
    <title>UrbanKicks</title>
    <link href="css/lib/bootstrap/bootstrap.min.css" rel="stylesheet">
    <link href="css/helper.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body class="fix-header">
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" />
        </svg>
    </div>
    <div id="main-wrapper">
        <div class="header">
            <nav class="navbar top-navbar navbar-expand-md navbar-light">
                <div class="navbar-header">
                    <a class="navbar-brand" href="dashboard.php">
                        <span><img style="width: 150px" src="../images/logo2.png" /></span>
                    </a>
                </div>
                <div class=" navbar-collapse">
                    <ul class="navbar-nav mr-auto mt-md-0">
                    </ul>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-muted  " href="#" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false"><img src="images/bookingSystem/user-icn.png"
                                alt="user" class="profile-pic" /></a>
                        <div class="dropdown-menu dropdown-menu-right animated zoomIn">
                            <ul class="dropdown-user">
                                <li><a href="logout.php"><i class="fa fa-power-off"></i> Logout</a></li>
                            </ul>
                        </div>
                    </li>
                    </ul>
                </div>
            </nav>
        </div>

        <div class="left-sidebar">
            <div class="scroll-sidebar">
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li class="nav-devider"></li>
                        <li class="nav-label">Home</li>
                        <li> <a href="dashboard.php"><i class="fa fa-tachometer"></i><span>Dashboard</span></a></li>
                        <li class="nav-label">Log</li>
                        <li> <a href="all_users.php"> <span><i
                                        class="fa fa-user f-s-20 "></i></span><span>Users</span></a></li>
                        <li> <a href="all_category.php"><i class="fa fa-archive"
                                    aria-hidden="true"></i><span>Category</span></a></li>
                        <li> <a class="has-arrow  " href="#" aria-expanded="false"><i class="fa fa-filter"
                                    aria-hidden="true"></i><span class="hide-menu">Product</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="all_product.php">All Products</a></li>
                                <li><a href="add_product.php">Add Product</a></li>
                            </ul>
                        </li>
                        <li> <a href="all_orders.php"><i class="fa fa-shopping-cart"
                                    aria-hidden="true"></i><span>Orders</span></a></li>
                    </ul>
                </nav>
            </div>
        </div>

        <div class="page-wrapper">
            <div class="container-fluid">
                <div class="col-lg-12">
                    <div class="card card-outline-info">
                        <div class="card-header">
                            <h4 class="m-b-0 text-white text-center">Admin Dashboard</h4>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card p-15">
                                    <div class="media">
                                        <div class="media-left meida media-middle">
                                            <span><i class="fa fa-archive f-s-40 "></i></span>
                                        </div>
                                        <div class="media-body media-text-right">
                                            <h2>
                                                <?php
                                                    $sql = "SELECT * FROM category";
                                                    $result = mysqli_query($db, $sql);
                                                    $rws = mysqli_num_rows($result);
                                                    echo $rws;
                                                ?>
                                            </h2>
                                            <p class="m-b-0">Categories</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="card p-15">
                                    <div class="media">
                                        <div class="media-left meida media-middle">
                                            <span><i class="fa fa-filter f-s-40" aria-hidden="true"></i></span>
                                        </div>
                                        <div class="media-body media-text-right">
                                            <h2>
                                                <?php
                                                    $sql = "SELECT * FROM Product";
                                                    $result = mysqli_query($db, $sql);
                                                    $rws = mysqli_num_rows($result);
                                                    echo $rws;
                                                ?>
                                            </h2>
                                            <p class="m-b-0">Product</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="card p-15">
                                    <div class="media">
                                        <div class="media-left meida media-middle">
                                            <span><i class="fa fa-users f-s-40"></i></span>
                                        </div>
                                        <div class="media-body media-text-right">
                                            <h2>
                                                <?php
                                                    $sql = "SELECT * FROM users";
                                                    $result = mysqli_query($db, $sql);
                                                    $rws = mysqli_num_rows($result);
                                                    echo $rws;
                                                ?>
                                            </h2>
                                            <p class="m-b-0">Users</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="card p-15">
                                    <div class="media">
                                        <div class="media-left meida media-middle">
                                            <span><i class="fa fa-shopping-cart f-s-40" aria-hidden="true"></i></span>
                                        </div>
                                        <div class="media-body media-text-right">
                                            <h2>
                                                <?php
                                                    $sql = "SELECT * FROM users_orders";
                                                    $result = mysqli_query($db, $sql);
                                                    $rws = mysqli_num_rows($result);
                                                    echo $rws;
                                                ?>
                                            </h2>
                                            <p class="m-b-0">Total Orders</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="card p-15">
                                    <div class="media">
                                        <div class="media-left meida media-middle">
                                            <span><i class="fa fa-spinner f-s-40" aria-hidden="true"></i></span>
                                        </div>
                                        <div class="media-body media-text-right">
                                            <h2>
                                                <?php
                                                    $sql = "SELECT * FROM users_orders WHERE status = 'in process'";
                                                    $result = mysqli_query($db, $sql);
                                                    $rws = mysqli_num_rows($result);
                                                    echo $rws;
                                                ?>
                                            </h2>
                                            <p class="m-b-0">Processing Orders</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="card p-15">
                                    <div class="media">
                                        <div class="media-left meida media-middle">
                                            <span><i class="fa fa-check f-s-40" aria-hidden="true"></i></span>
                                        </div>
                                        <div class="media-body media-text-right">
                                            <h2>
                                                <?php
                                                    $sql = "SELECT * FROM users_orders WHERE status = 'closed'";
                                                    $result = mysqli_query($db, $sql);
                                                    $rws = mysqli_num_rows($result);
                                                    echo $rws;
                                                ?>
                                            </h2>
                                            <p class="m-b-0">Delivered Orders</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="card p-15">
                                    <div class="media">
                                        <div class="media-left meida media-middle">
                                            <span><i class="fa fa-times f-s-40" aria-hidden="true"></i></span>
                                        </div>
                                        <div class="media-body media-text-right">
                                            <h2>
                                                <?php
                                                    $sql = "SELECT * FROM users_orders WHERE status = 'rejected'";
                                                    $result = mysqli_query($db, $sql);
                                                    $rws = mysqli_num_rows($result);
                                                    echo $rws;
                                                ?>
                                            </h2>
                                            <p class="m-b-0">Cancelled Orders</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="card p-15">
                                    <div class="media">
                                        <div class="media-left meida media-middle">
                                            <span><i class="fa fa-inr f-s-40" aria-hidden="true"></i></span>
                                        </div>
                                        <div class="media-body media-text-right">
                                            <h2>
                                                <?php
                                                    $result = mysqli_query($db, 'SELECT SUM(price) AS value_sum FROM users_orders WHERE status = "closed"');
                                                    $row = mysqli_fetch_assoc($result);
                                                    $sum = $row['value_sum'];
                                                    echo $sum;
                                                ?>
                                            </h2>
                                            <p class="m-b-0">Total Earnings</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="card p-15">
                                    <div class="media">
                                        <div class="media-left meida media-middle">
                                            <span><i class="fa fa-credit-card f-s-40" aria-hidden="true"></i></span>
                                        </div>
                                        <div class="media-body media-text-right">
                                            <h2>
                                                <?php
                                                    $sql = "SELECT * FROM users_orders WHERE payment_method = 'Online(RazorPay)'";
                                                    $result = mysqli_query($db, $sql);
                                                    $rws = mysqli_num_rows($result);
                                                    echo $rws;
                                                ?>
                                            </h2>
                                            <p class="m-b-0">RazorPay Payment Orders</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="card p-15">
                                    <div class="media">
                                        <div class="media-left meida media-middle">
                                            <span><i class="fa fa-money f-s-40" aria-hidden="true"></i></span>
                                        </div>
                                        <div class="media-body media-text-right">
                                            <h2>
                                                <?php
                                                    $sql = "SELECT * FROM users_orders WHERE payment_method = 'COD'";
                                                    $result = mysqli_query($db, $sql);
                                                    $rws = mysqli_num_rows($result);
                                                    echo $rws;
                                                ?>
                                            </h2>
                                            <p class="m-b-0">Cash On Delivery Orders</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <footer class="footer"> © 2024 - UrbanKicks </footer>
        </div>
        <script src="js/lib/jquery/jquery.min.js"></script>
        <script src="js/lib/bootstrap/js/popper.min.js"></script>
        <script src="js/lib/bootstrap/js/bootstrap.min.js"></script>
        <script src="js/jquery.slimscroll.js"></script>
        <script src="js/sidebarmenu.js"></script>
        <script src="js/lib/sticky-kit-master/dist/sticky-kit.min.js"></script>
        <script src="js/custom.min.js"></script>

</body>

</html>
<?php
}
?>
