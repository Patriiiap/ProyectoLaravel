<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard Profesional</title>
    <link rel="stylesheet" href="{{ asset('css/vistas_profesional_css/dashboard.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <header class="header">
        <div class="user-profile dropdown">
            <a href="#" id="userDropdown" class="dropdown-toggle d-flex align-items-center text-white"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2">{{ Auth::guard('profesional')->user()->nombre }}</span>
                <img src="https://cdn-icons-png.flaticon.com/128/149/149995.png" alt="Icono" class="rounded-circle"
                    width="32" height="32" />
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
        <div class="acciones">
            <button>Ver todas las citas</button>
            <button>Nueva cita</button>
            <button>Ver facturas</button>
        </div>
    </header>

    <main class="dashboard">

        <section class="next-appointment">
            <h2>Próxima cita <span class="status">Activo</span></h2>
            <ul>
                <li><strong>📅</strong> 28 de marzo de 2024</li>
                <li><strong>⏰</strong> 10:00</li>
                <li><strong>👤</strong> Usuario de la cita: Juan Luna</li>
            </ul>
        </section>

        <section class="calendar-section">
            <h3>marzo 2024</h3>
            <div class="calendar">
                <!-- Calendario simplificado -->
                <div>L</div>
                <div>M</div>
                <div>X</div>
                <div>J</div>
                <div>V</div>
                <div>S</div>
                <div>D</div>
                <!-- Celdas del calendario -->
                <div class="empty"></div>
                <div class="empty"></div>
                <div class="empty"></div>
                <div class="empty"></div>
                <div class="date">1</div>
                <div class="date">2</div>
                <div class="date">3</div>
                <div class="date">4</div>
                <div class="date">5</div>
                <div class="date">6</div>
                <div class="date">7</div>
                <div class="date">8</div>
                <div class="date">9</div>
                <div class="date">10</div>
                <div class="date">11</div>
                <div class="date">12</div>
                <div class="date">13</div>
                <div class="date selected">14</div>
                <div class="date">15</div>
                <div class="date">16</div>
                <div class="date">17</div>
                <div class="date">18</div>
                <div class="date">19</div>
                <div class="date">20</div>
                <div class="date">21</div>
                <div class="date">22</div>
                <div class="date">23</div>
                <div class="date">24</div>
                <div class="date">25</div>
                <div class="date">26</div>
                <div class="date">27</div>
                <div class="date">28</div>
                <div class="empty"></div>
                <div class="empty"></div>
                <div class="empty"></div>
            </div>
        </section>
    </main>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>