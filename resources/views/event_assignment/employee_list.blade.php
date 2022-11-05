<div class="table-responsive">
    <table class="table gy-5 gs-7 border rounded align-middle">
        <thead>
            <tr class="fw-bolder fs-6 text-gray-800">
                <th>Event</th>
                <th>Employee</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($employees as $employee)
                <tr>
                    <td>
                        {{ $event->title }}
                    </td>
                    <td>
                        {{ $employee->full_name }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
