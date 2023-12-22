const { createApp } = Vue;

createApp({
  data() {
    return {
      products: [],
      favoritesLength: 0,
      orderLength: 0,
      favoriteDatas: [],
      orderDatas: [],
      carts: [],
      deliver_status: 0 // Replace with your actual deliver_status value
    };
  },
  created() {
    this.userOrder();
    this.displayCarts();
    this.displayMyFavorite();
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
  methods: {
    setStatus(step) {
      // Update the deliver_status only if it matches the current step
      if (this.product.deliver_status === step - 1) {
          this.product.deliver_status = step;
      }
  },
    removeFavorite(id) {
      const data = new FormData();
      data.append('method', 'removeFavorite');
      data.append('id', id);
      axios.post('../api/index.php', data).then((res) => {
        console.log(res.data)
        if (res.data == 1) {
          alert("Removed successfully!");
          this.displayMyFavorite();
        }
      })
    },
    removeCart(id) {
      if (confirm("Are you want to remove this?")) {
        const data = new FormData();
        data.append("method", "removeCart");
        data.append("id", id);
        axios.post("../api/index.php", data).then((res) => {
          console.log(res.data);
          if (res.data == 1) {
            alert("Removed Successfully!");
            this.displayCarts();
          } else {
            console.log(res.data);
            alert("Something went wrong please try again later!");
          }
        });
      }
    },
    displayCarts() {
      const data = new FormData();
      data.append("method", "displayCarts");
      axios.post("../api/index.php", data).then((res) => {
        console.log(res.data)
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
    userOrder() {
      const data = new FormData();
      data.append("method", "userOrder");
      axios.post("../api/index.php", data).then((res) => {
        this.orderDatas = res.data;
        this.orderLength = res.data.length;
      });
    },
    addToMyFavorite(id) {
      const data = new FormData();
      data.append("method", "addToMyFavorite");
      data.append("product", id);
      axios.post("../api/index.php", data).then((res) => {
        if (res.data === 200) {
          alert("Added to favorites!");
          this.displayMyFavorite();
        } else if (res.data === 409) {
          alert("This item is already in your favorites list!");
          // Handle the case where the item is already in favorites
          // Example: Do something else, or simply notify the user
        } else {
          alert("Error: " + res.data);
        }
      }).catch((error) => {
        console.error("Error occurred:", error);
        alert("An error occurred. Please try again later.");
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
  },
}).mount("#app");
