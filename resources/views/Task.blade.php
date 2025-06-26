<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/x-icon" href="https://cdn-icons-png.flaticon.com/512/8324/8324227.png">
    <title>Schedule Manage</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
</head>
<style>
    body {
        font-family: "bahnschrift";
    }
</style>

<body>
    <header class="p-3 mb-3 border-bottom">
        <div class="container">
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-decoration-none"
                    style="margin-right: 50px; font-weight:bolder; color: #2832c2; font-size: 18px">
                    SCHEDULE MANAGE
                </a>

                <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                    <li><a href="{{ route('page.dashboard') }}" class="nav-link px-2 link-secondary">DashBoard</a></li>
                    <li><a href="{{ route('page.task') }}" class="nav-link px-2 link-dark">Tasks</a></li>
                    <li><a href="#" class="nav-link px-2 link-secondary">Daily</a></li>
                </ul>

                <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3">
                    <input type="search" class="form-control" placeholder="Search..." aria-label="Search">
                </form>

                <div class="dropdown text-end">
                    <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" id="dropdownUser1"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="https://cdn.pixabay.com/photo/2023/02/18/11/00/icon-7797704_640.png" alt=""
                            width="32" height="32" class="rounded-circle">
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
    <div class="container-fluid" style="width:100%; min-height:100vh; padding-right: 15%; padding-left: 15%">
        <table class = "table table-hover">
            <thead>
                <th style="width: 10%">ID</th>
                <th style="width: 30%">Task Name</th>
                <th style="width: 40%">Detail</th>
                <th style="width: 30%">Duration</th>
                <th style="width: 10%">Handle</th>
            </thead>
            {{-- <tbody>
                @foreach ($collection as $item)
                    <th>{{$item->id}}</th>
                    <th>{{$item->name}}</th>
                    <th>{{$item->detail}}</th>
                    <th>{{$item->duration}}</th>
                    <th>
                        <form action=""></form>
                    </th>
                @endforeach
            </tbody> --}}
        </table>
    </div>
</body>

</html>
