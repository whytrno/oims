@extends('layouts.app')

@section('content')
    <div class="grid min-h-screen w-full md:grid-cols-[220px_1fr] lg:grid-cols-[280px_1fr]">
        {{-- SIDEBAR --}}
        @include('components.sidebar')
        <div class="flex flex-col">
            {{-- NAVBAR --}}
            @include('components.navbar')
            <main class="flex flex-1 flex-col gap-4 p-4 lg:gap-6 lg:p-6 w-screen lg:w-full">
                {{-- PAGE TITLE --}}
                @include('components.pageTitle')

                {{-- MAIN --}}
                @yield('dashboard-content')
            </main>
        </div>
    </div>

    {{-- MOBILE SIDEBAR MODAL --}}
    @include('components.mobileSidebarModal')

    {{-- USER NAV MODAL --}}
    @include('components.navbar.userNavModal')
@endsection
