@php
    $provinces = Http::get('https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json');
    $provinces = json_decode($provinces->body());
    $provinceOptions = [];

    foreach ($provinces as $province) {
        $provinceOptions[$province->name] = $province->id;
    }
    $others = [
        'Pilih Provinsi' => 'Pilih Provinsi',
        'HO' => 'HO'
    ];

    $provinces = array_merge($others, $provinces);
    $provinceOptions = array_merge($others, $provinceOptions);
@endphp

<div class="space-y-2 px">
    <label class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70">
        Provinsi
    </label>
    <select id="provinsi"
            class="flex h-9 w-full rounded-md border border-input bg-transparent px-3 py-1 text-sm shadow-sm transition-colors file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:cursor-not-allowed disabled:opacity-50"
            aria-describedby=":rr:-form-item-description" aria-invalid="false" name="{{ $name }}">
        @foreach ($provinceOptions as $value => $text)
            <option value="{{ $value }}">
                {{ $value }}
            </option>
        @endforeach
    </select>

    @if ($errors->has($name))
        <div class="text-red-600 text-xs">
            {{ $errors->first($name) }}
        </div>
    @endif
</div>

@push('scripts')
    <script>
        document.getElementById('provinsi').addEventListener('change', function () {
            var selectedProvinceName = this.value;

            var selectedProvinceId = {!! json_encode($provinceOptions) !!}[selectedProvinceName];

            if (selectedProvinceName === 'HO') {
                var kabupatenOptions = document.getElementById('kabupaten');
                kabupatenOptions.innerHTML = '';

                var option = document.createElement('option');
                option.value = 'HO';
                option.text = 'HO';
                kabupatenOptions.appendChild(option);

                return;
            }

            fetch(`https://www.emsifa.com/api-wilayah-indonesia/api/regencies/${selectedProvinceId}.json`)
                .then(response => response.json())
                .then(regencies => {
                    var kabupatenOptions = document.getElementById('kabupaten');
                    kabupatenOptions.innerHTML = '';

                    regencies.forEach(regency => {
                        var option = document.createElement('option');
                        option.value = regency.name;
                        option.text = regency.name;
                        kabupatenOptions.appendChild(option);
                    });
                })
                .catch(error => console.error('Error fetching regencies:', error));
        });
    </script>
@endpush
