<table>
    <thead>
    <tr>
        <th>Name</th>
        <th>Description</th>
        <th>Color Code</th>
        <th>Status</th>
        <th>Created At</th>
        <th>Updated At</th>
    </tr>
    </thead>
    <tbody>
    @foreach($subjects as $subject)
        <tr>
            <td>{{ $subject->title }}</td>
            <td>{{ $subject->description }}</td>
            <td>{{ $subject->color }}</td>
            <td>{{ $subject->status == 1 ? 'Active':'Not Active' }}</td>
            <td>{{ Carbon\Carbon::parse($subject->created_at)->format("d-m-Y") }}</td>
            <td>{{ Carbon\Carbon::parse($subject->updated_at)->format("d-m-Y") }}</td>
        </tr>
    @endforeach
    </tbody>
</table>