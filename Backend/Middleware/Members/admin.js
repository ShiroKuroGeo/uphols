const { createApp } = Vue;

const Dashboard = createApp({
    data() {
        return {
            customerLength: 0,
            productLength: 0,
            recommendationLength: 0,
            ordersLength: 0,
            customers: [],
            products: [],
        }
    },
    methods: {
        getCountOfCustomer: function () {
            const vue = this;
            var data = new FormData();
            data.append("Method", "countAllUsers");
            axios.post('/uphols/Backend/Routes/Members/Admin/users.php', data)
                .then(function (r) {
                    for (var v of r.data) {
                        vue.customerLength = v.userCount;
                    }
                });
        },
        getCountOfProduct: function () {
            const vue = this;
            var data = new FormData();
            data.append("Method", "countAllProduct");
            axios.post('/uphols/Backend/Routes/Members/Admin/product.php', data)
                .then(function (r) {
                    for (var v of r.data) {
                        vue.productLength = v.totalProductCount;
                    }
                });
        },
        getCountOfRecommendation: function () {
            const vue = this;
            var data = new FormData();
            data.append("Method", "countAllRecommendation");
            axios.post('/uphols/Backend/Routes/Members/Admin/recommendation.php', data)
                .then(function (r) {
                    for (var v of r.data) {
                        vue.recommendationLength = v.totalRecommendationCount;
                    }
                });
        },
        getCountOfOrders: function () {
            const vue = this;
            var data = new FormData();
            data.append("Method", "countAllOrder");
            axios.post('/uphols/Backend/Routes/Members/Admin/orders.php', data)
                .then(function (r) {
                    vue.ordersLength = r.data.length;
                });
        },
        getAllLatestCustomer: function () {
            const vue = this;
            var data = new FormData();
            data.append("Method", "latestCustomer");
            axios.post('/uphols/Backend/Routes/Members/Admin/users.php', data)
                .then(function (r) {
                    vue.customers = [];
                    for (var c of r.data) {
                        vue.customers.push({
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
                });
        },
        selectAllProduct: function () {
            const vue = this;
            var data = new FormData();
            data.append("Method", "selectlatestProduct");
            axios.post('/uphols/Backend/Routes/Members/Admin/product.php', data)
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
                });
        },
        chartOfIndex: function () {

            const vue = this;
            var data = new FormData();
            data.append("Method", "selectAllColumn");
            axios.post('/uphols/Backend/Routes/Members/Admin/product.php', data)
                .then(function (r) {
                    var chartData = [];

                    r.data.forEach(function (d) {
                        chartData.push({
                            'totalData': d.total
                        })
                    });

                    var xValues = ["Orders", "Products", "Users", "Recommendation"];
                    var barColors = ["#7DCEA0", "#27AE60", "#1E8449", "#145A32"];


                    new Chart("indexChart", {
                        type: "doughnut",
                        data: {
                            labels: xValues,
                            datasets: [{
                                backgroundColor: barColors,
                                data: chartData.map(row => row.totalData)
                            }]
                        }
                    });
                });
        },
        theCalendar: function () {
            var vue = this;
            var data = new FormData();
            data.append('Method', 'getDateDelivery');
            axios.post('/uphols/Backend/Routes/Members/Admin/transactions.php', data)
                .then(function (r) {
                    var schedule = [];

                    r.data.forEach(function (item) {
                        schedule.push({
                            title: item.pn,
                            start: item.deli,
                            description: item.uname
                        });
                    });

                    var t = moment().startOf("day")
                        , e = t.format("YYYY-MM")
                        , i = t.clone().subtract(1, "day").format("YYYY-MM-DD")
                        , o = t.format("YYYY-MM-DD")
                        , t = t.clone().add(1, "day").format("YYYY-MM-DD")
                        , r = document.getElementById("calendar");
                    new FullCalendar.Calendar(r, {
                        headerToolbar: {
                            left: "prev,next today",
                            center: "title",
                            right: "dayGridMonth,timeGridWeek,timeGridDay,listMonth"
                        },
                        height: 900,
                        contentHeight: 800,
                        aspectRatio: 3,
                        nowIndicator: !0,
                        now: o + "T09:25:00",
                        initialView: "dayGridMonth",
                        initialDate: o,
                        editable: !0,
                        dayMaxEvents: !0,
                        navLinks: !0,
                        events: schedule
                    }).render()
                })
        }
    },
    created: function () {
        this.getCountOfCustomer(); this.getCountOfProduct(); this.getCountOfRecommendation(); this.getAllLatestCustomer(); this.selectAllProduct(); this.getCountOfOrders(); this.chartOfIndex(); this.theCalendar();
    }
});

const Customer = createApp({
    data() {
        return {
            custo: [],
            selectedUser: [],
            editSelectedUser: [],
            selectedUserCart: [],
            selectedCustomerOrder: [],
            selectedRole: 0,
            status: '',
            UserCount: 0,
            totalInfoCart: 0,
            totalInfoOrders: 0,
            searchUsers: null,
            dateCreated: '',
        }
    },
    methods: {
        getCustomer: function () {
            const vue = this;
            var data = new FormData();
            data.append("Method", "allUsers");

            axios.post('/uphols/Backend/Routes/Members/Admin/users.php', data)
                .then(function (r) {
                    vue.UserCount = r.data.length;
                    vue.custo = [];
                    for (var c of r.data) {
                        vue.custo.push({
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
                            created: c.created_at,
                            updated_at: c.updated_at
                        });
                    }
                });
        },
        dateToString: function (date) {
            let d = new Date(date);
            return d.toDateString();
        },
        viewMyCart: function () {
            var searchParams = new URLSearchParams(window.location.search);
            var user_id = searchParams.get("user_id");

            const vue = this;
            var data = new FormData();
            data.append("Method", "viewMyCart");
            data.append("user_id", user_id);
            axios.post('/uphols/Backend/Routes/Members/Admin/users.php', data)
                .then(function (r) {
                    vue.selectedUserCart = [];
                    for (var p of r.data) {
                        vue.selectedUserCart.push({
                            cart_id: p.cart_id,
                            user_id: p.user_id,
                            product_id: p.product_id,
                            quantityCart: p.quantityCart,
                            statusCart: p.statusCart,
                            product_picture: p.product_picture,
                            productName: p.productName,
                            productPrice: p.productPrice,
                            created: p.created_at,
                        });
                    }
                });
        },
        getCustomerOrder: function () {
            var searchParams = new URLSearchParams(window.location.search);
            var user_id = searchParams.get("user_id");

            const vue = this;
            var data = new FormData();
            data.append("Method", "getCustomerOrder");
            data.append("user_id", user_id);
            axios.post('/uphols/Backend/Routes/Members/Admin/users.php', data)
                .then(function (r) {
                    vue.selectedCustomerOrder = [];
                    for (var c of r.data) {
                        vue.selectedCustomerOrder.push({
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
                            created: c.created_at,
                        });
                    }
                });
        },
        userSelected: function () {
            var searchParams = new URLSearchParams(window.location.search);
            var user_id = searchParams.get("user_id");

            const vue = this;
            var data = new FormData();
            data.append("Method", "userSelected");
            data.append("user_id", user_id);
            axios.post('/uphols/Backend/Routes/Members/Admin/users.php', data)
                .then(function (r) {
                    vue.selectedUser = [];
                    for (var c of r.data) {
                        vue.selectedRole = c.role;
                        vue.selectedUser.push({
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
                            updated_at: c.updated_at,
                        });
                        vue.totalInfoCart = c.totalCart;
                        vue.totalInfoOrders = c.totalOrders;
                    }
                });
        },
        editUser: function (user_id) {
            const vue = this;
            var data = new FormData();
            data.append("Method", "userSelected");
            data.append("user_id", user_id);
            axios.post('/uphols/Backend/Routes/Members/Admin/users.php', data)
                .then(function (r) {
                    vue.editSelectedUser = [];
                    for (var c of r.data) {
                        vue.selectedRole = c.role;
                        vue.editSelectedUser.push({
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
                });
        },
        updateStatusOfUser: function (user_id) {
            const vue = this;
            var data = new FormData();
            data.append("Method", "updateStatusOfUser");
            data.append("status", vue.status);
            data.append("user_id", user_id);
            axios.post('/uphols/Backend/Routes/Members/Admin/users.php', data)
                .then(function (r) {
                    if (r.data == "200") {
                        toastr.success('Status updated');
                        vue.getCustomer();
                    } else {
                        toastr.danger('Status Not updated');
                    }
                });
        },
        codeAt: function (code) {
            return code.replace(/.(?=.{2})/g, "*");
        }
    },
    computed: {
        searchUser: function () {
            if (!this.searchUsers) {
                return this.custo;
            }

            var searchUser = this.searchUsers.toLowerCase();
            return this.custo.filter(cust => cust.firstname.toLowerCase().includes(searchUser));
        }
    },
    created: function () {
        this.getCustomer(); this.userSelected(); this.editUser(); this.viewMyCart(); this.getCustomerOrder();
    },
});

const recommendation = createApp({
    data() {
        return {
            dataRecommendation: [],
            recom: 0,
            dataSelectedRecommendation: [],
        }
    },
    methods: {
        selectAllRecommendation: function () {
            const vue = this;
            var data = new FormData();
            data.append("Method", "selectAllRecommendation");

            axios.post('/uphols/Backend/Routes/Members/Admin/recommendation.php', data)
                .then(function (r) {
                    vue.recom = r.data.length;
                    vue.dataRecommendation = [];
                    for (var c of r.data) {
                        vue.dataRecommendation.push({
                            id: c.id,
                            fullname: c.fullname,
                            email: c.email,
                            phoneNumber: c.phoneNumber,
                            message: c.message,
                            created_at: c.created_at,
                            updated_at: c.updated_at
                        });
                    }
                });
        },
        dateToString: function (date) {
            let d = new Date(date);
            return d.toDateString();
        },
        selectedRecommendationId: function () {
            var searchParams = new URLSearchParams(window.location.search);
            var recomId = searchParams.get("recomId");

            const vue = this;
            var data = new FormData();
            data.append("Method", "selectedRecommend");
            data.append("recommend_id", recomId);
            axios.post('/uphols/Backend/Routes/Members/Admin/recommendation.php', data)
                .then(function (r) {
                    vue.dataSelectedRecommendation = [];
                    for (var c of r.data) {
                        vue.dataSelectedRecommendation.push({
                            id: c.id,
                            fullname: c.fullname,
                            email: c.email,
                            phoneNumber: c.phoneNumber,
                            message: c.message,
                            created_at: c.created_at,
                            updated_at: c.updated_at
                        });
                    }
                });
        },
    },
    created: function () {
        this.selectAllRecommendation(); this.selectedRecommendationId();
    }
});

const order = createApp({
    data() {
        return {
            order: [],
            selectedOrder: [],
            selectedItem: [],
            totalInvoicePrice: 0,
            transac_status: '',
            date_delivery: '',
            firstname: '',
            lastname: '',
            email: '',
            phone: '',
            address_region: '',
            address_province: '',
            address_city: '',
            address_barangay: '',
            address_street: '',
            address_zipCode: '',
            errorMessage: 'Something is wrong!',
        }
    },
    methods: {
        getSelectAllOrder: function () {
            const vue = this;
            var data = new FormData();
            data.append("Method", "getSelectAllOrder");
            axios.post('/uphols/Backend/Routes/Members/Admin/orders.php', data)
                .then(function (r) {
                    vue.order = [];
                    for (var c of r.data) {
                        vue.order.push({
                            customer_id: c.customer_id,
                            order_status: c.order_status,
                            firstname: c.firstname,
                            lastname: c.lastname,
                        });
                    }
                });
        },
        getSelectedCustomerOrder: function () {
            var searchParams = new URLSearchParams(window.location.search);
            var invoice = searchParams.get("invoice");

            var vue = this;
            var data = new FormData();
            data.append('Method', 'getSelectedCustomerOrder');
            data.append("orderId", invoice);
            axios.post('/uphols/Backend/Routes/Members/Admin/orders.php', data)
                .then(function (r) {
                    vue.selectedOrder = [];
                    for (var c of r.data) {
                        vue.firstname = c.firstname;
                        vue.lastname = c.lastname;
                        vue.email = c.email;
                        vue.phone = c.phone;
                        vue.address_region = c.address_region;
                        vue.address_province = c.address_province;
                        vue.address_city = c.address_city;
                        vue.address_barangay = c.address_barangay;
                        vue.address_street = c.address_street;
                        vue.address_zipCode = c.address_zipCode;

                        vue.selectedOrder.push({
                            id: c.id,
                            customer_id: c.customer_id,
                            product_id: c.product_id,
                            address_id: c.address_id,
                            order_quantity: c.order_quantity,
                            order_status: c.order_status,
                            created_at: c.created_at,
                            updated_at: c.updated_at,
                            product_picture: c.product_picture,
                            productName: c.productName,
                            productDescription: c.productDescription,
                            productPrice: c.productPrice,
                            productQuantity: c.productQuantity,
                            productStatus: c.productStatus,
                            productSales: c.productSales,
                        });
                    }
                })
        },
        getUpdateQuantityInApproval: function (orderId, status, customerId, gmail) {
            if (status == 1) {
                this.ApproveAll(1, customerId, orderId, gmail);
                this.approvalToTransaction(customerId, orderId, 1);
            } else {
                toastr.error(this.errorMessage);
            }
        },
        getAllApproveCustomersOrder: function (gmail) {
            var searchParams = new URLSearchParams(window.location.search);
            var invoice = searchParams.get("invoice");

            document.getElementById('selectedItem').checked = false;

            let getAllSelectedItems = this.selectedItem;

            for (let i = 0; i < getAllSelectedItems.length; i++) {
                this.ApproveAll(1, invoice, getAllSelectedItems[i], gmail);
                this.approvalToTransaction(invoice, getAllSelectedItems[i], 1);
                this.getUpdateAllTransactionTotalPrice();
                this.getSelectedCustomerOrder();
            }
        },
        ApproveAll: function (status, customerId, id, gmail) {
            var data = new FormData();
            data.append('Method', 'getAllApproveCustomersOrder');
            data.append("status", status);
            data.append("orderId", id);
            data.append("customer", customerId);
            data.append("gmail", gmail);
            axios.post('/uphols/Backend/Routes/Members/Admin/orders.php', data)
                .then(function (r) {
                    alert(r.data);
                    this.getSelectedCustomerOrder();
                    if (r.data == 400) {
                        toastr.error('Something is missing!');
                    }
                })
        },
        approvalToTransaction: function (customerId, id, status) {
            var data = new FormData();
            data.append('Method', 'getOrderToTransaction');
            data.append("orderId", id);
            data.append("status", status);
            data.append("customerId", customerId);
            axios.post('/uphols/Backend/Routes/Members/Admin/transactions.php', data)
                .then(function (r) {
                    alert(r.data);
                    this.getSelectedCustomerOrder();
                    if (r.data == 400) {
                        toastr.error('Something is missing!');
                    }
                })
        },
        getUpdateAllTransactionTotalPrice: function () {
            var searchParams = new URLSearchParams(window.location.search);
            var customerId = searchParams.get("invoice");
            var vue = this;
            var data = new FormData();
            data.append('Method', 'getSelectAll');
            data.append("customerId", customerId);
            axios.post('/uphols/Backend/Routes/Members/Admin/transactions.php', data)
                .then(function (r) {
                    vue.totalInvoicePrice = 0;
                    for (var c of r.data) {
                        vue.totalInvoicePrice = parseInt(vue.totalInvoicePrice + c.transac_totalPrice);
                        vue.getUpdateAllTransactionTotalPrice();
                    }
                })
        },
        getSelectedUserTransaction: function (id) {
            var searchParams = new URLSearchParams(window.location.search);
            var customerId = searchParams.get("invoice");

            var vue = this;
            var data = new FormData();
            data.append('Method', 'getSelectedUserTransaction');
            data.append("customerId", customerId);
            axios.post('/uphols/Backend/Routes/Members/Admin/transactions.php', data)
                .then(function (r) {
                    for (var c of r.data) {
                        vue.transac_status = c.transac_status;
                        vue.date_delivery = c.date_delivery;
                    }
                })
        },
        chartForUsers: function () {
            var vue = this;
            var data = new FormData();
            data.append('Method', 'getOrderUserChart');
            axios.post('/uphols/Backend/Routes/Members/Admin/orders.php', data)
                .then(function (r) {
                    const monthNumbers = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12];
                    const monthNames = [
                        "January", "February", "March", "April",
                        "May", "June", "July", "August",
                        "September", "October", "November", "December"
                    ];

                    var chartData = [];

                    r.data.forEach(function (d) {
                        chartData.push({
                            'current_month': d.current_month,
                            'total': d.totalIds,
                        })
                    });

                    const selectedMonth = chartData.map(row => row.current_month);
                    const selectedMonthNames = selectedMonth.map((monthNumber) => {
                        return monthNames[monthNumber - 1];
                    });

                    var months = selectedMonthNames;
                    var dataOfMonth = chartData.map(row => row.total);
                    var colorEveryMonth = ["red", "blue", "yellow", "purple", "green"];

                    new Chart("orderChart", {
                        type: "bar",
                        data: {
                            labels: months,
                            datasets: [{
                                backgroundColor: colorEveryMonth,
                                data: dataOfMonth
                            }]
                        },
                        options: {
                            legend: { display: false },
                            title: {
                                display: true,
                                text: "Upholstery Orders"
                            }
                        }
                    });
                })
        },
    },
    created: function () {this.getSelectAllOrder();this.getSelectedCustomerOrder();this.getUpdateAllTransactionTotalPrice();this.getSelectedUserTransaction();this.chartForUsers();}
});

const request = createApp({
    data() {
        return {
            request: [], allInfoRequest: [], design: [], dateCreated: '', price: '', date: '', dateDeliver: '', selectStatusOption: 0, isShown: false,}
    },
    methods: {
        updateStatus: function (id, gmail) {
            var vue = this;
            if (vue.selectStatusOption != 0) {
                var data = new FormData();
                data.append('Method', 'updateStatus');
                data.append('id', id);
                data.append('status', vue.selectStatusOption);
                data.append('dateDeliver', vue.dateDeliver);
                data.append('gmail', gmail);
                axios.post('/uphols/Backend/Routes/Members/Admin/request.php', data)
                    .then(function (r) {
                        if (r.data == 200) {
                            toastr.success('Updated');
                            vue.getAllInfoRequest();
                        }
                    })
            } else {
                document.getElementById('errorAlert').classList.remove('visually-hidden');
            }
        },
        viewMyRequest: function () {
            const vue = this;
            vue.isShown = !vue.isShown;
        },
        dateToString: function (date) {
            let d = new Date(date);
            return d.toDateString();
        },
        getAllInfoRequest: function () {
            var searchParams = new URLSearchParams(window.location.search);
            var invoice = searchParams.get("invoice");

            var vue = this;
            var data = new FormData();
            data.append('Method', 'getAllInfoRequest');
            data.append('ID', invoice);
            axios.post('/uphols/Backend/Routes/Members/Admin/request.php', data)
                .then(function (r) {
                    vue.allInfoRequest = [];

                    for (var req of r.data) {
                        let data = new Date(req.created_at);
                        let dateDel = new Date(req.dateDeliver);
                        vue.dateCreated = data.toDateString();
                        vue.selectStatusOption = req.status;
                        vue.dateDeliver = dateDel.toDateString();
                        vue.allInfoRequest.push({
                            id: req.id,
                            Types: req.Types,
                            color: req.color,
                            message: req.message,
                            paymentMethod: req.paymentMethod,
                            status: req.status,
                            firstname: req.firstname,
                            lastname: req.lastname,
                            phone: req.phone,
                            email: req.email,
                            dateDeliver: req.dateDeliver,
                            address_region: req.address_region,
                            address_province: req.address_province,
                            address_city: req.address_city,
                            address_barangay: req.address_barangay,
                            address_street: req.address_street,
                            address_zipCode: req.address_zipCode
                        })
                    }
                })
        },
        getInfoRequest: function () {
            var vue = this;
            var data = new FormData();
            data.append('Method', 'getInfoRequest');
            axios.post('/uphols/Backend/Routes/Members/Admin/request.php', data)
                .then(function (r) {
                    vue.request = [];

                    for (var req of r.data) {
                        vue.request.push({
                            id: req.id,
                            status: req.status,
                            lastname: req.lastname,
                            firstname: req.firstname,
                        })
                    }
                })
        },
        storeRequest: function (e) {
            e.preventDefault();

            var searchParams = new URLSearchParams(window.location.search);
            var invoice = searchParams.get("invoice");

            var vue = this;
            var form = e.currentTarget;
            var data = new FormData(form);
            data.append('Method', 'doStoreScheduleRepairFunction');
            data.append('id', invoice);
            data.append('paymentTotalPrice', vue.price);
            data.append('date', vue.date);
            axios.post('/uphols/Backend/Routes/Members/Admin/request.php', data)
                .then(function (r) {
                    if (r.data == 200) {
                        toastr.success('Costumize Project Form Successfully Sent to User');
                    } else {
                        toastr.error('Costumize Project Form Failed Sent to User');
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
        chartForUsers: function () {
            var vue = this;
            var data = new FormData();
            data.append('Method', 'getDateAndTotalId');
            axios.post('/uphols/Backend/Routes/Members/Admin/request.php', data)
                .then(function (r) {
                    const monthNumbers = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12];
                    const monthNames = [
                        "January", "February", "March", "April",
                        "May", "June", "July", "August",
                        "September", "October", "November", "December"
                    ];

                    var chartData = [];

                    r.data.forEach(function (d) {
                        chartData.push({
                            'current_month': d.current_month,
                            'total': d.totalIds,
                        })
                    });

                    const selectedMonth = chartData.map(row => row.current_month);
                    const selectedMonthNames = selectedMonth.map((monthNumber) => {
                        return monthNames[monthNumber - 1];
                    });

                    var months = selectedMonthNames;
                    var dataOfMonth = chartData.map(row => row.total);
                    var colorEveryMonth = ["purple", "yellow", "blue", "red"];

                    new Chart("requestChart", {
                        type: "bar",
                        data: {
                            labels: months,
                            datasets: [{
                                backgroundColor: colorEveryMonth,
                                data: dataOfMonth
                            }]
                        },
                        options: {
                            legend: { display: false },
                            title: {
                                display: true,
                                text: "Upholstery Requests"
                            }
                        }
                    });
                })
        }
    },
    created: function () {
        this.getInfoRequest();this.getAllInfoRequest();this.chartForUsers();this.getAllDesign();
    }
});

const product = createApp({
    data() {
        return {
            product: [],
            productLength: 0,
            productQuantity: [],
            productActive: [],
            productQuantityTotalSale: 0,
            activeProductStatus: 0,
            showdDeleteProduct: [],
            DeleteSelectedProduct: [],
            UpdateSelectedProduct: [],
            searchProduct: null,
        }
    },
    methods: {
        getAllProduct: function () {
            var vue = this;
            var data = new FormData();
            data.append('Method', 'selectAllProduct');
            axios.post('/uphols/Backend/Routes/Members/Admin/product.php', data)
                .then(function (r) {
                    vue.product = [];
                    for (var p of r.data) {
                        vue.product.push({
                            product_id: p.product_id,
                            product_picture: p.product_picture,
                            productName: p.productName,
                            productDescription: p.productDescription,
                            productPrice: p.productPrice,
                            productQuantity: p.productQuantity,
                            productStatus: p.productStatus,
                            productSales: p.productSales,
                        });
                        if (p.productStatus == 1) {
                            vue.productActive.push(p.productStatus)
                            var productActive = vue.productActive;

                            vue.activeProductStatus = productActive.length;
                        }

                        vue.productQuantity.push(p.productQuantity)
                    }

                    var quantitySale = vue.productQuantity;
                    for (let i = 0; i < quantitySale.length; i++) {
                        if (quantitySale[i] <= 0) {
                            vue.productQuantityTotalSale += 1;
                        } else if (quantitySale[i] >= 0) {
                            vue.productLength += 1;;
                        }
                    }

                })
        },
        getStoreProduct: function (e) {
            e.preventDefault();
            var vue = this;
            var form = e.currentTarget;
            console.log(form);
            var data = new FormData(form);
            data.append('Method', 'getStoreProduct');
            axios.post('/uphols/Backend/Routes/Members/admin/product.php', data)
                .then(function (r) {
                    if (r.data == 200) {
                        toastr.success('Successfully added to list.');
                        vue.getStoreProduct();
                    } else {
                        toastr.error("Product cannot add!");
                    }
                })
        },
        deleteProduct: function (id) {
            var vue = this;
            var data = new FormData();
            data.append('Method', 'showdDeleteProduct');
            data.append('ProductId', id);
            axios.post('/uphols/Backend/Routes/Members/Admin/product.php', data)
                .then(function (r) {
                    vue.showdDeleteProduct = [];
                    for (var p of r.data) {
                        vue.showdDeleteProduct.push({
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
                })
        },
        deleteSelectedProduct: function (id) {
            var vue = this;
            var data = new FormData();
            data.append('Method', 'deleteSelectedProduct');
            data.append('ProductId', id);
            axios.post('/uphols/Backend/Routes/Members/Admin/product.php', data)
                .then(function (r) {
                    if (r.data == 200) {
                        vue.getAllProduct();
                        toastr.success('Successfully Delete this product!');
                    } else {
                        toastr.error('Something is wrong about this product!.');
                    }
                })
        },
        updateSelectedProduct: function (id) {
            var productName = document.getElementById('productName');
            var productQuantity = document.getElementById('productQuantity');
            var productPrice = document.getElementById('productPrice');
            var productStatus = document.getElementById('productStatus');
            var productDescription = document.getElementById('productDescription');

            var vue = this;
            var data = new FormData();
            data.append('Method', 'updateSelectedProduct');
            data.append('ProductId', id);
            data.append('productName', productName.value);
            data.append('productQuantity', productQuantity.value);
            data.append('productPrice', productPrice.value);
            data.append('productStatus', productStatus.value);
            data.append('productDescription', productDescription.value);
            axios.post('/uphols/Backend/Routes/Members/Admin/product.php', data)
                .then(function (r) {
                    toastr.success(r.data);
                })
        },
        chartProduct: function () {
            var vue = this;
            var data = new FormData();
            data.append('Method', 'selectAllDisplayedProduct');
            axios.post('/uphols/Backend/Routes/Members/Admin/product.php', data)
                .then(function (r) {
                    let productLength = vue.productLength;
                    let activeProductStatus = vue.activeProductStatus;
                    let productQuantityTotalSale = vue.productQuantityTotalSale;

                    let arrays = [productLength, activeProductStatus, productQuantityTotalSale];

                    var xValues = ["Total Product", "Active Product", "Total Sales"];
                    var barColors = ["red", "green", "blue"];

                    new Chart("productChart", {
                        type: "pie",
                        data: {
                            labels: xValues,
                            datasets: [{
                                backgroundColor: barColors,
                                data: arrays
                            }]
                        },
                        options: {
                            title: {
                                display: true,
                                text: "World Wide Wine Production"
                            }
                        }
                    });
                })
        },
    },
    computed: {
        searchProducts: function () {
            if (!this.searchProduct) {
                return this.product;
            }

            var searchProductTerm = this.searchProduct.toLowerCase();

            return this.product.filter(pro => pro.productName.toLowerCase().includes(searchProductTerm));
        }
    },
    created: function () {
        this.getAllProduct();this.chartProduct();
    }
});

const designAdmin = createApp({
    data() {
        return {
            design: [],
            selectedDesign: [],
            designLenght: 0,
            searchThisDesign: null,
        }
    },
    methods: {
        getAllDesign: function () {
            var vue = this;
            var data = new FormData();
            data.append('Method', 'getSelectAllRequestForms');
            axios.post('/uphols/Backend/Routes/Members/Admin/requestForms.php', data)
                .then(function (r) {
                    vue.designLenght = r.data.length;
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
        dateToString: function (date) {
            let d = new Date(date);
            return d.toDateString();
        },
        getDesignData: function (id) {
            var vue = this;
            var data = new FormData();
            data.append('Method', 'getSelectAllRequestForms');
            axios.post('/uphols/Backend/Routes/Members/Admin/requestForms.php', data)
                .then(function (r) {
                    vue.selectedDesign = [];
                    for (var p of r.data) {
                        if (p.requestForm_id == id) {
                            vue.selectedDesign.push({
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
                    }
                })
        },
        storeCustomization: function (e) {
            var vue = this;
            var form = e.currentTarget;
            var data = new FormData(form);
            data.append('Method', 'storeCustomization');
            axios.post('/uphols/Backend/Routes/Members/Admin/requestForms.php', data)
                .then(function (r) {
                    if (r.data == 200) {
                        vue.getAllDesign();
                        toastr.success('Data successfully Added');
                    } else {
                        toastr.error('Data not inserted!');
                    }
                })
        },
        deleteDesignId: function (id) {
            var vue = this;
            var data = new FormData();
            data.append('Method', 'deleteDesignId');
            data.append('designId', id);
            axios.post('/uphols/Backend/Routes/Members/Admin/requestForms.php', data)
                .then(function (r) {
                    if (r.data == 200) {
                        vue.getAllDesign();
                        toastr.success('Data successfully Deleted');
                    } else {
                        toastr.success('Data not Deleted');
                    }
                })
        },
        updateDesignId: function (id) {
            var vue = this;
            var data = new FormData();
            data.append('Method', 'updateDesignId');
            data.append('designId', id);
            data.append('typesUpdate', document.getElementById('typesUpdate').value);
            data.append('TypesPriceUpdate', document.getElementById('TypesPriceUpdate').value);
            data.append('colorUpdate', document.getElementById('colorUpdate').value);
            data.append('colorPriceUpdate', document.getElementById('colorPriceUpdate').value);
            data.append('fabricUpdate', document.getElementById('fabricUpdate').value);
            data.append('fabricPriceUpdate', document.getElementById('fabricPriceUpdate').value);
            axios.post('/uphols/Backend/Routes/Members/Admin/requestForms.php', data)
                .then(function (r) {
                    if (r.data == 200) {
                        vue.getAllDesign();
                    } else {
                        toastr.success('Data not Updated');
                    }
                })
        },
    },
    computed: {
        searchDesign: function () {
            if (!this.searchThisDesign) {
                return this.design;
            }

            var searchDesignTerm = this.searchThisDesign.toLowerCase();

            return this.design.filter(des => des.Types.toLowerCase().includes(searchDesignTerm));
        }
    },
    created: function () {
        this.getAllDesign();
    }
});

Dashboard.mount('#Dashboard-admin');
Customer.mount('#customer-admin');
order.mount('#order-admin');
recommendation.mount('#recommendation-admin');
product.mount('#product-admin');
designAdmin.mount('#design-admin');
request.mount('#request-admin');