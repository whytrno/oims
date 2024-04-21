<div class="p-10">
    <form
        wire:submit="@if ($type == 'edit') update({{ $id }})
    @elseif($type === 'create') create @endif"
        class="space-y-5">
        <h1 class="text-lg font-semibold text-center">
            @if ($type == 'edit')
                Ubah
            @elseif($type == 'create')
                Tambah
            @endif
            Data Penempatan
        </h1>
        @csrf
        <x-inputs.input label="Nama Lokasi Site" name="name" wire:model.lazy="name" />
        <x-button type="button" buttonType="submit" width="full">
            Submit
        </x-button>
    </form>
</div>
