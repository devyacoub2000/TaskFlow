@extends('admin.master')

@section('title', 'Create Task')

@section('content')
<h1 class="h3 mb-4 text-gray-800">Create Task</h1>

<form action="{{ route('admin.task.store') }}" method="POST">
    @csrf

    {{-- Task Name --}}
    <div class="mb-3">
        <label for="name">Task Name</label>
        <input type="text" name="name" placeholder="Task Name"
            value="{{ old('name') }}"
            class="form-control @error('name') is-invalid @enderror">
        @error('name')
        <small class="invalid-feedback">{{ $message }}</small>
        @enderror
    </div>

    {{-- Task Description --}}
    <div class="mb-3">
        <label for="body">Task Description</label>
        <textarea name="body" rows="4" placeholder="Task Description"
            class="form-control @error('body') is-invalid @enderror">{{ old('body') }}</textarea>
        @error('body')
        <small class="invalid-feedback">{{ $message }}</small>
        @enderror
    </div>

    {{-- Team --}}
    <div class="mb-3">
        <label for="team_id">Team</label>
        <select name="team_id" class="form-control @error('team_id') is-invalid @enderror">
            <option value="" disabled>-- Select Team --</option>
            @foreach ($teams as $team)
                <option value="{{ $team->id }}" 
                {{ old('team_id') == $team->id ? 'selected' : '' }}>
                    {{ $team->name }}
                </option>
            @endforeach
        </select>
        @error('team_id')
        <small class="invalid-feedback">{{ $message }}</small>
        @enderror
    </div>

    {{-- Assigned To --}}
    <div class="mb-3">
        <label for="assigned_to">Assigned To (User)</label>
        <select name="assigned_to" class="form-control @error('assigned_to') is-invalid @enderror">
            <option value="" disabled>-- Select User --</option>
            @foreach ($users as $user)
                <option value="{{ $user->id }}"
                 {{ old('assigned_to') == $user->id ? 'selected' : '' }}>
                    {{ $user->name }}
                </option>
            @endforeach
        </select>
        @error('assigned_to')
        <small class="invalid-feedback">{{ $message }}</small>
        @enderror
    </div>

    {{-- Status --}}
    <div class="mb-3">
        <label for="status">Status</label>
        <select name="status" class="form-control @error('status') is-invalid @enderror">
            <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
            <option value="in_progress" {{ old('status') == 'in_progress' ? 'selected' : '' }}>In Progress</option>
            <option value="done" {{ old('status') == 'done' ? 'selected' : '' }}>Done</option>
        </select>
        @error('status')
        <small class="invalid-feedback">{{ $message }}</small>
        @enderror
    </div>

    {{-- Priority --}}
    <div class="mb-3">
        <label for="priority">Priority</label>
        <select name="priority" class="form-control @error('priority') is-invalid @enderror">
            <option value="low" {{ old('priority') == 'low' ? 'selected' : '' }}>Low</option>
            <option value="medium" {{ old('priority') == 'medium' ? 'selected' : '' }}>Medium</option>
            <option value="high" {{ old('priority') == 'high' ? 'selected' : '' }}>High</option>
        </select>
        @error('priority')
        <small class="invalid-feedback">{{ $message }}</small>
        @enderror
    </div>

    {{-- Due Date --}}
    <div class="mb-3">
        <label for="due_date">Due Date</label>
        <input type="date" name="due_date"
            value="{{ old('due_date') }}"
            class="form-control @error('due_date') is-invalid @enderror">
        @error('due_date')
        <small class="invalid-feedback">{{ $message }}</small>
        @enderror
    </div>

    {{-- Submit --}}
    <div class="mb-3">
        <button class="btn btn-success">
            <i class="fas fa-save"></i> Save Task
        </button>
        <a href="{{ route('admin.task.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back
        </a>
    </div>

</form>
@endsection
