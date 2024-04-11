<div class="hidden border-r bg-muted/40 md:block">
    <div class="flex h-full max-h-screen flex-col gap-4">
        <div class="flex h-14 items-center border-b px-4 lg:h-[60px] lg:px-6">
            <a href="/" class="flex items-center gap-2 font-semibold">
                <img src="/logo.png" alt="logo" class="size-10" />
                <span class="">OimsApps</span>
            </a>
        </div>
        <div class="flex-1">
            <nav class="grid gap-2 items-start px-2 text-sm font-medium lg:px-4">
                @php
                    $navLinks = [
                        [
                            'name' => 'Dashboard',
                            'route' => 'dashboard',
                            'icon' => 'mdi:home',
                        ],
                        [
                            'name' => 'Users',
                            'route' => 'users',
                            'icon' => 'mdi:account-group',
                        ],
                        [
                            'name' => 'Profile',
                            'route' => 'profile',
                            'icon' => 'mdi:account',
                        ],
                    ];
                @endphp
                @foreach ($navLinks as $navLink)
                    @if (Auth::user()->role_id == 3 && $navLink['name'] != 'Profile')
                        @continue
                    @endif
                    <a href={{ route($navLink['route']) }}
                        class="flex items-center gap-3 rounded-lg px-5 py-3 transition-all {{ Request::routeIs($navLink['route']) ? 'bg-primary text-white' : 'text-muted-foreground hover:text-primary' }}">
                        <iconify-icon icon="{{ $navLink['icon'] }}" observer="false"></iconify-icon>
                        {{ $navLink['name'] }}
                    </a>
                @endforeach
            </nav>

        </div>
    </div>
</div>

@push('scripts')
    <script>
        function toggleMobileSidebar() {
            const sidebarModal = $('#sidebar-mobile-modal');
            const dataState = sidebarModal.attr('data-state');

            if (dataState === 'open') {
                sidebarModal.attr('data-state', 'closed');
            } else {
                sidebarModal.attr('data-state', 'open');
            }
        }
    </script>
@endpush
