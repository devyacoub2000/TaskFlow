@extends('admin.master')

@section('title', 'Tasks')

@section('content')
@if(session('msg'))
<div class="alert alert-{{session('type')}} alert-dismissible fade show" role="alert">
    {{session('msg')}}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

<h1 class="h3 mb-4 text-gray-800">Tasks</h1>

<form method="GET" action="{{ route('admin.task.index') }}" class="form-inline mb-4">
    <select name="team_id" class="form-control mr-2">
        <option value="">All Teams</option>
        @foreach($teams as $team)
        <option value="{{ $team->id }}" {{ request('team_id') == $team->id ? 'selected' : '' }}>
            {{ $team->name }}
        </option>
        @endforeach
    </select>

    <select name="assigned_to" class="form-control mr-2">
        <option value="" disabled>All Users</option>
        @foreach($users as $user)
        <option value="{{ $user->id }}" {{ request('assigned_to') == $user->id ? 'selected' : '' }}>
            {{ $user->name }}
        </option>
        @endforeach
    </select>

    <select name="status" class="form-control mr-2">
        <option value="" disabled>All Status</option>
        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
        <option value="in_progress" {{ request('status') == 'in_progress' ? 'selected' : '' }}>In Progress</option>
        <option value="done" {{ request('status') == 'done' ? 'selected' : '' }}>Done</option>
    </select>

    <select name="priority" class="form-control mr-2">
        <option value="" disabled>All Priority</option>
        <option value="low" {{ request('priority') == 'low' ? 'selected' : '' }}>Low</option>
        <option value="medium" {{ request('priority') == 'medium' ? 'selected' : '' }}>Medium</option>
        <option value="high" {{ request('priority') == 'high' ? 'selected' : '' }}>High</option>
    </select>

    <button type="submit" class="btn btn-primary">
        <i class="fas fa-filter"></i> Filter
    </button>

    <a href="{{ route('admin.task.index') }}" class="btn btn-secondary ml-2">
        <i class="fas fa-sync-alt"></i> Reset
    </a>
</form>

<table class="table table-bordered table-hover">
    <thead class="bg-dark text-white">
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Team</th>
            <th>Assigned To</th>
            <th>Status</th>
            <th>Priority</th>
            <th>Due Date</th>
            <th>Action</th>
        </tr>
    </thead>

    <tbody>
        @forelse($data as $item)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $item->name }}</td>
            <td>{{ $item->team->name ?? '—' }}</td>
            <td>{{ $item->assignedTo->name ?? '—' }}</td>
            <td>
                <span class="badge badge-{{ $item->status == 'done' ? 'success' : ($item->status == 'in_progress' ? 'warning' : 'secondary') }}">
                    {{ ucfirst($item->status) }}
                </span>
            </td>
            <td>
                <span class="badge badge-{{ $item->priority == 'high' ? 'danger' : ($item->priority == 'medium' ? 'info' : 'light') }}">
                    {{ ucfirst($item->priority) }}
                </span>
            </td>
            <td>{{ $item->due_date ?? '—' }}</td>
            <td>
                <a href="{{ route('admin.task.edit', $item->id) }}" class="btn btn-sm btn-info">
                    <i class="fas fa-edit"></i>
                </a>
                <form class="d-inline" action="{{ route('admin.task.destroy', $item->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                        <i class="fas fa-trash"></i>
                    </button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="8" class="text-center">No Tasks Found</td>
        </tr>
        @endforelse
    </tbody>
</table>

{{ $data->links() }}

@endsection