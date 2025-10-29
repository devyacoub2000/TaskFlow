@extends('admin.master')

@section('title', 'Team Details')

@section('css')
<style>
    .team-header {
        background: #4e73df;
        color: white;
        padding: 20px;
        border-radius: 8px;
        margin-bottom: 20px;
    }

    .team-header h1,
    .team-header h4 {
        margin: 0;
    }

    .card {
        border-radius: 8px;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        margin-bottom: 20px;
    }

    .card-header {
        background-color: #f8f9fc;
        font-weight: bold;
    }

    .task-item,
    .user-item {
        padding: 10px 15px;
        border-bottom: 1px solid #eee;
    }

    .task-item:last-child,
    .user-item:last-child {
        border-bottom: none;
    }

    .badge-status {
        font-size: 0.85rem;
        padding: 5px 10px;
        border-radius: 12px;
        color: white;
    }

    .badge-pending {
        background-color: gray;
    }

    .badge-in_progress {
        background-color: orange;
    }

    .badge-done {
        background-color: green;
    }
</style>
@endsection

@section('content')

@if(session('msg'))
<div class="alert alert-{{session('type')}} alert-dismissible fade show" role="alert">
    {{session('msg')}}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

<div class="team-header">
    <h1>{{ $team->name }}</h1>
    <h4>{{ $team->body ?? 'No description available' }}</h4>
</div>

<div class="row">
    <!-- Tasks Card -->
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">Tasks</div>
            <div class="card-body">
                @forelse($team->tasks as $task)
                <div class="task-item d-flex justify-content-between align-items-center">
                    <span>{{ $task->name }}</span>
                    <span class="badge badge-status badge-{{ $task->status }}">
                        {{ ucfirst(str_replace('_',' ',$task->status)) }}
                    </span>
                </div>
                @empty
                <p>No tasks found for this team.</p>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Users Card -->
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">Team Members</div>
            <div class="card-body">
                @forelse($team->users as $user)
                <div class="user-item">{{ $user->name }}</div>
                @empty
                <p>No users in this team.</p>
                @endforelse
            </div>
        </div>
    </div>
</div>

@endsection