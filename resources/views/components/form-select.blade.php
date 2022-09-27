@props (['label', 'name', 'class', 'info', 'value'])

<div class="mb-10 fv-row">
    <label class="{{$class ?? 'form-label'}}">{{$label ?? $name}}</label>
    <select name="{{$name}}" class="form-control mb-2" data-control="select2"
            data-hide-search="false" data-placeholder="Select Role">
        {{$slot}}
    </select>
    <div class="text-muted fs-7">{{$info ?? ''}}
    </div>
</div>
