<div class="iq-top-navbar">
    <div class="iq-navbar-custom">
        <nav class="navbar navbar-expand-lg navbar-light p-0">
            <div class="iq-navbar-logo d-flex align-items-center justify-content-between">
                <!-- <i class="ri-menu-line wrapper-menu"></i> -->
                <a href="{{ route('home') }}" class="header-logo">
                    <img src="{{ asset('img/logo.png') }}" class="img-fluid light-logo" alt="logo">
                    <img src="{{ asset('img/logo.png') }}" class="img-fluid darkmode-logo" alt="logo">
                </a>
            </div>
            <div class="iq-search-bar device-search">
                {{-- <form>
                            <div class="input-prepend input-append">
                                <div class="btn-group">
                                    <label class="dropdown-toggle searchbox" data-toggle="dropdown">
                                        <input class="dropdown-toggle search-query text search-input" type="text"
                                            placeholder="Type here to search..."><span class="search-replace"></span>
                                        <a class="search-link" href="#"><i class="ri-search-line"></i></a>
                                        <span class="caret"><!--icon--></span>
                                    </label>
                                    <ul class="dropdown-menu">
                                        <li><a href="#">
                                                <div class="item"><i class="far fa-file-pdf bg-info"></i>PDFs</div>
                                            </a></li>
                                        <li><a href="#">
                                                <div class="item"><i
                                                        class="far fa-file-alt bg-primary"></i>Documents</div>
                                            </a></li>
                                        <li><a href="#">
                                                <div class="item"><i
                                                        class="far fa-file-excel bg-success"></i>Spreadsheet</div>
                                            </a></li>
                                        <li><a href="#">
                                                <div class="item"><i
                                                        class="far fa-file-powerpoint bg-danger"></i>Presentation</div>
                                            </a></li>
                                        <li><a href="#">
                                                <div class="item"><i class="far fa-file-image bg-warning"></i>Photos
                                                    & Images</div>
                                            </a></li>
                                        <li><a href="#">
                                                <div class="item"><i class="far fa-file-video bg-info"></i>Videos
                                                </div>
                                            </a></li>
                                    </ul>
                                </div>
                            </div>
                        </form> --}}
            </div>

            <div class="d-flex align-items-center">
                <div class="change-mode mt-3">
                    <div class="custom-control custom-switch custom-switch-icon custom-control-inline">
                        <div class="custom-switch-inner">
                            <p class="mb-0"> </p>
                            <input type="checkbox" class="custom-control-input" id="dark-mode" data-active="true">
                            <label class="custom-control-label" for="dark-mode" data-mode="toggle">
                                <span class="switch-icon-left"><i class="a-left"></i></span>
                                <span class="switch-icon-right"><i class="a-right"></i></span>
                            </label>
                        </div>
                    </div>
                </div>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-label="Toggle navigation">
                    <i class="ri-menu-3-line"></i>
                </button>
                <div class="navbar-collapse collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav navbar-list align-items-center ml-auto">
                        <li class="nav-item nav-icon dropdown">
                        </li>
                        <li class="nav-item nav-icon dropdown caption-content mt-3">
                            <a href="#" class="search-toggle dropdown-toggle" id="dropdownMenuButton03"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <div class="caption bg-primary line-height">{{ $alias }}</div>
                            </a>
                            <div class="iq-sub-dropdown dropdown-menu" aria-labelledby="dropdownMenuButton03">
                                <div class="card mb-0">
                                    <div class="card-header d-flex justify-content-between align-items-center mb-0">
                                        <div class="header-title">
                                            <h4 class="card-title mb-0">Profile</h4>
                                        </div>
                                        <div class="close-data badge badge-primary cursor-pointer text-right">
                                            <i class="ri-close-fill"></i>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="profile-header">
                                            <div class="cover-container text-center">
                                                <div class="rounded-circle profile-icon bg-primary d-block mx-auto">
                                                    {{ $alias }}
                                                </div>
                                                <div class="profile-detail mt-3">
                                                    <h5 class="h2">
                                                        <p>{{ auth()->user()->name }}</p>
                                                    </h5>
                                                    <p class="h6">
                                                        {{ auth()->user()->position !== null ? auth()->user()->position : auth()->user()->email }}
                                                    </p>
                                                    @if (auth()->user()->rank !== null || auth()->user()->nip !== null)
                                                        <p class="h6">
                                                            {{ auth()->user()->rank !== null ? auth()->user()->rank : '' }}/{{ auth()->user()->group !== null ? auth()->user()->group : '' }}
                                                        </p>
                                                        <p class="h6">
                                                            {{ auth()->user()->nip !== null ? auth()->user()->nip : '' }}
                                                        </p>
                                                    @endif
                                                </div>
                                                <form action="{{ route('logout') }}" method="post" class="d-inline">
                                                    @csrf
                                                    <button class="btn btn-primary">Sign
                                                        Out</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</div>
