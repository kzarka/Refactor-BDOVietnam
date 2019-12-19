<!-- BEGIN HEADER -->
<div class="header-background"></div>
<!-- BEGIN LOGO -->
<div class="logo-wrapper">
    <a href="{{ url('') }}" title="" rel="home">
        <img src="/images/logo.png" alt="BDOVietnam">
    </a>
</div>
<!-- END LOGO -->
<div class="header-wrapper">
    <!-- BEGIN NAVIGATION BAR -->
    <div class="main-nav-wrapper">
        <!-- BEGIN MENU BUTTON + TABS PREFIX -->
        <div class="main-nav-button-prefix-wrapper">
            <div class="menu-button-wrapper">
                <div class="menu-tooltip"></div>
                <div class="menu-button-wrapper-inner">
                    <div class="menu-button"></div>
                    <div class="menu-button-middle"></div>
                </div>
                <div class="menu-button-text">BROWSE</div>
            </div>
            <div class="header-tabs-prefix">Sections:</div>
        </div>
        <!-- END MENU BUTTON + TABS PREFIX -->
        <!-- BEGIN TABS -->
        <div class="header-tabs-wrapper">
            <div class="menu-tabs-container">
                <ul id="menu-tabs" class="menu">
                    <li class="menu-item menu-item-type-custom menu-item-object-custom @if((Route::current()) && Route::current()->getName() == 'home') current-menu-item @endif current_page_item menu-item-home">
                        <a href="{{ url('') }}">Trang Chủ</a>
                    </li>
                    <li class="marked menu-item menu-item-type-custom menu-item-object-custom menu-item-623">
                        <a href="">About Us</a>
                    </li>
                    <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-622">
                        <a>Danh Mục</a>
                        <ul class="sub-menu">
                            @forelse($header_categories as $header_cat)
                            @php $cat_children = $header_cat->children; @endphp
                            @if($cat_children && $cat_children->count() !== 0)
                            <li id="menu-item-653" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-653">
                                <a href="javascript:void(0)">{{ $header_cat->name }}</a>
                                <ul class="sub-menu">
                                    @foreach($cat_children as $cat_child)
                                    <li id="menu-item-654" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-654">
                                        <a href="{{ $cat_child->url }}">{{ $cat_child->name }}</a>
                                    </li>
                                    @endforeach
                                </ul>
                            </li>
                            @else
                            <li class="menu-item menu-item-type-post_type menu-item-object-post menu-item-664">
                                <a href="{{ $header_cat->url }}">{{ $header_cat->name }}</a>
                            </li>
                            @endif
                            @empty
                            @endforelse
                        </ul>
                    </li>
                    <li lass="highlighted menu-item menu-item-type-custom menu-item-object-custom menu-item-624">
                        <a href="">Highlighted</a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- END TABS -->
    </div>
    <!-- END NAVIGATION BAR -->
    
    <!-- BEGIN QUICKLINK + SEARCH -->
    <div class="header-search-quicklink-wrapper">
        @if(auth()->guest())
        <div class="header-quicklink">
            <a href="{{ route('login') }}">Đăng Nhập</a>
        </div>
        @elseif(auth()->check())
        <div class="header-quicklink">
            <a href="{{ route('admin.dashboard') }}">Dashboard</a>
        </div>
        <div class="header-quicklink">
            <a href="{{ route('logout') }}">Đăng xuất</a>
        </div>
        @endif
        <div class="header-search-wrapper">
            <div class="search-wrapper">
                <form method="get" id="searchform" action="{{ route('search') }}">
                    <input type="text" name="q" id="s" placeholder="Tìm kiếm..." value="{{ app('request')->input('q') }}">
                    <div class="search-button-wrapper"><input type="submit" id="searchsubmit" value="" /></div>
                </form>
            </div>
        </div>
        <!-- END SEARCH -->
    </div>
    <!-- END QUICKLINK + SEARCH -->
</div>
<!-- END HEADER -->
<!-- BEGIN MENU INCLUDE -->
<!-- BEGIN MENU -->
<div class="powerup-bg-line"></div>
<div class="powerup-wrapper">
    <div class="close-button"></div>
    <div class="powerup smooth-scroll">
        <div class="powerup-inner">
            <!-- BEGIN SEARCH -->
            <div class="menu-search-wrapper">
                <div class="search-wrapper">
                    <form method="get" id="menu-searchform" action="{{ route('search') }}">
                    <input type="text" class="field" name="q" id="" placeholder="Tìm kiếm..."  value="{{ app('request')->input('q') }}" />
                    </form>
                </div>
            </div>
            <!-- END SEARCH -->
            <!-- BEGIN MENU -->
            <div class="menu-dropdown-menu-container">
                <ul id="menu-dropdown-menu" class="menu">
                    <li id="menu-item-155" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children">
                        <a href="#">The PowerUp Theme</a>
                        <div class="menu-item-description"></div>
                        <ul class="sub-menu">
                            <li id="menu-item-156" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children">
                                <a href="#">Hot games</a>
                                <div class="menu-item-description"></div>
                                <ul class="sub-menu">
                                    <li id="menu-item-245" class="menu-item menu-item-type-custom menu-item-object-custom">
                                        <a href="#">Destiny 2</a><div class="menu-item-description"></div>
                                    </li>
                                    <li id="menu-item-246" class="menu-item menu-item-type-custom menu-item-object-custom">
                                        <a href="#">Tomb Raider</a><div class="menu-item-description"></div>
                                    </li>
                                    <li id="menu-item-247" class="menu-item menu-item-type-custom menu-item-object-custom">
                                        <a href="#">Mass Effect Andromeda</a><div class="menu-item-description"></div>
                                    </li>
                                    <li id="menu-item-248" class="menu-item menu-item-type-custom menu-item-object-custom">
                                        <a href="#">Nioh</a><div class="menu-item-description"></div>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li id="menu-item-153" class="menu-item menu-item-type-custom menu-item-object-custom"><a href="#">Three-level navigation</a><div class="menu-item-description">Note: Width and height of the dropdown are customizable.</div></li>
                    <li id="menu-item-150" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children"><a href="#">Unique 3-level menu</a><div class="menu-item-description"></div>
                        <ul class="sub-menu">
                            <li id="menu-item-151" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children">
                                <a href="#">2nd level</a><div class="menu-item-description"></div>
                                <ul class="sub-menu">
                                    <li id="menu-item-152" class="menu-item menu-item-type-custom menu-item-object-custom"><a href="#">3rd level</a><div class="menu-item-description"></div></li>
                                    <li id="menu-item-154" class="menu-item menu-item-type-custom menu-item-object-custom"><a href="#">3rd level</a><div class="menu-item-description"></div></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
            <!-- END MENU -->
            <!-- BEGIN WIDGETS -->
            <div class="widgets-wrapper menu-widgets">
                <div id="text-2" class="widget widget_text">
                    <div class="textwidget">
                        <img alt="Dropdown menu widget location" src="http://bonfirethemes.com/powerup/one/wp-content/uploads/sites/3/2017/03/lcgo.jpg">
                        <div style="font-size:11px;line-height:14px;padding:3px 3px 15px 7px;">Awaiting your creativity at the bottom of the menu is an unstyled widget location; as a quick example, we've included an image and some text with custom formatting.</div></div>
                </div>
            </div>
                
            <!-- END WIDGETS -->
        </div>
    </div>
    <!-- BEGIN SOCIAL -->
    <div class="social-bar-wrapper">
        <div class="social-bar-label">SOCIAL:</div>
        <div class="social-bar-icons">
            <a href="#" target="_blank">
                <span class="icon-twitch"></span>
            </a>
            <a href="#" target="_blank">
                <span class="icon-youtube"></span>
            </a>
            <a href="#" target="_blank">
                <span class="icon-twitter"></span>
            </a>
            <a href="#" target="_blank">
                <span class="icon-instagram"></span>
            </a>
        </div>
    </div>
    <!-- END SOCIAL -->
</div>
<!-- END MENU -->
<!-- END MENU INCLUDE -->

<div class="sitewrap-inner">
        
<!-- BEGIN TRENDING STORIES -->
<div class="trending-ticker-wrapper">
    <!-- BEGIN TICKER SLIDER -->
    <div class="swiper-container-ticker">
    <div class="swiper-wrapper">
        <!-- THE LOOP -->
        <!-- END LOOP -->
    </div>
    </div>
    <!-- Swiper Pagination -->
    <div class="swiper-button-next"></div>
    <div class="swiper-button-prev"></div>
    <!-- END TICKER SLIDER -->

    <!-- BEGIN "Trending" MARKER -->
    <div class="trending-posts-marker">
        Trending 
        <span class="icon-help-with-circle"></span>
        <div class="trending-posts-tooltip">
            Most discussed stories from the last week.                    
        </div>
    </div>
    <!-- END "Trending" MARKER -->
</div>
<!-- END TRENDING STORIES -->
