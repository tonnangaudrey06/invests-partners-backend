<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
    <a class="sidebar-brand brand-logo" href="">
      <img src="{{ asset('backend/assets/images/logo.png') }}" alt="logo" /></a>
    <a class="sidebar-brand brand-logo-mini" href="">
      <img src="{{ asset('backend/assets/images/logo.png') }}" alt="logo" /></a>
  </div>
  <ul class="nav">
    <li class="nav-item profile">
      <div class="profile-desc">
        <div class="profile-pic">
          <div class="count-indicator">
            <img class="img-xs rounded-circle " src="{{ asset('backend/assets/images/faces/user.png') }}" alt="">
            <span class="count bg-success"></span>
          </div>
          <div class="profile-name">
            <h5 class="mb-0 font-weight-normal">Admin</h5>
            <span>admin@gmail.com</span>
          </div>
        </div>
        <a href="#" id="profile-dropdown" data-toggle="dropdown"><i class="mdi mdi-dots-vertical"></i></a>
        <div class="dropdown-menu dropdown-menu-right sidebar-dropdown preview-list" aria-labelledby="profile-dropdown">
          <a href="#" class="dropdown-item preview-item">
            <div class="preview-thumbnail">
              <div class="preview-icon bg-dark rounded-circle">
                <i class="mdi mdi-settings text-primary"></i>
              </div>
            </div>
            <div class="preview-item-content">
              <p class="preview-subject ellipsis mb-1 text-small">Paramètres</p>
            </div>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item preview-item">
            <div class="preview-thumbnail">
              <div class="preview-icon bg-dark rounded-circle">
                <i class="mdi mdi-onepassword  text-info"></i>
              </div>
            </div>
            <div class="preview-item-content">
              <p class="preview-subject ellipsis mb-1 text-small">Changer mot de passe</p>
            </div>
          </a>
          {{-- <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item preview-item">
            <div class="preview-thumbnail">
              <div class="preview-icon bg-dark rounded-circle">
                <i class="mdi mdi-calendar-today text-success"></i>
              </div>
            </div>
            <div class="preview-item-content">
              <p class="preview-subject ellipsis mb-1 text-small">To-do list</p>
            </div>
          </a> --}}
        </div>
      </div>
    </li>
    <li class="nav-item nav-category">
      <span class="nav-link">Navigation</span>
    </li>
    <li class="nav-item menu-items">
      <a class="nav-link" href="index.html">
        <span class="menu-icon">
          <i class="mdi mdi-speedometer"></i>
        </span>
        <span class="menu-title">Tableau de bord</span>
      </a>
    </li>

    <li class="nav-item menu-items">
      <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
        <span class="menu-icon">
          <i class="mdi mdi-home"></i>
        </span>
        <span class="menu-title">Accueil</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="ui-basic">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href=" {{route('home.slider')}}  ">Slider</a></li>
          <li class="nav-item"> <a class="nav-link" href=" {{ route('home.partenaire') }}">Partenaires</a></li>
          <li class="nav-item"> <a class="nav-link" href=" {{ route('home.chiffre') }}">Chiffres clés </a></li>
        </ul>
      </div>
    </li>

    <li class="nav-item menu-items">
      <a class="nav-link" href="">
        <span class="menu-icon">
          <i class="mdi mdi-layers"></i>
        </span>
        <span class="menu-title">Categories</span>
      </a>
    </li>

    <li class="nav-item menu-items">
      <a class="nav-link" data-toggle="collapse" href="#ui-projet" aria-expanded="false" aria-controls="ui-projet">
        <span class="menu-icon">
          <i class="mdi mdi-laptop"></i>
        </span>
        <span class="menu-title">Projets</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="ui-projet">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="   ">Projets</a></li>
          <li class="nav-item"> <a class="nav-link" href="">Porteurs de projets</a></li>
        </ul>
      </div>
    </li>

    <li class="nav-item menu-items">
      <a class="nav-link" data-toggle="collapse" href="#district" aria-expanded="false" aria-controls="district">
        <span class="menu-icon">
          <i class="mdi mdi-security"></i>
        </span>
        <span class="menu-title">investisseurs</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="district">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="pages/samples/blank-page.html"> Investissements </a></li>
          <li class="nav-item"> <a class="nav-link" href="pages/samples/error-404.html"> Investisseurs </a></li>
        </ul>
      </div>
    </li>
    
    
    <li class="nav-item menu-items">
      <a class="nav-link" href="pages/forms/basic_elements.html">
        <span class="menu-icon">
          <i class="mdi mdi-playlist-play"></i>
        </span>
        <span class="menu-title">Evènements</span>
      </a>
    </li>

    <li class="nav-item menu-items">
      <a class="nav-link" href="pages/tables/basic-table.html">
        <span class="menu-icon">
          <i class="mdi mdi-table-large"></i>
        </span>
        <span class="menu-title">Conseillers</span>
      </a>
    </li>

    <li class="nav-item menu-items">
      <a class="nav-link" href="pages/charts/chartjs.html">
        <span class="menu-icon">
          <i class="mdi mdi-message-text"></i>
        </span>
        <span class="menu-title">Messages</span>
      </a>
    </li>

    <li class="nav-item menu-items">
      <a class="nav-link" href="pages/icons/mdi.html">
        <span class="menu-icon">
          <i class="mdi mdi-contacts"></i>
        </span>
        <span class="menu-title">Roles</span>
      </a>
    </li>
    {{-- <li class="nav-item menu-items">
      <a class="nav-link" data-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
        <span class="menu-icon">
          <i class="mdi mdi-security"></i>
        </span>
        <span class="menu-title">User Pages</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="auth">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="pages/samples/blank-page.html"> Blank Page </a></li>
          <li class="nav-item"> <a class="nav-link" href="pages/samples/error-404.html"> 404 </a></li>
          <li class="nav-item"> <a class="nav-link" href="pages/samples/error-500.html"> 500 </a></li>
          <li class="nav-item"> <a class="nav-link" href="pages/samples/login.html"> Login </a></li>
          <li class="nav-item"> <a class="nav-link" href="pages/samples/register.html"> Register </a></li>
        </ul>
      </div>
    </li> --}}
    <li class="nav-item menu-items">
      <a class="nav-link" href="http://www.bootstrapdash.com/demo/corona-free/jquery/documentation/documentation.html">
        <span class="menu-icon">
          <i class="mdi mdi-file-document-box"></i>
        </span>
        <span class="menu-title">Documentation</span>
      </a>
    </li>
  </ul>
</nav>