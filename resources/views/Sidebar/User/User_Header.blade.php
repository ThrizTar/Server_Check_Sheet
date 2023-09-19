<header>
    <h2>
        <label for="nav-toggle">
            <span class="fa-solid fa-bars"></span>
        </label>

        Dashboard
    </h2>
    {{-- <input type="hidden" name="checksheet_id" id="checksheet_id" value="{{ $checksheet_id }}"> --}}
    <div class="search-wrapper">
        <span><i class="fa-solid fa-magnifying-glass"></i></span>
        <input type="search" name="search_viewcheck" id="search_viewcheck" placeholder="Search....">
    </div>
    <div class="user-wrapper">
        {{-- <img src="" width="30px" height="30px" alt=""> --}}
        <div>
            <h5>{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</h5>
            <small>Organize: {{ Auth::user()->organize }}</small>
        </div>
    </div>
</header>
