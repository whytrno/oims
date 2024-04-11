@extends('layouts.app')

@section('content')
    <div
        class="w-full h-screen bg-[url('{{ asset('images/auth-bg.jpeg') }}')] flex justify-center items-center bg-cover bg-center">
        <img src="{{ asset('images/auth-bg.jpeg') }}" alt=""
            class="h-screen w-full object-cover object-top fixed top-0 left-0 z-10">
        <div class="rounded-xl border text-card-foreground shadow mx-auto max-w-sm bg-white/90 z-50">
            <div class="flex flex-col space-y-1.5 p-6">
                <h3 class="font-semibold tracking-tight text-2xl">Register</h3>
                <p class="text-sm text-muted-foreground">Enter your email below to login to your account</p>
            </div>
            <div class="p-6 pt-0">
                <form action="{{ route('register.process') }}" method="POST">
                    @csrf
                    <div class="grid gap-4">
                        <div class="grid gap-2">
                            <label
                                class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70"
                                for="email">Email</label>

                            <input
                                class="flex h-9 w-full rounded-md border border-input bg-transparent px-3 py-1 text-sm shadow-sm transition-colors file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:cursor-not-allowed disabled:opacity-50"
                                id="email" name="email" placeholder="m@example.com" required="" type="email"
                                value="">
                            <div data-lastpass-icon-root=""
                                style="position: relative !important; height: 0px !important; width: 0px !important; float: left !important;">
                            </div>
                            @if ($errors->has('email'))
                                <div class="text-red-600 text-xs">
                                    {{ $errors->first('email') }}
                                </div>
                            @endif
                        </div>
                        <div class="grid gap-2">
                            <div class="flex items-center">
                                <label
                                    class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70"
                                    for="password">Password</label>
                            </div>
                            <input
                                class="flex h-9 w-full rounded-md border border-input bg-transparent px-3 py-1 text-sm shadow-sm transition-colors file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:cursor-not-allowed disabled:opacity-50"
                                id="password" name="password" placeholder="Password" required="" type="password"
                                value="">
                            @if ($errors->has('password'))
                                <div class="text-red-600 text-xs">
                                    {{ $errors->first('password') }}
                                </div>
                            @endif
                        </div>
                        <div class="grid gap-2">
                            <div class="flex items-center">
                                <label
                                    class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70"
                                    for="password">Password Confirmation</label>
                            </div>
                            <input
                                class="flex h-9 w-full rounded-md border border-input bg-transparent px-3 py-1 text-sm shadow-sm transition-colors file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:cursor-not-allowed disabled:opacity-50"
                                name="password_confirm" placeholder="Password" required="" type="password"
                                value="">
                            @if ($errors->has('password_confirm'))
                                <div class="text-red-600 text-xs">
                                    {{ $errors->first('password_confirm') }}
                                </div>
                            @endif
                        </div>
                        <div class="grid gap-2">
                            <div class="flex items-center">
                                <label
                                    class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70"
                                    for="password">Nama</label>
                            </div>
                            <input
                                class="flex h-9 w-full rounded-md border border-input bg-transparent px-3 py-1 text-sm shadow-sm transition-colors file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:cursor-not-allowed disabled:opacity-50"
                                name="nama" placeholder="Masukan Nama" required="" type="text" value="">
                            @if ($errors->has('nama'))
                                <div class="text-red-600 text-xs">
                                    {{ $errors->first('nama') }}
                                </div>
                            @endif
                        </div>
                        <div class="grid gap-2">
                            <div class="flex items-center">
                                <label
                                    class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70"
                                    for="password">No. HP</label>
                            </div>
                            <input
                                class="flex h-9 w-full rounded-md border border-input bg-transparent px-3 py-1 text-sm shadow-sm transition-colors file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:cursor-not-allowed disabled:opacity-50"
                                name="no_hp" placeholder="No HP" required="" type="number" value="">
                        </div>
                        @if ($errors->has('no_hp'))
                            <div class="text-red-600 text-xs">
                                {{ $errors->first('no_hp') }}
                            </div>
                        @endif
                        <button
                            class="inline-flex items-center justify-center whitespace-nowrap rounded-md text-sm font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 bg-primary text-primary-foreground shadow hover:bg-primary/90 h-9 px-4 py-2 w-full"
                            type="submit">Register</button>
                    </div>
                </form>
                <div class="mt-4 text-center text-sm">Have an account? <a class="underline" href="{{ route('login') }}">Sign
                        in</a>
                </div>
            </div>
        </div>
    </div>
@endsection
