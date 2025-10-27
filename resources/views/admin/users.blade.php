@extends('admin.master')

@section('title', 'User Management')

@section('content')

<h1 class="h3 mb-4 text-gray-800">Users Management</h1>
<table class="table table-bordered table-hover">
    <tr class="bg-dark text-white">
        <th>#</th>
        <th>Name</th>
        <th>Email</th>
        <th>Current Team </th>
        <th>Team Change </th>
    </tr>

    @forelse($data as $item)
    <tr>
        <td>{{$loop->iteration}}</td>
        <td>{{$item->name}}</td>
        <td>{{$item->email}}</td>
        <td>{{$item->team->name ?? 'No Team'}}</td>
        <td>
            <form class="d-inline"
                action="{{route('admin.select_user', $item->id)}}"
                enctype="multipart/form-data" method="POST">
                @csrf
                @method('PUT')

                <select name="team_id" class="mb-1 form-control" onchange="this.form.submit()">
                    <option value="Select Team" disabled> ---- Select --- Team ----</option>
                    @foreach($teams as $team)
                    <option value="{{$team->id}}" {{ $item->team_id == $team->id ? 'selected' : '' }}>
                        {{$team->name}}
                    </option>
                    @endforeach

                </select>

            </form>
        </td>
    </tr>

    @empty

    <tr>
        <td colspan="5" class="text-center"> No Data Found </td>
    </tr>

    @endforelse
</table>

{{$data->links()}}

@endsection