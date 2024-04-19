<div class="w-full h-screen flex justify-center items-center bg-cover bg-center">
    <img src="{{ asset('images/auth-bg.jpg') }}" alt=""
        class="h-screen w-full object-cover object-top fixed top-0 left-0 z-10">
    <div class="rounded-xl border text-card-foreground shadow mx-auto max-w-sm bg-white/90 z-50">
        <div class="flex flex-col space-y-1.5 p-6">
            <h3 class="font-semibold tracking-tight text-2xl">Login</h3>
            <p class="text-sm text-muted-foreground">Enter your email below to login to your account</p>
        </div>
        <div class="p-6 pt-0">
            <form wire:submit="formSubmit">
                @csrf
                <div class="grid gap-4">
                    <x-inputs.input label="Email" name="email" disabled="{{ false }}" />
                    <x-inputs.input label="Password" name="password" type="password" disabled="{{ false }}" />
                    @if ($_page === 'register')
                        <x-inputs.input label="Konfirmasi Password" name="password_confirmation" type="password"
                            disabled="{{ false }}" />
                        <x-inputs.input label="Nama" name="nama" disabled="{{ false }}" />
                        <x-inputs.input label="No. HP" name="no_hp" type="number" disabled="{{ false }}" />
                    @endif
                    <button
                        class="inline-flex items-center justify-center whitespace-nowrap rounded-md text-sm font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 bg-primary text-primary-foreground shadow hover:bg-primary/90 h-9 px-4 py-2 w-full"
                        type="submit">
                        @if ($_page === 'register')
                            Register
                        @elseif($_page === 'login')
                            Login
                        @endif
                    </button>
                </div>
            </form>

            <div class="mt-4 text-center text-sm">
                @if ($_page === 'login')
                    Don't have an account?
                    <button wire:click="changePage('register')" class="underline">Sign up</button>
                @elseif($_page === 'register')
                    Have an account?
                    <button wire:click="changePage('login')" class="underline">Sign In</button>
                @endif
            </div>
        </div>
    </div>
</div>
