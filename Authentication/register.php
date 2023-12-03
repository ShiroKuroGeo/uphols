<?php
session_start();

if (isset($_SESSION['user_id'])) {
    if (!$role) {
        header("location: /uphols/Backend/Routes/Logout.php");
    } else if ($role == 1) {
        header("location: /uphols/Frontend/Public/Users/Admin/index.php");
    } else if ($role == 2) {
        header("location: /uphols/Frontend/Public/Users/Members/Employee/index.php");
    } else if ($role == 3) {
        header("location: /Uphols/Frontend/Public/Users/Members/Customer/profile.php");
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upholstery - Register</title>
    <link rel="stylesheet" href="/uphols/Assets/Plugins/Aos/Aos.min.css">
    <link rel="stylesheet" href="/uphols/Assets/Css/theme.min.css">
    <link rel="stylesheet" href="/uphols/Assets/Css/multistep.css">
    <link rel="stylesheet" href="/uphols/Assets/Css/functions.css">
    <script src="https://kit.fontawesome.com/d41feec2f9.js" crossorigin="anonymous"></script>
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/uphols/Assets/Plugins/Toastr/toastr.min.css">
    <link rel="stylesheet" href="/uphols/Assets/Plugins/Toastr/toastrColor.css">
    <link rel="stylesheet" href="/uphols/Assets/Css/authCustom.css">
</head>

<body>
    <div id="auth-content">
        <section class="container-fluid d-flex flex-column">
            <div class="row align-items-center justify-content-center min-vh-100">
                <div class="col-lg-4 col-md-8">
                    <div class="card shadow-lg" id="firstnameAndLast">
                        <div class="card-body p-6">
                            <div class="mb-3">
                                <div class="d-flex justify-content-center align-items-center mb-4">
                                    <a href="../index.php">
                                        <img src="/uphols/Assets/Images/mainLogo.png" width="170" alt="UpholsteryLogo">
                                    </a>
                                </div>
                                <h1 class="mb2 fs-4">Sign up</h1>
                                <span class="fs-5">Already have an account? <a href="login.php" class="ms-1">Sign in</a></span>
                                <div class="d-flex justify-content-between mt-2">
                                    <div :class="progressing >= 0 ? 'col-1 border rounded-circle  bg-primary text-center p-1 text-light' : 'col-1 border rounded-circle text-center p-1' ">1</div>
                                    <div :class="progressing >= 25 ? 'col-1 border rounded-circle bg-primary text-center p-1 text-light' : 'col-1 border rounded-circle text-center p-1' ">2</div>
                                    <div :class="progressing >= 50 ? 'col-1 border rounded-circle bg-primary text-center p-1 text-light' : 'col-1 border rounded-circle text-center p-1' ">3</div>
                                    <div :class="progressing >= 75 ? 'col-1 border rounded-circle bg-primary text-center p-1 text-light' : 'col-1 border rounded-circle text-center p-1' ">4</div>
                                </div>
                            </div>
                            <div class="form">
                                <div class="mb-4">
                                    <label for="username" class="form-label fs-6">Firstname</label>
                                    <input type="text" id="firstname" class="form-control" name="Firstname" placeholder="First Name" required>
                                </div>
                                <div class="mb-5">
                                    <label for="email" class="form-label fs-6">Lastname</label>
                                    <input type="text" id="lastname" class="form-control" name="Lastname" placeholder="Last Name" required>
                                </div>
                                <div class="alert alert-danger visually-hidden" id="flError" role="alert">
                                    Empty fields is found.
                                </div>
                                <div>
                                    <div class="d-grid">
                                        <button type="button" @click="nextAuth" class="btn btn-primary">
                                            Next
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card shadow-lg visually-hidden" id="fileAndNumber">
                        <div class="card-body p-6">
                            <div class="mb-3">
                                <a href="../index.php">
                                    <img src="/uphols/Assets/Images/mainLogo.png" width="90" alt="UpholsteryLogo">
                                </a>
                                <h1 class="mb2 fs-4">Sign up</h1>
                                <span class="fs-5">Already have an account? <a href="login.php" class="ms-1">Sign in</a></span>
                                <div class="d-flex justify-content-between mt-2">
                                    <div :class="progressing >= 0 ? 'col-1 border rounded-circle  bg-primary text-center p-1 text-light' : 'col-1 border rounded-circle text-center p-1' ">1</div>
                                    <div :class="progressing >= 25 ? 'col-1 border rounded-circle bg-primary text-center p-1 text-light' : 'col-1 border rounded-circle text-center p-1' ">2</div>
                                    <div :class="progressing >= 50 ? 'col-1 border rounded-circle bg-primary text-center p-1 text-light' : 'col-1 border rounded-circle text-center p-1' ">3</div>
                                    <div :class="progressing >= 75 ? 'col-1 border rounded-circle bg-primary text-center p-1 text-light' : 'col-1 border rounded-circle text-center p-1' ">4</div>
                                </div>
                            </div>
                            <div class="form">
                                <div class="mb-4">
                                    <label for="username" class="form-label fs-6">Profile Picture</label><br>
                                    <i class="fa fa-camera fa-4x" style="cursor: pointer" aria-hidden="true" onclick="document.getElementById('file').click()"></i>
                                    <input type="file" class="visually-hidden" name="file" id="file">
                                </div>
                                <div class="mb-5">
                                    <label for="email" class="form-label fs-6">Phone Number</label>
                                    <input type="number" class="form-control" name="Phone" id="phone">
                                </div>
                                <div class="alert alert-danger visually-hidden" id="numberError" role="alert">
                                    Number Should Atleast 11 digit number.
                                </div>
                                <div>
                                    <div class="d-grid">
                                        <button type="button" @click="nextAuth2nd" class="btn btn-primary">
                                            Next
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card shadow-lg visually-hidden" id="usernameAndEmail">
                        <div class="card-body p-6">
                            <div class="mb-3">
                                <a href="../index.php">
                                    <img src="/uphols/Assets/Images/mainLogo.png" width="90" alt="UpholsteryLogo">
                                </a>
                                <h1 class="mb2 fs-4">Sign up</h1>
                                <span class="fs-5">Already have an account? <a href="login.php" class="ms-1">Sign in</a></span>
                                <div class="d-flex justify-content-between mt-2">
                                    <div :class="progressing >= 0 ? 'col-1 border rounded-circle  bg-primary text-center p-1 text-light' : 'col-1 border rounded-circle text-center p-1' ">1</div>
                                    <div :class="progressing >= 25 ? 'col-1 border rounded-circle bg-primary text-center p-1 text-light' : 'col-1 border rounded-circle text-center p-1' ">2</div>
                                    <div :class="progressing >= 50 ? 'col-1 border rounded-circle bg-primary text-center p-1 text-light' : 'col-1 border rounded-circle text-center p-1' ">3</div>
                                    <div :class="progressing >= 75 ? 'col-1 border rounded-circle bg-primary text-center p-1 text-light' : 'col-1 border rounded-circle text-center p-1' ">4</div>
                                </div>
                            </div>
                            <div class="form">
                                <div class="mb-4">
                                    <label for="username" class="form-label fs-6">Username</label>
                                    <input type="text" id="username" class="form-control" name="Username" placeholder="Enter Username" required>
                                </div>
                                <div class="mb-5">
                                    <label for="email" class="form-label fs-6">Email</label>
                                    <input type="email" id="email" class="form-control" name="Email" placeholder="Enter Email" required>
                                </div>
                                <div class="alert alert-danger visually-hidden" id="emailError" role="alert">
                                    Email at least 10 digits. <br>
                                    Username at least 8 digits.
                                </div>
                                <div>
                                    <div class="d-grid">
                                        <button type="button" @click="nextAuth3rd" class="btn btn-primary">
                                            Next
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card shadow-lg visually-hidden" id="passwordAndRetype">
                        <div class="card-body p-6">
                            <div class="mb-3">
                                <a href="../index.php">
                                    <img src="/uphols/Assets/Images/mainLogo.png" width="90" alt="UpholsteryLogo">
                                </a>
                                <h1 class="mb2 fs-4">Sign up</h1>
                                <span class="fs-5">Already have an account? <a href="login.php" class="ms-1">Sign in</a></span>
                                <div class="d-flex justify-content-between mt-2">
                                    <div :class="progressing >= 0 ? 'col-1 border rounded-circle  bg-primary text-center p-1 text-light' : 'col-1 border rounded-circle text-center p-1' ">1</div>
                                    <div :class="progressing >= 25 ? 'col-1 border rounded-circle bg-primary text-center p-1 text-light' : 'col-1 border rounded-circle text-center p-1' ">2</div>
                                    <div :class="progressing >= 50 ? 'col-1 border rounded-circle bg-primary text-center p-1 text-light' : 'col-1 border rounded-circle text-center p-1' ">3</div>
                                    <div :class="progressing >= 75 ? 'col-1 border rounded-circle bg-primary text-center p-1 text-light' : 'col-1 border rounded-circle text-center p-1' ">4</div>
                                </div>
                            </div>
                            <div class="form">
                                <div class="mb-4">
                                    <label for="username" class="form-label fs-6">Password</label>
                                    <input type="password" id="password" class="form-control" name="Password" placeholder="***********" required>
                                </div>
                                <div class="mb-5">
                                    <label for="email" class="form-label fs-6">Retpye Password</label>
                                    <input type="password" id="retypepassword" class="form-control" name="retypepassword" placeholder="*********" required>
                                </div>
                                <div class="alert alert-danger visually-hidden" id="passwordError" role="alert">
                                    There is error in validations <br>
                                    Password is not match. <br>
                                    Or <br>
                                    Password at least 8 digits.
                                </div>
                                <div>
                                    <div class="d-grid">
                                        <button type="button" @click="nextAuth4th" class="btn btn-primary">
                                            Next
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <script src="/uphols/Backend/Middleware/Vue/axios.js"></script>
    <script src="/uphols/Backend/Middleware/Vue/vue.3.js"></script>
    <script src="/uphols/Backend/Middleware/Auth/Authentic.js"></script>
    <script src="/uphols/Assets/Js/jquery.js"></script>
    <script src="/uphols/Assets/Js/multistep.js"></script>
    <script src="/uphols/Assets/Js/theme.min.js"></script>
    <script src="/uphols/Assets/Plugins/Aos/Aos.min.js"></script>
    <script src="/uphols/Assets/Plugins/Toastr/toastr.min.js"></script>
    <script>
        AOS.init({
            duration: 2000
        });
    </script>
</body>

</html>