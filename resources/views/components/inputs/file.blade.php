@props([
    'name',
    'label',
    'note' => null,
    'accept' => 'image/*',
    'src' => null,
    'class' => null,
    'disabled' => auth()->user()->getRoleNames()->first() === 'admin' ? false : true,
])

<div class="space-y-2">
    <div class="grid w-full items-center gap-2 {{ $class }}">
        <div class="flex justify-between">
            <label for="{{ $name }}" class="block text-sm font-medium text-gray-700">
                {{ $label }}
                <span class="text-sm text-red-600">{{ $note }}</span>
            </label>

            {{ $slot }}
        </div>
        <input @class([
            'flex h-9 rounded-md border border-input bg-transparent px-3 py-1 text-sm shadow-sm transition-colors file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:cursor-not-allowed disabled:opacity-50 w-full',
            'border-red-600' => $errors->has($name),
        ]) @disabled($disabled) accept="{{ $accept }}" type="file"
            wire:model.lazy="{{ $name }}">
    </div>

    @if ($errors->has($name))
        <div class="text-red-600 text-xs">
            {{ $errors->first($name) }}
        </div>
    @endif
</div>
