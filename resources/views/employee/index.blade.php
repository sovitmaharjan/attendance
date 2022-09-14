<a href="{{ route('employee.create') }}">create</a>
<table border="1px solid">
    <tr>
        <th>s.n.</th>
        <th>name</th>
    </tr>
    @foreach ($employee as $key => $value)
        <tr>
            <th>{{ $key + 1 }}</th>
            <th>{{ $value->firstname . $value->middlename . $value->lastname }}</th>
            <th><a href="{{ route('employee.edit', $value->id) }}">edit</a> <form id="delete{{ $value->id }}" method="post" action="{{ route('employee.destroy', $value->id) }}">@csrf @method('delete')</form> <a href="javascript:void(0)" onclick="document.getElementById('delete' + {{ $value->id }}).submit()">delete</a></th>
        </tr>
    @endforeach
</table>