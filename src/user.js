const { createApp } = Vue;

createApp({
  data() {
    return {
      user: {},
      currentPassword: '',
      newPassword: '',
      confirmPassword: '',
      error: ""
    };
  },
  created() {
    console.log("created");
  },
  methods: {
    displayUser() {
      const data = new FormData();
      data.append("method", "displayUser");
      axios.post(`../api/index.php`, data).then((r) => {
        this.user = r.data;
      });
    },
    login(e) {
      e.preventDefault();
      const b = this
      const data = new FormData(e.currentTarget);
      data.append("method", "login");
      axios.post(`../api/index.php`, data).then((r) => {
        if (r.data == 1) {
          location.href = "../back-end/dashboard.php";
        } else if (r.data == 0) {
          location.href = "index.php";
        } else if (r.data == 'locked') {
          alert('account is locked');
        }
      });
    },
    changePassword(e) {
      e.preventDefault();
      const form = e.target;

      if (this.newPassword !== this.confirmPassword) {
        this.error = "New password and confirmation password do not match.";
        return;
      }

      const formData = new FormData(e.currentTarget);
      formData.append('method', 'fnChangePassword');
      console.log(formData);
      axios
        .post(`../api/user-api.php`, formData)
        .then(response => {
          console.log(response);
          const responseData = response.data;
          if (responseData === 'success') {
            alert("Your password has been changed successfully.");
            // window.location.reload();
            this.currentPassword = '';
            this.newPassword = '';
            this.confirmPassword = '';
            this.error = ''; // Clear any previous errors
          } else if (responseData === 'passwordMismatch') {
            this.error = "New password and confirm password do not match";
          } else if (responseData === 'currentPasswordMismatch') {
            this.error = "Current password does not match.";
          } else {
            console.log(responseData);
            this.error = "An error occurred while changing your passwords";
          }
        })
        .catch(error => {
          console.log(error);
          this.error = "An error occurred while processing your request.";
        });
    },

    register(e) {
      e.preventDefault();
      if (e.target.password.value != e.target.confirm_password.value) {
        alert('Passwords do not match');
        return false;
      }
      const data = new FormData(e.currentTarget);
      data.append("method", "register");
      axios.post(`../api/index.php`, data).then((r) => {
        if (r.data == 0) {
          location.href = "index.php";
        }
      });
    },
  },
}).mount("#app");
