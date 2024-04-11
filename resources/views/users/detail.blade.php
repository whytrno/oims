@extends('layouts.dashboard')

@section('dashboard-content')
    <div class="border rounded-lg h-full p-5 space-y-5">
        <div class="flex gap-3 items-center">

            <span onclick="$('#foto').click()"
                class="relative flex shrink-0 overflow-hidden rounded-full size-14 cursor-pointer">
                @if (!isset($data))
                    <div
                        class="h-full w-full rounded-full flex items-center justify-center bg-gray-200 text-gray-600 font-semibold">
                        U
                    </div>
                @elseif (isset($data) && is_null($data->profile->foto))
                    @php
                        $namaExplode = explode(' ', $data->profile->nama);
                        $fallback = $namaExplode[0][0];
                    @endphp
                    <div
                        class="h-full w-full rounded-full flex items-center justify-center bg-gray-200 text-gray-600 font-semibold">
                        {{ $fallback }}
                    </div>
                @else
                    <img class="aspect-square size-14 rounded-full" alt="Foto" src="{{ $data->profile->foto }}">
                @endif
            </span>
            <div class="capitalize">
                <h1 id="name" class="text-lg font-semibold">{{ isset($data) ? $data->profile->nama : 'User' }}</h1>
                <p id="role-name" class="text-sm text-gray-500">{{ isset($data) ? $data->role->name : 'User' }}</p>
            </div>
        </div>
        <x-divider />
        {{-- {{ isset($data) ? route('users.update', $data->id) : route('users.store') }} --}}
        <form class="space-y-8"
            @if (isset($data) && !isset($type)) action="{{ route('users.update', $data->id) }}"            
        @elseif(isset($data) && isset($type) && $type == 'profile')
            action="{{ route('profile.update') }}"
            @else
            action="{{ route('users.store') }}" @endif
            enctype="multipart/form-data" method="POST">
            @csrf
            <h1 class="text-lg font-semibold">Authentication</h1>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                @php
                    $roleOptions = [
                        '1' => 'Admin',
                        '2' => 'Management',
                        '3' => 'User',
                    ];

                    $selectedRole = ['3' => 'User'];

                    if (isset($data)) {
                        $selectedRole = [$data->role_id => $data->role->name];
                    }
                @endphp
                <x-inputs.select label="Role" name="role_id" :options="$roleOptions" :selected="$selectedRole" />
                <x-inputs.input name="email" label="Email" type="email"
                    value="{{ isset($data) ? $data->email : '' }}" />
                <x-inputs.input name="password" label="Password" type="password" value="" />
                <x-inputs.input name="password_confirmation" label="Password Confirmation" type="password" value="" />
            </div>

            <x-divider />

            <h1 class="text-lg font-semibold">Profile</h1>
            <div class="grid md:grid-cols-2 gap-10">
                <x-inputs.file name="foto" label="Foto" accept="image/*" class="hidden" />
                <x-inputs.input name="nama" label="Name" type="text"
                    value="{{ isset($data) ? $data->profile->nama : '' }}" />
                <x-inputs.input name="no_hp" label="No. HP" type="number"
                    value="{{ isset($data) ? $data->profile->no_hp : '' }}" />
                <x-inputs.input name="nik" label="NIK" type="number"
                    value="{{ isset($data) ? $data->profile->nik : '' }}" />
                <x-inputs.input name="tgl_lahir" label="Tanggal Lahir" type="date"
                    value="{{ isset($data) ? $data->profile->tgl_lahir : '' }}" />
                <x-inputs.input name="tempat_lahir" label="Tempat Lahir" type="text"
                    value="{{ isset($data) ? $data->profile->tempat_lahir : '' }}" />
                <x-inputs.input name="domisili" label="Domisili" type="text"
                    value="{{ isset($data) ? $data->profile->domisili : '' }}" />
                <x-inputs.input name="alamat_ktp" label="Alamat KTP" type="text"
                    value="{{ isset($data) ? $data->profile->alamat_ktp : '' }}" />
                <x-inputs.input name="kontak_darurat" label="Kontak Darurat" type="number"
                    value="{{ isset($data) ? $data->profile->kontak_darurat : '' }}" />
                <x-inputs.input name="no_rek_bca" label="No. Rek BCA" type="number"
                    value="{{ isset($data) ? $data->profile->no_rek_bca : '' }}" />
                <x-inputs.input name="tgl_bergabung" label="Tanggal Bergabung" type="date"
                    value="{{ isset($data) ? $data->profile->tgl_bergabung : '' }}" />
                <x-inputs.input name="nrp" label="NRP" type="text"
                    value="{{ isset($data) ? $data->profile->nrp : '' }}" />
                <x-inputs.input name="no_kontrak" label="No. Kontrak" type="number"
                    value="{{ isset($data) ? $data->profile->no_kontrak : '' }}" />

                @php
                    $mcuOptions = [
                        'ada' => 'Ada',
                        'tidak ada' => 'Tidak Ada',
                    ];

                @endphp
                <x-inputs.select label="MCU" name="mcu" :options="$mcuOptions" :selected="['ada' => 'Ada']" />

                @php
                    $statusKontrakOptions = [
                        'aktif' => 'Aktif',
                        'tidak aktif' => 'Tidak Aktif',
                    ];

                    $selectedStatusKontrak = ['aktif' => 'Aktif'];

                    if (isset($data)) {
                        $selectedStatusKontrak = [
                            $data->profile->status_kontrak => ucfirst($data->profile->status_kontrak),
                        ];
                    }
                @endphp
                <x-inputs.select label="Status Kontrak" name="status_kontrak" :options="$statusKontrakOptions" :selected="$selectedStatusKontrak" />

                @php
                    $agamaOptions = [
                        'islam' => 'Islam',
                        'kristen' => 'Kristen',
                        'katolik' => 'Katolik',
                        'hindu' => 'hindu',
                        'budha' => 'Budha',
                        'konghucu' => 'Konghucu',
                    ];

                    $selectedAgama = ['kristen' => 'Kristen'];

                    if (isset($data)) {
                        $selectedAgama = [$data->profile->agama => ucfirst($data->profile->agama)];
                    }
                @endphp
                <x-inputs.select label="Agama" name="agama" :options="$agamaOptions" :selected="$selectedAgama" />

                @php
                    $pendidikanOptions = [
                        'sd' => 'SD',
                        'smp' => 'SMP',
                        'sma' => 'SMA',
                        'd3' => 'D3',
                        's1' => 'S1',
                        's2' => 'S2',
                        's3' => 'S3',
                    ];

                    $selectedPendidikan = ['sd' => 'SD'];

                    if (isset($data)) {
                        $selectedPendidikan = [
                            $data->profile->pendidikan_terakhir => strtoupper($data->profile->pendidikan_terakhir),
                        ];
                    }
                @endphp
                <x-inputs.select label="Pendidikan Terakhir" name="pendidikan_terakhir" :options="$pendidikanOptions"
                    :selected="$selectedPendidikan" />


                @php
                    $statusPernikahanOptions = [
                        'belum menikah' => 'Belum Menikah',
                        'menikah' => 'Menikah',
                        'cerai' => 'Cerai',
                    ];

                    $selectedStatus = ['belum menikah' => 'Belum Menikah'];

                    if (isset($data)) {
                        $selectedStatus = [
                            $data->profile->status_pernikahan => ucfirst($data->profile->status_pernikahan),
                        ];
                    }
                @endphp
                <x-inputs.select label="Status Pernikahan" name="status_pernikahan" :options="$statusPernikahanOptions" :selected="$selectedStatus" />

                <x-inputs.input
                    disabled="{{ isset($data) && $data->profile->status_pernikahan == 'belum menikah' ? 'true' : 'false' }}"
                    name="anak" label="Jumlah Anak" type="number"
                    value="{{ isset($data) ? $data->profile->anak : '' }}" />
            </div>

            <x-divider />

            <h1 class="text-lg font-semibold">Lokasi Site</h1>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                @php
                    $selectedProvince = [];
                @endphp

                <x-inputs.provinceSelect name="provinsi" :selected="$selectedProvince" />

                @php
                    $selectedKabupaten = [];
                @endphp

                <x-inputs.kabupatenSelect name="kabupaten" :selected="$selectedKabupaten" />

                <button
                    class="md:col-span-2 inline-flex items-center justify-center whitespace-nowrap rounded-md text-sm font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 bg-primary text-primary-foreground shadow hover:bg-primary/90 h-9 px-4 py-2 w-full"
                    type="submit">
                    Submit
                </button>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script type="module">
        $('input[name="foto"]').on('change', function() {
            const file = $(this)[0].files[0];
            const reader = new FileReader();
            reader.onload = function(e) {
                $('#profile-input-preview').attr('src', e.target.result);
            }
            reader.readAsDataURL(file);
        });
        $('input[name="nama"]').on('input', function() {
            console.log($(this).val());
            $('#name').text($(this).val());
        });
        $('select[name="role_id"]').on('change', function() {
            var selectedText = $(this).find('option:selected').text();
            $('#role-name').text(selectedText);
        });
        $('select[name="status_pernikahan"]').on('change', function() {
            var selectedText = $(this).find('option:selected').text();

            if (selectedText === 'Belum Menikah') {
                $('input[name="anak"]').prop('disabled', true);
            } else {
                console.log('enabled')
                $('input[name="anak"]').prop('disabled', false);
            }
        });
    </script>
@endpush
