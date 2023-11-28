<?php
session_start();
include './shared/head.php'; ?>

<div id="app">

    <?php

    include './shared/header.php';
    include './shared/mobile-header.php';
    ?>

    <!-- Breadcrumb Section Start -->
    <section class="breadscrumb-section pt-0">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-12">
                    <div class="breadscrumb-contain">
                        <h2>List Of My Order</h2>
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item">
                                    <a href="index.php">
                                        <i class="fa-solid fa-house"></i>
                                    </a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">My Order
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Wishlist Section Start -->
    <section class="wishlist-section section-b-space">
        <div class="container-fluid-lg">
            <div class="row g-sm-3 g-2">
                <!-- Use a v-for loop to iterate over products -->
                <div class="col-xxl-2 col-lg-3 col-md-4 col-6 product-box-contain" v-for="product in orderDatas" :key="product.trans_id">
                    <div class="product-box-3 h-100">
                        <div class="product-header">
                            <div class="product-image">
                                <!-- Use proper binding for the product URL -->
                                <a :href="'../uploads/products/' + product.images">
                                    <img :src="'../uploads/products/' + product.images" class="img-fluid lazyload" alt="">
                                </a>
                            </div>
                        </div>
                        <div class="product-footer">
                            <div class="product-detail">
                                <a>
                                    <h5 class="name">{{ product.productName }}</h5>
                                </a>
                                <h5 class="price">
                                    <span class="theme-color">{{ product.price }}</span>
                                </h5>
                                <h5 class="price">
                                    <span class="theme-color">{{ product.deliver_status == 0 ? 'Pending' : 'Approved' }}</span>
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Wishlist Section End -->

    <!-- Footer Section Start -->
    <?php include './shared/footer.php' ?>
    <!-- Footer Section End -->

</div>
<?php include './shared/scripts.php'; ?>
<script src="../src/favorite.js"></script>
</body>

</html>