<div class="sidebar">
    <div class="logo-details">
        <i class="fa-solid fa-server"></i>
        @php
            $delspace_checkform_name = str_replace(' ', '', $checksheet_name);
        @endphp
        <span class="logo_name"> {{ $delspace_checkform_name }}</span>
    </div>
    <ul class="nav-links">
        <li>
            <a href="{{ route('user.checksheet') }}">
                <i class="fa-regular fa-folder"></i>
                <span class="link_name">CheckSheets</span></a>
            <ul class="sub-menu blank">
                <li>
                    <a class="link_name" href="#">CheckSheets</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="{{ url('user/checkforms/' . $checksheet_name) }}">
                <i class="fa-brands fa-wpforms"></i>
                <span class="link_name">CheckForms</span></a>
            <ul class="sub-menu blank">
                <li>
                    <a class="link_name" href="#">CheckForms</a>
                </li>
            </ul>
        </li>
        <li>
            <div class="profile-details">
                <div class="profile-content">
                    {{-- <img src="/images/Test.png" alt="profile"> --}}
                </div>
                <div class="name-job">
                    <div class="profile_name">{{ Auth::user()->first_name }} <br> {{ Auth::user()->last_name }}</div>
                    <div class="job">Organize: {{ Auth::user()->organize }}</div>
                </div>
                <div class="icon-link">
                    <a href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                        <i class="fa-solid fa-arrow-right-from-bracket"></i>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
                <ul class="sub-menu">
                    <a href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                        Log Out
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </ul>
            </div>
        </li>
    </ul>
</div>
<section class="home-section">
    <div class="home-content">
        <i class="fa-solid fa-bars"></i>
        <span class="text">Dashboard</span>
    </div>
</section>
@include('Sidebar.Sidebar_Js')
