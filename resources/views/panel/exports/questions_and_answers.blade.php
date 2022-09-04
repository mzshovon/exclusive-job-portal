<table>
    {{-- <thead>
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
    </thead> --}}
    <tbody>
        @foreach ($data->questions as $question)
        <tr>
            <td>{{$question->name}}</td>
            @foreach ($question->answers as $answer)
                <td>{!! $answer->name !!}</td>
                @if ($answer->is_answer == 1)
                    <td>yes</td>
                @endif
            @endforeach
        </tr>
        @endforeach
    </tbody>
</table>

