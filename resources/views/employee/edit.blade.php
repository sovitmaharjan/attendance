<div>
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div>{{ $error }}</div>
        @endforeach
    @endif
</div>
<a href="{{ route('employee.index') }}">list</a>
<form method="post" action="{{ route('employee.store') }}">
    @csrf
    <label>prefix</label>
    <select name="prefix" required>
        <option value="Mr." {{ $employee->prefix == 'Mr.' ? 'selected' : '' }}>Mr.</option>
        <option value="Ms." {{ $employee->prefix == 'Ms.' ? 'selected' : '' }}>Ms.</option>
        <option value="Mrs." {{ $employee->prefix == 'Mrs.' ? 'selected' : '' }}>Mrs.</option>
    </select>
    <br />
    <label>firstname</label>
    <input type="text" name="firstname" value="{{ $employee->firstname ?? old('firstname') }}" required>
    <br />
    <label>middlename</label>
    <input type="text" name="middlename" value="{{ $employee->middlename ?? old('middlename') }}">
    <br />
    <label>lastname</label>
    <input type="text" name="lastname" value="{{ $employee->lastname ?? old('lastname') }}" required>
    <br />
    <label>gender</label>
    <select name="gender" required>
        <option value="Male" {{ $employee->gender == 'Male' ? 'selected' : '' }}>Male</option>
        <option value="Female" {{ $employee->gender == 'Female' ? 'selected' : '' }}>Female</option>
        <option value="Other" {{ $employee->gender == 'Other' ? 'selected' : '' }}>Other</option>
    </select>
    <br />
    <label>relationship</label>
    <select name="relationship" required>
        <option value="Single" {{ $employee->realtionship == 'Single' ? 'selected' : '' }}>Single</option>
        <option value="Married" {{ $employee->realtionship == 'Married' ? 'selected' : '' }}>Married</option>
        <option value="Divorced" {{ $employee->realtionship == 'Divorced' ? 'selected' : '' }}>Divorced</option>
    </select>
    <br />
    <label>dob</label>
    <input type="text" name="dob" value="{{ $employee->dob->format('Y-m-d') ?? old('dob') }}" required>
    <br />
    <label>join date</label>
    <input type="text" name="join_date" value="{{ $employee->join_date->format('Y-m-d') ?? old('join_date') }}" required>
    <br />
    <label>email</label>
    <input type="text" name="email" value="{{ $employee->email ?? old('email') }}" required>
    <br />
    <label>company</label>
    <select name="company_id" required>
        @foreach ($company as $item)
            <option value="{{ $item->id }}" {{ $item->id == $employee->company_id ? 'selected' : '' }}>{{ $item->name }}</option>
        @endforeach
    </select>
    <br />
    <label>branch</label>
    <select name="branch_id" required>
        @foreach ($branch as $item)
            <option value="{{ $item->id }}" {{ $item->id == $employee->branch_id ? 'selected' : '' }}>{{ $item->name }}</option>
        @endforeach
    </select>
    <br />
    <label>department</label>
    <select name="department_id" required>
        @foreach ($department as $item)
            <option value="{{ $item->id }}" {{ $item->id == $employee->department_id ? 'selected' : '' }}>{{ $item->name }}</option>
        @endforeach
    </select>
    <br />
    <label>login id</label>
    <input type="text" name="login_id" value="{{ $employee->login_id ?? old('login_id') }}" required>
    <br />
    <label>supervisor</label>
    <select name="supervisor" required>
        @foreach ($supervisor as $item)
            <option value="{{ $item->id }}" {{ $item->id == $employee->supervisor ? 'selected' : '' }}>{{ $item->firstname . $item->middlename . $item->lastname }}</option>
        @endforeach
    </select>
    <br />
    <label>status</label>
    <select name="status" required>
        <option value="status1" {{ $employee->status = 'status1' ? 'selected' : '' }}>status1</option>
        <option value="status2" {{ $employee->status = 'status2' ? 'selected' : '' }}>status2</option>
    </select>
    <br />
    <label>type</label>
    <select name="type" required>
        <option value="type1" {{ $employee->type = 'type1' ? 'selected' : '' }}>type1</option>
        <option value="type2" {{ $employee->type = 'type1' ? 'selected' : '' }}>type2</option>
    </select>
    <br />
    <button type="submit">save</button>
</form>
