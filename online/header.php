<?php include 'admin/config.php'; 
if(!isset($_SESSION['uid']) || $_SESSION['uid'] == NULL){
}else{
    $uid = $_SESSION['uid'];
    $fetch_orders = "SELECT *, o.id as orderid FROM products p inner join orders o on o.product_id = p.id WHERE user_id = '$uid' and o.status is NULL";
    $orders = $conn->query($fetch_orders);

    $total_amount_query = "SELECT sum(p.product_price) as total, count(o.id) as totalorder FROM products p inner join orders o on o.product_id = p.id WHERE user_id = '$uid' and o.status is NULL";
    $total_amount = $conn->query($total_amount_query);
    $total = 50;
    while($row = $total_amount->fetch_assoc()){
        $total = $row['total'];
        $totalorder = $row['totalorder'];
    }
}
?>
<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Fashi Template">
    <meta name="keywords" content="Fashi, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>The Buddies</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Muli:300,400,500,600,700,800,900&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="css/themify-icons.css" type="text/css">
    <link rel="stylesheet" href="css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="css/style.css" type="text/css">
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Header Section Begin -->
    <header class="header-section">
        <div class="header-top">
            <div class="container">
                <div class="ht-left">
                    <div class="mail-service">
                        <i class=" fa fa-envelope"></i>
                        <?php
                        if(isset($_SESSION['user_email']) && $_SESSION['user_email'] != NULL){
                            echo $_SESSION['user_email'];
                        }else{
                            echo 'xxx@xmail.com';
                        }
                        ?>
                    </div>
                    <div class="phone-service">
                        <i class=" fa fa-phone"></i>
                        <?php
                        if(isset($_SESSION['contactno']) && $_SESSION['contactno'] != NULL){
                            echo $_SESSION['contactno'];
                        }else{
                            echo '+91 xxxxxxxxxx';
                        }
                        ?>
                    </div>
                </div>
                <div class="ht-right">
                <?php
                if(isset($_SESSION['contactno']) && $_SESSION['contactno'] != NULL){
                    ?>
                    <img src="<?php echo $_SESSION['profilephoto']; ?>" style="width:50px; height:50px;" class="img-round">
                    <a href="logout.php" class="login-panel"><i class="fa fa-user"></i>Logout</a>
                    <?php
                }else{
                    ?>
                    <a href="login.php" class="login-panel"><i class="fa fa-user"></i>Login</a>
                    <?php  
                }
                ?>
                    
                   
                </div>
            </div>
        </div>
        <div class="container">
            <div class="inner-header">
                <div class="row">
                    <div class="col-lg-2 col-md-2">
                        <div class="logo">
                            <a href="./index.php">
                                <img src="img/logo.png" alt="" style="width:100px; height:100px;">
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-7 col-md-7">
                      
                    </div>
                    <div class="col-lg-3 text-right col-md-3">
                        <?php
                        if(isset($_SESSION['uid']) && $_SESSION['uid'] != NULL){
                        ?>
                        <ul class="nav-right">
                            <li class="heart-icon">
                               
                            </li>
                            <li class="cart-icon">
                                <a href="#">
                                    <i class="icon_bag_alt"></i>
                                    <span><?php echo $totalorder; ?></span>
                                </a>
                                <div class="cart-hover">
                                    <div class="select-items">
                                        <table>
                                            <tbody>
                                                <?php
                                                while($row = $orders->fetch_assoc()){
                                                    ?>
                                                    <tr>
                                                        <td class="si-pic"><img style="width:75px;height:75px;" src="<?php echo 'admin/'.$row['image']; ?>" alt=""></td>
                                                        <td class="si-text">
                                                            <div class="product-selected">
                                                                <p><?php echo $row['product_name']; ?></p>
                                                                <h6><?php echo $row['product_details']; ?></h6>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="select-total">
                                        <span>total:</span>
                                        <h5>Rs. <?php echo $total; ?></h5>
                                    </div>
                                    <div class="select-button">
                                        <a href="shopping-cart.php" class="primary-btn view-card">VIEW CART</a>
                                        <a href="check-out.php" class="primary-btn checkout-btn">CHECK OUT</a>
                                    </div>
                                </div>
                            </li>
                            <li class="cart-price">Rs. <?php echo $total; ?></li>
                        </ul>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="nav-item">
            <div class="container">
               
                <nav class="nav-menu mobile-menu">
                    <ul>
                        <li class="active"><a href="./index.php">Home</a></li>
                        <li><a href="./shop.php">Shop</a></li>
                        <li><a href="./contact.php">Contact</a></li>
                        <li><a href="./aboutus.php">About Us</a></li>
                        <li><a href="./orders.php">Your Orders</a></li>
                        <!-- <li><a href="#">Pages</a>
                            <ul class="dropdown">
                                <li><a href="./blog-details.php">Blog Details</a></li>
                                <li><a href="./shopping-cart.php">Shopping Cart</a></li>
                                <li><a href="./check-out.php">Checkout</a></li>
                                <li><a href="./faq.php">Faq</a></li>
                                <li><a href="./register.php">Register</a></li>
                                <li><a href="./login.php">Login</a></li>
                            </ul>
                        </li> -->
                    </ul>
                </nav>
                <div id="mobile-menu-wrap"></div>
            </div>
        </div>
    </header>
    <!-- Header End -->
    