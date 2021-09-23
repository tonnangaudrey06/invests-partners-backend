<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title" key="t-menu">Menu</li>

                <li>
                    <a href="{{ route('dashboard') }}" class="waves-effect">
                        <i class="bx bx-home-circle"></i>
                        <span key="t-dashboard">Tableaux de bord</span>
                    </a>
                </li>

                <li>
                    <a href="calendar.html" class="waves-effect">
                        <i class="bx bx-calendar"></i>
                        <span key="t-projet">Projets</span>
                    </a>
                </li>

                <li>
                    <a href="calendar.html" class="waves-effect">
                        <i class="bx bx-calendar"></i>
                        <span key="t-investment">Investissements</span>
                    </a>
                </li>

                <li>
                    <a href="calendar.html" class="waves-effect">
                        <i class="bx bx-calendar"></i>
                        <span key="t-evenement">Événements</span>
                    </a>
                </li>

                <li>
                    <a href="calendar.html" class="waves-effect">
                        <i class="bx bx-calendar"></i>
                        <span key="t-archive">Archives</span>
                    </a>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bx-store"></i>
                        <span key="t-user">Utilisateurs</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('user.administrateur') }}" key="t-admin">Administrateurs</a></li>
                        <li><a href="{{ route('user.conseille') }}" key="t-counsellor">Conseillés</a></li>
                        <li><a href="{{ route('user.porteur.projet') }}" key="t-projet-owner">Porteur projets </a></li>
                        <li><a href="{{ route('user.investisseur') }}" key="t-investisor">Investisseurs </a></li>
                    </ul>
                </li>

                <li class="menu-title" key="t-menu">Paramètrage</li>

                <li>
                    <a href="{{ route('profil.investisseur.home') }}" class="waves-effect">
                        <i class="bx bx-calendar"></i>
                        <span key="t-profil-investisseur">Profils investisseurs</span>
                    </a>
                </li>

                <li>
                    <a href="calendar.html" class="waves-effect">
                        <i class="bx bx-calendar"></i>
                        <span key="t-categorie">Catégories</span>
                    </a>
                </li>

                <li>
                    <a href="calendar.html" class="waves-effect">
                        <i class="bx bx-calendar"></i>
                        <span key="t-role">Roles</span>
                    </a>
                </li>

                <li>
                    <a href="calendar.html" class="waves-effect">
                        <i class="bx bx-calendar"></i>
                        <span key="t-privilege">Privilèges</span>
                    </a>
                </li>

                <li class="menu-title" key="t-menu">Site</li>

                <li>
                    <a href="calendar.html" class="waves-effect">
                        <i class="bx bx-calendar"></i>
                        <span key="t-slide">Slides</span>
                    </a>
                </li>

                <li>
                    <a href="calendar.html" class="waves-effect">
                        <i class="bx bx-calendar"></i>
                        <span key="t-partenaire">Partenaires</span>
                    </a>
                </li>

            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
