
@props(['col', 'label', 'name', 'info', 'value', 'type', 'placeholder', 'class', 'multiple'=>false])

<div class="col-{{$col}} mb-10">
    <label class="{{$class ?? 'form-label'}}">{{$label ?? $name}}</label>
    <input type="{{$type}}" name="{{$name}}" class="form-control mb-2"
        @if ($type == 'number') min="1" @endif {{ $multiple ? 'multiple' : '' }}
        placeholder="{{$placeholder ?? ''}}" value="{{ $value ?? old($name) }}" />
        <div class="text-muted fs-7">{{$info ?? ''}}</div>
    @error($name)
        <div class="fv-plugins-message-container invalid-feedback">
            <div data-field="{{$name}}" data-validator="notEmpty">{{ $message }}</div>
        </div>
    @enderror
</div>