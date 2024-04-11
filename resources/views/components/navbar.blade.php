<header class="flex h-14 items-center gap-4 border-b bg-muted/40 px-4 lg:h-[60px] lg:px-6">
    {{-- USER MOBILE --}}
    @include('components.navbar.mobileSidebarToggler')

    <div class="w-full flex-1"></div>

    {{-- USER NAV INFO --}}
    @include('components.navbar.userNavInfo')
</header>

@push('scripts')
    <script>
        function toggleUserNavModal() {
            const userNavModal = $('#user-nav-modal');
            const dataState = userNavModal.attr('data-state');

            if (dataState === 'open') {
                userNavModal.attr('data-state', 'closed');
            } else {
                userNavModal.attr('data-state', 'open');
            }
        }
    </script>
@endpush
