<div class="space-y-2 {{ $class ?? '' }}" id="input-{{ $name }}-container">
    <label class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70"
           for=":rr:-form-item">
        {{ $label }}
    </label>
    <input @readonly(isset($readonly) ? $readonly : false) id="input-{{ $name }}"
           class="flex h-9 w-full rounded-md border border-input bg-transparent px-3 py-1 text-sm shadow-sm transition-colors file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:cursor-not-allowed disabled:opacity-50"
           placeholder="Masukkan {{ $label }} anda" aria-describedby=":rr:-form-item-description" aria-invalid="false"
           type="{{ $type }}" name="{{ $name }}" value="{{ old($name, $value) }}">

    @if ($errors->has($name))
        <div class="text-red-600 text-xs">
            {{ $errors->first($name) }}
        </div>
    @endif
</div>

@push('scripts')
    <script type="module">
        const disabeldVar = {{ $disabled ?? 'false' }}

        if(disabeldVar)
        {
            $('#input-{{ $name }}').prop('disabled', true)
        }
    </script>
@endpush
