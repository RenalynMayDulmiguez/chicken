const { createApp } = Vue;

createApp({
  data() {
    return {
      products: [],
      product: {},
      carts: [],
      transactions: [],
      HistoryTransactions: [],
      transactionsAdmin: [],
      favoriteDatas: [],
      favoritesLength: 0,
      orderLength: 0,
      editQuantity: 0,
      editPrice: 0,
      statsEdit: 0,
      currentPassword: '',
      newPassword: '',
      selectedTransId: 0,
      selectedTransStatus: 0,
      TransStatus: 'selected',
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
    this.displayTransaction();
    this.displayTransactionAdmin();
    this.displayMyFavorite();
    this.displayHistoryTransaction();
    this.userOrder();
  },

  methods: {
    userOrder() {
      const data = new FormData();
      data.append("method", "userOrder");
      axios.post("../api/index.php", data).then((res) => {
        this.orderDatas = res.data;
        this.orderLength = res.data.length;
      });
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
          alert("Added to Cart");
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
    displayTransaction() {
      const data = new FormData();
      data.append("method", "displayTransaction");
      axios.post("../api/index.php", data).then((res) => {
        this.transactions = res.data;
      });
    },
    displayTransactionAdmin() {
      const data = new FormData();
      data.append("method", "displayTransactionAdmin");
      axios.post("../api/index.php", data).then((res) => {
        this.transactionsAdmin = res.data;
      });
    },
    updateProductOnApproveFunction(id) {
      const data = new FormData();
      data.append("method", "updateProductOnApproveFunction");
      data.append("id", id);
      axios.post("../api/index.php", data).then((res) => {
        alert(res.data);
      });
    },
    displayHistoryTransaction() {
      const data = new FormData();
      data.append("method", "displayHistoryTransaction");
      axios.post("../api/index.php", data).then((res) => {
        this.HistoryTransactions = res.data;
      })
    },
    selectTrans(tid) {
      const data = new FormData();
      data.append("method", "displayTransaction");
      axios.post("../api/index.php", data).then((res) => {
        for(var v of res.data){
          if(v.trans_id == tid){
            this.selectedTransId = v.trans_id;
            this.selectedTransStatus = v.deliver_status;
          }
        }
      });
    },
    updateStatusTransaction() {
      const data = new FormData();
      data.append("method", "updateStatusTransaction");
      data.append("ID", this.selectedTransId );
      data.append("status", this.TransStatus);
      axios.post("../api/index.php", data).then((res) => {
        this.updateProductOnApproveFunction(this.selectedTransId);
      });
    },
    addToMyFavorite(id) {
      const data = new FormData();
      data.append("method", "addToMyFavorite");
      data.append("product", id);
      axios.post("../api/index.php", data).then((res) => {
        if(res.data == 200){
          alert("Add to favorites!");
          this.displayMyFavorite();
        }else{
          alert(res.data);
        }
      });
    },
    displayMyFavorite() {
      const data = new FormData();
      data.append("method", "displayMyProductFavorites");
      axios.post("../api/index.php", data).then((res) => {
        this.favoriteDatas = res.data;
        this.favoritesLength = res.data.length;
      });
    },
    editProduct(product) {
      this.product = product;
      this.editQuantity = product.quantity;
      this.editPrice = product.price;
      this.statsEdit = product.status;
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
      data.append("status", this.statsEdit);
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
      window.location.reload();
    },
  },
}).mount("#app");
