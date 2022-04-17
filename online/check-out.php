<?php include 'header.php'; 
if(!isset($_SESSION['uid']) || $_SESSION['uid'] == NULL){
    ?>
    <script>
    window.location = "shop.php";
    </script>
    <?php
    exit;
}
$uid = $_SESSION['uid'];
$fetch_orders = "SELECT *, o.id as orderid FROM products p inner join orders o on o.product_id = p.id WHERE user_id = '$uid' and status is NULL";
$orders = $conn->query($fetch_orders);

$total_amount_query = "SELECT sum(p.product_price) as total FROM products p inner join orders o on o.product_id = p.id WHERE user_id = '$uid' and status is NULL";
$total_amount = $conn->query($total_amount_query);
$total = 50;
while($row = $total_amount->fetch_assoc()){
    $total = $row['total'];
}
if(isset($_POST['placeorder'])){
    if($_POST['country'] != NULL && $_POST['town'] != NULL && $_POST['street'] != NULL && $_POST['zip'] != NULL ){
        $full_address = $_POST['street'].', '.$_POST['town'].', '.$_POST['country'].', '.$_POST['zip'];
        $datetime = date("Y-m-d h:i:sa");
        $place_order_query = "update orders set address = '$full_address', status = 0, date = '$datetime' where user_id = '$uid' and status is NULL";
        $result = $conn->query($place_order_query);
        if($result === TRUE){
            ?>
            <script>
                alert("Thank You For Shopping !");
                window.location = "orders.php";
            </script>
            <?php
        }else{
            ?>
            <script>
                alert("Some error occurred !");
                // window.location = "orders.php";
            </script>
            <?php
        }
    }else{
        ?>
            <script>
                alert("Please fill all the details !");
                // window.location = "orders.php";
            </script>
            <?php
    }
}
?>

    <!-- Breadcrumb Section Begin -->
    <div class="breacrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text product-more">
                        <a href="./index.html"><i class="fa fa-home"></i> Home</a>
                        <a href="./shop.html">Shop</a>
                        <span>Check Out</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Section Begin -->

    <!-- Shopping Cart Section Begin -->
    <section class="checkout-section spad">
        <div class="container">
            <form method="post" class="checkout-form">
                <div class="row">
                    <div class="col-lg-6">
                        <!-- <div class="checkout-content">
                            <a href="#" class="content-btn">Click Here To Login</a>
                        </div> -->
                        <h4>Biiling Details</h4>
                        <div class="row">
                            <div class="col-lg-12">
                                <label for="cun">Country<span>*</span></label>
                                <input type="text" id="cun" name="country">
                            </div>
                            <div class="col-lg-12">
                                <label for="street">Street Address<span>*</span></label>
                                <input type="text" id="street" class="street-first" name="street">
                            </div>
                            <div class="col-lg-12">
                                <label for="zip">Postcode </label>
                                <input type="text" id="zip" name="zip">
                            </div>
                            <div class="col-lg-12">
                                <label for="town">Town / City<span>*</span></label>
                                <input type="text" id="town" name="town">
                            </div>
                            <!-- <div class="col-lg-6">
                                <label for="email">Email Address<span>*</span></label>
                                <input type="text" id="email">
                            </div>
                            <div class="col-lg-6">
                                <label for="phone">Phone<span>*</span></label>
                                <input type="text" id="phone">
                            </div> -->
                            <div class="col-lg-12">
                                <!-- <div class="create-item">
                                    <label for="acc-create">
                                        Create an account?
                                        <input type="checkbox" id="acc-create">
                                        <span class="checkmark"></span>
                                    </label>
                                </div> -->
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <!-- <div class="checkout-content">
                            <input type="text" placeholder="Enter Your Coupon Code">
                        </div> -->
                        <div class="place-order">
                            <h4>Your Order</h4>
                            <div class="order-total">
                                <ul class="order-table">
                                    <li>Product <span>Total</span></li>
                                    <?php
                                    while($row = $orders->fetch_assoc()){
                                        ?>
                                        <li class="fw-normal"><?php echo $row['product_name'] ?><span>Rs. <?php echo $row['product_price'] ?></span></li>
                                        <?php
                                    }
                                    ?>
                                    <li class="total-price">Total <span>Rs. <?php echo $total ?></span></li>
                                    <input type="hidden" value="<?php echo $total;?>" name="total">
                                </ul>
                                <div class="order-btn">
                                    <button type="submit" class="site-btn place-btn" name="placeorder">Place Order</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
    <!-- Shopping Cart Section End -->

   <?php include 'footer.php'; ?>