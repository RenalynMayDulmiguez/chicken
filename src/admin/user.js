const { createApp } = Vue;

createApp({
    data() {
        return {
            users: [],
            editUserId: 0,
            editFullname: '',
            editMobile: '',
            editEmail: '',
        }
    },
    created() {
        this.displayAllUser();
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
            if(confirm('Are you sure you want to proceed with this action?')) {
                const data = new FormData();
                data.append('userId', userId);
                data.append('counterlock', counterlock);
                data.append('method', 'updateCounterlock');
                axios.post(`../api/index.php`, data).then((r) => {
                    this.displayAllUser();
                })
            }
        }
    }

}).mount('#pageWrapper');