<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/x-icon" href="https://cdn-icons-png.flaticon.com/512/8324/8324227.png">
    <title>Schedule Manage</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
</head>
<style>
    body{
        font-family: "bahnschrift";
    }
</style>
<body>
    <header class="p-3 mb-3 border-bottom">
        <div class="container">
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-decoration-none" style="margin-right: 50px; font-weight:bolder; color: #2832c2; font-size: 18px"> 
                    SCHEDULE MANAGE
                </a>

                <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                    <li><a href="{{route('page.dashboard')}}" class="nav-link px-2 link-dark">DashBoard</a></li>
                    <li><a href="{{route('page.task')}}" class="nav-link px-2 link-secondary">Tasks</a></li>
                    <li><a href="#" class="nav-link px-2 link-secondary">Daily</a></li>
                </ul>

                <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3">
                    <input type="search" class="form-control" placeholder="Search..." aria-label="Search">
                </form>

                <div class="dropdown text-end">
                    <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" id="dropdownUser1"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="https://cdn.pixabay.com/photo/2023/02/18/11/00/icon-7797704_640.png" alt="" width="32" height="32"
                            class="rounded-circle">
                    </a>
                    <ul class="dropdown-menu text-small" aria-labelledby="dropdownUser1">
                        <li><a class="dropdown-item" href="#">New project...</a></li>
                        <li><a class="dropdown-item" href="#">Settings</a></li>
                        <li><a class="dropdown-item" href="#">Profile</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="#">Sign out</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </header>
    <form id="logout-form" action="/logout" method="POST">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <button type="submit">Logout</button>
    </form>
    <button id = "check" onclick="check()">check token</button>
</body>
<script>
        document.getElementById('logout-form').addEventListener('submit', async function(e) {
            e.preventDefault();
            const token = localStorage.getItem('token');
            const response = await fetch('/logout', {
                method: 'POST',
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                    'Accept': 'application/json'
                }
            });
            if (response.ok) {
                localStorage.removeItem('token');
                window.location.href = '/loginPage';
            }
        });

        function check(){
            console.log(localStorage.getItem('token'));
        }
    </script>
</html>
