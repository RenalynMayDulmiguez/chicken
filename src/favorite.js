const { createApp } = Vue;

createApp({
  data() {
    return {
    // favorite:[],
    // isFavoritesPage: false,
      products: [],
      carts: [],
    };
  },
  created() {
    this.displayFavorites();
    this.displayCarts();
    // if (window.location.pathname === '/favorites.php') {
    //   this.isFavoritesPage = true;
    // }
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

    removeFavorite(id) {
      const data = new FormData();
      data.append('id', id);
      data.append('method', 'removeFavorite');
      axios.post('../api/index.php', data).then((res) => {
        console.log(res.data)
        if(res.data == 1) {
          alert("Removed successfully!");
          this.displayFavorites();
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
            this.displayFavorites()
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

    displayFavorites() {
      const data = new FormData();
      data.append("method", "displayFavorites");
      axios.post("../api/index.php", data).then((res) => {
        console.log(res.data);
        this.products = res.data;
      });
    },
    addToCartFromFavorites(id) {
      const data = new FormData();
      const product = JSON.stringify(id);
      data.append("product", product);
      data.append("method", "addToCartFromFavorites");
      axios.post("../api/index.php", data).then((res) => {
        console.log(res.data)
        alert('Added successfully!');
        this.displayFavorites();
        this.displayCarts();
      });
    },
  },
}).mount("#app");
