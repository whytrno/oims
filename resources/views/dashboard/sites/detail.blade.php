<x-layouts.user :page="$page">
    <div class="border rounded-lg h-full p-5 space-y-5">
        <div class="flex gap-3 items-center">
            <div @click="$refs.profilephoto.click()" <x-avatar :src="$foto" :fallback="$nama" />
        </div>

        <div class="capitalize">
            <h1 id="name" class="text-lg font-semibold">{{ $nama }}</h1>
            <p id="role-name" class="text-sm text-gray-500">{{ $role }}</p>
        </div>
    </div>

    <x-divider />

    <form class="space-y-8" wire:submit.prevent="update">
        @csrf
        <h1 class="text-lg font-semibold">Authentication</h1>

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
            <input x-ref="profilephoto" type="file" class="hidden" wire:model.lazy="foto"
                disabled="{{ auth()->user()->getRoleNames()->first() === 'admin' ? false : true }}">
            <x-inputs.file name="foto_ktp" label="Foto KTP" accept="image/*" :src="$foto_ktp" :disabled="$_disabled">
                @if (is_string($foto_ktp))
                    <x-link type="modalButton" modalComponent="ImagePreviewModal"
                        arguments="{ image: '{{ $foto_ktp }}' }">
                        Lihat KTP
                    </x-link>
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
                        <x-link type="modalButton" modalComponent="ImagePreviewModal"
                            arguments="{ image: '{{ $foto_mcu }}' }">
                            Lihat MCU
                        </x-link>
                    @endif
                </x-inputs.file>
            @endif

            <x-inputs.select label="Status Kontrak" name="status_kontrak" :options="$statusKontrakOptions" :selected="$status_kontrak"
                :disabled="$_disabled" />
            <x-inputs.select label="Agama" name="agama" :options="$agamaOptions" :selected="$agama" :disabled="$_disabled" />
            <x-inputs.select label="Pendidikan Terakhir" name="pendidikan_terakhir" :options="$pendidikanTerakhirOptio :disabled="$_disabled"ns"
                :selected="$pendidikan_terakhir" />
            <x-inputs.select label="Status Pernikahan" name="status_pernikahan" :options="$statusPernikahanOptions" :selected="$status_pernikahan"
                :disabled="$_disabled" />

            @if ($status_pernikahan === 'menikah')
                <x-inputs.input name="anak" label="Jumlah Anak" type="number" :disabled="$_disabled" />
            @endif
        </div>

        <x-link type="submit" width="full" :disabled="$_disabled">
            Submit
        </x-link>
    </form>
    </div>
</x-layouts.user>
