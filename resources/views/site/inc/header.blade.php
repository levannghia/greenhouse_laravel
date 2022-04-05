<header>
    <div class="menu-header">
            <div class="row">
                <div class="logo-header">
                    <a href="/">
                        <img src="{{ asset('public/upload/images/photo/thumb/' . $logo->photo) }}" alt="">
                    </a>
                </div>
                <nav class="navbar navbar-expand-lg navbar-light">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav pd-li menu-category menu-center">

                            <li class="nav-item bg-ani {{ Request::path() == '/' ? 'actives' : '' }}">
                                <a class="nav-link" href="/">{{ __('lang.home') }}</a>
                            </li>
                            {{-- <li class="nav-item bg-ani {{ Request::path() == 'gioi-thieu' ? 'actives' : '' }}">
                                <a class="nav-link " href="/gioi-thieu">{{ __('lang.about') }}</a>
                            </li> --}}
                            {{-- <div class="dropdown">
                                <li class="nav-item bg-ani {{ Request::path() == 'dich-vu' ? 'actives' : '' }}">
                                    <a class="nav-link"
                                        href="{{ route('get.service') }}">Nhà đất bán</a>
                                </li>
                                <div class="dropdown-content">
                                    @foreach ($serviceHeader as $item)
                                        <a href="/dich-vu/{{ $item->slug }}">{{ $item->title }}</a>
                                    @endforeach
                                </div>
                            </div> --}}
                            @foreach ($categoryHeader as $item)
                            <li class="nav-item bg-ani {{ Request::path() == $item->slug ? 'actives' : '' }}">
                                <a class="nav-link" href="/bat-dong-san/{{$item->slug}}">{{$item->name}}</a>
                            </li>
                            @endforeach
                            <li class="nav-item bg-ani {{ Request::path() == 'tuyen-dung' ? 'actives' : '' }}">
                                <a class="nav-link"
                                    href="{{ route('get.recruit') }}">Ký gửi</a>
                            </li>
                            <li class="nav-item bg-ani {{ Request::path() == 'edu' ? 'actives' : '' }}">
                                <a class="nav-link "
                                    href="{{ route('get.page.dao.tao') }}">Dự án</a>
                            </li>
                            <li class="nav-item bg-ani {{ Request::path() == 'edu' ? 'actives' : '' }}">
                                <a class="nav-link "
                                    href="{{ route('get.page.dao.tao') }}">Tin tức</a>
                            </li>
                            <li class="nav-item bg-ani {{ Request::path() == 'lien-he' ? 'actives' : '' }}">
                                <a class="nav-link " href="/lien-he">{{ __('lang.contacts') }}</a>
                            </li>
                        </ul>
                        {{-- <form class="form-inline my-2 my-lg-0" action="{{ route('search.product') }}">
                            <!-- <input class="form-control mr-sm-2 search-input" type="search" placeholder="Nhập từ khóa tìm kiếm..." aria-label="Search">
                        <button style="    border-radius: 9px; padding: 3px;" class="btn btn-outline-success my-2 my-sm-0" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button> -->
                            <div id="search">
                                <input type="text" name="q" id="keyword" class="form-control mr-sm-2 search-input"
                                    type="search" placeholder="{{ __('lang.search') }}..." aria-label="Search">
                                <button class="btn btn-outline-success my-2 my-sm-0" type="submit"><i
                                        class="fa fa-search" aria-hidden="true"></i></button>
                            </div>
                        </form> --}}

                    </div>
                </nav>
            </div>
        
    </div>
</header>
