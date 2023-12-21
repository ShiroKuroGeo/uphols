const { createApp } = Vue;

const CustomerLandingPage = createApp({
    data() {
        return {
            products: [],
            showToBuy: [],
            address_idssss: [],
            customerAddress: [],
            product_id: '',
            showProducts: false,
            product_picture: '',
            productName: '',
            productDescription: '',
            productPrice: '',
            productQuantity: '',
            productStatus: '',
            productSales: '',
            role: '',
        }
    },
    methods: {
        getAllProduct: function () {

            var vue = this;
            var data = new FormData();
            data.append('Method', 'selectAllDisplayedProduct');
            axios.post('/uphols/Backend/Routes/Members/Customer/product.php', data)
                .then(function (r) {
                    if (r.data.length <= 1) {
                        vue.showProducts = false;
                    } else {
                        vue.showProducts = true;
                    }
                    vue.products = [];
                    for (var p of r.data) {
                        if (p.productQuantity > 0) {
                            vue.products.push({
                                product_id: p.product_id,
                                product_picture: p.product_picture,
                                productName: p.productName,
                                productDescription: p.productDescription,
                                productPrice: p.productPrice,
                                productQuantity: p.productQuantity,
                                productStatus: p.productStatus,
                                productSales: p.productSales,
                            });
                        }
                    }
                })
        },
        addToCart: function (product_id) {
            var data = new FormData();
            data.append('Method', 'storeCart');
            data.append('product', product_id);
            axios.post('/uphols/Backend/Routes/Members/Customer/cart.php', data)
                .then(function (r) {
                    if (r.data == 200) {
                        toastr.success("Add to cart");
                    } else {
                        toastr.danger("Product is unavailable");
                    }
                });
        },
        showToOrder: function (product_id) {
            var vue = this;
            var data = new FormData();
            data.append('Method', 'showToOrder');
            data.append('product', product_id);
            axios.post('/uphols/Backend/Routes/Members/Customer/product.php', data)
                .then(function (r) {
                    vue.showToBuy = [];
                    for (var p of r.data) {
                        vue.showToBuy.push({
                            product_id: p.product_id,
                            product_picture: p.product_picture,
                            productName: p.productName,
                            productDescription: p.productDescription,
                            productPrice: p.productPrice,
                            productQuantity: p.productQuantity,
                            productQuantity: p.productQuantity,
                            productStatus: p.productStatus,
                            productSales: p.productSales,
                        });
                    }
                });
        },
        buyProduct: function (proId) {
            var vue = this;
            var address = document.getElementById('address').value;
            var quantity = document.getElementById('quantity').value;
            if (address != 0) {
                if (quantity == '') {
                    quantity = 1;
                    var data = new FormData();
                    data.append('Method', 'buyProduct');
                    data.append('product', proId);
                    data.append('address', address);
                    data.append('quantity', quantity);
                    axios.post('/uphols/Backend/Routes/Members/Customer/order.php', data)
                        .then(function (r) {
                            if (r.data == 200) {

                            } else {
                                toastr.error('Purchasing Failed!');
                            }
                        });
                } else {
                    var data = new FormData();
                    data.append('Method', 'buyProduct');
                    data.append('product', proId);
                    data.append('address', address);
                    data.append('quantity', quantity);
                    axios.post('/uphols/Backend/Routes/Members/Customer/order.php', data)
                        .then(function (r) {
                            if (r.data == 200) {
                                toastr.success('Purchasing Success!');
                            } else {
                                toastr.error('Purchasing Failed!');
                            }
                        });
                }
            } else {
                toastr.error('Select an Address');
            }
        },
        getUserAddress: function () {
            var vue = this;
            var data = new FormData();
            data.append('Method', 'getUserAddress');
            axios.post('/uphols/Backend/Routes/Members/Customer/address.php', data)
                .then(function (r) {
                    vue.customerAddress = [];
                    for (var c of r.data) {
                        vue.customerAddress.push({
                            address_id: c.address_id,
                            user_id: c.user_id,
                            address_region: c.address_region,
                            address_province: c.address_province,
                            address_city: c.address_city,
                            address_barangay: c.address_barangay,
                            address_street: c.address_street,
                            address_zipCode: c.address_zipCode,
                            created_at: c.created_at,
                            updated_at: c.updated_at
                        });
                    }

                    vue.address_idssss = [];
                    for (var c of r.data) {
                        vue.address_idssss.push(c.address_id);
                    }

                })
        },
        minimum: function (address) {
            return address === Math.min(...this.address_idssss);
        }
    },
    created: function () {
        this.getAllProduct();
        this.getUserAddress();
    }
});

const CustomerCart = createApp({
    data() {
        return {
            products: [],
            selectedProduct: [],
            recommended: [],
            totalPriceCart: 0,
            carts: [],
            cart_ids: [],
            cart_id: '',
            user_id: '',
            product_id: '',
            quantityCart: [],
            statusCart: '',
            product_picture: '',
            productName: '',
            productPrice: [],
            totalSelected: 0,
            SetQuantity: 0,
            address_idssss: [],
            customerAddress: [],
            role: '',
            countTotalSelected: 0,
            itemSelected: 0,
        }
    },
    methods: {
        getAllRecommendedProduct: function () {
            var vue = this;
            var data = new FormData();
            data.append('Method', 'selectAllRecommendedProduct');
            axios.post('/uphols/Backend/Routes/Members/Customer/product.php', data)
                .then(function (r) {
                    vue.products = [];
                    for (var p of r.data) {
                        vue.products.push({
                            product_id: p.product_id,
                            product_picture: p.product_picture,
                            productName: p.productName,
                            productDescription: p.productDescription,
                            productPrice: p.productPrice,
                            productQuantity: p.productQuantity,
                            productQuantity: p.productQuantity,
                            productStatus: p.productStatus,
                            productSales: p.productSales,
                        });
                    }
                })
        },
        selectedToRemoveItem: function (id) {
            this.itemSelected = id;
        },
        getMyCart: function () {
            var vue = this;
            var data = new FormData();
            data.append('Method', 'viewMyCart');
            axios.post('/uphols/Backend/Routes/Members/Customer/cart.php', data)
                .then(function (r) {
                    vue.carts = [];
                    for (var p of r.data) {
                        vue.carts.push({
                            cart_id: p.cart_id,
                            user_id: p.user_id,
                            product_id: p.product_id,
                            quantityCart: p.quantityCart,
                            statusCart: p.statusCart,
                            product_picture: p.product_picture,
                            productName: p.productName,
                            productPrice: p.productPrice,
                        });
                    }
                    vue.cart_ids = [];
                    for (var p of r.data) {
                        vue.cart_ids.push(p.cart_id);
                    }

                })
        },
        getRecommendedProduct: function () {
            var vue = this;
            var data = new FormData();
            data.append('Method', 'selectAllRecommendedProduct');
            axios.post('/uphols/Backend/Routes/Members/Customer/product.php', data)
                .then(function (r) {
                    vue.recommended = [];
                    for (var tp of r.data) {
                        vue.recommended.push({
                            product_id: tp.product_id,
                            product_picture: tp.product_picture,
                            productName: tp.productName,
                            productDescription: tp.productDescription,
                            productPrice: tp.productPrice,
                            productQuantity: tp.productQuantity,
                            productQuantity: tp.productQuantity,
                            productStatus: tp.productStatus,
                            productSales: tp.productSales,
                        });
                    }
                })
        },
        totalPriceInYourCart: function () {
            var vue = this;
            var data = new FormData();
            data.append('Method', 'totalPriceCart');
            axios.post('/uphols/Backend/Routes/Members/Customer/cart.php', data)
                .then(function (r) {
                    for (var tp of r.data) {
                        vue.totalPriceCart = tp.totalPrice;
                    }
                })
        },
        addToCart: function (product_id) {
            var vue = this;
            var data = new FormData();
            data.append('Method', 'storeCart');
            data.append('product', product_id);
            axios.post('/uphols/Backend/Routes/Members/Customer/cart.php', data)
                .then(function (r) {
                    if (r.data == 200) {
                        toastr.info("Successfully stored in your cart!");
                        vue.getMyCart();
                        vue.totalPriceInYourCart();
                    } else {
                        toastr.danger("Sorry, there is something wrong in this product, please select another.");
                    }
                });
        },
        storeAllSelectedCartData: function () {
            let vue = this;
            let all = vue.selectedProduct;

            var data = new FormData();
            data.append('Method', 'storeAllSelectedCart');
            data.append('cart_ids', all);
            axios.post('/uphols/Backend/Routes/Members/Customer/cart.php', data)
                .then(function (r) {
                    let result = r.data;
                    if (result == "false") {
                        vue.totalSelected = 0;
                    } else {
                        vue.totalSelected = result;
                    }
                });
        },
        purchaseSelectedItem: function () {
            var address = document.getElementById('address').value;
            var vue = this;
            var all = vue.selectedProduct;
            var popoverButton = document.getElementById('popoverButton');

            if (all != 0 || address != '') {
                if (all != 0) {
                    if (address != '') {
                        var data = new FormData();
                        data.append('Method', 'purchaseSelectedItem');
                        data.append('cart_ids', all);
                        data.append('address', address);
                        axios.post('/uphols/Backend/Routes/Members/Customer/cart.php', data)
                            .then(function (r) {
                                if (r.data == 200) {
                                    if (r.data == 200) {
                                        toastr.success("Successfully added to your order");
                                        for (let i = 0; i < all.length; i++) {
                                            popoverButton.setAttribute('data-bs-content', 'Successfully added to your order');
                                            vue.removeThisData(all[i]);
                                        }
                                    }
                                } else {
                                    popoverButton.setAttribute('data-bs-content', 'Something is wrong in the order');
                                }
                            });
                    } else {
                        popoverButton.setAttribute('data-bs-content', 'Select an Address');
                    }
                } else {
                    popoverButton.setAttribute('data-bs-content', 'Check an Item');
                }
            } else {
                popoverButton.setAttribute('data-bs-content', 'Select an Item');
            }
        },
        removeThisData: function (cart_id) {
            var vue = this;
            var data = new FormData();
            data.append('Method', 'destroySelectedCart');
            data.append('cart_id', cart_id);
            axios.post('/uphols/Backend/Routes/Members/Customer/cart.php', data)
                .then(function (r) {
                    if (r.data == 200) {
                        toastr.success("Successfully remove item");
                        vue.getMyCart();
                        vue.totalPriceInYourCart();
                    } else {
                        toastr.danger("Sorry, there is something wrong in this product, please select another.");
                    }
                });
        },
        updateThisCartQuality: function (cart_id) {
            var vue = this;
            var data = new FormData();
            let quantity = document.getElementById(cart_id);
            data.append('Method', 'updateThisCartQuality');
            data.append('quantity', quantity.value);
            data.append('cart_id', cart_id);
            axios.post('/uphols/Backend/Routes/Members/Customer/cart.php', data)
                .then(function (r) {
                    if (r.data == 200) {
                        vue.getMyCart();
                        vue.totalPriceInYourCart();
                        toastr.info("Successfully Updated one of the cart");
                    } else {
                        toastr.danger("Sorry, there is something wrong in this product, please select another.");
                    }
                });
        },
        getUserAddress: function () {
            var vue = this;
            var data = new FormData();
            data.append('Method', 'getUserAddress');
            axios.post('/uphols/Backend/Routes/Members/Customer/address.php', data)
                .then(function (r) {
                    vue.customerAddress = [];
                    for (var c of r.data) {
                        vue.customerAddress.push({
                            address_id: c.address_id,
                            user_id: c.user_id,
                            address_region: c.address_region,
                            address_province: c.address_province,
                            address_city: c.address_city,
                            address_barangay: c.address_barangay,
                            address_street: c.address_street,
                            address_zipCode: c.address_zipCode,
                            created_at: c.created_at,
                            updated_at: c.updated_at
                        });
                    }

                    vue.address_idssss = [];
                    for (var c of r.data) {
                        vue.address_idssss.push(c.address_id);
                    }

                })
        },
        purchaseAllItem: function (carts_id) {
            var address = document.getElementById('Alladdress').value;
            var vue = this;
            var all = carts_id;
            var popoverButton = document.getElementById('popoverButton');

            if (all != 0 || address != '') {
                if (all != 0) {
                    if (address != '') {
                        var data = new FormData();
                        data.append('Method', 'purchaseSelectedItem');
                        data.append('cart_ids', all);
                        data.append('address', address);
                        axios.post('/uphols/Backend/Routes/Members/Customer/cart.php', data)
                            .then(function (r) {
                                if (r.data == 200) {
                                    if (r.data == 200) {
                                        toastr.success("Purchased!");
                                        for (let i = 0; i < all.length; i++) {
                                            popoverButton.setAttribute('data-bs-content', 'Successfully added to your order');
                                            vue.removeThisData(all[i]);
                                        }
                                    }
                                } else {
                                    popoverButton.setAttribute('data-bs-content', 'Something is wrong in the order');
                                }
                            });
                    } else {
                        popoverButton.setAttribute('data-bs-content', 'Select an Address');
                    }
                } else {
                    popoverButton.setAttribute('data-bs-content', 'Check an Item');
                }
            } else {
                popoverButton.setAttribute('data-bs-content', 'Select an Item');
            }
        },
        minimum: function (address) {
            return address === Math.min(...this.address_idssss);
        },
        isShown: function () {
            let checkbox = null;
            let checkCheckedBox = document.querySelectorAll('input[type="checkbox"]:checked');

            for (let i = 0; i < checkCheckedBox.length; i++) {
                checkbox = checkCheckedBox[i];
            }

            if (checkbox == null) {
                document.getElementById('acceptSelected').classList.add('visually-hidden');
                document.getElementById('NoneSelected').classList.remove('visually-hidden');
            } else {
                document.getElementById('acceptSelected').classList.remove('visually-hidden');
                document.getElementById('NoneSelected').classList.add('visually-hidden');
            }
        }
    },
    created: function () {
        this.getAllRecommendedProduct();
        this.getMyCart();
        this.totalPriceInYourCart();
        this.getRecommendedProduct();
        this.getUserAddress();
    }
});

const profileCustomer = createApp({
    data() {
        return {
            customerInfo: [],
            customerAddress: [],
            address_idssss: [],
            customerInfoHeader: [],
            citiesOfCordova: [{ value: 'Talisay City', name: 'Talisay City' }, { value: 'Minglanilla', name: 'Minglanilla' }, { value: 'Naga City', name: 'Naga City' }, { value: 'San Fernando', name: 'San Fernando' }, { value: 'Carcar City', name: 'Carcar City' }, { value: 'Sibonga', name: 'Sibonga' }, { value: 'Dalaguete', name: 'Dalaguete' }, { value: 'Alegria', name: 'Alegria' }, { value: 'Santander', name: 'Santander' }, { value: 'Dumanjug', name: 'Dumanjug' }, { value: 'Argao', name: 'Argao' }, { value: 'Alcantara', name: 'Alcantara' }, { value: 'Alcoy', name: 'Alcoy' }, { value: 'Boljoon', name: 'Boljoon' }, { value: 'Malabuyoc', name: 'Malabuyoc' }, { value: 'Ronda', name: 'Ronda' }, { value: 'Badian', name: 'Badian' }, { value: 'Samboan', name: 'Samboan' }, { value: 'Oslob', name: 'Oslob' }, { value: 'Moalboal', name: 'Moalboal' }, { value: 'Ginatilan', name: 'Ginatilan' }, { value: 'Aloguinsan', name: 'Aloguinsan' }, { value: 'Asturias', name: 'Asturias' }, { value: 'Tuburan', name: 'Tuburan' }, { value: 'Barili', name: 'Barili' }, { value: 'Balamban', name: 'Balamban' }, { value: 'Toledo City', name: 'Toledo City' }, { value: 'Pinamungahan', name: 'Pinamungahan' }, { value: 'Santa Fe', name: 'Santa Fe' }, { value: 'Tabogon', name: 'Tabogon' }, { value: 'Madridejos', name: 'Madridejos' }, { value: 'Bantayan', name: 'Bantayan' }, { value: 'Bogo City', name: 'Bogo City' }, { value: 'Medellin', name: 'Medellin' }, { value: 'San Remigio', name: 'San Remigio' }, { value: 'Tabuelan', name: 'Tabuelan' }, { value: 'Daanbantayan', name: 'Daanbantayan' }, { value: 'Catmon', name: 'Catmon' }, { value: 'Poro', name: 'Poro' }, { value: 'Borbon', name: 'Borbon' }, { value: 'Danao City', name: 'Danao City' }, { value: 'Pilar', name: 'Pilar' }, { value: 'Sogod', name: 'Sogod' }, { value: 'Tudela', name: 'Tudela' }, { value: 'San Francisc', name: 'San Francisco' }, { value: 'Carmen', name: 'Carmen' }, { value: 'Compostela', name: 'Compostela' }, { value: 'Liloan', name: 'Liloan' }, { value: 'Cordova', name: 'Cordova' }, { value: 'Consolacion', name: 'Consolacion' }, { value: 'Mandaue City', name: 'Mandaue City' }],
            user_id: '',
            firstname: '',
            lastname: '',
            username: '',
            password: '',
            email: '',
            cities: '0',
            phone: '',
            status: '',
            code: '',
            role: '',
            oldCode: '',
            progressing: 1,
            profilePicture: '',
            selectedAddressDelete: 0,
            countAllOrder: 0,
            approvedOrdersArray: [],
            countAllCart: 0,
            totalRepaired: 0,
            changeOldPassword: '',
            selectedNotificationData: [],
            OrderNofitication: [],
        }
    },
    methods: {
        getAllInformation: function () {
            var vue = this;
            var data = new FormData();
            data.append('Method', 'customersInformation');
            axios.post('/uphols/Backend/Routes/Members/Customer/profile.php', data)
                .then(function (r) {
                    vue.customerInfo = [];
                    for (var c of r.data) {
                        vue.customerInfo.push({
                            user_id: c.user_id,
                            firstname: c.firstname,
                            lastname: c.lastname,
                            username: c.username,
                            email: c.email,
                            phone: c.phone,
                            stat: c.status,
                            code: c.code,
                            role: c.role,
                            profilePicture: c.profilePicture,
                            created_at: c.created_at,
                            updated_at: c.updated_at
                        });
                    }
                })
        },
        countSelectedCustomerCart: function () {
            var vue = this;
            var data = new FormData();
            data.append('Method', 'countSelectedCustomerCart');
            axios.post('/Uphols/backend/Routes/Members/customer/cart.php', data)
                .then(function (r) {
                    vue.countAllCart = r.data.totalCount;
                })
        },
        getAllInformationForHeader: function () {
            var vue = this;
            var data = new FormData();
            data.append('Method', 'customersInformation');
            axios.post('/uphols/Backend/Routes/Members/Customer/profile.php', data)
                .then(function (r) {
                    vue.customerInfoHeader = [];
                    for (var c of r.data) {
                        vue.customerInfoHeader.push({
                            user_id: c.user_id,
                            firstname: c.firstname,
                            lastname: c.lastname,
                            username: c.username,
                            email: c.email,
                            phone: c.phone,
                            stat: c.status,
                            code: c.code,
                            role: c.role,
                            profilePicture: c.profilePicture,
                            created_at: c.created_at,
                            updated_at: c.updated_at
                        });
                    }
                })
        },
        updateInformation: function (e) {
            var form = e.currentTarget;
            var vue = this;
            var data = new FormData(form);
            data.append('Method', 'updateInformation');
            axios.post('/uphols/Backend/Routes/Members/Customer/profile.php', data)
                .then(function (r) {
                    if (r.data == 200) {
                        vue.getAllInformation();
                        toastr.info("Successfully changed information");
                    } else {
                        toastr.danger("Cannot change your information, try to contact the owner.");
                    }
                })
        },
        getUserAddress: function () {
            var vue = this;
            var data = new FormData();
            data.append('Method', 'getUserAddress');
            axios.post('/uphols/Backend/Routes/Members/Customer/address.php', data)
                .then(function (r) {
                    vue.customerAddress = [];
                    for (var c of r.data) {
                        vue.customerAddress.push({
                            address_id: c.address_id,
                            user_id: c.user_id,
                            address_region: c.address_region,
                            address_province: c.address_province,
                            address_city: c.address_city,
                            address_barangay: c.address_barangay,
                            address_street: c.address_street,
                            address_zipCode: c.address_zipCode,
                            created_at: c.created_at,
                            updated_at: c.updated_at
                        });
                    }

                    vue.address_idssss = [];
                    for (var c of r.data) {
                        vue.address_idssss.push(c.address_id);
                    }

                })
        },
        addAddress: function (e) {
            var form = e.currentTarget;
            var vue = this;
            var data = new FormData(form);
            data.append('Method', 'storeAddress');
            axios.post('/uphols/Backend/Routes/Members/Customer/address.php', data)
                .then(function (r) {
                    if (r.data == 200) {
                        vue.getUserAddress();
                        toastr.info("Address added");
                    } else {
                        toastr.danger("Cannot add your address information, try to contact the owner.");
                    }
                })
        },
        selectedDeleteAddress: function (address_id) {
            this.selectedAddressDelete = address_id;
        },
        deleteAddress: function (address_id) {
            var vue = this;
            var data = new FormData();
            data.append('Method', 'deleteAddress');
            data.append('id', address_id);
            axios.post('/uphols/Backend/Routes/Members/Customer/address.php', data)
                .then(function (r) {
                    if (r.data == 200) {
                        vue.getUserAddress();
                        toastr.info("Address added");
                    } else {
                        toastr.danger("Cannot add your address information, try to contact the owner.");
                    }
                })
        },
        updateProfile: function (e) {
            e.preventDefault();
            let form = e.currentTarget;
            var vue = this;
            var data = new FormData(form);
            data.append('Method', 'changeProfile');
            axios.post('/uphols/Backend/Routes/Members/Customer/profile.php', data)
                .then(function (r) {
                    if (r.data == 200) {
                        vue.getAllInformation();
                        vue.getAllInformationForHeader();
                        toastr.info("Profile Updated!");
                    } else {
                        toastr.danger("Something is wrong about the picture. Please choose another.");
                    }
                })
        },
        getCustomerOrder: function () {
            var vue = this;
            var data = new FormData();
            data.append('Method', 'getCustomerOrder');
            axios.post('/Uphols/backend/Routes/Members/customer/order.php', data)
                .then(function (r) {
                    for (var v of r.data) {
                        vue.countAllOrder = r.data.length;
                        if (v.order_status == 1) {
                            vue.approvedOrdersArray.push(v.order_status);
                        }
                    }
                })
        },
        checkOldPassword: function () {
            let oldPassNotCorrect = document.getElementById('oldPassNotCorrect');
            let oldPassword = document.getElementById('oldPassword').value;
            let check = document.getElementById('checked');
            let changeToNewPassword = document.getElementById('changeToNewPassword');
            let checkPassword = document.getElementById('checkPassword');

            var vue = this;
            var data = new FormData();
            data.append('Method', 'checkOldPassword');
            data.append('oldPass', oldPassword);
            axios.post('/uphols/Backend/Routes/Members/Customer/profile.php', data)
                .then(function (r) {
                    for (var r of r.data) {
                        vue.changeOldPassword = r.password
                    }
                    if (!vue.changeOldPassword) {
                        oldPassNotCorrect.classList.remove('visually-hidden');
                    } else {
                        vue.progressing = 50;
                        oldPassNotCorrect.classList.add('visually-hidden');
                        check.classList.remove('visually-hidden');
                        changeToNewPassword.classList.remove('visually-hidden');
                        checkPassword.classList.add('visually-hidden');
                    }
                })
        },
        ViewInfomationDetails: function () {
            var searchParams = new URLSearchParams(window.location.search);
            var transac_id = searchParams.get("transac_id");

            var vue = this;
            var data = new FormData();
            data.append('Method', 'seletedCustomerData');
            data.append('transac_id', transac_id);
            axios.post('/uphols/Backend/Routes/Members/Customer/transaction.php', data)
                .then(function (r) {
                    vue.selectedNotificationData = [];

                    for (var c of r.data) {
                        vue.selectedNotificationData.push({
                            transac_id: c.transac_id,
                            created_at: c.created_at,
                            transac_quantity: c.transac_quantity,
                            transac_status: c.transac_status,
                            date_delivery: c.date_delivery,
                            product_picture: c.product_picture,
                            productName: c.productName,
                            productPrice: c.productPrice,
                            address_region: c.address_region,
                            address_province: c.address_province,
                            address_city: c.address_city,
                            address_barangay: c.address_barangay,
                            address_street: c.address_street,
                            address_zipCode: c.address_zipCode,
                        })
                    }
                })
        },
        changePassword: function (e) {
            e.preventDefault();
            let newPassword = document.getElementById('newPassword').value;
            let retypePassword = document.getElementById('retypePassword').value;
            let notMatch = document.getElementById('notMatch');

            if (newPassword == retypePassword) {
                var vue = this;
                let oldPass = vue.changeOldPassword;
                var data = new FormData();
                data.append('Method', 'changePassword');
                data.append('newPassword', newPassword);
                data.append('oldPassword', oldPass);
                axios.post('/uphols/Backend/Routes/Members/Customer/profile.php', data)
                    .then(function (r) {
                        if (r.data == 200) {
                            toastr.info("Successfully Updated!");
                            vue.progressing = 100;
                        } else {
                            toastr.danger("Cannot change password!");
                        }
                    })
            } else {
                e.preventDefault();
                notMatch.classList.remove('visually-hidden');
            }

        },
        minimum: function (address) {
            return address === Math.min(...this.address_idssss);
        },
        countAllMyRequest: function () {
            var vue = this;
            var data = new FormData();
            data.append('Method', 'countAllMyTotalRequest');
            axios.post('/uphols/Backend/Routes/Members/Customer/profile.php', data)
                .then(function (r) {
                    for (var v of r.data) {
                        vue.totalRepaired = v.totalRequest;
                    }
                })
        },
        viewInformationOfOrderNofitication: function () {
            var searchParams = new URLSearchParams(window.location.search);
            var id = searchParams.get("notif");

            var vue = this;
            var data = new FormData();
            data.append('Method', 'onApprove');
            data.append('transac_id', id);
            axios.post('/uphols/Backend/Routes/Members/Customer/transaction.php', data)
                .then(function (r) {
                    vue.OrderNofitication = [];
                    for (var c of r.data) {
                        vue.OrderNofitication.push({
                            firstname: c.firstname,
                            lastname: c.lastname,
                            email: c.email,
                            phone: c.phone,
                            transac_id: c.transac_id,
                            transac_quantity: c.transac_quantity,
                            date_delivery: c.date_delivery,
                            transac_status: c.transac_status,
                            created_at: c.created_at,
                            product_picture: c.product_picture,
                            productName: c.productName,
                            productPrice: c.productPrice,
                            address_region: c.address_region,
                            address_province: c.address_province,
                            address_city: c.address_city,
                            address_barangay: c.address_barangay,
                            address_street: c.address_street,
                            address_zipCode: c.address_zipCode,
                        })
                    }
                })
        },
        changeOldCode: function (id, old) {
            if (id == old) {
                var vue = this;
                var data = new FormData();
                data.append('Method', 'changeOldCode');
                data.append('oldCode', id);
                axios.post('/uphols/Backend/Routes/Members/Customer/profile.php', data)
                    .then(function (r) {
                        if (r.data == 200) {
                            document.getElementById('TheSameOldCode').classList.remove('visually-hidden');
                            window.location.reload();
                        } else {
                            toastr.error("Code Not Updated!");
                        }
                    })
            } else {
                document.getElementById('NotTheSameOldCode').classList.remove('visually-hidden');
            }

        },
    },
    created: function () {
        this.getAllInformation();
        this.getUserAddress();
        this.ViewInfomationDetails();
        this.getCustomerOrder();
        this.countSelectedCustomerCart();
        this.countAllMyRequest();
        this.viewInformationOfOrderNofitication();
    }
});

const profileCustomerHeader = createApp({
    data() {
        return {
            customerInfo: [],
            customerInfoHeader: [],
            customerOrders: [],
            totalMyCarts: 0,
            notification: 0,
            notificationData: [],
            OrderNofitication: [],
        }
    },
    methods: {
        getAllInformationForHeader: function () {
            var vue = this;
            var data = new FormData();
            data.append('Method', 'customersInformation');
            axios.post('/uphols/Backend/Routes/Members/Customer/profile.php', data)
                .then(function (r) {
                    vue.customerInfoHeader = [];
                    for (var c of r.data) {
                        vue.customerInfoHeader.push({
                            user_id: c.user_id,
                            firstname: c.firstname,
                            lastname: c.lastname,
                            username: c.username,
                            email: c.email,
                            phone: c.phone,
                            stat: c.status,
                            code: c.code,
                            role: c.role,
                            profilePicture: c.profilePicture,
                            created_at: c.created_at,
                            updated_at: c.updated_at
                        });
                    }
                })
        },
        countSelectedCustomerCart: function () {
            var vue = this;
            var data = new FormData();
            data.append('Method', 'countSelectedCustomerCart');
            axios.post('/Uphols/backend/Routes/Members/customer/cart.php', data)
                .then(function (r) {
                    vue.totalMyCarts = r.data.totalCount;
                    vue.countSelectedCustomerCart();
                })
        },
        ViewNotificationCount: function () {
            var vue = this;
            var data = new FormData();
            data.append('Method', 'AllCustomerTransaction');
            axios.post('/uphols/Backend/Routes/Members/Customer/transaction.php', data)
                .then(function (r) {
                    vue.notification = r.data.length;
                    vue.notificationData = [];
                    for (var c of r.data) {
                        vue.notificationData.push({
                            transac_id: c.transac_id,
                            transac_quantity: c.transac_quantity,
                            transac_status: c.transac_status,
                            date_delivery: c.date_delivery,
                            created_at: c.created_at,
                            product_picture: c.product_picture,
                            productName: c.productName,
                            productPrice: c.productPrice,
                        })
                    }
                })
        },
        dateToString: function (date) {
            let d = new Date(date);
            return d.toDateString();
        },
        formattedDate: function (time) {
            const dateObject = new Date(time);
            const year = dateObject.getFullYear();
            const month = (dateObject.getMonth() + 1).toString().padStart(2, '0');
            const day = dateObject.getDate().toString().padStart(2, '0');

            return `${month}-${day}-${year}`;
        },
        formattedTime: function (time) {
            const dateObject = new Date(time);
            const hours = dateObject.getHours().toString().padStart(2, '0');
            const minutes = dateObject.getMinutes().toString().padStart(2, '0');
            const seconds = dateObject.getSeconds().toString().padStart(2, '0');

            return `${hours}:${minutes}:${seconds}`;
        },
    },
    created: function () {
        this.getAllInformationForHeader();
        this.countSelectedCustomerCart();
        this.ViewNotificationCount();
    }
});

const customerOrder = createApp({
    data() {
        return {
            customerOrders: [],
            customerRequest: [],
            readMessage: '',
            dateDeliver: '',
            customerAllOrder: 0,
            searchOrderNow: null,
            selectedSort: 1,
            idCancel: 0,
        }
    },
    methods: {
        getCustomerOrder: function () {
            var vue = this;
            var data = new FormData();
            data.append('Method', 'getCustomerOrder');
            axios.post('/Uphols/backend/Routes/Members/customer/order.php', data)
                .then(function (r) {
                    vue.customerOrders = [];

                    for (var c of r.data) {
                        vue.customerOrders.push({
                            product_picture: c.product_picture,
                            productName: c.productName,
                            productDescription: c.productDescription,
                            productPrice: c.productPrice,
                            productQuantity: c.productQuantity,
                            productStatus: c.productStatus,
                            productSales: c.productSales,
                            order_quantity: c.order_quantity,
                            order_status: c.order_status,
                            id: c.id,
                        });
                    }
                })
        },
        getCustomerRequest: function () {
            var vue = this;
            var data = new FormData();
            data.append('Method', 'getCustomerRequest');
            axios.post('/uphols/Backend/Routes/Members/Customer/request.php', data)
                .then(function (r) {
                    vue.customerRequest = [];

                    for (var c of r.data) {
                        vue.customerRequest.push({
                            id: c.id,
                            address_id: c.address_id,
                            address_province: c.address_province,
                            address_city: c.address_city,
                            address_barangay: c.address_barangay,
                            address_street: c.address_street,
                            Types: c.Types,
                            color: c.color,
                            fabric: c.fabric,
                            message: c.message,
                            paymentMethod: c.paymentMethod,
                            paymentTotalPrice: c.paymentTotalPrice,
                            status: c.status,
                            created_at: c.created_at,
                        });
                    }
                })
        },
        viewMessage: function (id) {
            var vue = this;
            var data = new FormData();
            data.append('Method', 'getCustomerRequest');
            axios.post('/uphols/Backend/Routes/Members/Customer/request.php', data)
                .then(function (r) {

                    for (var c of r.data) {
                        if (c.id == id) {
                            vue.readMessage = c.message;
                        }
                    }
                })
        },
        viewDateDelivery: function (id) {
            var vue = this;
            var data = new FormData();
            data.append('Method', 'getCustomerRequest');
            axios.post('/uphols/Backend/Routes/Members/Customer/request.php', data)
                .then(function (r) {

                    for (var c of r.data) {
                        if (c.id == id) {
                            vue.dateDeliver = c.dateDeliver;
                        }
                    }
                })
        },
        countAllOrderFromCustomer: function () {
            var vue = this;
            var data = new FormData();
            data.append('Method', 'countAllOrderFromCustomer');
            axios.post('/Uphols/backend/Routes/Members/customer/order.php', data)
                .then(function (r) {
                    vue.customerAllOrder = r.data.totalNumber;
                })
        },
        requestCancel: function (id) {
            var vue = this;
            var data = new FormData();
            data.append('Method', 'cancelOrder');
            data.append('orderId', id);
            axios.post('/Uphols/backend/Routes/Members/customer/order.php', data)
                .then(function (r) {
                    vue.getCustomerOrder();
                })
        },
        backToPending: function (id) {
            var vue = this;
            var data = new FormData();
            data.append('Method', 'requestCancel');
            data.append('orderId', id);
            data.append('status', 3);
            axios.post('/Uphols/backend/Routes/Members/customer/order.php', data)
                .then(function (r) {
                    vue.getCustomerOrder();
                })
        },
        dateToString: function (date) {
            let d = new Date(date);
            return d.toDateString();
        },
        getId: function (id) {
            var vue = this;
            vue.idCancel = id;
        },
    },
    computed: {

        searchOrder: function () {
            if (!this.searchOrderNow) {
                return this.customerOrders;
            }

            return this.customerOrders.filter(customer => customer.productName.toLowerCase().includes(this.searchOrderNow.toLowerCase()));
        },

        searchRequest: function () {
            if (!this.searchOrderNow) {
                return this.customerRequest;
            }

            return this.customerRequest.filter(customer => customer.Types.toLowerCase().includes(this.searchOrderNow.toLowerCase()));
        }

    },
    created: function () {
        this.countAllOrderFromCustomer();
        this.getCustomerOrder();
        this.getCustomerRequest();
        this.getId();
    }
});

const request = createApp({
    data() {
        return {
            customerAddress: [],
            design: [],
            cheque: 2000,
            selectedType: 'selected',
            selectedColor: 'selected',
            selectedFabric: 'selected',
            addressSelected: 0,
            totalCheque: 1,
            totalCheque: 0,
        }
    },
    methods: {
        getUserAddress: function () {
            var vue = this;
            var data = new FormData();
            data.append('Method', 'getUserAddress');
            axios.post('/uphols/Backend/Routes/Members/Customer/address.php', data)
                .then(function (r) {
                    vue.customerAddress = [];
                    for (var c of r.data) {
                        vue.customerAddress.push({
                            address_id: c.address_id,
                            user_id: c.user_id,
                            address_region: c.address_region,
                            address_province: c.address_province,
                            address_city: c.address_city,
                            address_barangay: c.address_barangay,
                            address_street: c.address_street,
                            address_zipCode: c.address_zipCode,
                            created_at: c.created_at,
                            updated_at: c.updated_at
                        });
                    }

                    vue.address_idssss = [];
                    for (var c of r.data) {
                        vue.address_idssss.push(c.address_id);
                    }

                })
        },
        getAllDesign: function () {
            var vue = this;
            var data = new FormData();
            data.append('Method', 'getSelectAllRequestForms');
            axios.post('/uphols/Backend/Routes/Members/Admin/requestForms.php', data)
                .then(function (r) {
                    vue.design = [];
                    for (var p of r.data) {
                        vue.design.push({
                            requestForm_id: p.requestForm_id,
                            Types: p.Types,
                            typePrice: p.typePrice,
                            Color: p.Color,
                            colorPrice: p.colorPrice,
                            fabric: p.fabric,
                            fabricPrice: p.fabricPrice,
                            created_at: p.created_at,
                        })
                    }
                })
        },
        storeRequest: function (e) {
            e.preventDefault();
            var vue = this;
            var form = e.currentTarget;
            var data = new FormData(form);
            data.append('Method', 'storeRequest');
            data.append('paymentTotalPrice', this.totalCheque);
            axios.post('/uphols/Backend/Routes/Members/Customer/request.php', data)
                .then(function (r) {
                    if (r.data == 200) {
                        toastr.success('Costumize Project Form Successfully Sent to Admin');
                        setTimeout(window.location.reload(), 5000);
                    } else if (r.data == 400) {
                        toastr.error('Costumize Project Form Failed Sent to Admin');
                        setTimeout(window.location.reload(), 5000);
                    } else {
                        window.open(r.data, '_blank');
                    }
                })
        },
        scheduleRepair: function () {
            var vue = this;
            var data = new FormData();
            data.append('Method', 'scheduleRepair');
            data.append('address', vue.addressSelected);
            axios.post('/uphols/Backend/Routes/Members/Customer/request.php', data)
                .then(function (r) {
                    let rd = r.data;
                    alert(rd);
                    // if (rd == 200) {
                    //     window.location.href = "myorders.php";
                    // } else {
                    //     toastr.error('Cannot schedule this time. Please contact us.');
                    // }

                })
        },
        minimum: function (address) {
            return address === Math.min(...this.address_idssss);
        },
    },
    watch: {

        selectedType(newtype) {
            const selectedDesign = this.design.find(d => d.Types === newtype);
            this.cheque += selectedDesign ? selectedDesign.typePrice : null;
        },
        selectedColor(newtype) {
            const selectedDesign = this.design.find(d => d.Color === newtype);
            this.cheque += selectedDesign ? selectedDesign.colorPrice : null;
        },
        selectedFabric(newtype) {
            const selectedDesign = this.design.find(d => d.fabric === newtype);
            this.cheque += selectedDesign ? selectedDesign.fabricPrice : null;
        },

    },
    created: function () {
        this.getUserAddress();
        this.getAllDesign();
    },
    computed: {
        chequeDown() {
            // this.chequeDowns = parseInt(this.cheque * 0.40);
            return parseInt(this.cheque * 0.40);
        }
    }
});

CustomerLandingPage.mount('#customer-index');
CustomerCart.mount('#customer-cart');
profileCustomerHeader.mount('#customer-profile-header');
profileCustomer.mount('#customer-profile');
customerOrder.mount('#customer-Order');
request.mount('#customer-Request');