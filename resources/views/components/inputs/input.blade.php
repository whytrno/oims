@props(['name', 'label', 'type' => 'text', 'disabled' => false, 'min' => null, 'max' => null])

@php
    // if (auth()->check()) {
    //     $disabled = auth()->user()->getRoleNames()->first() === 'admin' ? false : true;
    // } else {
    //     $disabled = false;
    // }
@endphp

<div class="grid gap-2">
    <div class="flex items-center">
        <label
            class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70">{{ $label }}</label>
    </div>
    <input @class([
        'flex h-9 w-full rounded-md border border-input bg-transparent px-3 py-1 text-sm shadow-sm transition-colors file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:cursor-not-allowed disabled:opacity-50',
        'border-red-600' => $errors->has($name),
    ]) @disabled($disabled) wire:model.lazy="{{ $name }}"
        min="{{ $min }}" max="{{ $max }}" type="{{ $type }}"
        placeholder="Masukkan {{ $label }} Anda" />

    @error($name)
        <span class="text-xs text-red-600">{{ $message }}</span>
    @enderror
</div>
