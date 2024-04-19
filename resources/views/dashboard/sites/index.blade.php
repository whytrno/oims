<div class="space-y-2">
    <button type="button" wire:click="$dispatch('openModal', { component: 'Modals.CreateSiteModal'})"
        class="md:col-span-2 w-full inline-flex items-center justify-center whitespace-nowrap rounded-md text-sm font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 text-primary-foreground shadow h-9 px-4 py-2 bg-primary hover:bg-primary/90">
        Tambah Data
    </button>
    @livewire('Tables.SiteTable')
</div>
