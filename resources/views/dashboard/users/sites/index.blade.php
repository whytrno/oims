<div class="space-y-10">
    <button type="button" wire:click="$dispatch('openModal', { component: 'Modals.CreateUserSiteLocation', })"
            class="md:col-span-2 w-full inline-flex items-center justify-center whitespace-nowrap rounded-md text-sm font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 text-primary-foreground shadow h-9 px-4 py-2 bg-primary hover:bg-primary/90">
        Tambah Data
    </button>
    <div class="space-y-5">
        <div class="flex gap-4">
            <x-inputs.input width="full" name="tgl_keberangkatan" label="Tanggal Pemberangkatan" type="date"/>
            <x-inputs.input width="full" name="tgl_kembali" label="Tanggal Kembali" type="date"
                            :min="$tgl_keberangkatan"/>
        </div>
        <button @click="$dispatch('filter')"
                class="md:col-span-2 inline-flex items-center justify-center whitespace-nowrap rounded-md text-sm font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 text-primary-foreground shadow h-9 px-4 py-2 bg-primary hover:bg-primary/90 w-full">
            Filter
        </button>
    </div>
    @livewire('Tables.UserSiteLocationTable')
</div>
