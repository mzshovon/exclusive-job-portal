<table>
    <thead>
    <tr>
        <th>Name</th>
        <th>Description</th>
        <th>Status</th>
        <th>Type</th>
        @foreach ($data->questions as $question)
            <th>Question  {{$loop->iteration}}</th>
            @foreach ($question->answers as $answer)
                <td>Option  {{$loop->iteration}}</td>
                <td>Is Answer  {{$loop->iteration}}</td>
            @endforeach
        @endforeach
        <th>Created At</th>
        <th>Updated At</th>
    </tr>
    </thead>
    <tbody>
        <tr>
            <td>{{ $data->title }}</td>
            <td>{{ $data->description }}</td>
            <td>{{ $data->status == 1 ? 'Active':'Not Active' }}</td>
            <td>{{ $data->questions->first()->type == 1 ? 'Mcq':'Written' }}</td>
            @foreach ($data->questions as $question)
                <td>{{$question->name}}</td>
                @foreach ($question->answers as $answer)
                    <td>{!! $answer->name !!}</td>
                    <td>{{$answer->is_answer == 1? 'Yes':'No'}}</td>
                @endforeach
            @endforeach
            <td>{{ Carbon\Carbon::parse($data->updated_at)->format("d-m-Y") }}</td>
            <td>{{ Carbon\Carbon::parse($data->created_at)->format("d-m-Y") }}</td>
            <td>{{ Carbon\Carbon::parse($data->updated_at)->format("d-m-Y") }}</td>
        </tr>
    </tbody>
</table>