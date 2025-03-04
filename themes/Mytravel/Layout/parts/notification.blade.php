<?php
if(!auth()->check()) return;
[$notifications,$countUnread] = getNotify();

?>

<div class="language-option dropdown dropdown-notifications position-relative px-3 u-header__login-form dropdown-connector-xl u-header__topbar-divider">
    <a href="{{route('core.notification.loadNotify')}}" class="d-inline-block font-size-14 mr-1 dropdown-nav-link">
        <i class="flaticon-bell mr-2 ml-1 font-size-18"></i>
        <span class="d-inline-block badge badge-danger notification-icon text-white">{{$countUnread}}</span>
    </a>
</div>
