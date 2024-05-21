<!DOCTYPE html>
<html lang="en">
<?php
include("../connection/connect.php");
error_reporting(0);
session_start();
?>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="../images/icon.png">
    <title>UrbanKicks</title>
    <link href="css/lib/bootstrap/bootstrap.min.css" rel="stylesheet">
    <link href="css/helper.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
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
                <div class="row">
                    <div class="col-12">
                        <div class="col-lg-12">
                            <div class="card card-outline-info">
                                <div class="card-header">
                                    <h4 class="m-b-0 text-white text-center">All Product </h4>
                                </div>
                                <div class="table-responsive m-t-40">
                                    <table id="example23"
    class="display nowrap table table-hover table-striped table-bordered"
    cellspacing="0" width="100%">
    <thead class="thead-dark">
        <tr>
            <th>No</th>
            <th>Product Name</th>
            <th>Category</th>
            <th>Description</th>
            <th>Price</th>
            <th>Image</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $serial_number = 1; // Initialize serial number counter
        $sql = "SELECT * FROM Product order by p_id ";
        $query = mysqli_query($db, $sql);
        if (!mysqli_num_rows($query) > 0) {
            echo '<td colspan="11"><center>No Menu</center></td>';
        } else {
            while ($rows = mysqli_fetch_array($query)) {
                $mql = "select * from category where rs_id='" . $rows['rs_id'] . "'";
                $newquery = mysqli_query($db, $mql);
                $fetch = mysqli_fetch_array($newquery);
                echo '<tr><td>' . $serial_number . '</td>
                        <td>' . $fetch['title'] . '</td>
                        <td>' . $rows['title'] . '</td>
                        <td>' . $rows['slogan'] . '</td>
                        <td>₹ ' . $rows['price'] . '</td>
                        <td>
                            <div class="col-md-3 col-lg-8 m-b-10">
                            <center><img src="Res_img/dishes/' . $rows['img'] . '" class="img-responsive  radius" style="height:100px;width:100px;" /></center>
                            <div>
                        </td>								
                        <td>
                            <a href="delete_product.php?menu_del=' . $rows['p_id'] . '" class="btn btn-danger btn-flat btn-addon btn-xs m-b-10"><i class="fa fa-trash-o" style="font-size:16px"></i></a> 
                            <a href="update_product.php?menu_upd=' . $rows['p_id'] . '" class="btn btn-info btn-flat btn-addon btn-sm m-b-10 m-l-5"><i class="fa fa-edit"></i></a>
                        </td></tr>';
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
        </div>
    </div>
    </div>
    <footer class="footer"> © 2024 - UrbanKicks </footer>
    </div>
    </div>

    <script src="js/lib/jquery/jquery.min.js"></script>
    <script src="js/lib/bootstrap/js/popper.min.js"></script>
    <script src="js/lib/bootstrap/js/bootstrap.min.js"></script>
    <script src="js/jquery.slimscroll.js"></script>
    <script src="js/sidebarmenu.js"></script>
    <script src="js/lib/sticky-kit-master/dist/sticky-kit.min.js"></script>
    <script src="js/custom.min.js"></script>
    <script src="js/lib/datatables/datatables.min.js"></script>
    <script src="js/lib/datatables/cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
    <script src="js/lib/datatables/cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
    <script src="js/lib/datatables/cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
    <script src="js/lib/datatables/cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
    <script src="js/lib/datatables/cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
    <script src="js/lib/datatables/cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
    <script src="js/lib/datatables/datatables-init.js"></script>
</body>

</html>