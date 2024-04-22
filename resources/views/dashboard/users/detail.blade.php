<x-layouts.pageActions :page="$_page">
    @if ($_page === 'view')
        @role('admin')
            {{-- <x-iconButton :href="route('users.create')" icon="mdi:location-check-outline">
                Tambah Data
            </x-iconButton> --}}
        @endrole
    @elseif($_page === 'edit')
        <x-button type="iconButton" :href="route('users.sites.detail', $userId)" icon="mdi:location-check-outline">
            Lokasi Site
        </x-button>
    @endif
</x-layouts.pageActions>

<div>
    <div class="border rounded-lg flex p-5 space-y-5 gap-3 items-center">
        <div class="flex items-center gap-3">
            <div @click="$refs.profilephoto.click()">
                <x-avatar :src="$foto" :fallback="$nama" />
            </div>
            <div class="capitalize">
                <h1 id="name" class="text-lg font-semibold">{{ $nama }}</h1>
                <p id="role-name" class="text-sm text-gray-500">{{ $role }}</p>
            </div>
        </div>
    </div>

    <x-divider />

    <form class="space-y-8" wire:submit.prevent="update">
        @csrf
        <h1 class="text-lg font-semibold">Authentication</h1>

        <input x-ref="profilephoto" type="file" class="hidden" wire:model.lazy="foto" @disabled($_disabled)>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
            <x-inputs.select label="Role" name="role_id" :options="$roles" :disabled="$_disabled" />
            <x-inputs.input name="email" label="Email" type="email" :disabled="$_disabled" />
            <x-inputs.input name="password" label="Password" type="password" :disabled="$_disabled" />
            <x-inputs.input name="password_confirmation" label="Password Confirmation" type="password"
                :disabled="$_disabled" />
        </div>

        <x-divider />

        <h1 class="text-lg font-semibold">Profile</h1>

        <div class="grid md:grid-cols-2 gap-10">
            <x-inputs.file name="foto_ktp" label="Foto KTP" accept="image/*" :src="$foto_ktp" :disabled="$_disabled">
                @if (is_string($foto_ktp))
                    <x-button type="modalButton" modalComponent="ImagePreviewModal"
                        arguments="{ image: '{{ $foto_ktp }}' }">
                        Lihat KTP
                    </x-button>
                @endif
            </x-inputs.file>
            <x-inputs.input name="nama" label="Name" type="text" :disabled="$_disabled" />
            <x-inputs.input name="no_hp" label="No. HP" type="number" :disabled="$_disabled" />
            <x-inputs.input name="nik" label="NIK" type="number" :disabled="$_disabled" />
            <x-inputs.input name="tempat_lahir" label="Tempat Lahir" type="text" :disabled="$_disabled" />
            <x-inputs.input name="tgl_lahir" label="Tanggal Lahir" type="date" :disabled="$_disabled" />
            <x-inputs.input name="alamat_ktp" label="Alamat KTP" type="text" :disabled="$_disabled" />
            <x-inputs.input name="domisili" label="Domisili" type="text" :disabled="$_disabled" />
            <x-inputs.input name="nama_kontak_darurat" label="Nama Kontak Darurat" type="text" :disabled="$_disabled" />
            <x-inputs.input name="hubungan_kontak_darurat" label="Hubungan Kontak Darurat" type="text"
                :disabled="$_disabled" />
            <x-inputs.input name="no_kontak_darurat" label="Nomor Kontak Darurat" type="number" :disabled="$_disabled" />
            <x-inputs.input name="no_rek_bca" label="No. Rek BCA" type="number" :disabled="$_disabled" />
            <x-inputs.input name="tgl_bergabung" label="Tanggal Bergabung" type="date" :disabled="$_disabled" />
            <x-inputs.input name="nrp" label="NRP" type="text" :disabled="$_disabled" />
            <x-inputs.input name="no_kontrak" label="No. Kontrak" type="number" :disabled="$_disabled" />
            <x-inputs.select label="MCU" name="mcu" :options="$mcuOptions" :disabled="$_disabled" />

            @if ($mcu === 'ada')
                <x-inputs.file name="foto_mcu" label="Foto MCU" accept="image/*" :src="$foto_mcu" :disabled="$_disabled">
                    @if (is_string($foto_mcu))
                        <x-button type="modalButton" modalComponent="ImagePreviewModal"
                            arguments="{ image: '{{ $foto_mcu }}' }">
                            Lihat MCU
                        </x-button>
                    @endif
                </x-inputs.file>
            @endif

            <x-inputs.select label="Status Kontrak" name="status_kontrak" :options="$statusKontrakOptions" :selected="$status_kontrak"
                :disabled="$_disabled" />
            <x-inputs.select label="Agama" name="agama" :options="$agamaOptions" :selected="$agama" :disabled="$_disabled" />
            <x-inputs.select label="Pendidikan Terakhir" name="pendidikan_terakhir" :options="$pendidikanTerakhirOptions"
                :disabled="$_disabled" :selected="$pendidikan_terakhir" />
            <x-inputs.select label="Status Pernikahan" name="status_pernikahan" :options="$statusPernikahanOptions" :selected="$status_pernikahan"
                :disabled="$_disabled" />

            @if ($status_pernikahan === 'menikah')
                <x-inputs.input name="nama_istri" label="Nama Istri" type="text" :disabled="$_disabled" />
                <x-inputs.input name="anak" label="Jumlah Anak" type="number" :disabled="$_disabled" />

                @if ($anak > 0)
                    @for ($i = 0; $i < $anak; $i++)
                        <x-inputs.input name="nama_anak.{{ $i }}" label="Nama Anak {{ $i + 1 }}"
                            type="text" wire:model.lazy="nama_anak.{{ $i }}" :disabled="$_disabled" />
                    @endfor
                @endif
            @endif
        </div>

        @php
            $_buttonDisabled = true;

            if ($errors->any() || $_disabled) {
                $_buttonDisabled = true;
            } else {
                $_buttonDisabled = false;
            }
        @endphp

        <x-button type="button" buttonType="submit" width="full" :disabled="$_buttonDisabled">
            Submit
        </x-button>
    </form>
</div>
