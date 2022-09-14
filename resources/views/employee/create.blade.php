<div>
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div>{{ $error }}</div>
        @endforeach
    @endif
</div>
<form method="post" action="{{ route('employee.store') }}">
    @csrf
    <label>prefix</label>
    <select name="prefix" required>
        <option value="Mr.">Mr.</option>
        <option value="Ms.">Ms.</option>
        <option value="Mrs.">Mrs.</option>
    </select>
    <br />
    <label>firstname</label>
    <input type="text" name="firstname" required>
    <br />
    <label>middlename</label>
    <input type="text" name="middlename">
    <br />
    <label>lastname</label>
    <input type="text" name="lastname" required>
    <br />
    <label>gender</label>
    <select name="gender" required>
        <option value="Male">Male</option>
        <option value="Female">Female</option>
        <option value="Other">Other</option>
    </select>
    <br />
    <label>relationship</label>
    <select name="relationship" required>
        <option value="Single">Single</option>
        <option value="Married">Married</option>
        <option value="Divorced">Divorced</option>
    </select>
    <br />
    <label>dob</label>
    <input type="text" name="dob" required>
    <br />
    <label>join date</label>
    <input type="text" name="join_date" required>
    <br />
    <label>email</label>
    <input type="text" name="email" required>
    <br />
    <label>company</label>
    <select name="company_id" required>
        @foreach ($company as $item)
            <option value="{{ $item->id }}">{{ $item->name }}</option>
        @endforeach
    </select>
    <br />
    <label>branch</label>
    <select name="branch_id" required>
        @foreach ($branch as $item)
            <option value="{{ $item->id }}">{{ $item->name }}</option>
        @endforeach
    </select>
    <br />
    <label>department</label>
    <select name="department_id" required>
        @foreach ($department as $item)
            <option value="{{ $item->id }}">{{ $item->name }}</option>
        @endforeach
    </select>
    <br />
    <label>login id</label>
    <input type="text" name="login_id" required>
    <br />
    <label>supervisor</label>
    <select name="supervisor" required>
        @foreach ($supervisor as $item)
            <option value="{{ $item->id }}">{{ $item->firstname . $item->middlename . $item->lastname }}</option>
        @endforeach
    </select>
    <br />
    <label>status</label>
    <select name="status" required>
        <option value="status1">status1</option>
        <option value="status2">status2</option>
    </select>
    <br />
    <label>type</label>
    <select name="type" required>
        <option value="type1">type1</option>
        <option value="type2">type2</option>
    </select>
    <br />
    <button type="submit">save</button>
</form>
