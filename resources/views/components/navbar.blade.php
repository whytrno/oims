<header x-data="{ mobileSidebarToggler: false, userNavModal: false }" class="flex h-14 items-center gap-4 border-b bg-muted/40 px-4 lg:h-[60px] lg:px-6">
    {{-- USER MOBILE --}}
    <x-navbar.mobileSidebarToggler />

    <div class="w-full flex-1">
    </div>

    {{-- USER NAV INFO --}}
    <x-navbar.userNavInfo />

    {{-- MOBILE SIDEBAR MODAL --}}
    <x-mobileSidebarModal />

    {{-- USER NAV MODAL --}}
    <x-navbar.userNavModal />
</header>
