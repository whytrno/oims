@props([
    'name',
    'label',
    'options',
    'selected' => [],
    'disabled' => auth()->user()->getRoleNames()->first() === 'admin' ? false : true,
])
<div class="space-y-2">
    <label class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70">
        {{ $label }}
    </label>
    <select @disabled($disabled) @class([
        'flex h-9 w-full rounded-md border border-input bg-transparent px-3 py-1 text-sm shadow-sm transition-colors file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:cursor-not-allowed disabled:opacity-50',
        'border-red-600' => $errors->has($name),
    ]) wire:model.lazy="{{ $name }}">
        @empty(!$options)
            <option value="">Pilih {{ $label }}</option>
            @foreach ($options as $value => $label)
                <option value="{{ $value }}">
                    {{ ucfirst($label) }}
                </option>
            @endforeach
        @else
            <option value="">Tidak ada data</option>
        @endempty
    </select>

    @error($name)
        <span class="text-xs text-red-600">{{ $message }}</span>
    @enderror
</div>
