@props (['label', 'name', 'class', 'info', 'value'])

<div class="mb-10 fv-row">
    <label class="{{$class ?? 'form-label'}}">{{$label ?? $name}}</label>
    <select name="{{$name}}" class="form-control mb-2">
        {{$slot}}
    </select>
    <div class="text-muted fs-7">{{$info ?? ''}}
    </div>
</div>