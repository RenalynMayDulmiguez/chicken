<?php 
include './shared/head.php';
?>
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
            <h2>Cart</h2>
            <nav>
              <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item">
                  <a href="index.php">
                    <i data-feather="home"></i>
                  </a>
                </li>
              </ol>
            </nav>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Breadcrumb Section End -->

  <!-- Cart Section Start -->
  <section class="cart-section section-b-space">
    <div class="container-fluid-lg">
      <div class="row g-sm-5 g-3">
        <div class="col-xxl-9">
          <div class="cart-table">
            <div class="table-responsive-xl">
              <table class="table">
                <tbody>
                  <tr v-for="cart in carts" class="product-box-contain">
                    <td class="product-detail">
                      <div class="product border-0">
                        <a :href="`product.php?product_id=${cart.product_id}`"
                          class="product-image">
                          <img :src="`../uploads/products/${cart.mainImage}`"
                            class="img-fluid lazyload" :alt="cart.mainImage">
                        </a>
                        <div class="product-detail">
                          <ul>
                            <li class="name">
                              <a :href="`product.php?product_id=${cart.product_id}`">
                               {{ cart.name }}
                              </a>
                            </li>

                          </ul>
                        </div>
                      </div>
                    </td>

                    <td class="price">
                      <h4 class="table-title text-content">Price</h4>
                      <h5>₱{{ cart.price }}</h5>
                    </td>

                    <td class="quantity">
                      <h4 class="table-title text-content">Qty</h4>
                      <div class="quantity-price">
                        <div class="cart_qty">
                          <div class="input-group">
                            <button type="button" :disabled="cart.quantity <= 1"
                              @click="updateQuantity('minus', cart.quantity, cart.id)"
                              class="btn qty-left-minus" >
                              <i data-feather="minus" aria-hidden="true"></i>
                            </button>
                            <input 
                              class="form-control input-number qty-input"
                              type="number" name="quantity" :value="cart.quantity" @change="updateQuantity('change', $event, cart.id)">
                            <button type="button" 
                             @click="updateQuantity('plus', cart.quantity, cart.id)"
                              class="btn qty-right-plus">
                              <i data-feather="plus" aria-hidden="true"></i>
                            </button>
                          </div>
                        </div>
                      </div>
                    </td>

                    <td class="subtotal">
                      <h4 class="table-title text-content">Total</h4>
                      <h5>₱{{ cart.total }}</h5>
                    </td>

                    <td class="save-remove">
                      <h4 class="table-title text-content">Action</h4>
                      <a class="remove close_button" @click="removeCart(cart.id)"
                        href="javascript:void(0)">Remove</a>
                    </td>
                  </tr>

                </tbody>
              </table>
            </div>
          </div>
        </div>

        <div class="col-xxl-3">
          <div class="summery-box p-sticky">
            <div class="summery-header">
              <h3>Cart Total</h3>
            </div>

            <div class="summery-contain">
              <ul>
                <li>
                  <h4>Subtotal</h4>
                  <h4 class="price">₱{{ subTotal }}</h4>
                </li>

                <li class="align-items-start">
                  <h4>Shipping</h4>
                  <h4 class="price text-end">₱99.99</h4>
                </li>
              </ul>
            </div>

            <ul class="summery-total">
              <li class="list-total border-top-0">
                <h4>Total (PHP)</h4>
                <h4 class="price theme-color">₱{{ getTotal }}</h4>
              </li>
            </ul>

            <div class="button-group cart-button">
              <ul>
                <li>
                  <button
                    class="btn btn-animation proceed-btn fw-bold">Process To
                    Checkout</button>
                </li>

                <li>
                  <button onclick="location.href = 'index.php';"
                    class="btn btn-light shopping-button text-dark">
                    <i class="fa-solid fa-arrow-left-long"></i>Return To
                    Shopping</button>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Cart Section End -->

</div>

<?php 
  include './shared/footer.php'; 
  include './shared/scripts.php'; ?>
<script src="../src/cart.js"></script>
</body>


</html>