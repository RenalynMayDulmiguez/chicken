const { createApp } = Vue;

createApp({
  data() {
    return {};
  },

  methods: {
    addProduct(e) {
      e.preventDefault();
      const data = new FormData(e.currentTarget);
      data.append("method", "addProduct");
      axios.post("../api/index.php", data).then((res) => {
        if (res.data == 1) {
          const successMessage = document.createElement("div");
      successMessage.innerText = "Added successfully!";
      successMessage.style.textAlign = "center";
      successMessage.style.position = "fixed";
      successMessage.style.top = "50%";
      successMessage.style.left = "50%";
      successMessage.style.transform = "translate(-50%, -50%)";
      successMessage.style.backgroundColor = "#eaf7ea";
      successMessage.style.padding = "10px";
      successMessage.style.border = "1px solid #2ecc71";
      successMessage.style.borderRadius = "5px";
      successMessage.style.zIndex = "9999";
      document.body.appendChild(successMessage);
          e.target.reset();
          window.location.href = "../back-end/products.php";
        } else {
          console.log(res.data);
          alert(res.data);
        }
      });
    },
  },
}).mount("#pageWrapper");
