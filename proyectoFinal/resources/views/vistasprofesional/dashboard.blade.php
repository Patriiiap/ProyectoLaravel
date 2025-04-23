<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Tutor Dashboard - Home</title>
    <link rel="stylesheet" href="{{ asset('css/vistas_profesional_css/dashboard.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <div class="navbar">
        <div class="nav-title"><strong>Tutor Dashboard</strong></div>
        <div class="nav-links">
            <a href="#">Home</a>
            <a href="#">Schedule</a>
            <a href="#">Invoices</a>
        </div>
        <div class="profile-icon dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                    {{ Auth::guard('profesional')->user()->nombre }}
                </span>
            </a>

            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                {{-- <a class="dropdown-item" href="/profile">
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                    Profile
                </a>
                <a class="dropdown-item" href="#">
                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                    Settings
                </a>
                <a class="dropdown-item" href="#">
                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                    Activity Log
                </a>
                <div class="dropdown-divider"></div> --}}
                <a class="dropdown-item" href="{{ route('logout') }}">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Logout
                </a>
            </div>
        </div>
    </div>

    <h1>Hello, {{ Auth::guard('profesional')->user()->nombre }}.</h1>
    <p class="subtitle">Here’s a summary of the week.</p>

    <div class="dashboard">
        <div class="card user-card">
            <div class="user-name">Lucas Williams</div>
            <div class="user-info">Age 10 | Occupational Therapy</div>
        </div>

        <div class="card">
            <h3>Upcoming Sessions</h3>
            <div class="sessions-list">
                <div class="session">Monday, April 8 <time>9:00 AM</time><br><small>John Smith</small></div>
                <div class="session">Wednesday, April 10 <time>1:00 PM</time><br><small>Emily Johnson</small></div>
                <div class="session">Friday, April 12 <time>11:00 AM</time><br><small>Daniel Brown</small></div>
            </div>
        </div>

        <div class="card alert-box">
            <p>An alert box to indicate important information to user.</p>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>