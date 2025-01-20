<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    <!-- Navbar Brand-->
    @php
    $user = Auth::user();
    $usertype="";
    if($user['usertype'] == 0){
    $usertype='Admin';
    }elseif($user['usertype'] == 1){
    $usertype='Sub Admin';
    }elseif($user['usertype'] == 2){
    $usertype='Manage Seo';
    }elseif($user['usertype'] == 4){
    $usertype='Manage Appointment';
    }elseif($user['usertype'] == 5){
    $usertype='Manage Blog';
    }
    @endphp
    <a class="navbar-brand ps-3" href="{{ route('dashboard') }}"> {{$usertype }}</a>
    <!-- Sidebar Toggle-->
    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
    <!-- Navbar Search-->
    <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
        <div class="input-group">

        </div>
    </form>
    <!-- Navbar-->

    <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                @php
                $user = Auth::user();
                @endphp
                @if( $user['usertype'] == 0 )
                <li>
                    <x-dropdown-link :href="route('profile.edit')" class="dropdown-item">
                        {{ __('Profile') }}
                    </x-dropdown-link>
                </li>
                @endif
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-dropdown-link :href="route('logout')" class="dropdown-item" onclick="event.preventDefault();
                                                this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-dropdown-link>
                    </form>
                </li>
            </ul>
        </li>
    </ul>
</nav>