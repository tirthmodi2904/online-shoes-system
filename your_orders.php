<!DOCTYPE html>
<html lang="en">
<?php
include("connection/connect.php");
// error_reporting(0);
session_start();

if(empty($_SESSION['user_id']))  
{
	header('location:login.php');
}
else
{
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
    <style type="text/css" rel="stylesheet">
    .indent-small {
        margin-left: 5px;
    }

    .form-group.internal {
        margin-bottom: 0;
    }

    .dialog-panel {
        margin: 10px;
    }

    .datepicker-dropdown {
        z-index: 200 !important;
    }

    .panel-body {
        background: #e5e5e5;
        /* Old browsers */
        background: -moz-radial-gradient(center, ellipse cover, #e5e5e5 0%, #ffffff 100%);
        /* FF3.6+ */
        background: -webkit-gradient(radial, center center, 0px, center center, 100%, color-stop(0%, #e5e5e5), color-stop(100%, #ffffff));
        /* Chrome,Safari4+ */
        background: -webkit-radial-gradient(center, ellipse cover, #e5e5e5 0%, #ffffff 100%);
        /* Chrome10+,Safari5.1+ */
        background: -o-radial-gradient(center, ellipse cover, #e5e5e5 0%, #ffffff 100%);
        /* Opera 12+ */
        background: -ms-radial-gradient(center, ellipse cover, #e5e5e5 0%, #ffffff 100%);
        /* IE10+ */
        background: radial-gradient(ellipse at center, #e5e5e5 0%, #ffffff 100%);
        /* W3C */
        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#e5e5e5', endColorstr='#ffffff', GradientType=1);
        font: 600 15px "Open Sans", Arial, sans-serif;
    }

    label.control-label {
        font-weight: 600;
        color: #777;
    }


    table {
        width: 750px;
        border-collapse: collapse;
        margin: auto;

    }

    /* Zebra striping */
    tr:nth-of-type(odd) {
        background: #eee;
    }

    th {
        background: #404040;
        color: white;
        font-weight: bold;

    }

    td,
    th {
        padding: 10px;
        border: 1px solid #ccc;
        text-align: left;
        font-size: 14px;

    }

    @media only screen and (max-width: 760px),
    (min-device-width: 768px) and (max-device-width: 1024px) {

        table {
            width: 100%;
        }


        table,
        thead,
        tbody,
        th,
        td,
        tr {
            display: block;
        }


        thead tr {
            position: absolute;
            top: -9999px;
            left: -9999px;
        }

        tr {
            border: 1px solid #ccc;
        }

        td {

            border: none;
            border-bottom: 1px solid #eee;
            position: relative;
            padding-left: 50%;
        }

        td:before {

            position: absolute;

            top: 6px;
            left: 6px;
            width: 45%;
            padding-right: 10px;
            white-space: nowrap;

            content: attr(data-column);

            color: #000;
            font-weight: bold;
        }
    }
    </style>

</head>

<body>


    <header id="header" class="header-scroll top-header headrom">
        <nav class="navbar navbar-dark">
            <div class="container">
                <button class="navbar-toggler hidden-lg-up" type="button" data-toggle="collapse"
                    data-target="#mainNavbarCollapse">&#9776;</button>
                <a class="navbar-brand" href="index.php"> <img class="img-rounded" src="images/logo.png"
                        style="width: 150px" alt="kush">
                </a>
                <div class="collapse navbar-toggleable-md  float-lg-right" id="mainNavbarCollapse">
                    <ul class="nav navbar-nav">
                        <li class="nav-item"> <a class="nav-link active" href="index.php">Home <span
                                    class="sr-only">(current)</span></a> </li>
                        <li class="nav-item"> <a class="nav-link active" href="category.php">Category <span
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
        <div class="inner-page-hero bg-image" data-image-src="images/img/pimg.jpg">
            <div class="container"> </div>
        </div>
        <div class="result-show">
            <div class="container">
                <div class="row">
                </div>
            </div>
        </div>
        <section class="category-page">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                    </div>
                    <div class="col-xs-14">
                        <div class="bg-gray">
                            <div class="row">
                                <table class="table table-bordered table-hover">
    <thead style="background: #404040; color:white;">
        <tr>
            <th>No</th> <!-- Add this line for the serial number -->
            <th>Item</th>
            <th>Quantity</th>
            <th>Shoe Size</th>
            <th>Price</th>
            <th>Payment Method</th>
            <th>Status</th>
            <th>Order Date</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php 
            $query_res = mysqli_query($db, "select * from users_orders where u_id='".$_SESSION['user_id']."'");
            if(!mysqli_num_rows($query_res) > 0) {
                echo '<tr><td colspan="8"><center>You have No orders Placed yet. </center></td></tr>';
            } else {
                $serial_number = 1; // Initialize serial number counter
                while($row = mysqli_fetch_array($query_res)) {
        ?>
        <tr>
            <td data-column="Serial Number"><?php echo $serial_number; ?></td> <!-- Display the serial number -->
            <td data-column="Item"><?php echo $row['title']; ?></td>
            <td data-column="Quantity"><?php echo $row['quantity']; ?></td>
            <td data-column="Size"><?php echo $row['shoe_size']; ?></td>
            <td data-column="price">₹ <?php echo $row['price']*$row['quantity']; ?></td>
            <td><?php echo $row['payment_method']; ?></td>
            <td data-column="status">
                <?php 
                    $status = $row['status'];
                    if($status == "" or $status == "NULL") {
                ?>
                <button type="button" class="btn btn-primary"><span class="fa fa-bars"
                        aria-hidden="true"></span> Dispatch</button>
                <?php 
                    } elseif($status == "in process") { ?>
                <button type="button" class="btn btn-warning"><span class="fa fa-cog fa-spin"
                        aria-hidden="true"></span> On The Way!</button>
                <?php } elseif($status == "closed") { ?>
                <button type="button" class="btn btn-success"><span class="fa fa-check-circle"
                        aria-hidden="true"></span> Delivered</button>
                <?php } elseif($status == "rejected") { ?>
                <button type="button" class="btn btn-danger"> <i class="fa fa-close"></i> Cancelled</button>
                <?php } ?>
            </td>
            <td data-column="Date"><?php echo $row['date']; ?></td>
            <td data-column="Action" style="text-align: center;">
                <a href="delete_orders.php?order_del=<?php echo $row['o_id'];?>"
                    onclick="return confirm('Are you sure you want to cancel your order?');"
                    class="btn btn-danger btn-flat btn-addon btn-xs m-b-10"><i class="fa fa-trash-o"
                        style="font-size:16px"></i></a>
                <a href="invoice_email.php?order_id=<?php echo $row['o_id'];?>"
                    class="btn btn-success btn-flat btn-addon btn-xs m-b-10"><i class="fa fa-envelope"
                        style="font-size:16px"></i></a>
            </td>
        </tr>
        <?php 
                $serial_number++; // Increment serial number for next row
            }
        }
        ?>
    </tbody>
</table>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    </section>

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
<?php
}
?>