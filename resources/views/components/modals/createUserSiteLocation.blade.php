<div class="p-5">
    <form
        wire:submit.prevent="@if ($type == 'edit') update({{ $id }})
    @elseif($type === 'create') create @endif">
        @csrf
        <div class="space-y-5">
            <x-inputs.select name="user_id" label="Karyawan" :options="$userOptions" />
            <x-inputs.select name="site_location_id" label="Lokasi Site" :options="$siteLocationOptions" />
            <div class="grid grid-cols-1 md:grid-cols-2 gap-3 md:gap-10">
                <x-inputs.input name="tgl_keberangkatan" label="Tanggal Pemberangkatan" type="date" />
                <x-inputs.input name="tgl_kembali" label="Tanggal Kembali" type="date" :min="$tgl_keberangkatan" />
            </div>

            <x-button type="button" buttonType="submit" width="full">
                Submit
            </x-button>
        </div>
    </form>
</div>
