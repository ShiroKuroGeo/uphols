const { createApp } = Vue;

createApp({
    data() {
        return {
            confirmDataForResetPassword: [],
            selectWhatMethod: false,
            progressBarForResetPassword: 1,
            idToResetPassword: 0,
            codeToResetPassword: 0,
            progressing: 0,
            gmailForgotPassword: '',
            userEmail: '',
            verifyCodeEmail: '',
        }
    },
    methods: {
        Login: function (e) {
            e.preventDefault();
            var form = e.currentTarget;

            const vue = this;
            var data = new FormData(form);
            data.append("Method", "Login");
            axios.post('../Backend/Routes/Auth/Auth.php', data)
                .then(function (r) {
                    let rd = r.data;
                    if (rd == 3) {
                        window.location.href = "/Uphols/Frontend/Public/Users/Members/Customer/profile.php";
                        toastr.info("Succesfully Login as Customer");
                    } else if (rd == 2) {
                        toastr.info("Succesfully Login as Employee");
                        window.location.href = "/Uphols/Frontend/Public/Users/Members/Employee/index.php";
                    } else if (rd == 1) {
                        toastr.info("Succesfully Login as Admin");
                        window.location.href = "/Uphols/Frontend/Public/Users/Admin/index.php";
                    } else if (rd == 5) {
                        window.location.href = "/Uphols/Authentication/confirmLogin.php?email=" + vue.userEmail;
                    } else {
                        toastr.info("No Data Existing!");
                    }
                });
        },
        register: function (firstname, lastname, file, phone, username, email, password) {
            const vue = this;
            var data = new FormData();
            data.append("Method", "register");
            data.append("file", file);
            data.append("Firstname", firstname);
            data.append("Lastname", lastname);
            data.append("Username", username);
            data.append("Password", password);
            data.append("Email", email);
            data.append("Phone", phone);
            axios.post('../Backend/Routes/Auth/Auth.php', data)
                .then(function (r) {
                    if (r.data == 401) {

                        toastr.info("Email is already registered!");

                    } else {

                        window.location.href = "/Uphols/Authentication/confirmLogin.php?email=" + email;

                    }
                });
        },
        confirmEmail: function () {
            var ifNoDataExisted = document.getElementById('ifNoDataExisted');
            var cctrp = document.getElementById('confirmCodeToResetPassword');
            var eetrp = document.getElementById('enterEmailToResetPassword');

            const vue = this;
            var data = new FormData();
            data.append("Method", "forgotPassword");
            data.append("email", document.getElementById('emailInput').value);
            axios.post('../../Backend/Routes/Auth/Auth.php', data)
                .then(function (r) {
                    if (r.data != "") {
                        ifNoDataExisted.classList.add("visually-hidden");
                        cctrp.classList.remove("visually-hidden");
                        eetrp.classList.add("visually-hidden");
                        vue.progressBarForResetPassword = 34;
                    } else {
                        ifNoDataExisted.classList.remove("visually-hidden");
                    }
                });
        },
        resetPassword: function () {
            var myCode = document.getElementById('myCode').value;
            var codeNot = document.getElementById('ifCodeIsNotExisted');
            var cctrp = document.getElementById('confirmCodeToResetPassword');
            var rpn = document.getElementById('resetPasswordNow');

            const vue = this;
            var data = new FormData();
            data.append("Method", "getCode");
            data.append("code", myCode);
            axios.post('../../Backend/Routes/Auth/Auth.php', data)
                .then(function (r) {
                    if (r.data != "") {
                        codeNot.classList.add('visually-hidden');
                        cctrp.classList.add('visually-hidden');
                        cctrp.classList.add('visually-hidden');
                        rpn.classList.remove('visually-hidden');
                        vue.progressBarForResetPassword = 67;
                        for (var d of r.data) {
                            vue.idToResetPassword = d.user_id;
                            vue.codeToResetPassword = d.code;
                        }
                    } else {
                        codeNot.classList.remove('visually-hidden');
                    }
                });
        },
        changePassword: function () {
            if (document.getElementById("newPassword").value == document.getElementById("renewPassword").value) {
                document.getElementById("notTheSame").classList.add("visually-hidden");
                if (document.getElementById("newPassword").value.length >= 8) {
                    document.getElementById('eightletters').classList.add('visually-hidden');
                    const vue = this;
                    var data = new FormData();
                    data.append("Method", "changePasswordFromForgotPassword");
                    data.append("id", vue.idToResetPassword);
                    data.append("forgotPassword", vue.codeToResetPassword);
                    data.append("newpass", document.getElementById("newPassword").value);
                    axios.post('../../Backend/Routes/Auth/Auth.php', data)
                        .then(function (r) {
                            if (r.data == 200) {
                                document.getElementById('resetPasswordNow').classList.add('visually-hidden');
                                document.getElementById('allAreDone').classList.remove('visually-hidden');
                                vue.progressBarForResetPassword = 100;
                            } else {
                                alert(r.data);
                            }
                        });
                } else {
                    document.getElementById('eightletters').classList.remove('visually-hidden');
                }
            } else {
                document.getElementById("notTheSame").classList.remove("visually-hidden");
            }

        },
        changePasswordUsingGmail: function () {
            const vue = this;
            var data = new FormData();
            data.append("Method", "changePasswordUsingGmail");
            data.append("gmail", vue.gmailForgotPassword);
            axios.post('../../Backend/Routes/Auth/Auth.php', data)
                .then(function (r) {
                    alert("Successfull");
                });
        },
        changeMyPassword: function () {
            var searchParams = new URLSearchParams(window.location.search);
            var resetToken = searchParams.get("resetToken");


            if (document.getElementById('newPassword').value == document.getElementById('renewPassword').value) {
                const vue = this;
                var data = new FormData();
                data.append("Method", "changeMyPassword");
                data.append("resetToken", resetToken);
                data.append("newPassword", document.getElementById('renewPassword').value);
                axios.post('../../Backend/Routes/Auth/Auth.php', data)
                    .then(function (r) {
                        if (r.data == 200) {
                            alert('Change Password!');
                        } else {
                            alert('Password not changed!');
                        }
                    });
            } else {
                alert("Password not match!");
            }

        },
        nextAuth: function () {
            //First Name and Last Name
            if (document.getElementById('firstname').value != '' && document.getElementById('lastname').value != '') {

                document.getElementById('fileAndNumber').classList.remove('visually-hidden');
                document.getElementById('firstnameAndLast').classList.add('visually-hidden');
                this.progressing = 25;

            } else {
                document.getElementById('flError').classList.remove('visually-hidden');
            }

        },
        nextAuth2nd: function () {

            //Picture and Phone Number
            if (document.getElementById('phone').value.length >= 11) {

                document.getElementById('usernameAndEmail').classList.remove('visually-hidden');
                document.getElementById('fileAndNumber').classList.add('visually-hidden');
                this.progressing = this.progressing + 25;

            } else {
                document.getElementById('numberError').classList.remove('visually-hidden');
            }

        },
        nextAuth3rd: function () {

            //User Name and Email Address
            if (document.getElementById('username').value.length >= 8 && document.getElementById('email').value.length >= 10) {

                document.getElementById('passwordAndRetype').classList.remove('visually-hidden');
                document.getElementById('usernameAndEmail').classList.add('visually-hidden');
                this.progressing = this.progressing + 25;

                //Password and Confirm Password
                if (document.getElementById('password').value.length >= 8 && document.getElementById('retypepassword').value.length >= 8) {

                    if (document.getElementById('password').value == document.getElementById('retypepassword').value) {

                        this.progressing = this.progressing + 25;
                    }

                }

            } else {

                document.getElementById('emailError').classList.remove('visually-hidden');

            }

        },
        nextAuth4th: function () {

            //Password and Confirm Password
            if (document.getElementById('password').value.length >= 8 && document.getElementById('retypepassword').value.length >= 8) {

                if (document.getElementById('password').value == document.getElementById('retypepassword').value) {

                    this.progressing = this.progressing + 25;

                    this.register(
                        document.getElementById('firstname').value,
                        document.getElementById('lastname').value,
                        document.getElementById('file').files[0],
                        document.getElementById('phone').value,
                        document.getElementById('username').value,
                        document.getElementById('email').value,
                        document.getElementById('password').value
                    );

                }

            } else {

                document.getElementById('numberError').classList.remove('visually-hidden');

            }

        },
        verifyEmail: function () {
            var searchParams = new URLSearchParams(window.location.search);
            var email = searchParams.get("email");

            const vue = this;
            var data = new FormData();
            data.append("Method", "verifyEmail");
            data.append("verificationEmail", vue.verifyCodeEmail);
            data.append("email", email);
            axios.post('../Backend/Routes/Auth/Auth.php', data)
                .then(function (r) {
                    if (r.data == 200) {
                        window.location.href = "/Uphols/Authentication/login.php";
                    } else {
                        toastr.error("Verification is wrong!");
                    }
                });
        }
    },
    created: function () {

    }
}).mount('#auth-content')