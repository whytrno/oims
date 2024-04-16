@if (isset($readonly) && $readonly === 'false')
    <div class="grid w-full items-center gap-2 {{ isset($class) ? $class : '' }}">
        <label for="{{ $name }}" class="block text-sm font-medium text-gray-700">
            {{ $label }}
        </label>
        <input
            class="flex h-9 rounded-md border border-input bg-transparent px-3 py-1 text-sm shadow-sm transition-colors file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:cursor-not-allowed disabled:opacity-50 w-full"
            id="{{ $name }}" accept="{{ $accept }}" type="file" name="{{ $name }}">
    </div>
@else
    <x-inputs.input :label="$label" type="text" :name="$name" value="{{ $value }}" :readonly="true" />
@endif

@if ($errors->has($name))
    <div class="text-red-600 text-xs">
        {{ $errors->first($name) }}
    </div>
@endif
