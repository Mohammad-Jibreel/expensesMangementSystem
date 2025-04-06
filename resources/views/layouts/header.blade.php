
<header class="header-desktop">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="header-wrap">
                <form class="form-header" action="" method="POST">
                </form>
                <div class="header-button">
                    <div class="noti-wrap">
                        <div class="noti__item js-item-menu">
                            <i class="zmdi zmdi-notifications"></i>
                            <span class="quantity">{{ auth()->user()->unreadNotifications->count() }}</span>
                            <div class="notifi-dropdown js-dropdown">
                                <div class="notifi__title">
                                    <p>You have {{ auth()->user()->unreadNotifications->count() }} Notifications</p>
                                </div>
                                @foreach(auth()->user()->unreadNotifications as $notification)
                                    <div class="notifi__item">
                                        <div class="bg-c1 img-cir img-40">
                                            <i class="zmdi zmdi-email-open"></i>
                                        </div>
                                        <div class="content">
                                            <p>{{ $notification->data['message'] }}</p>
                                            <span class="date">{{ $notification->created_at->format('F j, Y h:i A') }}</span>
                                        </div>
                                    </div>
                                @endforeach
                                <div class="notifi__footer">
                                    <a href="#">All notifications</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="account-wrap">
                        <div class="account-item clearfix js-item-menu">
                            <div class="image">
                                <img src="{{ Auth::user()->profile_image ? asset('storage/profile_images/' . Auth::user()->profile_image) : 'https://via.placeholder.com/150' }}" alt="{{ Auth::user()->name }}"/>
                            </div>
                            <div class="content">
                                <a class="js-acc-btn" href="#">{{ Auth::user()->name }}</a>
                            </div>
                            <div class="account-dropdown js-dropdown">
                                <div class="info clearfix">
                                    <div class="image">
                                        <a href="#">
                                            <img src="{{ Auth::user()->profile_image ? asset('storage/profile_images/' . Auth::user()->profile_image) : 'https://via.placeholder.com/150' }}" alt="{{ Auth::user()->name }}"/>
                                        </a>
                                    </div>
                                    <div class="content">
                                        <h5 class="name">
                                            <a href="#">{{ Auth::user()->name }}</a>
                                        </h5>
                                        <span class="email">{{ Auth::user()->email }}</span>
                                    </div>
                                </div>
                                <div class="account-dropdown__body">
                                    <div class="account-dropdown__item">
                                        <a href="{{ route('profile.show') }}">
                                            <i class="zmdi zmdi-account"></i>My Account</a>
                                    </div>

                                </div>
                                <div class="account-dropdown__footer">
                                    <!-- Form-based logout button -->
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                        <button type="submit" class="account-dropdown__item">
                                            <i class="zmdi zmdi-power"></i> Logout
                                        </button>
                                    </form>

                                    <!-- Link-based logout -->
                                    <a href="#" onclick="document.getElementById('logout-form').submit();" class="account-dropdown__item">
                                        <i class="zmdi zmdi-power"></i> Logout
                                    </a>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
=
