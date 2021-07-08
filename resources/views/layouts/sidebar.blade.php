<div class="sidebar" data-color="red">
    <!--
        Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red | yellow"
    -->
    <div class="logo">
        <a href="/" class="simple-text logo-mini">
          SDM
        </a>
        <a href="/" class="simple-text logo-normal">
          Sistem Data Mahasiswa
        </a>
    </div>
    <div class="sidebar-wrapper" id="sidebar-wrapper">
        <ul class="nav">
          @auth('web')
          <li class="{{ request()->routeIs('home') ? 'active' : '' }}">
            <a href="{{ route('admin') }}">
              <i class="now-ui-icons design_app"></i>
              <p>Dashboard</p>
            </a>
          </li>
          <li class="{{ request()->routeIs('mahasiswa*') ? 'active' : '' }}">
            <a href="{{ route('mahasiswa') }}">
              <i class="now-ui-icons education_atom"></i>
              <p>Data Mahasiswa</p>
            </a>
          </li>
          <li>
            <a href="./user.html">
              <i class="now-ui-icons users_single-02"></i>
              <p>User Profile</p>
            </a>
          </li>
          @endauth
          @auth('mahasiswa')
          <li class="{{ request()->routeIs('home') ? 'active' : '' }}">
            <a href="{{ url('/') }}">
              <i class="now-ui-icons design_app"></i>
              <p>Dashboard</p>
            </a>
          </li>
          <li class="{{ request()->routeIs('mahasiswa*') ? 'active' : '' }}">
            <a href="{{ route('mahasiswa.profile') }}">
              <i class="now-ui-icons education_atom"></i>
              <p>Profile</p>
            </a>
          </li>
          <li>
            <a href="./user.html">
              <i class="now-ui-icons users_single-02"></i>
              <p>User Profile</p>
            </a>
          </li>
          @endauth
        </ul>
    </div>
</div>