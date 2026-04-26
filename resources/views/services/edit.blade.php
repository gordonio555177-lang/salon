@extends('layouts.app')

@section('content')
<h1>Edit Service</h1>

<form action="{{ route('services.update', $service->id) }}" method="POST">
    @csrf
    @method('PUT')
    
    <div class="form-group">
        <label>Service Name:</label>
        <input type="text" name="name" value="{{ $service->name }}" required>
    </div>
    
    <div class="form-group">
        <label>Price:</label>
        <input type="text" name="price" value="{{ $service->price }}" required>
    </div>
    
    <div class="form-group">
        <label>Duration:</label>
        <input type="text" name="duration" value="{{ $service->duration }}" required>
    </div>
    
    <div class="form-group">
        <label>Description:</label>
        <textarea name="description">{{ $service->description }}</textarea>
    </div>
    
    <button type="submit" class="btn-update">Update Service</button>
    <a href="{{ route('services.index') }}" class="btn-back">Back</a>
</form>
@endsection