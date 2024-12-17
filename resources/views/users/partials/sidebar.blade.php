<div class="card-aside card-aside-left user-aside toggle-slide toggle-slide-left toggle-break-lg"
data-content="userAside" data-toggle-screen="lg" data-toggle-overlay="true">
<div class="card-inner-group" data-simplebar>
    <div class="card-inner">
        <div class="user-card">
            <div class="user-avatar bg-transparent">
                <span>
                    <img src="{{Auth::user()->profile_photo_path ? asset('storage/images/'.Auth::user()->profile_photo_path) :asset('images/avatar.png' )}}" width="40px" height="40px">
                </span>
            </div>
            <div class="user-info">
              
                <span class="lead-text">{{ Auth::user()->first_name . ' ' . Auth::user()->last_name }}</span>
                <span class="sub-text">{{ Auth::user()->email }}</span>
            </div>
        </div><!-- .user-card -->
    </div><!-- .card-inner -->

    <div class="card-inner p-0">
        <ul class="link-list-menu">
            <li><a  href="edit_profile"><em
                        class="icon ni ni-user-fill-c"></em><span>Personal
                        Infomation</span></a></li>
            <li><a href="change_password"><em
                        class="icon ni ni-bell-fill"></em><span>Change
                        Password</span></a></li>
            <li><a href="two-factor"><em
                            class="icon ni ni-lock"></em><span>Two factor authentication (2FA)</span></a></li>
            @if(auth()->user()->hasRole('Super Admin'))
            <li><a href="{{ route('superadmin-feedback', currentAccount()) }}"><em
                class="icon ni ni-help"></em><span>Feedback</span></a></li>
            @endif
        </ul>
    </div><!-- .card-inner -->
</div><!-- .card-inner-group -->
</div><!-- card-aside -->