<div class="space-y-2 px">
    @if(!isset($readonly))
        <label class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70">
            {{ $label }}
        </label>
        <select
                class="flex h-9 w-full rounded-md border border-input bg-transparent px-3 py-1 text-sm shadow-sm transition-colors file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:cursor-not-allowed disabled:opacity-50"
                aria-describedby=":rr:-form-item-description" aria-invalid="false" name="{{ $name }}">
            @foreach ($options as $value => $text)
                <option value="{{ $value }}"
                        {{ old($name, $selected) == $value || isset($selected[$value]) ? 'selected' : '' }}>{{ ucfirst($text) }}
                </option>
            @endforeach
        </select>
    @else
        @php
            $value = null;
            foreach ($options as $optionValue => $optionText) {
                if (old($name, $selected) == $optionValue || isset($selected[$optionValue])) {
                    $value = $optionText;
                    break;
                }
            }
        @endphp
        <x-inputs.input :label="$label" type="text" :name="$name" value="{{$value ? ucfirst($value) : ''}}"
                        :readonly="true"/>
    @endif

    @if ($errors->has($name))
        <div class="text-red-600 text-xs">
            {{ $errors->first($name) }}
        </div>
    @endif
</div>
