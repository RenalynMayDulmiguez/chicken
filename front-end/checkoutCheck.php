<?php
session_start();
include './shared/head.php';
?>

<div id="app">
    <section class="h-100 h-custom" style="background-color: #eee;">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col">
                    <div class="card">
                        <div class="card-body p-4">

                            <div class="row">

                                <div class="col-lg-7">
                                    <h5 class="mb-3"><a href="index.php" class="text-body"><i class="fas fa-long-arrow-alt-left me-2"></i>Continue shopping</a></h5>
                                    <hr>
                                    <div class="card mb-3" v-for="cart in carts">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between">
                                                <div class="d-flex flex-row align-items-center">
                                                    <div>
                                                        <img :src="'../uploads/products/' + productPhoto(cart.images)" class="img-fluid rounded-3" alt="Shopping item" style="width: 65px;">
                                                    </div>
                                                    <div class="ms-3">
                                                        <h5>Product Name: {{ cart.name }}</h5>
                                                        <p class="small mb-0">Description: {{cart.description}}</p>
                                                        <p class="small mb-0">Qty: {{cart.cartQuantitty}}</p>
                                                    </div>
                                                </div>
                                                <div class="d-flex flex-row align-items-center">
                                                    <div style="width: 80px;">
                                                        <h5 class="mb-0">₱{{cart.price}}</h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <h6>For further assistance, please contact me using <b class="text-danger">CFC@gmail.com</b> or <b class="text-danger">0129312312</b> or you can message me via facebook <b class="text-danger">facebook.com/helloworld</b></h6>
                                </div>
                                <div class="col-lg-5">

                                    <div class="card bg-primary text-white rounded-3">
                                        <div class="card-body p-5 text-center">
                                            <i class="fas fa-check-circle fa-5x m-5"></i><br>
                                            <!-- <span>Successfully Paid</span> -->
                                            <button class="col-12 btn btn-lg btn-info" @click="deleteAllThisItems(cartsId)">Thank You! <br> Your Order Successfully paid!</button>
                                        </div>
                                    </div>

                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php include './shared/scripts.php'; ?>

<script src="../src/checkout.js"></script>

<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

<script>
    function showWhenSelectedGcash() {
        let option = document.getElementById('paymentMethod');
        let selectedPaymentMethod = document.getElementById('gcashSelected');

        if (option == 2) {
            selectedPaymentMethod.classList.remove('visually-hidden');
        } else {
            selectedPaymentMethod.classList.add('visually-hidden');
        }
    }

    var swiper = new Swiper('.swiper-container', {
        slidesPerView: 1,
        spaceBetween: 10,
        pagination: {
            el: '.swiper-pagination-custom',
            clickable: true,
        },
        autoplay: {
            delay: 2000, // Autoplay delay in milliseconds (4 seconds)
            disableOnInteraction: false, // Prevents autoplay from stopping when the user interacts with the carousel
        },
    });
</script>
</body>

</html>