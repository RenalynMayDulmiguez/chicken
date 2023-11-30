const { createApp } = Vue;

createApp({
    data() {
        return {
            showGcashPaymentMethod: false,
            paymentMethod: 'selected',
            qrcodemain: '',
            selectedItem: [],
            carts: [],
            cartsId: [],
            totalAmount: 0,
            shippingAmount: 10,
            myQrCode: [],
            fileInput: null
        };
    },
    methods: {
        getAllCheckoutedItem: function () {
            var searchParams = new URLSearchParams(window.location.search);
            var proId = searchParams.get("proId");

            const vue = this;
            const data = new FormData();
            data.append("method", "displaySelectedChecoutedItem");
            data.append("product_id", proId);
            axios.post("../api/index.php", data).then((res) => {
                alert(res.data);
            });
        },
        getQrCodeForAdminqFunction: function () {
            const vue = this;
            const data = new FormData();
            data.append("method", "getQrCodeForAdminqFunction");
            axios.post("../api/index.php", data).then((res) => {
                for (var v of res.data) {
                    vue.qrcodemain = v.qrcodeMain;
                }
            });
        },
        getAllCart: function () {
            const vue = this;
            const data = new FormData();
            data.append("method", "getAllMyCart");
            axios.post("../api/index.php", data).then((res) => {
                vue.carts = res.data;
                for (var v of res.data) {
                    vue.totalAmount += v.cartQuantitty * v.price;
                    vue.cartsId.push(v.cartId);
                }
            });
        },
        deleteThisCartItem: function (cartId) {
            alert(cartId);
            const vue = this;
            const data = new FormData();
            data.append("method", "deleteThisCart");
            data.append("cartId", cartId);
            axios.post("../api/index.php", data).then((res) => {
                let r = res.data;
                if (r == 200) {
                    vue.getAllCart();
                } else {
                    alert(r);
                }
            });
        },
        deleteAllThisItems: function (cartId) {
            for (var i = 0; i < cartId.length; i++) {
                const vue = this;
                const data = new FormData();
                data.append("method", "deleteThisCart");
                data.append("cartId", cartId[i]);
                axios.post("../api/index.php", data).then((res) => {
                    window.location.href = "index.php";
                });
            }
        },
        sentToTransaction: function (cartsId) {
            const vue = this;
            if (vue.paymentMethod == 'selected') {
                alert("SELECT PAYMENT METHOD");
            } else if (vue.paymentMethod == 1) {
                for (var i = 0; i < cartsId.length; i++) {
                    const data = new FormData();
                    data.append("method", "sentToTransaction");
                    data.append("proofRecient", 'CODNoData');
                    data.append("paymentMethod", vue.paymentMethod);
                    data.append("cartId", cartsId[i]);
                    axios.post("../api/index.php", data).then((res) => {
                        window.location.href = "checkoutCheck.php";
                    });
                }
            } else if (vue.paymentMethod == 2) {
                for (var i = 0; i < cartsId.length; i++) {
                    const data = new FormData();
                    data.append("method", "sentToTransaction");
                    data.append("proofRecient", vue.fileInput);
                    data.append("paymentMethod", vue.paymentMethod);
                    data.append("cartId", cartsId[i]);
                    axios.post("../api/index.php", data).then((res) => {
                        if (res.data == 200) {
                            window.location.href = "checkoutCheck.php";
                        } else {
                            alert(res.data);
                        }
                    });
                }
            }
        },
        productPhoto: function (productPhotoName) {
            const namePattern = productPhotoName.slice(1, -1).replace(/"/g, '');
            return namePattern;
        },
        onFileChange(event) {
            this.fileInput = event.target.files[0];
        },

    },
    created() {
        this.getAllCart();
        this.getQrCodeForAdminqFunction();
    },
    computed: {
        showIfGcashMethod: function () {
            if (this.paymentMethod == 2) {
                return this.showGcashPaymentMethod = true;
            } else {
                return this.showGcashPaymentMethod = false;
            }
        }
    },
}).mount("#app");