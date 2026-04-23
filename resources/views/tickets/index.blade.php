@extends('layouts.app')

@section('title', 'Tickets - Security Lab')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>All Tickets</h1>
    <a href="{{ route('tickets.create') }}" class="btn btn-primary">Create New Ticket</a>
</div>

<div class="table-responsive">
    <table class="table table-striped table-hover align-middle">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Priority</th>
                <th>Status</th>
                <th>Created At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($tickets as $ticket)
            <tr>
                <td>{{ $ticket->id }}</td>
                <td>{{ $ticket->title }}</td>
                <td>
                    <span class="badge bg-{{ $ticket->priority == 'high' ? 'danger' : ($ticket->priority == 'medium' ? 'warning text-dark' : 'info text-dark') }}">
                        {{ ucfirst($ticket->priority) }}
                    </span>
                </td>
                <td>
                    <span class="badge bg-{{ $ticket->status == 'open' ? 'success' : 'secondary' }}">
                        {{ ucfirst($ticket->status) }}
                    </span>
                </td>
                <td>{{ $ticket->created_at->format('d M Y, H:i') }}</td>
                <td>
                    <a href="{{ route('tickets.edit', $ticket->id) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                    <form action="{{ route('tickets.destroy', $ticket->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this ticket?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center">No tickets found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
