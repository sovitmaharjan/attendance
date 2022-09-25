@props (['label', 'name', 'class', 'placeholder', 'info', 'type', 'value', 'multiple' => false ])

<div class="mb-10 fv-row">
    <label class="{{$class ?? 'form-label'}}">{{$label ?? $name}}</label>
    <input type="{{$type}}" name="{{$name}}" class="form-control mb-2"
           placeholder="{{$placeholder ?? ''}}"
           value="{{ $value ?? old($name) }}"
           @if ($type == 'number') min="1" @endif {{ $multiple ? 'multiple' : '' }} />
    <div class="text-muted fs-7">{{$info ?? ''}}
    </div>
    @error($name)
    <div class="fv-plugins-message-container invalid-feedback">
        <div data-field="{{$name}}" data-validator="notEmpty">{{ $message }}</div>
    </div>
    @enderror
</div>