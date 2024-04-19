<div class="p-10">
    <form wire:submit="create" class="space-y-5">
        <h1 class="text-lg font-semibold text-center">Tambah Data Penempatan</h1>
        @csrf
        <x-inputs.input label="Nama Lokasi Site" name="name" wire:model.lazy="name" />
        <x-button type="submit" width="full">
            Submit
        </x-button>
    </form>
</div>
