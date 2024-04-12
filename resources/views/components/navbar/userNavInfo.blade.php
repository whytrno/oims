<div class="flex gap-2 items-center" type="button" id="radix-:R6quda:" aria-haspopup="menu" aria-expanded="false"
    data-state="closed">
    <div class="flex flex-col gap-1 items-end capitalize">
        <p>{{ Auth::user()->profile->nama }}</p>
        <p class="text-xs">{{ Auth::user()->getRoleNames()->first() }}</p>
    </div>
    <button onclick="toggleUserNavModal()"
        class="inline-flex items-center justify-center whitespace-nowrap text-sm font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 bg-secondary text-secondary-foreground shadow-sm hover:bg-secondary/80 h-9 w-9 rounded-full">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
            class="lucide lucide-circle-user h-5 w-5">
            <circle cx="12" cy="12" r="10">

            </circle>
            <circle cx="12" cy="10" r="3">

            </circle>
            <path d="M7 20.662V19a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v1.662">

            </path>
        </svg>
        <span class="sr-only">Toggle user menu</span>
    </button>
</div>
