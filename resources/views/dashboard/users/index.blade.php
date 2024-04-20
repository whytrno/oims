@props(['userId' => null])

<x-layouts.pageActions :page="$_page">
    @if ($_page === 'view')
        {{-- <x-button type="iconButton" :href="route('users.sites', 1)" icon="mdi:location-check-outline">
            Lokasi Site
        </x-button> --}}
    @elseif($_page === 'edit')
        <x-button type="iconButton" :href="route('users.sites', $userId)" icon="mdi:location-check-outline">
            Lokasi Site
        </x-button>
    @endif
</x-layouts.pageActions>

<div>
    @livewire('Tables.UserTable')
</div>
