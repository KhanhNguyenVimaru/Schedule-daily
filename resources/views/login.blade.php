<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Schedule Manage</title>
    <meta name="csrf-token" content="{{ csrf_token() }}"> <!-- CSRF token -->
    <link rel="icon" type="image/x-icon" href="https://cdn-icons-png.flaticon.com/512/8324/8324227.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr"
        crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
</head>
<style>
        body {
            font-family: "bahnschrift";
        }
        .divider:after,
        .divider:before {
            content: "";
            flex: 1;
            height: 1px;
            background: #eee;
        }
        .h-custom {
            height: calc(100% - 73px);
        }
        @media (max-width: 450px) {
            .h-custom {
                height: 100%;
            }
        }
        #login-container-main {
            border: 1px solid #e0e0e0;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            padding: 0;
            width: 50vw;
            margin-top: 120px;
        }
    </style>
<body>
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12 col-lg-10" id="login-container-main">
                    <div class="wrap d-md-flex" style="display:flex; justify-content:space-between">
                        <div class="text-wrap p-4 p-lg-5 text-center d-flex align-items-center order-md-last"
                            style="background-color: rgb(13, 110, 253); border-radius: 0px 5px 5px 0;">
                            <div class="text w-100">
                                <h2 style="color: white">Welcome to login</h2>
                                <p style="color: white">Don't have an account?</p>
                                <a style="color: white" href="{{route('page.signup')}}" class="btn btn-white btn-outline-white">Sign Up</a>
                            </div>
                        </div>
                        <div class="login-wrap p-4 p-lg-5" style="width:60%">
                            <div class="d-flex">
                                <div class="w-100">
                                    <h3 class="mb-4">Sign In</h3>
                                </div>
                                <div class="w-100">
                                    <p class="social-media d-flex justify-content-end">
                                        <!-- Icon social -->
                                        <a href="#" class="social-icon d-flex align-items-center justify-content-center"><span class="fa fa-facebook"></span></a>
                                        <a href="#" class="social-icon d-flex align-items-center justify-content-center"><span class="fa fa-twitter"></span></a>
                                    </p>
                                </div>
                            </div>
                            <!-- Thêm id="login-form" -->
                            <form id="login-form" class="signin-form">
                                <div class="form-group mb-3">
                                    <label class="label" for="email">Email</label>
                                    <input type="email" name="email" class="form-control" placeholder="Email" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label class="label" for="password">Password</label>
                                    <input type="password" name="password" class="form-control" placeholder="Password" required>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="form-control btn btn-primary submit px-3">
                                        Sign In
                                    </button>
                                </div>
                                <div class="form-group d-md-flex"
                                    style="display: flex; justify-content:space-between; margin-top:20px">
                                    <div class="w-50 text-left" style="display: flex;">
                                        <label class="checkbox-wrap checkbox-primary mb-0">
                                            <input type="checkbox" checked="">
                                            <span class="checkmark">Remember Me</span>
                                        </label>
                                    </div>
                                    <a href="#">Forgot Password</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q"
        crossorigin="anonymous"></script>

    <!-- Xử lý login -->
    <script>
        document.getElementById('login-form').addEventListener('submit', async function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            try {
                const response = await fetch('/login', {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: new URLSearchParams(formData)
                });
                const result = await response.json();
                if (response.ok) {
                    localStorage.setItem('token', result.access_token);
                    console.log(localStorage.getItem('token'));
                    alert('Login successful!');
                    window.location.href = '/dashboardPage';
                } else {
                    alert(result.error || 'Login failed.');
                }
            } catch (error) {
                alert('Error: ' + error.message);
                console.error(error);
            }
        });
    </script>
</body>

</html>
