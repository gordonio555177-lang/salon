@extends('layouts.app')

@section('content')
<h1>Service Management</h1>

<!-- Add Service Form -->
<div class="product-form">
    <h3>Add New Service</h3>
    <form action="{{ route('services.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label>Service Name:</label>
            <input type="text" name="name" required placeholder="e.g., Manicure, Pedicure">
        </div>
        
        <div class="form-group">
            <label>Price:</label>
            <input type="text" name="price" required placeholder="0.00">
        </div>
        
        <div class="form-group">
            <label>Duration:</label>
            <input type="text" name="duration" required placeholder="e.g., 30 mins, 1 hour">
        </div>
        
        <div class="form-group">
            <label>Description:</label>
            <textarea name="description" placeholder="Service description"></textarea>
        </div>
        
        <button type="submit" class="btn-submit">Add Service</button>
    </form>
</div>

<hr>

<!-- Services List -->
<h3>All Services</h3>
<table class="data-table">
    <thead>
        <tr>
            <th>Service Name</th>
            <th>Price</th>
            <th>Duration</th>
            <th>Description</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse($services as $service)
        <tr>
            <td>{{ $service->name }}</td>
            <td>{{ number_format($service->price, 2) }}</td>
            <td>{{ $service->duration }}</td>
            <td>{{ $service->description ?? 'N/A' }}</td>
            <td>
                <a href="{{ route('services.edit', $service->id) }}" class="btn-update" style="padding: 5px 10px; font-size: 14px;">Edit</a>
                <form action="{{ route('services.destroy', $service->id) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="5" style="text-align: center;">No services found</td>
        </tr>
        @endforelse
    </tbody>
</table>
@endsection