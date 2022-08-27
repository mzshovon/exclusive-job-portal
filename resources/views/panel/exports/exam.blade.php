<table>
    <thead>
    <tr>
        <th>Name</th>
        <th>Description</th>
        <th>Color Code</th>
        <th>Status</th>
        <th>Start Date</th>
        <th>End Date</th>
        <th>Start Time</th>
        <th>End Time</th>
        <th>Duration</th>
        <th>Exam Type</th>
        <th>Created At</th>
        <th>Updated At</th>
    </tr>
    </thead>
    <tbody>
    @foreach($exams as $exam)
        <tr>
            <td>{{ $exam->title }}</td>
            <td>{{ $exam->description }}</td>
            <td>{{ $exam->color }}</td>
            <td>{{ $exam->status == 1 ? 'Active':'Not Active' }}</td>
            <td>{{ $exam->start_date ? Carbon\Carbon::parse($exam->start_date)->format("d-m-Y"): 'No Start Date Assigned Yet' }}</td>
            <td>{{ $exam->end_date ? Carbon\Carbon::parse($exam->end_date)->format("d-m-Y"): 'No Start Date Assigned Yet' }}</td>
            <td>{{ $exam->start_time ? Carbon\Carbon::parse($exam->start_time)->format("A h:i"): 'No Start Date Assigned Yet' }}</td>
            <td>{{ $exam->end_time ? Carbon\Carbon::parse($exam->end_time)->format("A h:i"): 'No Start Date Assigned Yet' }}</td>
            <td>{{ $exam->duration }}</td>
            <td>{{ $exam->exam_type == 1 ? 'Online Test':'IQ Test' }}</td>
            <td>{{ Carbon\Carbon::parse($exam->created_at)->format("d-m-Y") }}</td>
            <td>{{ Carbon\Carbon::parse($exam->updated_at)->format("d-m-Y") }}</td>
        </tr>
    @endforeach
    </tbody>
</table>