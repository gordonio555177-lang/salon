@extends('layouts.app')

@section('content')
<h1>Book New Appointment</h1>

<form action="{{ route('appointments.store') }}" method="POST">
    @csrf
    
    <div class="form-group">
        <label>Customer Name:</label>
        <input type="text" name="customer_name" required>
    </div>
    
    <div class="form-group">
        <label>Customer Email:</label>
        <input type="email" name="customer_email" required>
    </div>
    
    <div class="form-group">
        <label>Customer Phone:</label>
        <input type="text" name="customer_phone" required>
    </div>
    
    <div class="form-group">
        <label>Select Service:</label>
        <select name="service_id" required>
            <option value="">Choose a service</option>
            @foreach($services as $service)
                <option value="{{ $service->id }}">{{ $service->name }} - {{ number_format($service->price, 2) }} ({{ $service->duration }})</option>
            @endforeach
        </select>
    </div>
    
    <div class="form-group">
        <label>Appointment Date:</label>
        <input type="date" name="appointment_date" required>
    </div>
    
    <div class="form-group">
        <label>Appointment Time:</label>
        <input type="time" name="appointment_time" required>
    </div>
    
    <button type="submit" class="btn-submit">Book Appointment</button>
    <a href="{{ route('appointments.index') }}" class="btn-back">Cancel</a>
</form>
@endsection