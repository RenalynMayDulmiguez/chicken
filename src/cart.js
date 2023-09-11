const { createApp } = Vue;

createApp({
  data() {
    return {
      carts: [],
    };
  },

  computed: {
    subTotal() {
      return parseFloat(this.carts.reduce((accumulator, cart) => accumulator + cart.total, 0)).toFixed(2);
    },

    getTotal() {
      const totalSum = this.carts.reduce((accumulator, cart) => accumulator + cart.total, 0);
      const formattedTotal = (totalSum + 99.99).toFixed(2);
      return parseFloat(formattedTotal);
    },
  },

  created() {
    this.displayCarts();
  },
  methods: {
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
        this.carts = res.data;
      });
    },

    updateQuantity(process, event, id) {
      let quantity = event;
      switch (process) {
        case "minus":
          quantity--;
          break;
        case "plus":
          quantity++;
          break;
        default:
          quantity = event.target.value;
      }
      if (quantity < 0) {
        return 0;
      }
      const data = new FormData();
      data.append("method", "updateQuantity");
      data.append("quantity", quantity);
      data.append("id", id);
      axios.post("../api/index.php", data).then((res) => {
        if (res.data == 1) {
          this.displayCarts();
        } else {
          console.log(res.data);
          alert("Something went wrong, please try again later!");
        }
      });
    },
  },
}).mount("#app");
