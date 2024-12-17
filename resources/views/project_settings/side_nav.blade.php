<ul class="link-list-menu">
    <li><a href="{{ route('styles.index', [currentAccount(), currentProject()]) }}"
            class=" {{ Route::currentRouteName() == 'styles.index' ? 'active' : '' }} "><em
                class="icon ni ni-setting"></em></em><span>General</span></a></li>
    <li><a class=" {{ Route::currentRouteName() == 'styles.welcome' ? 'active' : '' }} "
            href="{{ route('styles.welcome', [currentAccount(), currentProject()]) }}"><em
                class="icon ni ni ni-home-fill"></em><span>Welcome
                Page</span></a></li>
    <li><a class=" {{ Route::currentRouteName() == 'styles.question' ? 'active' : '' }} "
            href="{{ route('styles.question', [currentAccount(), currentProject()]) }}"><em
                class="icon ni ni-notes-alt"></em><span>Questions</span></a>
    </li>
    {{-- <li><a class=" {{ Route::currentRouteName() == 'styles.new-question' ? 'active' : '' }}"
        href="{{ route('styles.new-question', [currentAccount(), currentProject()]) }}"><em
            class="icon ni ni-notes-alt"></em><span>Text Numeric Email Question</span></a>
</li> --}}
    <li><a class=" {{ Route::currentRouteName() == 'styles.advice' ? 'active' : '' }}"
            href="{{ route('styles.advice', [currentAccount(), currentProject()]) }}"><em
                class="icon ni ni-chat-circle-fill"></em><span>Advice</span></a>
    </li>

</ul>