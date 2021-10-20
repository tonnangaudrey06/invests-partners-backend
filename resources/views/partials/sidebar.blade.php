<div class="vertical-menu">

    <div data-simplebar class="h-100">



        <!--- Sidemenu -->
        <div id="sidebar-menu">

            @php
            $privileges = DB::table('privileges')->where('role', Auth::user()->role)->get();
            @endphp

            @if (Auth::user()->role == 1)

            <!-- Left Menu Start -->

            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title" key="t-menu">Menu</li>

                <li>
                    <a href="{{ route('dashboard') }}" class="waves-effect">
                        <i class="bx bx-home-circle"></i>
                        <span key="t-dashboard">Tableaux de bord</span>
                    </a>
                </li>

                <li class="mm-active">
                    <a href="javascript: void(0);" class="has-arrow waves-effect" aria-expanded="true">
                        <i class="bx bx-briefcase-alt-2"></i>
                        <span key="t-projects">Projets</span>
                    </a>
                    <ul class="sub-menu mm-collapse mm-show" aria-expanded="false" style="">
                        <li><a href="{{ route('projet.home') }}" key="t-p-grid">Plateforme</a></li>
                        <li><a href="{{ route('projet.home_ip') }}" key="t-p-list">I&P</a></li>
                    </ul>
                </li>

                
                <li>
                    <a href="{{route('investissement.home')}}" class="waves-effect">
                        <i class="bx bx-calendar"></i>
                        <span key="t-investment">Investissements</span>
                    </a>
                </li>

                <li>
                    <a href="{{route('events.home')}}" class="waves-effect">
                        <i class="bx bx-calendar"></i>
                        <span key="t-evenement">Événements</span>
                    </a>
                </li>

                <li>
                    <a href="{{route('projet.archives')}}" class="waves-effect">
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
                        
                        <li><a href="{{ route('user.sous_administrateur') }}" key="t-admin">Sous-administrateurs</a></li>
                        <li><a href="{{ route('user.conseiller') }}" key="t-counsellor">Conseillers </a></li>
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
                    <a href="{{ route('category.home') }}" class="waves-effect">
                        <i class="bx bx-calendar"></i>
                        <span key="t-categorie">Secteurs d'activités</span>
                    </a>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bx-store"></i>
                        <span key="t-user">Privilèges</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('add.writer') }}" key="t-writer">Ajouter un privilège</a></li>
                        <li><a href="{{ route('all.writer') }}" key="t-all_writer">Tous les privilèges</a></li>
                    </ul>
                </li>

                <li class="menu-title" key="t-menu">Site</li>

                <li>
                    <a href="{{route('slider.home')}}" class="waves-effect">
                        <i class="bx bx-calendar"></i>
                        <span key="t-slide">Slides</span>
                    </a>
                </li>

                <li>
                    <a href="{{route('partenaires.home')}}" class="waves-effect">
                        <i class="bx bx-calendar"></i>
                        <span key="t-partenaire">Partenaires</span>
                    </a>
                </li>

            </ul>

            @else

            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title" key="t-menu">Menu</li>

                <li>
                    <a href="{{ route('dashboard') }}" class="waves-effect">
                        <i class="bx bx-home-circle"></i>
                        <span key="t-dashboard">Tableaux de bord</span>
                    </a>
                </li>

                @foreach ($privileges as $privilege)

                @if( $privilege->module == 1 && $privilege->consulter == 1)

                <li class="mm-active">
                    <a href="javascript: void(0);" class="has-arrow waves-effect" aria-expanded="true">
                        <i class="bx bx-briefcase-alt-2"></i>
                        <span key="t-projects">Projets</span>
                    </a>
                    <ul class="sub-menu mm-collapse mm-show" aria-expanded="false" style="">
                        <li><a href="{{ route('projet.home') }}" key="t-p-grid">Plateforme</a></li>
                        <li><a href="{{ route('projet.home_ip') }}" key="t-p-list">I&P</a></li>
                    </ul>
                </li>

                {{-- <li>
                    <a href="{{ route('projet.home') }}" class="waves-effect">
                        <i class="bx bx-calendar"></i>
                        <span key="t-projet">Projets</span>
                    </a>
                </li> --}}

                @endif
                

                @if( $privilege->module == 6 && $privilege->consulter == 1)
                <li>
                    <a href="{{route('investissement.home')}}" class="waves-effect">
                        <i class="bx bx-calendar"></i>
                        <span key="t-investment">Investissements</span>
                    </a>
                </li>
                @endif
                

                @if( $privilege->module == 8 && $privilege->consulter == 1)
                <li>
                    <a href="calendar.html" class="waves-effect">
                        <i class="bx bx-calendar"></i>
                        <span key="t-evenement">Événements</span>
                    </a>
                </li>
                @endif
                
                @if( $privilege->module == 13 && $privilege->consulter == 1)
                <li>
                    <a href="{{route('projet.archives')}}" class="waves-effect">
                        <i class="bx bx-calendar"></i>
                        <span key="t-archive">Archives</span>
                    </a>
                </li>
                @endif
                @endforeach

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bx-store"></i>
                        <span key="t-user">Utilisateurs</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        @foreach ($privileges as $privilege)

                        @if( $privilege->module == 3 && $privilege->consulter == 1)
                        <li><a href="{{ route('user.sous_administrateur') }}" key="t-admin">Sous-administrateurs</a></li>
                        @endif
                        

                        @if( $privilege->module == 4 && $privilege->consulter == 1)
                        <li><a href="{{ route('user.conseiller') }}" key="t-counsellor">Conseillers </a></li>
                        @endif
                        
                        @if( $privilege->module == 5 && $privilege->consulter == 1)
                        <li><a href="{{ route('user.porteur.projet') }}" key="t-projet-owner">Porteur projets </a></li>
                        @endif
                        
                        @if( $privilege->module == 2 && $privilege->consulter == 1)
                        <li><a href="{{ route('user.investisseur') }}" key="t-investisor">Investisseurs </a></li>
                        @endif

                        @endforeach
                    </ul>
                </li>


                <li class="menu-title" key="t-menu">Paramètrage</li>

                @foreach ($privileges as $privilege)

                @if( $privilege->module == 7 && $privilege->consulter == 1)
                <li>
                    <a href="{{ route('profil.investisseur.home') }}" class="waves-effect">
                        <i class="bx bx-calendar"></i>
                        <span key="t-profil-investisseur">Profils investisseurs</span>
                    </a>
                </li>

                @endif
                

                @if( $privilege->module == 11 && $privilege->consulter == 1)

                <li>
                    <a href="{{ route('category.home') }}" class="waves-effect">
                        <i class="bx bx-calendar"></i>
                        <span key="t-categorie">Secteurs d'activités</span>
                    </a>
                </li>

                @endif


                @if( $privilege->module == 10 && $privilege->consulter == 1)

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bx-store"></i>
                        <span key="t-user">Privilèges</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('add.writer') }}" key="t-writer">Ajouter un privilège</a></li>
                        <li><a href="{{ route('all.writer') }}" key="t-all_writer">Tous les privilèges</a></li>
                    </ul>
                </li>
                @endif
                
                @if( $privilege->module == 12 && $privilege->consulter == 1)
                <li class="menu-title" key="t-menu">Site</li>

                <li>
                    <a href="{{route('slider.home')}}" class="waves-effect">
                        <i class="bx bx-calendar"></i>
                        <span key="t-slide">Slides</span>
                    </a>
                </li>

                <li>
                    <a href="{{route('partenaires.home')}}" class="waves-effect">
                        <i class="bx bx-calendar"></i>
                        <span key="t-partenaire">Partenaires</span>
                    </a>
                </li>
                @endif

                @endforeach


            </ul>
                
            @endif

        </div>
        <!-- Sidebar -->
    </div>
</div>