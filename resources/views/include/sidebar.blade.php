<div id="scrollbar">
    <div class="container-fluid">

        <div id="two-column-menu">
        </div>
        <ul class="navbar-nav" id="navbar-nav">
            @foreach (menus() as $category => $menus)
                @foreach ($menus as $menu)
                    @can('read ' . $menu->url)
                        @if (count($menu->subMenus))
                            <li class="nav-item">
                                <a @class([
                                    'nav-link menu-link',
                                    'active' => str_contains(request()->path(), $menu->url),
                                ]) href="#sidebar{{ str_replace(' ', '', $menu->name) }}"
                                    data-bs-toggle="collapse" role="button" aria-expanded="false"
                                    aria-controls="sidebar{{ str_replace(' ', '', $menu->name) }}">
                                    <i class="{{ $menu->icon }}"></i> <span data-key="t-{{ $menu->name }}">
                                        {{ __($menu->name) }} </span>
                                </a>

                                <div @class([
                                    'collapse menu-dropdown',
                                    'show' => str_contains(request()->path(), $menu->url),
                                ]) id="sidebar{{ str_replace(' ', '', $menu->name) }}">
                                    <ul class="nav nav-sm flex-column">
                                        @foreach ($menu->subMenus as $sm)
                                            @can('read ' . $sm->url)
                                                <li class="nav-item">
                                                    <a href="{{ url($sm->url) }}" @class([
                                                        'nav-link',
                                                        'active' => str_contains(request()->path(), $sm->url),
                                                    ])>
                                                        <i class="{{ $sm->icon }}"></i> <span
                                                            data-key="t-{{ $sm->name }}"> {{ __($sm->name) }}</span>
                                                    </a>
                                                </li>
                                            @endcan
                                        @endforeach
                                    </ul>
                                </div>
                            </li>
                        @else
                            <li class="nav-item">
                                <a href="{{ url($menu->url) }}" @class([
                                    'nav-link',
                                    'menu-link',
                                    'active' => str_contains(request()->path(), $menu->url),
                                ])
                                    data-key="t-{{ $menu->name }}">
                                    <i class="{{ $menu->icon }}"></i>
                                    <span data-key="t-{{ $menu->name }}">{{ __($menu->name) }}</span>
                                </a>
                            </li>
                            {{-- <li class="nav-item">
                                <a href="{{ url($menu->url) }}" @class([
                                    'nav-link',
                                    'active' => str_contains(request()->path(), $menu->url),
                                ])
                                    data-key="t-{{ $menu->name }}">
                                    <i class="{{ $menu->icon }}"></i> <span data-key="t-{{ $menu->name }}">
                                        {{ __($menu->name) }} </span>
                                </a>
                            </li> --}}
                        @endif
                    @endcan
                @endforeach
            @endforeach

            <!-- Multi level menu -->
            {{-- <li class="nav-item">
                <a class="nav-link menu-link" href="#sidebarMultilevel" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarMultilevel">
                    <i class="ri-share-line"></i> <span data-key="t-multi-level">Multi Level</span>
                </a>
                <div class="collapse menu-dropdown" id="sidebarMultilevel">
                    <ul class="nav nav-sm flex-column">
                        <li class="nav-item">
                            <a href="#" class="nav-link" data-key="t-level-1.1"> Level 1.1 </a>
                        </li>
                        <li class="nav-item">
                            <a href="#sidebarAccount" class="nav-link" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarAccount" data-key="t-level-1.2"> Level
                                1.2
                            </a>
                            <div class="collapse menu-dropdown" id="sidebarAccount">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="#" class="nav-link" data-key="t-level-2.1"> Level 2.1 </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#sidebarCrm" class="nav-link" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarCrm" data-key="t-level-2.2"> Level 2.2
                                        </a>
                                        <div class="collapse menu-dropdown" id="sidebarCrm">
                                            <ul class="nav nav-sm flex-column">
                                                <li class="nav-item">
                                                    <a href="#" class="nav-link" data-key="t-level-3.1"> Level 3.1
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="#" class="nav-link" data-key="t-level-3.2"> Level 3.2
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </li> --}}

        </ul>
    </div>
    <!-- Sidebar -->
</div>
<div class="sidebar-background"></div>
