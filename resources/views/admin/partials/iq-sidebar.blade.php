<div class="iq-sidebar sidebar-default">
    <div class="iq-sidebar-logo d-flex align-items-center justify-content-between">
        <a href="{{ route('home') }}" class="header-logo">
            <img src="{{ asset('img/logo.png') }}" class="img-fluid mr-2 light-logo" alt="logo {{ strtolower(env('APP_NAME')) }}">
            <img src="{{ asset('img/logo.png') }}" class="img-fluid mr-2 darkmode-logo" alt="logo {{ strtolower(env('APP_NAME')) }}">
            <p class="text-dark text-bold text-center h3 mt-2 d-flex justify-content-center align-items-center">{{ env('APP_NAME') }}</p>
        </a>
        <div class="iq-menu-bt-sidebar">
            <i class="fas fa-bars wrapper-menu"></i>
        </div>
    </div>
    <div class="data-scrollbar" data-scroll="1">
        @include('admin.partials.sidebar')
        <div class="p-3"></div>
    </div>
</div>
