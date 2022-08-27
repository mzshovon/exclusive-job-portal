<table>
    <thead>
    <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Mobile</th>
        <th>Sex</th>
        <th>Blood Group</th>
        <th>Packages</th>
        <th>Date Of Birth</th>
        <th>IP Address</th>
        <th>Status</th>
        <th>Created At</th>
        <th>Updated At</th>
    </tr>
    </thead>
    <tbody>
    @foreach($users as $user)
        <tr>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->mobile }}</td>
            <td>{{ $user->profile ? $user->profile->sex : "Not fillup yet" }}</td>
            <td>{{ $user->profile ? $user->profile->blood_group : "Not fillup yet" }}</td>
            <td>{{ $user->profile ? $user->profile->packages : "Not fillup yet" }}</td>
            <td>{{ $user->profile ?  $user->profile->date_of_birth : "Not fillup yet" }}</td>
            <td>{{ $user->profile ?  $user->profile->ip_address : "Not fillup yet" }}</td>
            <td>{{ $user->status == 1 ? 'Active':'Not Active' }}</td>
            <td>{{ Carbon\Carbon::parse($user->created_at)->format("d-m-Y") }}</td>
            <td>{{ Carbon\Carbon::parse($user->updated_at)->format("d-m-Y") }}</td>
        </tr>
    @endforeach
    </tbody>
</table>