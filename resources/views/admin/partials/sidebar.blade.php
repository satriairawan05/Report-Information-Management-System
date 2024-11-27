@php
    $pages = \App\Http\Controllers\Controller::get_sidebar_access(auth()->user()->role_id);

    $report = 0;
    $folder = 0;
    $profile = 0;

    foreach ($pages as $r) {
        if ($r->page_name == 'Report') {
            if ($r->action == 'Read') {
                $report = $r->access;
            }
        }

        if ($r->page_name == 'Folder') {
            if ($r->action == 'Read') {
                $folder = $r->access;
            }
        }

        if ($r->page_name == 'Profile') {
            if ($r->action == 'Read') {
                $profile = $r->access;
            }
        }
    }
@endphp

<nav class="iq-sidebar-menu">
    <ul id="iq-sidebar-toggle" class="iq-menu">
        <li class="{{ request()->is('home') ? 'active' : '' }}">
            <a href="{{ route('home') }}" class="">
                <i class="fas fa-home iq-arrow-left"></i><span>Dashboard</span>
            </a>
            <ul id="dashboard" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
            </ul>
        </li>
        @if ($report == 1)
            <li class="">
                <a href="{{ route('report.index') }}" class="">
                    <i class="fas fa-file-archive iq-arrow-left"></i><span>Report</span>
                </a>
                <ul id="page-reports" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                </ul>
            </li>
        @endif
        @if ($folder == 1)
            <li class="{{ request()->is('folder.*') ? 'active' : '' }}">
                <a href="{{ route('folder.index') }}" class="">
                    <i class="fas fa-folder iq-arrow-left"></i><span>Folder</span>
                </a>
                <ul id="page-folders" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                </ul>
            </li>
        @endif
        <li class="{{ request()->is('group.*') || request()->is('profile.*') ? 'active' : '' }}">
            <a href="#otherpage" class="collapsed" data-toggle="collapse" aria-expanded="false">
                <i class="fas fa-cogs iq-arrow-left"></i><span>Setting</span>
                <i class="fas fa-angle-double-right iq-arrow-right arrow-active"></i>
                <i class="fas fa-angle-down iq-arrow-right arrow-hover"></i>
            </a>
            <ul id="otherpage" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                @if (auth()->user()->role_id == 1)
                    <li class="{{ request()->is('group.*') ? 'active' : '' }}">
                        <a href="{{ route('group.index') }}">
                            <i class="fas fa-user-cog"></i><span>Role</span>
                        </a>
                    </li>
                @endif
                @if ($profile == 1)
                    <li class="{{ request()->is('profile.*') ? 'active' : '' }}">
                        <a href="{{ route('profile.index') }}">
                            <i class="fas fa-users-gear"></i><span>Profile</span>
                        </a>
                    </li>
                @endif
            </ul>
        </li>
    </ul>
</nav>
