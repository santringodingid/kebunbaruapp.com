<div class="mb-5 row" wire:ignore>
    <label for="{{ $name }}" class="col-sm-4 col-form-label">{{ $label }}</label>
    <div class="col-sm-8">
        <select wire:model.live="value" class="form-select" data-dropdown-parent="#{{ $parent }}" data-placeholder="Masukkan nama {{ $text }}" id="{{ $name }}">
            <option value="0">.:Pilih nama {{ $text }}:.</option>
            @if($options)
                @foreach($options as $option)
                    <option value="{{ $option->id }}">{{ $option->name ?? $option->village.' - '.$option->city }}
                @endforeach
            @endif
        </select>
    </div>
</div>
@script
<script>
    $('#{{ $name }}').select2()
    $('#{{ $name }}').on('change', function (e){
        let value = e.target.value;
        if($(this).val() === '0') {
            value = null;
        }
        $wire.$set('value', value)
    })
</script>
@endscript
