@extends('admin.master')

@section('title', 'Tasks')

@section('css')
<style type="text/css">
    .image_task {
        object-fit: cover;
        border-radius: 10px;
        width: 100px;
        height: 100px;
    }
</style>
@endsection

@section('content')

@if(session('msg'))
<div class="alert alert-{{ session('type') }} alert-dismissible fade show" role="alert">
    {{ session('msg') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

<h1 class="h3 mb-4 text-gray-800">Tasks</h1>

<a href="{{ route('admin.task.create') }}" class="btn btn-success mb-3">
    <i class="fas fa-plus"></i> Add New Task
</a>

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
            <td>{{ $item->team?->name ?? '-' }}</td>
            <td>{{ $item->assignedTo?->name ?? '-' }}</td>
            <td>
                @if($item->status == 'pending')
                    <span class="badge badge-warning">Pending</span>
                @elseif($item->status == 'in_progress')
                    <span class="badge badge-info">In Progress</span>
                @else
                    <span class="badge badge-success">Done</span>
                @endif
            </td>
            <td>
                @if($item->priority == 'low')
                    <span class="badge badge-secondary">Low</span>
                @elseif($item->priority == 'medium')
                    <span class="badge badge-primary">Medium</span>
                @else
                    <span class="badge badge-danger">High</span>
                @endif
            </td>
            <td>{{ $item->due_date ?? '-' }}</td>

            <td>
                <a href="{{ route('admin.task.edit', $item->id) }}"
                 class="btn btn-info btn-sm">
                    <i class="fas fa-edit"></i>
                </a>
                <form class="d-inline" action="{{ route('admin.task.destroy', $item->id) }}" method="POST"
                    onsubmit="return confirm('Are you sure you want to delete this task?');">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm">
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
