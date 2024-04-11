@php
    $kabupatenOptions = [];

    if (isset($data)) {
        $selectedKabupaten = [$data->profile->kabupaten => $data->profile->kabupaten];
    }
@endphp

<div class="space-y-2 px">
    <label class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70">
        Kabupaten
    </label>
    <select id="kabupaten"
        class="kabupaten-select flex h-9 w-full rounded-md border border-input bg-transparent px-3 py-1 text-sm shadow-sm transition-colors file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:cursor-not-allowed disabled:opacity-50"
        aria-describedby=":rr:-form-item-description" aria-invalid="false" name="{{ $name }}">
        {{-- @foreach ($kabupatenOptions as $value => $text)
            <option value="{{ $text }}"
                {{ old($name, $selected) == $value || isset($selected[$value]) ? 'selected' : '' }}>{{ $text }}
            </option>
        @endforeach --}}
    </select>

    @if ($errors->has($name))
        <div class="text-red-600 text-xs">
            {{ $errors->first($name) }}
        </div>
    @endif
</div>
