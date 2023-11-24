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
                                                    <a href="#!" style="color: #cecece;" @click="deleteThisCartItem(cart.cartId)"><i class="fas fa-trash-alt"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <h6>For further assistance, please contact me using <b class="text-danger">thisissample@gmail.com</b> or <b class="text-danger">0129312312</b> or you can message me via facebook <b class="text-danger">facebook.com/helloworld</b></h6>
                                </div>
                                <div class="col-lg-5">

                                    <div class="card bg-primary text-white rounded-3">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between align-items-center mb-4">
                                                <h5 class="mb-0">Checkout</h5>
                                            </div>
                                            <div class="form">
                                                <div class="form-outline form-white mb-4">
                                                    <select v-model="paymentMethod" class="form-control form-control-lg" @click="showIfGcashMethod">
                                                        <option value="selected">Select Payment Method</option>
                                                        <option value="1">COD</option>
                                                        <option value="2">Gcash</option>
                                                    </select>
                                                </div>
                                                <div v-if="showGcashPaymentMethod">
                                                    <div class="form-outline form-white mb-4">
                                                        <a :href="myQrCode" target="_blank" class="btn btn-lg btn-lg btn-info">Scan and send via QRCODE</a>
                                                    </div>
                                                    <div class="form-outline form-white mb-4">
                                                        Send here the proof of reciept
                                                        <input type="file" class="form-control form-control-lg" ref="proofRecient" @change="onFileChange">
                                                    </div>
                                                </div>
                                            </div>

                                            <hr class="my-4">

                                            <div class="d-flex justify-content-between">
                                                <p class="mb-2">Total Amount</p>
                                                <p class="mb-2">₱{{totalAmount}}</p>
                                            </div>

                                            <div class="d-flex justify-content-between">
                                                <p class="mb-2">Shipping</p>
                                                <p class="mb-2">₱{{shippingAmount}}</p>
                                            </div>

                                            <div class="d-flex justify-content-between mb-4">
                                                <p class="mb-2">Total Payment</p>
                                                <p class="mb-2">₱{{totalAmount + shippingAmount}}</p>
                                            </div>
                                            <!-- Ang css ani nga botton nganong naka outline? Usba lang nya ni -->
                                            <button type="button" class="col-12 btn btn-info btn-block btn-lg" @click="sentToTransaction(cartsId)">
                                                <div class="d-flex justify-content-between">
                                                    <div class="col-6">Send <i class="fas fa-long-arrow-alt-right ms-2"></i></div>
                                                </div>
                                            </button>

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
    function showWhenSelectedGcash(){
        let option = document.getElementById('paymentMethod');
        let selectedPaymentMethod = document.getElementById('gcashSelected');

        if(option == 2){
            selectedPaymentMethod.classList.remove('visually-hidden');
        }else{
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