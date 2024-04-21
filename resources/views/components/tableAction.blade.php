@props(['detail' => false, 'edit' => false, 'delete' => false])

<div class="flex gap-3">
    @if ($detail)
        <x-button type="link" :href="$detailRoute">
            View
        </x-button>
    @endif

    @role('admin')
        @if ($edit)
            @if ($edit === 'userSiteLocation')
                <x-button type="modalButton" modalComponent="Modals.CreateUserSiteLocation"
                    arguments="{ 
        'type': 'edit',
        'id': {{ $data->id }},
        'user_id' : {{ $data->user->id }},
        'site_location_id': '{{ $data->site_location_id }}',
        'tgl_keberangkatan': '{{ $data->tgl_keberangkatan }}',
        'tgl_kembali': '{{ $data->tgl_kembali }}',
     }">
                    Ubah Data
                </x-button>
            @else
                <x-button type="modalButton" modalComponent="Modals.CreateEditSiteModal"
                    arguments="{ 
        'type': 'edit',
        'id' : {{ $data->id }},
        'name': '{{ $data->name }}'
     }">
                    Ubah Data
                </x-button>
            @endif
        @endif

        @if ($delete)
            <button wire:click="destroy({{ $data->id }})" wire:confirm="Apakah anda yakin ingin menghapus data ini?"
                class="border-b border-b-gray-400 border-dotted hover:border-b-black text-sm w-min whitespace-nowrap">
                Delete
            </button>
        @endif
    @endrole
</div>
