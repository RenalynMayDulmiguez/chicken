<?php
session_start();
include './shared/head.php'; ?>

<div id="app">

    <?php

    include './shared/header.php';
    include './shared/mobile-header.php';
    ?>

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
    <section class="wishlist-section section-b-space">
        <div class="container-fluid-lg">
            <div class="row g-sm-3 g-2">
                <div class="col-xxl-2 col-lg-3 col-md-4 col-6 product-box-contain" v-for="product in orderDatas" :key="product.trans_id">
                    <div class="product-box-3 h-100">
                        <div class="product-header">
                            <div class="product-image">
                                <a :href="'../uploads/products/' + product.images">
                                    <img :src="'../uploads/products/' + product.images" class="img-fluid lazyload" alt="">
                                </a>
                            </div>
                        </div>
                        <div class="product-footer">
                            <div class="product-detail">
                                <a>
                                    <h5 class="text-capitalize fw-bold">{{ product.productName }}</h5>
                                </a>
                                <h5 class="price">
                                    Price: <span class="theme-color">₱ {{ product.price }}</span>
                                </h5>
                                <h5 class="price">
                                    Quantity: <span class="theme-color">{{ product.transaction_amount / product.price }}</span>
                                </h5>
                                <h5 class="price">
                                    Total Amount: <span class="theme-color">₱ {{ product.transaction_amount }}</span>
                                </h5>                 
                            <div class="tracking">
                        <div class="mt-2 theme-color fs-2 text-center">Status</div>
                    </div>
                    <div class="progress-track" v-if="product.deliver_status !== -1 && product.deliver_status < 4">
                        <ul id="progressbar">
                            <li :class="{ 'active': product.deliver_status >= 0 }" id="step1">
                                <i class="fas fa-hourglass-start"></i>
                                Pending
                            </li>
                            <li :class="{ 'active': product.deliver_status >= 1 }" id="step2"  v-bind:class="{ 'inactive': product.deliver_status < 1 }">
                                <i class="fas fa-check-circle"></i>
                               Approved
                            </li>
                            <li :class="{ 'active': product.deliver_status >= 2 }" id="step3" v-bind:class="{ 'inactive': product.deliver_status < 2 }">
                                <i class="fas fa-shipping-fast"></i>
                                On the way
                            </li>
                            <li :class="{ 'active': product.deliver_status >= 3 }" id="step4" v-bind:class="{ 'inactive': product.deliver_status < 3 }">
                                <i class="fas fa-box"></i>
                                Deliver
                            </li>
                        </ul>
                    </div>
                    <div v-else class="text-center price">
                        Decline
                    </div>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php include './shared/footer.php' ?>
</div>
<?php include './shared/scripts.php'; ?>
<script src="../src/favorite.js"></script>
</body>

</html>