<div class="nk-header nk-header-fluid is-dark">
    <div class="container-xl wide-xl">
        <div class="nk-header-wrap">
            <div class="nk-menu-trigger mr-sm-2 d-lg-none">
                <a href="#" class="nk-nav-toggle nk-quick-nav-icon" data-target="headerNav"><em
                        class="icon ni ni-menu"></em></a>
            </div>
            <div class="nk-header-brand">
                <a href="/dashboard" class="logo-link">
                    <img class="logo-light logo-img" src="{{ asset('images/logo.svg') }}"
                        srcset="{{ asset('images/logo2x.svg') }} 2x" alt="logo">
                    <img class="logo-dark logo-img" src="{{ asset('images/logo-dark.svg') }}"
                        srcset="{{ asset('images/logo-dark2x.svg') }} 2x" alt="logo-dark">
                </a>
            </div><!-- .nk-header-brand -->
            <div class="nk-header-menu" data-content="headerNav">
                <div class="nk-header-mobile">
                    <div class="nk-header-brand">
                        <a href="/dashboard" class="logo-link">
                            <img class="logo-light logo-img" src="{{ asset('images/logo.svg') }}"
                                srcset="{{ asset('images/logo2x.svg') }} 2x" alt="logo">
                            <img class="logo-dark logo-img" src="{{ asset('images/logo-dark.svg') }}"
                                srcset="{{ asset('images/logo-dark2x.svg') }} 2x" alt="logo-dark">
                        </a>
                    </div>
                    <div class="nk-menu-trigger mr-n2">
                        <a href="#" class="nk-nav-toggle nk-quick-nav-icon" data-target="headerNav"><em
                                class="icon ni ni-arrow-left"></em></a>
                    </div>
                </div>
                @if (currentAccount())
                    <ul class="nk-menu nk-menu-main ui-s2">
                        <li class="nk-menu-item">
                            <a href="{{ route('projects.index', currentAccount()) }}" class="nk-menu-link">
                                <span class="nk-menu-text">Projects</span>
                            </a>

                        </li><!-- .nk-menu-item -->
                        <li class="nk-menu-item has-sub">
                            <a href="{{ route('advices.index', currentAccount()) }}" onclick="window.location.href=this.href;" class="nk-menu-link nk-menu-toggle open-advices">
                                <span class="nk-menu-text">Advices</span>
                            </a>
                            <ul class="nk-menu-sub">
                                <li class="nk-menu-item">
                                    <a href="{{ route('categories.index', currentAccount()) }}" class="nk-menu-link">
                                        <span class="nk-menu-text">Categories</span>
                                    </a>
                                </li><!-- .nk-menu-item -->
                                <li class="nk-menu-item">
                                    <a href="{{ route('products.index', currentAccount()) }}" class="nk-menu-link">
                                        <span class="nk-menu-text">Products</span>
                                    </a>
                                </li><!-- .nk-menu-item -->

                            </ul><!-- .nk-menu-sub -->
                        </li><!-- .nk-menu-item -->
                        <li class="nk-menu-item">
                            <a href="{{ route('settings.index', currentAccount()) }}" class="nk-menu-link">
                                <span class="nk-menu-text">Settings</span>
                            </a>
                        </li><!-- .nk-menu-item -->
                    </ul><!-- .nk-menu -->
                @endif
            </div><!-- .nk-header-menu -->
            <div class="nk-header-tools">
                <ul class="nk-quick-nav">

                    <li class="dropdown user-dropdown order-sm-first">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <div class="user-toggle">
                                <div class="user-avatar bg-transparent">
                                    <span><img src="{{Auth::user()->profile_photo_path ? asset('storage/images/'.Auth::user()->profile_photo_path) :asset('images/avatar.png' )}}" width="40px" height="40px"></span>
                                </div>
                                <div class="user-info d-none d-xl-block">
                                    <div class="user-status">{{ Auth::user()->getRoleNames()[0] }}</div>
                                    <div class="user-name dropdown-indicator">
                                        {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</div>
                                </div>
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-md dropdown-menu-right dropdown-menu-s1 is-light">
                            <div class="dropdown-inner user-card-wrap bg-lighter d-none d-md-block">
                                <div class="user-card">
                                    <div class="user-avatar">
                                        <span><img src="{{Auth::user()->profile_photo_path ? asset('storage/images/'.Auth::user()->profile_photo_path) :asset('images/avatar.png' )}}"></span>
                                    </div>
                                    <div class="user-info">
                                        <span class="lead-text">{{ Auth::user()->first_name }}
                                            {{ Auth::user()->last_name }}</span>
                                        <span class="sub-text">{{ Auth::user()->email }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="dropdown-inner">
                                <ul class="link-list">
                                    <li><a href="{{route('edit_profile')}}"><em class="icon ni ni-user-alt"></em><span>Profile</span></a></li>
                                    <li><a href="{{route('accounts.index')}}"><em class="icon ni ni-layers"></em><span>Accounts</span></a></li>
                                </ul>
                            </div>
                            <div class="dropdown-inner">
                                <ul class="link-list">
                                    <li>
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <a href="#" onclick="event.preventDefault();
                                            this.closest('form').submit();">
                                                <em class="icon ni ni-signout"></em><span>Sign out</span>
                                            </a>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </li><!-- .dropdown -->
                    <li class="dropdown language-dropdown d-none d-sm-inline-flex mr-n1"><a href="#"
                            class="dropdown-toggle nk-quick-nav-icon" data-toggle="dropdown" aria-expanded="false">
                            <div class="quick-icon text-white"><em class="icon ni ni-layers"></em></div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-s1" style="">
                            <ul class="language-list">
                                @if(accounts())
                                    @foreach(accounts() as $account)
                                        <li><a href="{{switchAccount($account->uuid)}}" class="language-item  @if($account->uuid == currentAccount()) active @endif">
                                            <span class="language-name">{{$account->name}}</span>
                                            </a>
                                        </li>
                                    @endforeach
                                @endif
                            </ul>
                        </div>
                    </li>
                </ul><!-- .nk-quick-nav -->
            </div><!-- .nk-header-tools -->
        </div><!-- .nk-header-wrap -->
    </div><!-- .container-fliud -->
</div>
@push('scripts')

@endpush