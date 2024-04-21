<div class="flex gap-4 items-center" type="button" id="radix-:R6quda:" aria-haspopup="menu" aria-expanded="false"
    data-state="closed">
    <div class="flex flex-col gap-1 items-end capitalize">
        <p>{{ Auth::user()->profile->nama }}</p>
        <p class="text-xs">{{ Auth::user()->getRoleNames()->first() }}</p>
    </div>
    <button @click="userNavModal = !userNavModal"
        class="inline-flex items-center justify-center whitespace-nowrap text-sm font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 bg-secondary text-secondary-foreground shadow-sm hover:bg-secondary/80 h-9 w-9 rounded-full">
        <x-avatar :src="auth()->user()->profile->foto" :fallback="auth()->user()->profile->nama" size="10" />
        <span class="sr-only">Toggle user menu</span>
    </button>
</div>
