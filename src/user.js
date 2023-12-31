const { createApp } = Vue;

createApp({
  data() {
    return {
      currentPassword: '',
      newPassword: '',
      confirmPassword: '',
      error: "",
      usernamei: '',
      username: '',
      fullnamei: '',
      fullname: '',
      addressi: '',
      address: '',
      mobilei: '',
      mobile: '',
      emaili: '',
      email: '',
      idi: '',
    };
  },
  created() {
    this.displayUser();
  },
  methods: {
    login(e) {
      e.preventDefault();
      const b = this
      const data = new FormData(e.currentTarget);
      data.append("method", "login");
      axios.post(`../api/auth.php`, data).then((r) => {
        if (r.data == 1) {
          location.href = "../back-end/dashboard.php";
        } else if (r.data == 0) {
          location.href = "index.php";
        } else if (r.data == 'locked') {
          alert('account is locked');
        }
        else {
          // alert("Invald Credentials");
          alert(r.data);
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
        this.error = "Passwords do not match";
        return false;
      }
      const data = new FormData(e.currentTarget);
      data.append("method", "register");
      axios.post(`../api/auth.php`, data).then((r) => {
        if (r.data == 0) {
          location.href = "index.php";
        } else {
          this.error = "Invalid Credentials";
        }
      });
    },
    changePasswordProfile() {
      const vue = this;
    
      if (vue.newPassword !== vue.confirmPassword) {
        vue.error = "New password and confirmation password do not match.";
        return;
      }
    
      const data = new FormData();
      data.append("method", "changePasswordProfile");
      data.append("currentPassword", vue.currentPassword);
      data.append("confirmPassword", vue.confirmPassword);
    
      axios.post(`../api/auth.php`, data)
        .then(function (r) {
          if (r.data === 200) {
            vue.error = "SucessFully Change Password";
            window.location.reload();
          } else {
            vue.error = "Current password is incorrect!";
          }
        })
        .catch(function (error) {
          vue.error = "An error occurred while changing the password.";
          console.error(error); // Log the actual error for debugging purposes
        });
    },
    
    displayUser() {
      const vue = this;
      const data = new FormData();
      data.append("method", "displayUser");
      axios.post(`../api/index.php`, data).then((r) => {
        vue.usernamei = r.data.username;
        vue.fullnamei = r.data.fullname;
        vue.addressi = r.data.address;
        vue.mobilei = r.data.mobile;
        vue.emaili = r.data.email;
        vue.idi = r.data.id;
        vue.qrCode = r.data.profile;
      });
    },
    saveChanges() {
      const vue = this;
      const data = new FormData();
      data.append("method", "UpdateProfile");
      data.append("username", vue.usernamei);
      data.append("fullname", vue.fullnamei);
      data.append("address", vue.addressi);
      data.append("mobile", vue.mobilei);
      data.append("email", vue.emaili);
      axios.post(`../api/index.php`, data).then((r) => {
        if(r.data == 200){
          alert("Profile Details Updated!");
          window.location.reload();
        }else{
          this.error = "Profile Details Not Updated!";
        }
      });
    },
  },
}).mount("#app");
