@props(['detail' => false, 'delete' => false])

<div class="flex gap-3">
    @if ($detail)
        <x-button type="link" :href="$detailRoute">
            View
        </x-button>
    @endif

    @if ($delete)
        @role('admin')
            <button wire:click="destroy({{ $data->id }})" wire:confirm="Apakah anda yakin ingin menghapus data ini?"
                class="border-b border-b-gray-400 border-dotted hover:border-b-black text-sm w-min whitespace-nowrap">
                Delete
            </button>
        @endrole
    @endif
</div>
