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
    // this.displayUser();
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
      const b =this
      const data = new FormData(e.currentTarget);
      data.append("method", "login");
      axios.post(`../api/index.php`, data).then((r) => {

        if (r.data === 1) {
          location.href = "../back-end/all-users.php";
        } else if(r.data === 0) {
          location.href = "index.php";
        } else if(r.data === 'locked') {
          alert('account is locked');
        }
        else {
          //alert("Unauthenticated");
          b.error="Unauthenticated"
        }
      });
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
    register(e) {
      e.preventDefault();
      if(e.target.password.value != e.target.confirm_password.value) {
        alert('Passwords do not match');
        return false;
      }
      const data = new FormData(e.currentTarget);
      data.append("method", "register");
      axios.post(`../api/index.php`, data).then((r) => {
        if (r.data == 0) {
          location.href = "index.php";
        } else {
          console.log(r.data);
          alert("Error: Data not saved");
        }
      });
    },
  },
}).mount("#app");
