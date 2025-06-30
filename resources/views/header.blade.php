<header class="p-3 mb-3 border-bottom">
    <div class="container">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
            <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-decoration-none" style="margin-right: 50px; font-weight:bolder; color: #2832c2; font-size: 18px"> 
                SCHEDULE MANAGE
            </a>
            <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                <li><a href="{{ route('page.dashboard') }}" class="nav-link px-2 {{ request()->routeIs('page.dashboard') ? 'link-dark' : 'link-secondary' }}">DashBoard</a></li>
                <li><a href="{{ route('page.task') }}" class="nav-link px-2 {{ request()->routeIs('page.task') ? 'link-dark' : 'link-secondary' }}">Tasks</a></li>
                <li><a href="#" class="nav-link px-2 {{ request()->routeIs('page.daily') ? 'link-dark' : 'link-secondary' }}">Daily</a></li>
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
                    <li><a class="dropdown-item" href="#">Settings</a></li>
                    <li><a class="dropdown-item" href="#">Profile</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="#" id="signout-link">Sign out</a></li>
                </ul>
            </div>
        </div>
    </div>
</header>
<form id="logout-form" action="/logout" method="POST" style="display:none;">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
</form>
<script>
    document.getElementById('signout-link').addEventListener('click', function(e) {
        e.preventDefault();
        const token = localStorage.getItem('token');
        fetch('/logout', {
            method: 'POST',
            headers: {
                'Authorization': `Bearer ${token}`,
                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                'Accept': 'application/json'
            }
        }).then(response => {
            if (response.ok) {
                localStorage.removeItem('token');
                window.location.href = '/loginPage';
            }
        });
    });
</script> 