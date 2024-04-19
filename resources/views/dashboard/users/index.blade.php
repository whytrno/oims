<x-layouts.pageActions :page="$_page">
    @if ($_page === 'view')
        {{-- @role('admin')
            <x-iconButton :href="route('users.create')" icon="mdi:location-check-outline">
                Add Data
            </x-iconButton>
        @endrole --}}
    @elseif($_page === 'edit')
        <x-iconButton :href="route('users.sites', 1)" icon="mdi:location-check-outline">
            Lokasi Site
        </x-iconButton>
    @endif
</x-layouts.pageActions>

<div>
    @livewire('UserTable')
</div>
