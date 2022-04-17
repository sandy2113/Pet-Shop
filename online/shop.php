<?php
include 'header.php';  
if(isset($_REQUEST['cat'])){
    $category = $_REQUEST['cat'];    
}else{
    $category = 0;
}
$fetch_product = "select * from products where type = '$category'";
$result = $conn->query($fetch_product);
?>

    <script>
        function addtocart(pid){
            $.post("addtocart.php", {
                pid:pid,
                addtocart:1
            }, function(data, status){
                if(data == 0){
                    window.location = "login.php";
                }else{
                    alert(data);
                }
            });
        }
    </script>
    <!-- Breadcrumb Section Begin -->
    <div class="breacrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text">
                        <a href="#"><i class="fa fa-home"></i> Home</a>
                        <span>Shop</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Section Begin -->

    <!-- Product Shop Section Begin -->
    <section class="product-shop spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-8 order-2 order-lg-1 produts-sidebar-filter">
                    <div class="filter-widget">
                        <h4 class="fw-title">Categories</h4>
                        <ul class="filter-catagories">
                            <li><a href="shop.php?cat=0">Pets</a></li>
                            <li><a href="shop.php?cat=1">Accessories</a></li>
                        </ul>
                    </div>
                    
                    <!-- <div class="filter-widget">
                        <h4 class="fw-title">Price</h4>
                        <div class="filter-range-wrap">
                            <div class="range-slider">
                                <div class="price-input">
                                    <input type="text" id="minamount">
                                    <input type="text" id="maxamount">
                                </div>
                            </div>
                            <div class="price-range ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content"
                                data-min="100" data-max="50000">
                                <div class="ui-slider-range ui-corner-all ui-widget-header"></div>
                                <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
                                <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
                            </div>
                        </div>
                        <a href="#" class="filter-btn">Filter</a>
                    </div> -->
                </div>
                <div class="col-lg-9 order-1 order-lg-2">
                    <!-- <div class="product-show-option">
                        <div class="row">
                            <div class="col-lg-7 col-md-7">
                                <div class="select-option">
                                    <select class="sorting">
                                        <option value="">Default Sorting</option>
                                    </select>
                                    <select class="p-show">
                                        <option value="">Show:</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-5 col-md-5 text-right">
                                <p>Show 01- 09 Of 36 Product</p>
                            </div>
                        </div>
                    </div> -->
                    <div class="product-list">
                        <div class="row">
                            <?php
                                while($row = $result->fetch_assoc()){
                                    ?>
                                    <div class="col-lg-4 col-sm-6">
                                    <div class="product-item">
                                        <div class="pi-pic">
                                            <img src="<?php echo 'admin/'.$row['image'] ?>" alt="">
                                            <div class="icon">
                                                <!-- <i class="icon_heart_alt"></i> -->
                                            </div>
                                            <ul>
                                                <li class="w-icon active"><button onclick="addtocart('<?php echo $row['id'];?>');"><i class="icon_bag_alt"></i></button></li>
                                                <li class="quick-view"><a href="#" data-toggle="modal" data-target=".bd-example-modal-lg-<?php echo $row['id']; ?>">+ Quick View</a></li>
                                                <!-- <li class="w-icon"><a href="#"><i class="fa fa-random"></i></a></li> -->
                                            </ul>
                                        </div>
                                        <div class="pi-text">
                                            <div class="catagory-name"><?php echo ($category==0?'Pet':'Accessory') ?></div>
                                            <a href="#">
                                                <h5><?php echo $row['product_name'] ?></h5>
                                            </a>
                                            <div class="product-price">
                                            Rs. <?php echo $row['product_price'] ?>
                                                <!-- <span>Rs 35.00</span> -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal fade bd-example-modal-lg-<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                        <p style="margin:20px;">
                                            <?php echo $row['product_details'] ?>
                                        </p>
                                        </div>
                                    </div>
                                </div>
                                    <?php
                                }?>
                        </div>
                    </div>
                    <!-- <div class="loading-more">
                        <i class="icon_loading"></i>
                        <a href="#">
                            Loading More
                        </a>
                    </div> -->
                </div>
            </div>
        </div>
    </section>
    <!-- Product Shop Section End -->
    <!-- Large modal -->
<!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">Large modal</button> -->



    <?php include 'footer.php'; ?>