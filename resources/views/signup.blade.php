<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Schedule Manage</title>
    <meta name="csrf-token" content="{{ csrf_token() }}"> <!-- CSRF token for backend -->
    <link rel="icon" type="image/x-icon" href="https://cdn-icons-png.flaticon.com/512/8324/8324227.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <!-- Bootstrap Icons CDN -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.3/font/bootstrap-icons.min.css">

    <style>
        body {
            font-family: "Bahnschrift", sans-serif;
            min-height: 100vh;
            width: 100%;
        }

        .card-registration {
            border-radius: 15px;
            background: #fff;
        }

        .card-registration .form-control {
            font-size: 14px;
            padding: 10px;
        }

        .input-group-text {
            background-color: #f8f9fa;
        }

        .form-check-label a {
            color: #0d6efd;
            text-decoration: none;
        }

        .form-check-label a:hover {
            text-decoration: underline;
        }

        .btn-primary {
            background-color: #0d6efd;
            border: none;
            padding: 10px 20px;
        }

        .btn-primary:hover {
            background-color: #0b5ed7;
        }

        .invalid-feedback {
            font-size: 12px;
        }
    </style>
</head>

<body>
    <section class="vh-100 gradient-custom">
        <div class="container py-5 h-100">
            <div class="row justify-content-center align-items-center h-100">
                <div class="col-12 col-lg-9 col-xl-7" style="width: 50%;">
                    <div class="card shadow-2-strong card-registration" style=" border: 1px solid #e0e0e0;box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                        <div class="card-body p-4 p-md-5">
                            <h4 class="mb-4 pb-2 pb-md-0 mb-md-5" style="margin-bottom: 30px !important;">Sign Up</h4>
                            <form action="{{route('api.register')}}" method="post" novalidate>
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <p class="text-muted">Please fill in this form to create an account!</p>
                                <hr>
                                <div class="form-group mb-3">
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="bi bi-person"></i> </span>
                                        <input type="text" class="form-control" name="name"
                                            placeholder="Username" required aria-describedby="usernameFeedback"
                                            fdprocessedid="8u5e1p">
                                        <div id="usernameFeedback" class="invalid-feedback">
                                            Please enter a valid username.
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group mb-3">
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="bi bi-envelope"></i>
                                        </span>
                                        <input type="email" class="form-control" name="email"
                                            placeholder="Email Address" required aria-describedby="emailFeedback"
                                            fdprocessedid="01e4xu">
                                        <div id="emailFeedback" class="invalid-feedback">
                                            Please enter a valid email address.
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group mb-3">
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="bi bi-lock"></i>
                                        </span>
                                        <input type="password" class="form-control" name="password"
                                            placeholder="Password" required aria-describedby="passwordFeedback"
                                            fdprocessedid="uve0fr">
                                        <div id="passwordFeedback" class="invalid-feedback">
                                            Password must be at least 6 characters.
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group mb-3">
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="bi bi-shield"></i>
                                        </span>
                                        <input type="password" class="form-control" name="password_confirmation"
                                            placeholder="Confirm Password" required
                                            aria-describedby="password_confirmation" fdprocessedid="bz50dr">
                                        <div id="password_confirmation" class="invalid-feedback">
                                            Passwords do not match.
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="terms" required>
                                        <label class="form-check-label" for="terms" style="font-size: 16px">
                                            I accept the <a href="#">Terms of Use</a> & <a href="#">Privacy
                                                Policy</a>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="submit" value="Sign Up" class = "btn btn-primary">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script>
        // Basic client-side validation
        document.querySelector('form').addEventListener('submit', async function(e) {
            e.preventDefault();
            const password = document.querySelector('input[name="password"]').value;
            const confirmPassword = document.querySelector('input[name="password_confirmation"]').value;
            const name = document.querySelector('input[name="name"]').value;
            const email = document.querySelector('input[name="email"]').value;

            let valid = true;
            if (name.length < 3) {
                document.querySelector('input[name="name"]').classList.add('is-invalid');
                valid = false;
            }
            if (!email.includes('@')) {
                document.querySelector('input[name="email"]').classList.add('is-invalid');
                valid = false;
            }
            if (password.length < 8) {
                document.querySelector('input[name="password"]').classList.add('is-invalid');
                valid = false;
            }
            if (password !== confirmPassword) {
                document.querySelector('input[name="password_confirmation"]').classList.add('is-invalid');
                valid = false;
            }
            if (!valid) return;

            // Gửi đăng ký qua fetch API với JSON
            try {
                const data = {
                    name: name,
                    email: email,
                    password: password,
                    password_confirmation: confirmPassword
                };
                const response = await fetch('/register', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify(data)
                });
                const result = await response.json();
                if (response.ok) {
                    localStorage.setItem('token', result.access_token);
                    alert('Sign up successful!');
                    window.location.href = '/dashboardPage';
                } else {
                    alert(result.message || 'Sign up failed.');
                }
            } catch (error) {
                alert('Error: ' + error.message);
                console.error(error);
            }
        });
    </script>
