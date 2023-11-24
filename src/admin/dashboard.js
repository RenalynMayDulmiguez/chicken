const { createApp } = Vue;

createApp({
  data() {
    return {
      products: [],
      product: [],
      carts: [],
      recentOrders: [],
      users: [],
      editUserId: 0,
      editFullname: '',
      editMobile: '',
      editEmail: '',
      editQuantity: 0,
      editPrice: 0,
      paid: 0,
      notpaid: 0,
      delivercount: 0,
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
    this.displayAllUser();
    this.adminDashboardViewPaidFunction();
    this.adminDashboardNoPaidPaidFunction();
    this.adminDashboardDeliveredPaidFunction();
    this.adminRecentOrders();
  },

  methods: {
    displayAllUser() {
      const data = new FormData();
      data.append('method', 'displayAllUser');
      axios.post(`../api/index.php`, data).then((r) => {
        this.users = r.data;
        console.log(r.data);
      })
    },
    deleteUser(userId) {
      const data = new FormData();
      data.append("method", "deleteUser");
      data.append("userId", userId);

      axios.post("../api/index.php", data)
        .then((res) => {
          if (res.data === 1) {
            this.displayAllUser();
          } else {
            console.log(res.data);
          }
        })
        .catch(error => {
          console.error(error);
        });
    },
    deleteChanges() {
      window.location.reload();
    },
    editUser(user) {
      this.editUserId = user.id;
      this.editFullname = user.fullname;
      this.editMobile = user.mobile;
      this.editEmail = user.email;

      var modal = document.getElementById('editUser');
      var modalInstance = new bootstrap.Modal(modal);
      modalInstance.show();
    },
    saveUserChanges() {
      const data = new FormData();
      data.append('method', 'editUser');
      data.append('userId', this.editUserId);
      data.append('fullname', this.editFullname);
      data.append('mobile', this.editMobile);
      data.append('email', this.editEmail);

      axios.post('../api/index.php', data)
        .then((response) => {
          if (response.data === 1) {
            this.displayAllUser();
            var modal = document.getElementById('editUserConfirmation');
            var modalInstance = new bootstrap.Modal(modal);
            modalInstance.show();
          } else {
            console.log(response.data);
          }
        })
        .catch((error) => {
          console.error(error);
        });
    },
    SaveChanges() {
      window.location.reload();
    },

    updateCounterlock(userId, counterlock) {
      if (confirm('Are you sure you want to proceed with this action?')) {
        const data = new FormData();
        data.append('userId', userId);
        data.append('counterlock', counterlock);
        data.append('method', 'updateCounterlock');
        axios.post(`../api/index.php`, data).then((r) => {
          this.displayAllUser();
        })
      }
    },
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
    adminDashboardViewPaidFunction() {
      const data = new FormData();
      data.append("method", "adminDashboardViewPaidFunction");
      axios.post("../api/index.php", data).then((res) => {
        for (var v of res.data) {
          this.paid = v.paid;
        }
      });
    },
    adminDashboardNoPaidPaidFunction() {
      const data = new FormData();
      data.append("method", "adminDashboardNoPaidPaidFunction");
      axios.post("../api/index.php", data).then((res) => {
        for (var v of res.data) {
          this.notpaid = v.notPaid;
        }
      });
    },
    adminDashboardDeliveredPaidFunction() {
      const data = new FormData();
      data.append("method", "adminDashboardDeliveredPaidFunction");
      axios.post("../api/index.php", data).then((res) => {
        for (var v of res.data) {
          this.delivercount = v.deliveryStatus;
        }
      });
    },
    adminRecentOrders(){
      const data = new FormData();
      data.append("method", "adminRecentOrders");
      axios.post("../api/index.php", data).then((r) => {
          this.recentOrders = r.data;
      });
    }
  },
}).mount("#pageWrapper");
