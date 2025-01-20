<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading"></div>
                <!-- for side bar active class -->
                @php
$dashboard = "";
$adminuser = "";
$adminappointment = "";
$adminpaymentdetails = "";
$adminservice = "";
$adminhoroscope = "";
$adminchember = "";
$adminclient = "";
$managebannervideo = "";
$adminsocial = "";
$manageblog = "";
$manageaboutcontactus = "";
$managecontactus = "";
$seodetails = "";
$seodetailsubmenu = "";
$alltag = "";
$adminreview = "";

if ($navstatus == "adminuser") {
    $adminuser = "active";
} elseif ($navstatus == "adminappointment") {
    $adminappointment = "active";
} elseif ($navstatus == "phonepepayment") {
    $adminpaymentdetails = "active";
} elseif ($navstatus == "adminservice") {
    $adminservice = "active";
} elseif ($navstatus == "horoscope") {
    $adminhoroscope = "active";
} elseif ($navstatus == "adminchember") {
    $adminchember = "active";
} elseif ($navstatus == "adminclient") {
    $adminclient = "active";
} elseif ($navstatus == "managebannervideo") {
    $managebannervideo = "active";
} elseif ($navstatus == "adminsocial") {
    $adminsocial = "active";
} elseif ($navstatus == "manageblog") {
    $manageblog = "active";
} elseif ($navstatus == "manageaboutcontactus") {
    $manageaboutcontactus = "active";
} elseif ($navstatus == "managecontactus") {
    $managecontactus = "active";
} elseif ($navstatus == "seodetails") {
    $seodetails = "active";
    $seodetailsubmenu = "show";
} elseif ($navstatus == "alttag") {
    $seodetails = "active";
    $seodetailsubmenu = "show";
} elseif ($navstatus == "reviews") {
    $adminreview = "active";
} else {
    $dashboard = "active";
}
$user = userdetails();

                @endphp

                <a class="nav-link {{ $dashboard }}" href="{{ route('dashboard') }}">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-table-columns {{ $dashboard }}"></i></div>
                    Dashboard
                </a>

                @if($user['usertype'] == 0)
                    <a class="nav-link {{ $adminuser }}" href="{{ URL::to('adminuser') }}">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-user-tie {{ $adminuser }}"></i></div>
                        Admin Management
                    </a>
                @endif

                @if($user['usertype'] == 0 || $user['usertype'] == 1 || $user['usertype'] == 4)
                    <a class="nav-link {{ $adminappointment }}" href="{{ URL::to('adminappointment') }}">
                        <div class="sb-nav-link-icon"><i class="fa-regular fa-calendar-check {{ $adminappointment }}"></i>
                        </div>
                        Appointment
                    </a>
                @endif

                @if($user['usertype'] == 0 || $user['usertype'] == 1 || $user['usertype'] == 4)
                    <a class="nav-link {{ $adminpaymentdetails }}" href="{{ URL::to('managepayment') }}">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-money-bill-1-wave {{ $adminpaymentdetails }}"></i>
                        </div>
                        Payment Details
                    </a>
                @endif

                @if($user['usertype'] == 0 || $user['usertype'] == 1 || $user['usertype'] == 5)
                    <a class="nav-link {{ $adminservice }}" href="{{ URL::to('adminservice') }}">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-hand-sparkles {{ $adminservice }}"></i></div>
                        Service
                    </a>
                @endif

                @if($user['usertype'] == 0 || $user['usertype'] == 1)
                                @php
    if ($adminhoroscope === "active") {
        $aria_expanded = true;
        $adminhoroscope = "show";
    } else {
        $adminhoroscope = "";
        $aria_expanded = false;
    }
                                @endphp

                                <a class="nav-link collapsed {{ $adminhoroscope }}" href="#" data-bs-toggle="collapse"
                                    data-bs-target="#collapseLayouts" aria-expanded="{{$aria_expanded}}"
                                    aria-controls="collapseLayouts">
                                    <div class="sb-nav-link-icon">
                                        <i class="fa-solid fa-circle-half-stroke" {{ $adminhoroscope }}"></i>
                                    </div>
                                    Horoscopes
                                    <div class="sb-sidenav-collapse-arrow">
                                        <i class="fas fa-angle-down"></i>
                                    </div>
                                </a>

                                <div class="collapse {{ $adminhoroscope }}" id="collapseLayouts" aria-labelledby="headingOne"
                                    data-bs-parent="#sidenavAccordion">
                                    <nav class="sb-sidenav-menu-nested nav">
                                        <a class="nav-link {{ $adminhoroscope }}" href="{{ URL::to('zodiacsigns') }}">
                                            <div class="sb-nav-link-icon">
                                                <i class="fa-regular fa-image {{ $adminhoroscope }}"></i>
                                            </div> Zodiac Signs
                                        </a>

                                        <a class="nav-link {{ $adminhoroscope }}" href="{{ URL::to('horoscopedata') }}">
                                            <div class="sb-nav-link-icon">
                                                <i class="fa-regular fa-image {{ $adminhoroscope }}"></i>
                                            </div> Horoscope Data
                                        </a>

                                        <a class="nav-link {{ $adminhoroscope }}" href="{{ URL::to('adminhoroscope') }}">
                                            <div class="sb-nav-link-icon">
                                                <i class="fa-regular fa-image {{ $adminhoroscope }}"></i>
                                            </div> Daily Horoscopes
                                        </a>
                                    </nav>
                                </div>
                @endif

                @if($user['usertype'] == 0 || $user['usertype'] == 1)
                    <a class="nav-link {{ $adminchember }}" href="{{ URL::to('adminchember') }}">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-location-dot {{ $adminchember }}"></i></div>
                        Chamber details
                    </a>
                @endif

                @if($user['usertype'] == 0 || $user['usertype'] == 1)
                    <a class="nav-link {{ $adminclient }}" href="{{ URL::to('adminclient') }}">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-users {{ $adminclient }}"></i></div>
                        Client
                    </a>
                @endif


                @if($user['usertype'] == 0 || $user['usertype'] == 1 || $user['usertype'] == 2)
                                @php
    if ($seodetails === "active") {
        $aria_expanded = true;
        $seodetailsubmenu = "show";
    } else {
        $seodetailsubmenu = "";
        $aria_expanded = false;
    }
                                @endphp
                                <a class="nav-link collapsed {{ $seodetails }}" href="#" data-bs-toggle="collapse"
                                    data-bs-target="#collapseLayouts" aria-expanded="{{$aria_expanded}}"
                                    aria-controls="collapseLayouts">
                                    <div class="sb-nav-link-icon">
                                        <i class="fa-solid fa-globe {{ $seodetails }}"></i>
                                    </div>

                                    SEO Details
                                    <div class="sb-sidenav-collapse-arrow">
                                        <i class="fas fa-angle-down"></i>
                                    </div>
                                </a>

                                <div class="collapse {{$seodetailsubmenu}}" id="collapseLayouts" aria-labelledby="headingOne"
                                    data-bs-parent="#sidenavAccordion">
                                    <nav class="sb-sidenav-menu-nested nav">
                                        <a class="nav-link {{ $seodetails }}" href="{{ URL::to('alttag') }}">
                                            <div class="sb-nav-link-icon">
                                                <i class="fa-regular fa-image {{ $seodetails }}"></i>
                                            </div> Alt Tag for Images
                                        </a>
                                        <a class="nav-link {{ $seodetails }}" href="{{ URL::to('seodetails') }}">
                                            <div class="sb-nav-link-icon">
                                                <i class="fa-regular fa-image {{ $seodetails }}"></i>
                                            </div> Manage Seo for Pages
                                        </a>
                                    </nav>
                                </div>
                @endif

                @if($user['usertype'] == 0 || $user['usertype'] == 1)
                    <a class="nav-link {{ $managebannervideo }}" href="{{ URL::to('managebannervideo') }}">
                        <div class="sb-nav-link-icon"><i class="fa-regular fa-images {{ $managebannervideo }}"></i></div>
                        Manage Banner and Video
                    </a>
                @endif

                @if($user['usertype'] == 0 || $user['usertype'] == 1 || $user['usertype'] == 2)
                    <a class="nav-link {{ $adminsocial }}" href="{{ URL::to('adminsocial') }}">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-hashtag {{ $adminsocial }}"></i></div>
                        Social media link
                    </a>
                @endif

                @if($user['usertype'] == 0 || $user['usertype'] == 1 || $user['usertype'] == 2 || $user['usertype'] == 5)
                    <a class="nav-link {{ $manageblog }}" href="{{ URL::to('manageblog') }}">
                        <div class="sb-nav-link-icon"><i class="fa-regular fa-clipboard {{ $manageblog }}"></i></div>
                        Manage Blog
                    </a>
                @endif

                @if($user['usertype'] == 0 || $user['usertype'] == 1 || $user['usertype'] == 5)
                    <a class="nav-link {{ $manageaboutcontactus }}" href="{{ URL::to('manageaboutcontactus') }}">
                        <div class="sb-nav-link-icon"><i class="fa-regular fa-address-card {{ $manageaboutcontactus }}"></i>
                        </div>
                        About and Contact details
                    </a>
                @endif

                @if($user['usertype'] == 0 || $user['usertype'] == 1 || $user['usertype'] == 5)
                    <a class="nav-link {{ $adminreview }}" href="{{ URL::to('adminreviewmanage') }}">
                        <div class="sb-nav-link-icon"><i class="fa-regular fa-comments {{ $adminreview }}"></i></div>
                        Manage customer review
                    </a>
                @endif

                @if($user['usertype'] == 0 || $user['usertype'] == 1)
                    <a class="nav-link {{ $managecontactus }}" href="managecontactus">
                        <div class="sb-nav-link-icon"><i class="fa-regular fa-message {{ $managecontactus }}"></i></div>
                        Contact us
                    </a>
                @endif
            </div>
        </div>
        <div class="sb-sidenav-footer">
            <div class="small">Logged in as: {{ $user['name'] }}</div>

        </div>
    </nav>
</div>