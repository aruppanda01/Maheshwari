<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar">
    <ul class="app-menu">
        <li>
            <a class="app-menu__item  {{ Route::currentRouteName() == 'admin.dashboard' ? 'active' : '' }}"
                href="{{ route('admin.dashboard') }}"><i class="app-menu__icon fa fa-dashboard"></i>
                <span class="app-menu__label">Dashboard</span>
            </a>
        </li>
        <li>
            <a class="app-menu__item user {{ request()->is('admin/user*') ? 'active' : '' }}" href="{{ route('admin.user.index') }}"><i class="app-menu__icon fa fa-group"></i>
                <span class="app-menu__label">User</span>
            </a>
        </li>
        <li>
            <a class="app-menu__item event {{ request()->is('admin/event*') ? 'active' : '' }}" href="{{ route('admin.event.index') }}"><i class="app-menu__icon fa fa-group"></i>
                <span class="app-menu__label">Events</span>
            </a>
        </li>
        <li>
            <a class="app-menu__item event {{ request()->is('admin/category*') ? 'active' : '' }}" href="{{ route('admin.category.index') }}"><i class="app-menu__icon fa fa-group"></i>
                <span class="app-menu__label">Category</span>
            </a>
        </li>
        <li>
            <a class="app-menu__item event {{ request()->is('admin/photo*') ? 'active' : '' }}" href="{{ route('admin.photo.index') }}"><i class="app-menu__icon fa fa-group"></i>
                <span class="app-menu__label">Photo</span>
            </a>
        </li>
        <li>
            <a class="app-menu__item event {{ request()->is('admin/update*') ? 'active' : '' }}" href="{{ route('admin.update.index') }}"><i class="app-menu__icon fa fa-group"></i>
                <span class="app-menu__label">Updates</span>
            </a>
        </li>
        <li>
            <a class="app-menu__item event {{ request()->is('admin/governor*') ? 'active' : '' }}" href="{{ route('admin.governor.index') }}"><i class="app-menu__icon fa fa-group"></i>
                <span class="app-menu__label">Governing Bodies</span>
            </a>
        </li>
        <li>
            <a class="app-menu__item event {{ request()->is('admin/contact-us*') ? 'active' : '' }}" href="{{ route('admin.contact.index') }}"><i class="app-menu__icon fa fa-group"></i>
                <span class="app-menu__label">Contact Us</span>
            </a>
        </li>
        <li>
            <a class="app-menu__item event {{ request()->is('admin/terms*') ? 'active' : '' }}" href="{{ route('admin.terms.index') }}"><i class="app-menu__icon fa fa-group"></i>
                <span class="app-menu__label">Terms and Condition</span>
            </a>
        </li>
        <li>
            <a class="app-menu__item event {{ request()->is('admin/privacy*') ? 'active' : '' }}" href="{{ route('admin.privacy.index') }}"><i class="app-menu__icon fa fa-group"></i>
                <span class="app-menu__label">Privacy</span>
            </a>
        </li>
        <li>
            <a class="app-menu__item event {{ request()->is('admin/faq*') ? 'active' : '' }}" href="{{ route('admin.faq.index') }}"><i class="app-menu__icon fa fa-group"></i>
                <span class="app-menu__label">FAQs</span>
            </a>
        </li>

    </ul>
</aside>

<script>
    $urlData = document.getElementsByClassName('app-menu__item');
    $a = window.location.href;
    console.log($a)
    if($a.includes('banner')){
        $urlData.add('active');
    }else{
        console.log('false')
    }
</script>