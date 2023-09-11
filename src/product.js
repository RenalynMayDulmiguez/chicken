const { createApp } = Vue;

createApp({
  data() {
    return {
      // favorite:[],
      products: [],
      product: {},
      carts: [],
      // isFavoritesPage: false,
      editQuantity: 0,
      editPrice: 0,
      currentPassword: '',
      newPassword: '',
      confirmPassword: ''
    };
  },

  computed: {
    getTotal() {
      if (this.carts.length > 0) {
        const totalSum = this.carts.reduce((accumulator, cart) => accumulator + cart.total, 0);
        const formatter = new Intl.NumberFormat("fil-PH", { style: "currency", currency: "PHP" });
        const formattedTotal = formatter.format(totalSum);
        return formattedTotal;
      } else {
        return 0;
      }
    },
  },

  created() {
    this.displayProducts();
    this.displayCarts();
    // this.displayFavorites();
    // if (window.location.pathname === '/favorites.php') {
    //   this.isFavoritesPage = true;
    // }
  },

  methods: {
    removeCart(id) {
      if (confirm("Are you sure you want to remove this?")) {
        const data = new FormData();
        data.append("method", "removeCart");
        data.append("id", id);
        axios.post("../api/index.php", data).then((res) => {
          if (res.data == 1) {
            alert("Removed Successfully!");
            this.displayCarts();
          } else {
            console.log(res.data);
            alert("Something went wrong. Please try again later!");
          }
        });
      }
    },
    changePassword(e) {
      e.preventDefault();
      const form = e.target;

      if (this.newPassword !== this.confirmPassword) {
          alert("New password and confirmation password do not match.");
          return;
      }

      const formData = new FormData();
      formData.append('currentPassword', this.currentPassword);
      formData.append('newPassword', this.newPassword);
      formData.append('confirmPassword', this.confirmPassword);
      formData.append('method', 'fnChangePassword');

      axios
          .post('../api/user-api.php', formData)
          .then(response => {
              console.log(response);
              const responseData = response.data;
              if (responseData === 'success') {
                  alert("Your password has been changed successfully.");
                  // window.location.reload();
                  this.currentPassword = '';
                  this.newPassword = '';
                  this.confirmPassword = '';
              } else if (responseData === 'passwordMismatch') {
                  alert("New password and confirm password do not match.");
              } else if (responseData === 'currentPasswordMismatch') {
                  alert("Current password does not match.");
              } else {
                  console.log(responseData);
              }
          })
          .catch(error => {
              console.log(error);
          });
  },

    displayCarts() {
      const data = new FormData();
      data.append("method", "displayCarts");
      axios.post("../api/index.php", data).then((res) => {
        console.log(res.data);
        this.carts = res.data;
      });
    },
    addToCart(id) {
      const data = new FormData();
      data.append("method", "addToCart");
      data.append("product_id", id);
      axios.post("../api/index.php", data).then((res) => {
        console.log(res.data);
        if (res.data == 1) {
          this.displayCarts();
        } else {
          console.log(res.data);
          alert("Something went wrong. Please try again!");
        }
      });
    },

    getProduct(product) {
      this.product = product;
      var modal = document.getElementById("deleteProduct");
      var modalInstance = new bootstrap.Modal(modal);
      modalInstance.show();
    },

    deleteProduct() {
      const data = new FormData();
      data.append("method", "deleteProduct");
      data.append("id", this.product.id);
      axios.post("../api/index.php", data).then((res) => {
        if (res.data == 1) {
          this.displayProducts();
        } else {
          console.log(res.data);
          alert("Something went wrong. Please try again later!");
        }
      });
    },
    // displayFavorites() {
    //   const data = new FormData();
    //   data.append("method", "displayFavorites");
    //   axios.post("../api/index.php", data).then((res) => {
    //     console.log(res.data);
    //     this.favorite = res.data;
    //   });
    // },
    displayProducts() {
      const data = new FormData();
      data.append("method", "displayProducts");
      axios.post("../api/index.php", data).then((res) => {
        this.products = res.data;
      });
    },
    favorites(id) {
      const data = new FormData();
      data.append("id", id);
      data.append("method", "favorites");
      axios.post("../api/index.php", data).then((res) => {
        console.log(res.data);
        if (res.data == 1) {
          this.displayProducts();
          // this.displayFavorites();
        }
      });
    },
editProduct(product) {
  this.product = product;
  this.editQuantity = product.quantity;
  this.editPrice = product.price;
  var modal = document.getElementById("editProduct");
  var modalInstance = new bootstrap.Modal(modal);
  modalInstance.show();
},
saveChanges() {
  const data = new FormData();
  data.append("method", "editProduct");
  data.append("id", this.product.id);
  data.append("quantity", this.editQuantity);
  data.append("price", this.editPrice);
  axios.post("../api/index.php", data).then((res) => {
    if (res.data == 1) {
      alert("Changes have been saved!");
      this.displayProducts();
      var modal = document.getElementById("editProductConfirmation");
      var modalInstance = new bootstrap.Modal(modal);
      modalInstance.show();
    } else {
      console.log(res.data);
      alert("Something went wrong. Please try again later!");
    }
  });
  // Refresh the page
  window.location.reload();
},
  },
}).mount("#app");
