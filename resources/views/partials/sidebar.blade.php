<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="/" class="brand-link text-center">
        <span class="brand-text font-weight-light">RDV Médecins</span>
    </a>

    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column">

                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link">
                        <i class="nav-icon fas fa-chart-line"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('medecins.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-user-md"></i>
                        <p>Médecins</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('specialites.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-tags"></i>
                        <p>Spécialités</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('creneaux.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-clock"></i>
                        <p>Créneaux</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('patients.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-user"></i>
                        <p>Patients</p>
                    </a>
                </li>

                
                <li class="nav-item">
                    <a href="{{ route('rendezvous.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-calendar-alt"></i>
                        <p>Rendez-vous</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('calendar.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-calendar"></i>
                        <p>Calendrier</p>
                    </a>
                </li>

            </ul>
        </nav>
    </div>
</aside>
